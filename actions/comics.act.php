<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*  comics_get                    Returns data related to a comic                                                    */
/*  comics_list                   Lists comics                                                                       */
/*  comics_add                    Adds a comic to the database                                                       */
/*  comics_edit                   Modifies an existing comic                                                         */
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
 * @param   int         $comic_id  The comic's ID
 *
 * @return  array|null             An array containing the comic's data, or null if it doesn't exist.
 */

function comics_get( int $comic_id ) : array|null
{
  // Sanitize the comic's id
  $comic_id = sanitize($comic_id, 'int');

  // Return null if the comic does not exist
  if(!database_row_exists('comics', $comic_id))
    return null;

  // Fetch the comics's data
  $comic_data = query(" SELECT  comics.is_public        AS 'c_public'   ,
                                comics.fk_comic_types   AS 'c_type'     ,
                                comics.upload_date      AS 'c_date'     ,
                                comics.title_en         AS 'c_title_en' ,
                                comics.title_fr         AS 'c_title_fr' ,
                                comics.description_en   AS 'c_desc_en'  ,
                                comics.description_fr   AS 'c_desc_fr'
                      FROM      comics
                      WHERE     comics.id = '$comic_id' ",
                      fetch_row: true);

  // Sanitize the data for display
  $data['private']  = sanitize_output(!$comic_data['c_public']);
  $data['type']     = sanitize_output($comic_data['c_type']);
  $data['date']     = sanitize_output($comic_data['c_date']);
  $data['title_en'] = sanitize_output($comic_data['c_title_en']);
  $data['title_fr'] = sanitize_output($comic_data['c_title_fr']);
  $data['desc_en']  = sanitize_output($comic_data['c_desc_en']);
  $data['desc_fr']  = sanitize_output($comic_data['c_desc_fr']);

  // Fetch the comic's tags
  $comic_tags = query(" SELECT  comic_tags.fk_tags AS 'ct_id'
                        FROM    comic_tags
                        WHERE   comic_tags.fk_comics = '$comic_id' ");

  // Prepare the data for display
  for($i = 0; $row = query_row($comic_tags); $i++)
    $data['tags']['id'][$i]   = sanitize_output($row['ct_id']);

  // Add the number of tags to the returned data
  $data['tags']['rows'] = $i;

  // Return the comic's data
  return $data;
}




/**
 * Lists comics.
 *
 * @param   array   $sort_by   How the comics should be sorted.
 * @param   array   $search    The search query.
 *
 * @return  array   An array containing the comics.
 */

function comics_list( $sort_by = 'date'   ,
                      $search  = array()  ) : array
{
  // Sanitize the search parameters
  $search_title   = sanitize_array_element($search, 'title', 'string');
  $search_type    = sanitize_array_element($search, 'type', 'int');
  $search_private = sanitize_array_element($search, 'private', 'int');
  $search_images  = sanitize_array_element($search, 'images', 'int');
  $search_tag_id  = sanitize_array_element($search, 'tag_id', 'int');

  // Fetch the user's current language
  $lang = string_change_case(user_get_language(), 'lowercase');

  // Search through the data
  $query_search = ($search_title)     ? " AND ( comics.title_en  LIKE '%$search_title%'
                                          OR    comics.title_fr  LIKE '%$search_title%' ) " : "";
  $query_search .= ($search_type)     ? " AND comics.fk_comic_types = $search_type "        : "";
  $query_search .= ($search_private)  ? " AND comics.is_public = 0 "                        : "";

  // Different search for tags
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
    default   => "  ORDER BY    comics.upload_date            DESC  ,
                                comics.title_$lang            ASC   ",
  };

  // Fetch the comics
  $comics = query("   SELECT    comics.id                     AS 'c_id'       ,
                                comics.title_$lang            AS 'c_title'    ,
                                comics.title_en               AS 'c_title_en' ,
                                comics.title_fr               AS 'c_title_fr' ,
                                comics.upload_date            AS 'c_date'     ,
                                comics.is_public              AS 'c_public'   ,
                                comic_types.name_$lang        AS 'ct_name'    ,
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
    $data[$i]['title']      = sanitize_output(string_truncate($row['c_title'], 32, '...'));
    $data[$i]['ftitle']     = sanitize_output($row['c_title']);
    $data[$i]['title_en']   = sanitize_output($row['c_title_en']);
    $data[$i]['title_fr']   = sanitize_output($row['c_title_fr']);
    $data[$i]['type']       = sanitize_output($row['ct_name']);
    $data[$i]['date']       = time_since(sanitize_output(strtotime($row['c_date'])));
    $data[$i]['date_full']  = date_to_text(sanitize_output(strtotime($row['c_date'])));
    $data[$i]['private']    = (!$row['c_public']);
    $data[$i]['ntags']      = sanitize_output($row['t_count']);
    $data[$i]['tags']       = sanitize_output($row['t_names']);
    $data[$i]['nimages']    = sanitize_output($row['i_count']);
    $data[$i]['images']     = sanitize_output($row['i_names']);
  }

  // Add the number of rows to the returned data
  $data['rows'] = $i;

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

  // Add the comic to the database
  query(" INSERT INTO comics
          SET         comics.title_en       = '$title_en' ,
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

  // Edit the comic
  query(" UPDATE  comics
          SET     comics.is_public      = '$comic_private'  ,
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

  // Fetch the comic types's data
  $comic_type_data = query("  SELECT  comic_types.sorting_order   AS 'ct_order'     ,
                                      comic_types.name_en         AS 'ct_name_en'   ,
                                      comic_types.name_fr         AS 'ct_name_fr'   ,
                                      comic_types.banner_en       AS 'ct_banner_en' ,
                                      comic_types.banner_fr       AS 'ct_banner_fr' ,
                                      comic_types.description_en  AS 'ct_desc_en'   ,
                                      comic_types.description_fr  AS 'ct_desc_fr'
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
  $data['desc_en']    = sanitize_output($comic_type_data['ct_desc_en']);
  $data['desc_fr']    = sanitize_output($comic_type_data['ct_desc_fr']);

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
  $comic_types = query("  SELECT  comic_types.id            AS 'ct_id'        ,
                                  comic_types.sorting_order AS 'ct_sort'      ,
                                  comic_types.name_$lang    AS 'ct_name'      ,
                                  comic_types.name_en       AS 'ct_name_en'   ,
                                  comic_types.name_fr       AS 'ct_name_fr'   ,
                                  comic_types.banner_en     AS 'ct_banner_en' ,
                                  comic_types.banner_fr     AS 'ct_banner_fr'
                          FROM    comic_types
                          ORDER BY comic_types.sorting_order ASC ");

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

  // Add the comic type to the database
  query(" INSERT INTO comic_types
          SET         comic_types.sorting_order   = '$comic_type_sort'      ,
                      comic_types.name_en         = '$comic_type_name_en'   ,
                      comic_types.name_fr         = '$comic_type_name_fr'   ,
                      comic_types.banner_en       = '$comic_type_banner_en' ,
                      comic_types.banner_fr       = '$comic_type_banner_fr' ,
                      comic_types.description_en  = '$comic_type_desc_en'   ,
                      comic_types.description_fr  = '$comic_type_desc_fr'   ");
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

  // Stop here if the comic type does not exist
  if(!database_row_exists('comic_types', $type_id))
    return;

  // Edit the comic type
  query(" UPDATE  comic_types
          SET     comic_types.sorting_order   = '$type_order'      ,
                  comic_types.name_en         = '$type_name_en'    ,
                  comic_types.name_fr         = '$type_name_fr'    ,
                  comic_types.banner_en       = '$type_banner_en'  ,
                  comic_types.banner_fr       = '$type_banner_fr'  ,
                  comic_types.description_en  = '$type_desc_en'    ,
                  comic_types.description_fr  = '$type_desc_fr'
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