<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*  comics_get                    Returns data related to a comic                                                    */
/*  comics_get_id                 Returns a comic's id from its slug                                                 */
/*  comics_get_random_slug        Returns a random comic's slug                                                      */
/*  comics_list                   Lists comics                                                                       */
/*  comics_add                    Adds a comic to the database                                                       */
/*  comics_edit                   Modifies an existing comic                                                         */
/*  comics_increment_view_count   Increments the view count of a comic                                               */
/*  comics_delete                 Deletes an existing comic                                                          */
/*                                                                                                                   */
/*  comic_types_get               Gets a comic type data                                                             */
/*  comic_types_list              Lists comic types                                                                  */
/*  comic_types_add               Adds a comic type                                                                  */
/*  comic_types_edit              Edits a comic type                                                                 */
/*  comic_types_delete            Deletes a comic type                                                               */
/*                                                                                                                   */
/*********************************************************************************************************************/

/**
 * Returns data related to a comic.
 *
 * @param   int         $comic_id         The comic's ID
 * @param   bool        $show_all_images  Shows all images linked to the comic instead of filtering by language.
 *
 * @return  array|null                    An array containing the comic's data, or null if it doesn't exist.
 */

function comics_get(  int   $comic_id                ,
                      bool  $show_all_images = false ) : array|null
{
  // Sanitize the comic's id
  $comic_id = sanitize($comic_id, 'int');

  // Return null if the comic does not exist
  if(!database_row_exists('comics', $comic_id))
    return null;

  // Get the user's current language
  $lang = string_change_case(user_get_language(), 'lowercase');

  // Fetch the comics's data
  $comic_data = query(" SELECT  comics.is_public          AS 'c_public'   ,
                                comics.fk_comic_types     AS 'c_type'     ,
                                comics.upload_date        AS 'c_date'     ,
                                comics.title_$lang        AS 'c_title'    ,
                                comics.title_en           AS 'c_title_en' ,
                                comics.title_fr           AS 'c_title_fr' ,
                                comics.description_$lang  AS 'c_desc'     ,
                                comics.description_en     AS 'c_desc_en'  ,
                                comics.description_fr     AS 'c_desc_fr'  ,
                                comic_types.banner_$lang  AS 'ct_banner'  ,
                                comic_types.name_$lang    AS 'ct_name'
                      FROM      comics
                      LEFT JOIN comic_types
                      ON        comic_types.id = comics.fk_comic_types
                      WHERE     comics.id = '$comic_id' ",
                      fetch_row: true);

  // Sanitize the data for display
  $data['private']      = sanitize_output(!$comic_data['c_public']);
  $data['type']         = sanitize_output($comic_data['c_type']);
  $data['date']         = sanitize_output($comic_data['c_date']);
  $data['date_full']    = date_to_text($comic_data['c_date'], strip_day: true);
  $data['title']        = sanitize_output($comic_data['c_title']);
  $data['title_en']     = sanitize_output($comic_data['c_title_en']);
  $data['title_fr']     = sanitize_output($comic_data['c_title_fr']);
  $data['page_en']      = sanitize_meta_tags($comic_data['c_title_en']);
  $data['page_fr']      = sanitize_meta_tags($comic_data['c_title_fr']);
  $data['desc']         = sanitize_output($comic_data['c_desc'], preserve_line_breaks: true);
  $data['desc_en']      = sanitize_output($comic_data['c_desc_en']);
  $data['desc_fr']      = sanitize_output($comic_data['c_desc_fr']);
  $data['type_name']    = sanitize_output($comic_data['ct_name']);

  // Get the correct banner image
  $root = root_path();
  if($comic_data['ct_banner'] && file_exists($root."img/banners/comics/types/".$comic_data['ct_banner']))
    $data['type_banner'] = "img/banners/comics/types/".$comic_data['ct_banner'];
  else
    $data['type_banner'] = "img/templates/comic_type_".$lang;

  // Prepare a condition for the images linked to the comic
  $query_where = ($show_all_images ===  true) ? " "
                                              : " AND images.language  LIKE '$lang'
                                                  AND images.is_a_preview = 0 ";

  // Prepare the query to fetch images linked to the comic
  $comic_query_start  = " SELECT    images.id           AS 'i_id'     ,
                                    images.name         AS 'i_name'   ,
                                    images.language     AS 'i_lang'   ,
                                    images.transcript   AS 'i_trans'  ,
                                    images.is_nsfw      AS 'i_nsfw'   ,
                                    images.is_a_preview AS 'i_preview'
                          FROM      images
                          WHERE     images.fk_comics = '$comic_id' ";
  $comic_query_end    = " ORDER BY  images.is_a_preview DESC  ,
                                    images.image_order  ASC   ,
                                    images.name         ASC   ,
                                    images.language     ASC   ";
  $comic_query        = $comic_query_start.$query_where.$comic_query_end;


  // Check for results
  $comic_images = query($comic_query, fetch_row: true);

  // If there are no images, try the opposite language
  if(!isset($comic_images['i_id']))
  {
    // Determine the opposite language
    $opposite_lang  = ($lang === 'en') ? 'fr' : 'en';

    // Rewrite the query condition
    $query_where    = ($show_all_images ===  true) ? " "
                                                   : " AND images.language  LIKE '$opposite_lang'
                                                       AND images.is_a_preview = 0 ";

    // Rewrite the updated query
    $comic_query = $comic_query_start.$query_where.$comic_query_end;
  }

  // Fetch images linked to the comic
  $comic_images = query($comic_query);

  // Prepare the data for display
  $transcript_count = 0;
  for($i = 0; $row = query_row($comic_images); $i++)
  {
    $data['images']['id'][$i]       = sanitize_output($row['i_id']);
    $data['images']['name'][$i]     = sanitize_output($row['i_name']);
    $data['images']['lang'][$i]     = sanitize_output($row['i_lang']);
    $data['images']['ftrans'][$i]   = sanitize_output($row['i_trans']);
    $data['images']['trans'][$i]    = sanitize_output($row['i_trans'], preserve_line_breaks: true);
    $data['images']['preview'][$i]  = ($row['i_preview'])
                                    ? __('admin_comics_edit_preview')
                                    : __('admin_comics_edit_comic');
    $data['images']['blur'][$i]     = ($row['i_nsfw']) ? ' blurred_container' : '';
    $data['images']['unblur'][$i]   = ($row['i_nsfw']) ? ' onmouseover="unblur_comic(this);"' : '';
    if($row['i_trans'])
      $transcript_count++;
  }

  // Add the number of images to the returned data
  $data['images']['rows']         = $i;
  $data['images']['transcripts']  = $transcript_count;

  // Fetch the comic's tags
  $comic_tags = query(" SELECT    comic_tags.fk_tags  AS 'ct_id'    ,
                                  tags.banner_$lang   AS 't_banner' ,
                                  tags.title_$lang    AS 't_title'
                        FROM      comic_tags
                        LEFT JOIN tags
                        ON        tags.id = comic_tags.fk_tags
                        WHERE     comic_tags.fk_comics = '$comic_id' ");

  // Prepare the data for display
  for($i = 0; $row = query_row($comic_tags); $i++)
  {
    $data['tags']['id'][$i]     = sanitize_output($row['ct_id']);
    $data['tags']['title'][$i]  = sanitize_output($row['t_title']);
    if($row['t_banner'] && file_exists($root."img/banners/comics/tags/".$row['t_banner']))
      $data['tags']['banner'][$i] = "img/banners/comics/tags/".$row['t_banner'];
    else
      $data['tags']['banner'][$i] = "img/templates/tag_".$lang;
  }

  // Add the number of tags to the returned data
  $data['tags']['rows'] = $i;

  // Look up the previous and next comic
  $comics_list = query("  SELECT    comics.id   AS 'c_id' ,
                                    comics.slug AS 'c_slug'
                          FROM      comics
                          LEFT JOIN comic_types
                          ON        comic_types.id        = comics.fk_comic_types
                          WHERE     comics.is_public      = 1
                          AND       comic_types.is_major  = 1
                          ORDER BY  comics.upload_date    DESC  ,
                                    comics.title_$lang    ASC   ");

  // Assemble all comics in an array
  $comic_slugs_id = 0;
  for($i = 0; $row = query_row($comics_list); $i++)
  {
    $comic_slugs[$i]  = $row['c_slug'];
    $comic_slugs_id   = ($row['c_id'] == $comic_id) ? $i : $comic_slugs_id;
  }

  // Get the previous comic's slug
  $data['previous'] = ($comic_slugs_id < $i-1) ? $comic_slugs[$comic_slugs_id + 1] : null;

  // Get the next comic's slug
  $data['next'] = ($comic_slugs_id > 0) ? $comic_slugs[$comic_slugs_id - 1] : null;

  // Return the comic's data
  return $data;
}




/**
 * Returns a comic's id from its slug.
 *
 * @param   string  $slug   The comic's slug.
 *
 * @return  int|null        The comic's id, or null if the slug does not exist.
 */

function comics_get_id( string $slug ) : int|null
{
  // Sanitize the slug
  $slug = sanitize($slug, 'string');

  // Fetch the comic's id
  $comic_id = query(" SELECT  comics.id AS 'c_id'
                      FROM    comics
                      WHERE   comics.slug = '$slug' ",
                      fetch_row: true);

  // If the slug does not exist, return null
  if(!$comic_id)
    return null;

  // Return the comic's id
  return $comic_id['c_id'];
}




/**
 * Returns a random comic's slug.
 *
 * @return  string|null  The comic's slug, or null if there are no comics.
 */

function comics_get_random_slug() : string|null
{
  // Fetch a random public comic of a major type
  $comics = query(" SELECT    comics.slug
                    FROM      comics
                    LEFT JOIN comic_types
                    ON        comic_types.id        = comics.fk_comic_types
                    WHERE     comics.is_public      = 1
                    AND       comic_types.is_major  = 1
                    ORDER BY  RAND()
                    LIMIT     1 ",
                    fetch_row: true);

  // Stop here if there are no comics
  if(!$comics)
    return null;

  // Return the comic's slug
  return $comics['slug'];
}




/**
 * Lists comics.
 *
 * @param   string  $sort_by    How the comics should be sorted.
 * @param   array   $search     The search query.
 * @param   bool    $is_public  Hide private comics.
 * @param   bool    $is_major   Hide minor comics.
 *
 * @return  array   An array containing the comics.
 */

function comics_list( string $sort_by = 'date'  ,
                      array  $search  = array() ,
                      bool   $is_public = false ,
                      bool   $is_major  = false ) : array
{
  // Sanitize the search parameters
  $search_body    = sanitize_array_element($search, 'body', 'string');
  $search_body_en = sanitize_array_element($search, 'body_en', 'string');
  $search_body_fr = sanitize_array_element($search, 'body_fr', 'string');
  $search_title   = sanitize_array_element($search, 'title', 'string');
  $search_type    = sanitize_array_element($search, 'type', 'int');
  $search_private = sanitize_array_element($search, 'private', 'int');
  $search_images  = sanitize_array_element($search, 'images', 'int');
  $search_tag_id  = sanitize_array_element($search, 'tag_id', 'int');

  // Fetch the user's current language
  $lang = string_change_case(user_get_language(), 'lowercase');

  // Search through the data
  $query_search = ($search_title)     ? " AND ( comics.title_en  LIKE '%$search_title%'
                                          OR    comics.title_fr  LIKE '%$search_title%' ) "           : "";
  $query_search .= ($search_type)     ? " AND comics.fk_comic_types = $search_type "                  : "";
  $query_search .= ($search_private)  ? " AND comics.is_public = 0 "                                  : "";
  $query_search .= ($is_public)       ? " AND comics.is_public = 1 "                                  : "";
  $query_search .= ($is_major)        ? " AND comic_types.is_major = 1 "                              : "";
  $query_search .= ($search_body)     ? " AND ( comics.description_en  LIKE '%$search_body%'
                                          OR    comics.description_fr  LIKE '%$search_body%'
                                          OR    comics.title_en        LIKE '%$search_body%'
                                          OR    comics.title_fr        LIKE '%$search_body%'
                                          OR    images.transcript      LIKE '%$search_body%' ) "      : "";
  $query_search .= ($search_body_en)  ? " AND ( comics.title_en        LIKE '%$search_body_en%'
                                          OR    comics.description_en  LIKE '%$search_body_en%'
                                          OR    comic_types.name_en    LIKE '%$search_body_en%'
                                          OR    images.transcript      LIKE '%$search_body_en%' ) "   : "";
  $query_search .= ($search_body_fr)  ? " AND ( comics.title_fr        LIKE '%$search_body_fr%'
                                          OR    comics.description_fr  LIKE '%$search_body_fr%'
                                          OR    comic_types.name_fr    LIKE '%$search_body_fr%'
                                          OR    images.transcript      LIKE '%$search_body_fr%' ) "   : "";

  // Different search for tags and images
  $query_having  = ($search_tag_id)         ? " AND FIND_IN_SET('$search_tag_id', GROUP_CONCAT(tags.id)) > 0  " : "";
  $query_having .= ($search_images === -1)  ? " AND COUNT(DISTINCT images.id) = 0                             " : "";
  $query_having .= ($search_images === 1)   ? " AND COUNT(DISTINCT images.id) > 0                             " : "";

  // Sort the data
  $query_sort = match($sort_by)
  {
    'title'   => "  ORDER BY    comics.title_$lang            ASC   ,
                                comics.upload_date            DESC  ,
                                comics.title_en               ASC   ",
    'type'    => "  ORDER BY    comic_types.sorting_order     ASC   ,
                                comics.upload_date            DESC  ,
                                comics.title_en               ASC   ",
    'private' => "  ORDER BY    comics.is_public              ASC   ,
                                comics.upload_date            DESC  ,
                                comics.title_$lang            ASC   ",
    'images'  => "  ORDER BY    COUNT(DISTINCT images.id)     DESC  ,
                                comics.upload_date            DESC  ,
                                comics.title_$lang            ASC   ",
    'tags'    => "  ORDER BY    COUNT(DISTINCT comic_tags.id) DESC  ,
                                comics.upload_date            DESC  ,
                                comics.title_$lang            ASC   ",
    'views'   => "  ORDER BY    comics.view_count             DESC  ,
                                comics.upload_date            DESC  ,
                                comics.title_$lang            ASC   ",
    default   => "  ORDER BY    comics.upload_date            DESC  ,
                                comics.title_$lang            ASC   ",
  };

  // Fetch the comics
  $comics = query("   SELECT    comics.id                     AS 'c_id'       ,
                                comics.slug                   AS 'c_slug'     ,
                                comics.title_$lang            AS 'c_title'    ,
                                comics.title_en               AS 'c_title_en' ,
                                comics.title_fr               AS 'c_title_fr' ,
                                comics.upload_date            AS 'c_date'     ,
                                comics.is_public              AS 'c_public'   ,
                                comics.view_count             AS 'c_views'    ,
                                comics.description_en         AS 'c_desc_en'  ,
                                comics.description_fr         AS 'c_desc_fr'  ,
                                comic_types.name_$lang        AS 'ct_name'    ,
                                preview_image.name            AS 'pi_name'    ,
                                preview_image.is_nsfw         AS 'pi_nsfw'    ,
                                COUNT(DISTINCT tags.id)       AS 't_count'    ,
                                GROUP_CONCAT(DISTINCT tags.title_$lang ORDER BY tags.sorting_order ASC SEPARATOR ', ')
                                                              AS 't_names'    ,
                                COUNT(DISTINCT images.id)     AS 'i_count'    ,
                                GROUP_CONCAT(DISTINCT images.name ORDER BY images.image_order ASC SEPARATOR ', ')
                                                              AS 'i_names'
                      FROM      comics
                      LEFT JOIN comic_types
                      ON        comic_types.id = comics.fk_comic_types
                      LEFT JOIN comic_tags
                      ON        comic_tags.fk_comics = comics.id
                      LEFT JOIN tags
                      ON        tags.id = comic_tags.fk_tags
                      LEFT JOIN images
                      ON        images.fk_comics = comics.id
                      LEFT JOIN images AS preview_image
                      ON        comics.id                   = preview_image.fk_comics
                      AND       preview_image.is_a_preview  = 1
                      AND       preview_image.language      = '$lang'
                      WHERE     1 = 1
                      $query_search
                      GROUP BY  comics.id
                      HAVING    1 = 1
                      $query_having
                      $query_sort ");

  // Prepare the data for display
  for($i = 0; $row = query_row($comics); $i++)
  {
    $data[$i]['id']         = sanitize_output($row['c_id']);
    $data[$i]['slug']       = sanitize_output($row['c_slug']);
    $data[$i]['url']        = sanitize_output($GLOBALS['website_url'].'comic/'.$row['c_slug']);
    $data[$i]['stitle']     = sanitize_output(string_truncate($row['c_title'], 25, '...'));
    $data[$i]['title']      = sanitize_output(string_truncate($row['c_title'], 38, '...'));
    $data[$i]['ltitle']     = sanitize_output(string_truncate($row['c_title'], 50, '...'));
    $data[$i]['ftitle']     = sanitize_output($row['c_title']);
    $data[$i]['title_en']   = sanitize_output($row['c_title_en']);
    $data[$i]['title_fr']   = sanitize_output($row['c_title_fr']);
    $data[$i]['type']       = sanitize_output($row['ct_name']);
    $data[$i]['date']       = time_since(sanitize_output(strtotime($row['c_date'])));
    $data[$i]['date_full']  = date_to_text(sanitize_output(strtotime($row['c_date'])));
    $data[$i]['date_rss']   = date(DATE_RSS, strtotime($row['c_date']));
    $data[$i]['private']    = (!$row['c_public']);
    $data[$i]['views']      = sanitize_output($row['c_views']);
    $data[$i]['desc_en']    = sanitize_output($row['c_desc_en']);
    $data[$i]['desc_fr']    = sanitize_output($row['c_desc_fr']);
    $data[$i]['preview']    = sanitize_output($row['pi_name']);
    $data[$i]['blur']       = ($row['pi_nsfw']) ? ' blurred_container' : '';
    $data[$i]['unblur']     = ($row['pi_nsfw']) ? ' onmouseover="unblur_comic(this);"' : '';
    $data[$i]['ntags']      = sanitize_output($row['t_count']);
    $data[$i]['tags']       = sanitize_output($row['t_names']);
    $data[$i]['nimages']    = sanitize_output($row['i_count']);
    $data[$i]['images']     = sanitize_output($row['i_names']);
  }

  // Add the number of rows to the returned data
  $data['rows'] = $i;

  // If a search was performed by a user, add the query to the txt file
  if($search_body_fr || $search_body_en)
  {
    // Grab and sanitize the search query
    $user_search = ($search_body_en) ? $search_body_en : $search_body_fr;
    $user_search = addslashes(htmlspecialchars(strip_tags(trim(substr($user_search, 0, 500))), ENT_QUOTES, 'UTF-8'));

    // Determine the text file's path
    $root      = root_path();
    $file_path = $root.'/admin/user_searches.txt';

    // Create the text file if it doesn't exist
    if(!file_exists($file_path))
      file_put_contents($file_path, '');

    // Append the search query to the end of the text file
    file_put_contents($file_path, $user_search."\n", FILE_APPEND);
  }

  // Return the prepared data
  return $data;
}




/**
 * Adds a comic to the database.
 *
 * @param   array   $data   An array containing the comic's data.
 *
 * @return  int             The newly created comic's id
 */

function comics_add( array $data ) : int
{
  // Sanitize the data
  $title_en = sanitize_array_element($data, 'title_en', 'string');
  $title_fr = sanitize_array_element($data, 'title_fr', 'string');
  $type     = sanitize_array_element($data, 'type', 'int');
  $date     = sanitize(date('Y-m-d'), 'string');

  // Generate a slug for the comic
  $slug = str_replace(' ', '_', string_truncate($title_en, 100));
  $slug = sanitize(string_change_case(preg_replace('/[^a-z0-9_]/i', '', $slug), 'lowercase'), 'string');

  // Make sure the slug is unique
  $underscores = '';
  while(database_entry_exists('comics', 'slug', $slug.$underscores))
    $underscores .= '_';
  $slug .= $underscores;

  // Add the comic to the database
  query(" INSERT INTO comics
          SET         comics.slug           = '$slug'     ,
                      comics.title_en       = '$title_en' ,
                      comics.title_fr       = '$title_fr' ,
                      comics.fk_comic_types = '$type'     ,
                      comics.upload_date    = '$date'     ,
                      comics.is_public      = 0           ");

  // Fetch the newly created comic's id
  $comic_id = query_id();

  // Return the comic's id
  return $comic_id;
}




/**
 * Edits an existing comic.
 *
 * @param   int     $comic_id  The id of the comic to edit.
 * @param   array   $data      The data to update the comic with.
 *
 * @return  void
 */

function comics_edit( int   $comic_id ,
                      array $data     ) : void
{
  // Sanitize the comic's id
  $comic_id = sanitize($comic_id, 'int');

  // Stop here if the comic does not exist
  if(!database_row_exists('comics', $comic_id))
    return;

  // Sanitize the data
  $comic_private  = !sanitize_array_element($data, 'private', 'int');
  $comic_type     = sanitize_array_element($data, 'type', 'int');
  $comic_date     = sanitize_array_element($data, 'date', 'string');
  $comic_title_en = sanitize_array_element($data, 'title_en', 'string');
  $comic_title_fr = sanitize_array_element($data, 'title_fr', 'string');
  $comic_desc_en  = sanitize_array_element($data, 'desc_en', 'string');
  $comic_desc_fr  = sanitize_array_element($data, 'desc_fr', 'string');

  // Get rid of the comic's slug
  query(" UPDATE  comics
          SET     comics.slug = ''
          WHERE   comics.id   = '$comic_id' ");

  // Generate a new slug for the comic
  $slug = str_replace(' ', '_', string_truncate($comic_title_en, 100));
  $slug = sanitize(string_change_case(preg_replace('/[^a-z0-9_]/i', '', $slug), 'lowercase'), 'string');

  // Make sure the slug is unique
  $underscores = '';
  while(database_entry_exists('comics', 'slug', $slug.$underscores))
    $underscores .= '_';
  $slug .= $underscores;

  // Edit the comic
  query(" UPDATE  comics
          SET     comics.slug           = '$slug'           ,
                  comics.is_public      = '$comic_private'  ,
                  comics.fk_comic_types = '$comic_type'     ,
                  comics.upload_date    = '$comic_date'     ,
                  comics.title_en       = '$comic_title_en' ,
                  comics.title_fr       = '$comic_title_fr' ,
                  comics.description_en = '$comic_desc_en'  ,
                  comics.description_fr = '$comic_desc_fr'
          WHERE   comics.id             = '$comic_id' ");

  // Get a list of all tags
  $tags_list = tags_list();

  // Go through the tag list
  for($i = 0; $i < $tags_list['rows']; $i++)
  {
    // Sanitize the tag's id
    $tag_id = sanitize($tags_list[$i]['id'], 'int');

    // Check whether tags have been applied
    if(isset($data['tags'][$tag_id]) && $data['tags'][$tag_id] === 1)
    {
      // Look for the tag
      $check_tag = query("  SELECT  comic_tags.fk_tags AS 'ct_id'
                            FROM    comic_tags
                            WHERE   comic_tags.fk_comics = '$comic_id'
                            AND     comic_tags.fk_tags   = '$tag_id' ",
                            fetch_row: true);

      // Create the tag if it is missing
      if(!isset($check_tag['ct_id']))
        query(" INSERT INTO comic_tags
                SET         comic_tags.fk_comics = '$comic_id' ,
                            comic_tags.fk_tags   = '$tag_id' ");
    }

    // Check whether the tag has been deleted
    else
    {
      // Look for the tag
      $check_tag = query("  SELECT  comic_tags.fk_tags AS 'ct_id'
                            FROM    comic_tags
                            WHERE   comic_tags.fk_comics = '$comic_id'
                            AND     comic_tags.fk_tags   = '$tag_id' ",
                            fetch_row: true);

      // Delete the tag if it exists
      if(isset($check_tag['ct_id']))
        query(" DELETE FROM comic_tags
                WHERE       comic_tags.fk_comics = '$comic_id'
                AND         comic_tags.fk_tags   = '$tag_id' ");
    }
  }
}




/**
 * Increments the view count of a comic.
 *
 * @param   int     $comic_id  The id of the comic to increment the view count of.
 *
 * @return  void
 */

function comics_increment_view_count( int $comic_id ) : void
{
  // Sanitize the comic's id
  $comic_id = sanitize($comic_id, 'int');

  // Increment the view count
  query(" UPDATE  comics
          SET     comics.view_count = comics.view_count + 1
          WHERE   comics.id         = '$comic_id' ");
}




/**
 * Deletes an existing comic.
 *
 * @param   int     $comic_id  The id of the comic to delete.
 *
 * @return  void
 */

function comics_delete( int $comic_id )
{
  // Sanitize the comic's id
  $comic_id = sanitize($comic_id, 'int');

  // Delete the comic
  query(" DELETE FROM comics
          WHERE       comics.id = '$comic_id' ");

  // Untag the comic
  query(" DELETE FROM comic_tags
          WHERE       comic_tags.fk_comics = '$comic_id' ");

  // Unlink images
  query(" UPDATE  images
          SET     images.fk_comics    = 0 ,
                  images.image_order  = 0
          WHERE   images.fk_comics    = '$comic_id' ");
}




/**
 * Returns data related to a comic type.
 *
 * @param   int         $comic_type_id  The comic type's ID
 *
 * @return  array|null                  An array containing the comic type's data, or null if it doesn't exist.
 */

function comic_types_get( int $comic_type_id ) : array|null
{
  // Sanitize the comic type's id
  $comic_type_id = sanitize($comic_type_id, 'int');

  // Return null if the comic type does not exist
  if(!database_row_exists('comic_types', $comic_type_id))
    return null;

  // Get the user's current language
  $lang = string_change_case(user_get_language(), 'lowercase');

  // Fetch the comic types's data
  $comic_type_data = query("  SELECT  comic_types.sorting_order     AS 'ct_order'     ,
                                      comic_types.name_en           AS 'ct_name_en'   ,
                                      comic_types.name_fr           AS 'ct_name_fr'   ,
                                      comic_types.banner_$lang      AS 'ct_banner'    ,
                                      comic_types.banner_en         AS 'ct_banner_en' ,
                                      comic_types.banner_fr         AS 'ct_banner_fr' ,
                                      comic_types.description_$lang AS 'ct_desc'      ,
                                      comic_types.description_en    AS 'ct_desc_en'   ,
                                      comic_types.description_fr    AS 'ct_desc_fr'   ,
                                      comic_types.is_major          AS 'ct_major'
                              FROM    comic_types
                              WHERE   comic_types.id = '$comic_type_id' ",
                              fetch_row: true);

  // Sanitize the data for display
  $data['id']         = $comic_type_id;
  $data['order']      = sanitize_output($comic_type_data['ct_order']);
  $data['name_en']    = sanitize_output($comic_type_data['ct_name_en']);
  $data['name_fr']    = sanitize_output($comic_type_data['ct_name_fr']);
  $data['banner_en']  = sanitize_output($comic_type_data['ct_banner_en']);
  $data['banner_fr']  = sanitize_output($comic_type_data['ct_banner_fr']);
  $data['desc']       = sanitize_output($comic_type_data['ct_desc'], preserve_line_breaks: true);
  $data['desc_en']    = sanitize_output($comic_type_data['ct_desc_en']);
  $data['desc_fr']    = sanitize_output($comic_type_data['ct_desc_fr']);
  $data['major']      = sanitize_output($comic_type_data['ct_major']);

  // Get the correct banner images
  $root = root_path();
  if($comic_type_data['ct_banner'] && file_exists($root."img/banners/comics/types/".$comic_type_data['ct_banner']))
    $data['banner'] = "img/banners/comics/types/".$comic_type_data['ct_banner'];
  else
    $data['banner']= "img/templates/comic_type_".$lang;

  // Return the comic type's data
  return $data;
}




/**
 * Lists comic types.
 *
 * @return  array   An array containing the comic types.
 */

function comic_types_list() : array
{
  // Fetch the user's current language
  $lang = string_change_case(user_get_language(), 'lowercase');

  // Fetch the comic types
  $comic_types = query("  SELECT    comic_types.id            AS 'ct_id'        ,
                                    comic_types.sorting_order AS 'ct_sort'      ,
                                    comic_types.name_$lang    AS 'ct_name'      ,
                                    comic_types.name_en       AS 'ct_name_en'   ,
                                    comic_types.name_fr       AS 'ct_name_fr'   ,
                                    comic_types.banner_$lang  AS 'ct_banner'    ,
                                    comic_types.banner_en     AS 'ct_banner_en' ,
                                    comic_types.banner_fr     AS 'ct_banner_fr' ,
                                    comic_types.is_major      AS 'ct_is_major'
                          FROM      comic_types
                          ORDER BY  comic_types.sorting_order ASC ");

  // Prepare the data for display
  for($i = 0; $row = query_row($comic_types); $i++)
  {
    $data[$i]['id']         = sanitize_output($row['ct_id']);
    $data[$i]['sort']       = sanitize_output($row['ct_sort']);
    $data[$i]['name']       = sanitize_output($row['ct_name']);
    $data[$i]['name_en']    = sanitize_output($row['ct_name_en']);
    $data[$i]['name_fr']    = sanitize_output($row['ct_name_fr']);
    $data[$i]['banner_en']  = sanitize_output($row['ct_banner_en']);
    $data[$i]['banner_fr']  = sanitize_output($row['ct_banner_fr']);
    $data[$i]['major_p']    = sanitize_output($row['ct_is_major']) ? ' !' : '';

    // Get the correct banner images
    $root = root_path();
    if($row['ct_banner'] && file_exists($root."img/banners/comics/types/".$row['ct_banner']))
      $data[$i]['banner'] = "img/banners/comics/types/".$row['ct_banner'];
    else
      $data[$i]['banner']= "img/templates/comic_type_".$lang;
  }

  // Add the number of rows to the returned data
  $data['rows'] = $i;

  // Return the prepared data
  return $data;
}




/**
 * Adds a comic type.
 *
 * @param   array   $data   An array containing the comic type's data
 *
 * @return  void
 */

function comic_types_add( array $data ) : void
{
  // Sanitize the data
  $comic_type_sort      = sanitize_array_element($data, 'sort', 'int');
  $comic_type_name_en   = sanitize_array_element($data, 'name_en', 'string');
  $comic_type_name_fr   = sanitize_array_element($data, 'name_fr', 'string');
  $comic_type_banner_en = sanitize_array_element($data, 'banner_en', 'string');
  $comic_type_banner_fr = sanitize_array_element($data, 'banner_fr', 'string');
  $comic_type_desc_en   = sanitize_array_element($data, 'desc_en', 'string');
  $comic_type_desc_fr   = sanitize_array_element($data, 'desc_fr', 'string');
  $comic_type_major     = sanitize_array_element($data, 'major', 'bool');

  // Add the comic type to the database
  query(" INSERT INTO comic_types
          SET         comic_types.sorting_order   = '$comic_type_sort'      ,
                      comic_types.name_en         = '$comic_type_name_en'   ,
                      comic_types.name_fr         = '$comic_type_name_fr'   ,
                      comic_types.banner_en       = '$comic_type_banner_en' ,
                      comic_types.banner_fr       = '$comic_type_banner_fr' ,
                      comic_types.description_en  = '$comic_type_desc_en'   ,
                      comic_types.description_fr  = '$comic_type_desc_fr'   ,
                      comic_types.is_major        = '$comic_type_major'     ");
}




/**
 * Edits a comic type.
 *
 * @param   int     $type_id  The id of the comic type to edit.
 * @param   array   $data     The data to update the comic type with.
 *
 * @return  void
 */

function comic_types_edit( int   $type_id  ,
                           array $data     ) : void
{
  // Sanitize the data
  $type_id        = sanitize($type_id, 'int');
  $type_order     = sanitize_array_element($data, 'order', 'int');
  $type_name_en   = sanitize_array_element($data, 'name_en', 'string');
  $type_name_fr   = sanitize_array_element($data, 'name_fr', 'string');
  $type_banner_en = sanitize_array_element($data, 'banner_en', 'string');
  $type_banner_fr = sanitize_array_element($data, 'banner_fr', 'string');
  $type_desc_en   = sanitize_array_element($data, 'desc_en', 'string');
  $type_desc_fr   = sanitize_array_element($data, 'desc_fr', 'string');
  $type_major     = sanitize_array_element($data, 'major', 'bool');

  // Stop here if the comic type does not exist
  if(!database_row_exists('comic_types', $type_id))
    return;

  // Edit the comic type
  query(" UPDATE  comic_types
          SET     comic_types.sorting_order   = '$type_order'     ,
                  comic_types.name_en         = '$type_name_en'   ,
                  comic_types.name_fr         = '$type_name_fr'   ,
                  comic_types.banner_en       = '$type_banner_en' ,
                  comic_types.banner_fr       = '$type_banner_fr' ,
                  comic_types.description_en  = '$type_desc_en'   ,
                  comic_types.description_fr  = '$type_desc_fr'   ,
                  comic_types.is_major        = '$type_major'
          WHERE   comic_types.id              = '$type_id' ");
}




/**
 * Delete a comic type.
 *
 * @param   int     $comic_type_id  The id of the comic type to delete.
 *
 * @return  void
 */

function comic_types_delete( int $type_id )
{
  // Sanitize the comic type
  $type_id = sanitize($type_id, 'int');

  // Delete the comic type
  query(" DELETE FROM comic_types
          WHERE       comic_types.id = '$type_id' ");

  // Remove any links to the deleted comic type
  query(" UPDATE comics
          SET    comics.fk_comic_types = NULL
          WHERE  comics.fk_comic_types = '$type_id' ");
}