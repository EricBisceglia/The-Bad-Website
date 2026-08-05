<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*  quote_authors_get           Fetches a quote author.                                                              */
/*  quote_authors_list          Fetches quote authors.                                                               */
/*  quote_authors_add           Adds a quote author to the database.                                                 */
/*  quote_authors_edit          Edits a quote author.                                                                */
/*  quote_authors_delete        Deletes a quote author.                                                              */
/*                                                                                                                   */
/*  quote_media_get             Fetches a quote media.                                                               */
/*  quote_media_get_authors     Fetches authors attached to a media.                                                 */
/*  quote_media_list            Fetches quote media.                                                                 */
/*  quote_media_add             Adds a quote media to the database.                                                  */
/*  quote_media_edit            Edits a quote media.                                                                 */
/*  quote_media_edit_authors    Updates the authors attached to a quote media.                                       */
/*  quote_media_delete          Deletes a quote media.                                                               */
/*                                                                                                                   */
/*  quote_tags_get              Fetches a quote tag.                                                                 */
/*  quote_tags_list             Fetches quote tags.                                                                  */
/*  quote_tags_add              Adds a quote tag to the database.                                                    */
/*  quote_tags_edit             Edits a quote tag.                                                                   */
/*  quote_tags_delete           Deletes a quote tag.                                                                 */
/*                                                                                                                   */
/*********************************************************************************************************************/

/**
 * Fetches a quote author.
 *
 * @param   int    $author_id  The ID of the quote author.
 *
 * @return  array              An array containing data on the quote author.
 */

function quotes_authors_get( int $author_id ) : ?array
{
  // Sanitize the data
  $author_id = sanitize($author_id, 'int');

  // Stop here if the author does not exist
  if(!$author_id || !database_row_exists('quote_authors', $author_id))
    return null;

  // Fetch the author's data
  $author = query(" SELECT  quote_authors.slug            AS 'qa_slug'      ,
                            quote_authors.name_en         AS 'qa_name_en'   ,
                            quote_authors.name_fr         AS 'qa_name_fr'   ,
                            quote_authors.year_birth      AS 'qa_birth'     ,
                            quote_authors.year_death      AS 'qa_death'     ,
                            quote_authors.description_en  AS 'qa_desc_en'   ,
                            quote_authors.description_fr  AS 'qa_desc_fr'
                      FROM  quote_authors
                      WHERE quote_authors.id = '$author_id' ",
                      fetch_row: true);

  // Prepare the data for display
  $data['id']           = sanitize_output($author_id);
  $data['slug']         = sanitize_output($author['qa_slug']);
  $data['name_en']      = sanitize_output($author['qa_name_en']);
  $data['name_fr']      = sanitize_output($author['qa_name_fr']);
  $data['birth']        = sanitize_output($author['qa_birth']);
  $data['death']        = sanitize_output($author['qa_death']);
  $data['desc_en_raw']  = sanitize_output($author['qa_desc_en']);
  $data['desc_fr_raw']  = sanitize_output($author['qa_desc_fr']);
  $data['desc_en']      = sanitize_output($author['qa_desc_en'], preserve_line_breaks: true);
  $data['desc_fr']      = sanitize_output($author['qa_desc_fr'], preserve_line_breaks: true);

  // Return the prepared data
  return $data;
}




/**
 * Fetches quote authors.
 *
 * @return  array  An array containing the quote authors.
 */

function quote_authors_list() : array
{
  // Get the user's current language
  $lang = string_change_case(user_get_language(), 'lowercase');

  // Fetch the authors
  $authors = query("  SELECT      quote_authors.id                      AS 'qa_id'      ,
                                  quote_authors.slug                    AS 'qa_slug'    ,
                                  quote_authors.name_$lang              AS 'qa_name'    ,
                                  quote_authors.name_en                 AS 'qa_name_en' ,
                                  quote_authors.name_fr                 AS 'qa_name_fr' ,
                                  quote_authors.year_birth              AS 'qa_birth'   ,
                                  quote_authors.year_death              AS 'qa_death'   ,
                                  COALESCE(quote_data.quote_count, 0)   AS 'q_count'    ,
                                  COALESCE(media_data.media_count, 0)   AS 'qma_count'  ,
                                  COALESCE(media_data.media_names, '')  AS 'qma_names'

                      FROM        quote_authors

                      LEFT JOIN
                      (
                        SELECT    author_quotes.author_id,
                                  COUNT(author_quotes.quote_id) AS 'quote_count'
                        FROM
                        (
                          SELECT  quotes.fk_quote_authors AS 'author_id',
                                  quotes.id               AS 'quote_id'
                          FROM    quotes
                          WHERE   quotes.fk_quote_authors > 0

                          UNION

                          SELECT  quote_media_authors.fk_quote_authors  AS 'author_id',
                                  quotes.id                             AS 'quote_id'
                          FROM    quote_media_authors
                          JOIN    quotes
                          ON      quotes.fk_quote_media = quote_media_authors.fk_quote_media
                          WHERE   quotes.fk_quote_media > 0
                     )
                     AS author_quotes
                     GROUP BY author_quotes.author_id
                   )
                   AS quote_data
                   ON quote_data.author_id = quote_authors.id

                   LEFT JOIN
                   (
                     SELECT       quote_media_authors.fk_quote_authors                AS 'author_id'    ,
                                  COUNT(DISTINCT quote_media_authors.fk_quote_media)  AS 'media_count'  ,
                                  GROUP_CONCAT(
                                  quote_media.name_$lang
                                  ORDER BY quote_media.name_$lang ASC
                                  SEPARATOR '|||')                                    AS 'media_names'
                     FROM         quote_media_authors
                     JOIN         quote_media
                     ON           quote_media.id = quote_media_authors.fk_quote_media
                     GROUP BY     quote_media_authors.fk_quote_authors
                   )
                   AS media_data
                   ON media_data.author_id = quote_authors.id

                   ORDER BY quote_authors.name_$lang ASC ");

  // Prepare the data for display
  for($i = 0; $row = query_row($authors); $i++)
  {
    // Quote author data
    $data[$i]['id']       = sanitize_output($row['qa_id']);
    $data[$i]['slug']     = sanitize_output($row['qa_slug']);
    $data[$i]['name']     = sanitize_output($row['qa_name']);
    $data[$i]['sname']    = sanitize_output(string_truncate($row['qa_name'], 25, '...'));
    $data[$i]['name_en']  = sanitize_output($row['qa_name_en']);
    $data[$i]['name_fr']  = sanitize_output($row['qa_name_fr']);
    $data[$i]['birth']    = sanitize_output($row['qa_birth']);
    $data[$i]['death']    = sanitize_output($row['qa_death']);
    $data[$i]['quotes']   = sanitize_output($row['q_count']);
    $data[$i]['media']    = sanitize_output($row['qma_count']);
    $data[$i]['used']     = sanitize_output($row['q_count'] + $row['qma_count']);

    // Quote media
    $media_names = sanitize_output($row['qma_names']);
    $data[$i]['media_list'] = str_replace('|||', '<br>', $media_names);
  }

  // Add the number of rows to the returned data
  $data['rows'] = $i;

  // Return the prepared data
  return $data;
}




/**
 * Adds a quote author to the database.
 *
 * @param   array  $data  An array containing data on the quote author.
 *
 * @return  int           The ID of the added quote author.
 */

function quote_authors_add( array $data ) : int
{
  // Sanitize the data
  $name_en    = sanitize_array_element($data, 'name_en', 'string');
  $name_fr    = sanitize_array_element($data, 'name_fr', 'string');
  $year_birth = sanitize_array_element($data, 'year_birth', 'int');
  $year_death = sanitize_array_element($data, 'year_death', 'int');
  $desc_en    = sanitize_array_element($data, 'desc_en', 'string');
  $desc_fr    = sanitize_array_element($data, 'desc_fr', 'string');

  // Generate a slug for the quote author
  $slug = str_replace(' ', '_', string_truncate($name_en, 100));
  $slug = sanitize(string_change_case(preg_replace('/[^a-z0-9_]/i', '', $slug), 'lowercase'), 'string');

  // Make sure the slug is unique
  $underscores = '';
  while(database_entry_exists('quote_authors', 'slug', $slug.$underscores))
    $underscores .= '_';
  $slug .= $underscores;

  // Add the quote author to the database
  query(" INSERT INTO quote_authors
          SET         quote_authors.slug            = '$slug',
                      quote_authors.name_en         = '$name_en',
                      quote_authors.name_fr         = '$name_fr',
                      quote_authors.year_birth      = '$year_birth',
                      quote_authors.year_death      = '$year_death',
                      quote_authors.description_en  = '$desc_en',
                      quote_authors.description_fr  = '$desc_fr' ");

  // Fetch the newly created quote author's ID
  $quote_author_id = query_id();

  // Return the quote author's ID
  return $quote_author_id;
}




/**
 * Edits a quote author.
 *
 * @param   int    $author_id  The ID of the quote author to edit.
 * @param   array  $data       An array containing data on the quote author.
 *
 * @return  void
 */

function quote_authors_edit(  int   $author_id  ,
                              array $data       ) : void
{
  // Sanitize the data
  $author_id   = sanitize($author_id, 'int');
  $name_en     = sanitize_array_element($data, 'name_en', 'string');
  $name_fr     = sanitize_array_element($data, 'name_fr', 'string');
  $year_birth  = sanitize_array_element($data, 'year_birth', 'int');
  $year_death  = sanitize_array_element($data, 'year_death', 'int');
  $desc_en     = sanitize_array_element($data, 'desc_en', 'string');
  $desc_fr     = sanitize_array_element($data, 'desc_fr', 'string');

  // Stop here if the author does not exist
  if(!$author_id || !database_row_exists('quote_authors', $author_id))
    return;

  // Get rid of the old slug
  query ("  UPDATE  quote_authors
            SET     quote_authors.slug = ''
            WHERE   quote_authors.id   = '$author_id' ");

  // Generate a new slug for the quote author
  $slug = str_replace(' ', '_', string_truncate($name_en, 100));
  $slug = sanitize(string_change_case(preg_replace('/[^a-z0-9_]/i', '', $slug), 'lowercase'), 'string');

  // Edit the quote author
  query(" UPDATE  quote_authors
          SET     quote_authors.slug            = '$slug'       ,
                  quote_authors.name_en         = '$name_en'    ,
                  quote_authors.name_fr         = '$name_fr'    ,
                  quote_authors.year_birth      = '$year_birth' ,
                  quote_authors.year_death      = '$year_death' ,
                  quote_authors.description_en  = '$desc_en'    ,
                  quote_authors.description_fr  = '$desc_fr'
          WHERE   quote_authors.id              = '$author_id' ");
}




/**
 * Deletes a quote author.
 *
 * @param   int    $author_id  The ID of the quote author to delete.
 *
 * @return  bool               Whether the quote author was deleted successfully.
 */

function quote_authors_delete( int $author_id ) : bool
{
  // Sanitize the data
  $author_id = sanitize($author_id, 'int');

  // Check whether the author is linked to any media
  $media = query(" SELECT COUNT(DISTINCT quote_media_authors.id) AS 'qma_id'
                   FROM   quote_media_authors
                   WHERE  quote_media_authors.fk_quote_authors = '$author_id' ",
                   fetch_row: true);

  // Return false if there are still media linked to the author
  if($media['qma_id'] > 0)
    return false;

  // Check whether the author is linked to any quotes
  $quotes = query(" SELECT COUNT(DISTINCT quotes.id) AS 'q_id'
                    FROM   quotes
                    WHERE  quotes.fk_quote_authors = '$author_id' ",
                    fetch_row: true);

  // Return false if there are still quotes linked to the author
  if($quotes['q_id'] > 0)
    return false;

  // Delete the quote author
  query(" DELETE FROM quote_authors
          WHERE       quote_authors.id = '$author_id' ");

  // The author has been deleted
  return true;
}




/**
 * Fetches a quote media.
 *
 * @param   int    $media_id  The ID of the quote media.
 *
 * @return  array             An array containing data on the quote media.
 */

function quote_media_get( int $media_id ) : ?array
{
  // Sanitize the data
  $media_id = sanitize($media_id, 'int');

  // Stop here if the media does not exist
  if(!$media_id || !database_row_exists('quote_media', $media_id))
    return null;

  // Fetch the media's data
  $media = query("  SELECT  quote_media.slug            AS 'qm_slug'      ,
                            quote_media.name_en         AS 'qm_name_en'   ,
                            quote_media.name_fr         AS 'qm_name_fr'   ,
                            quote_media.year_published  AS 'qm_year'      ,
                            quote_media.description_en  AS 'qm_desc_en'   ,
                            quote_media.description_fr  AS 'qm_desc_fr'   ,
                            quote_media.source_en       AS 'qm_source_en' ,
                            quote_media.source_fr       AS 'qm_source_fr'
                      FROM  quote_media
                      WHERE quote_media.id = '$media_id' ",
                      fetch_row: true);

  // Prepare the data for display
  $data['id']             = sanitize_output($media_id);
  $data['slug']           = sanitize_output($media['qm_slug']);
  $data['name_en']        = sanitize_output($media['qm_name_en']);
  $data['name_fr']        = sanitize_output($media['qm_name_fr']);
  $data['year']           = $media['qm_year'] ? sanitize_output($media['qm_year']) : '';
  $data['description_en'] = sanitize_output($media['qm_desc_en']);
  $data['description_fr'] = sanitize_output($media['qm_desc_fr']);
  $data['source_en']      = sanitize_output($media['qm_source_en']);
  $data['source_fr']      = sanitize_output($media['qm_source_fr']);

  // Return the prepared data
  return $data;
}




/**
 * Fetches authors attached to a quote media.
 *
 * @param   int    $media_id  The ID of the media.
 *
 * @return  array             An array containing the authors attached to the media.
 */

function quote_media_get_authors( int $media_id ) : array
{
  // Sanitize the media ID
  $media_id = sanitize($media_id, 'int');

  // Fetch the attached authors
  $authors = query("  SELECT    quote_media_authors.fk_quote_authors AS 'qma_id'
                      FROM      quote_media_authors
                      WHERE     quote_media_authors.fk_quote_media = '$media_id'
                      ORDER BY  quote_media_authors.fk_quote_authors ASC ");

  // Prepare the data for display
  for($i = 0; $row = query_row($authors); $i++)
    $data[$i] = sanitize_output($row['qma_id']);

  // Return the prepared data
  return ($data ?? []);
}




/**
 * Fetches quote media.
 *
 * @return  array  An array containing the quote media.
 */

function quote_media_list() : array
{
  // Get the user's current language
  $lang = string_change_case(user_get_language(), 'lowercase');

  // Fetch the media
  $media = query("  SELECT        quote_media.id                          AS 'qm_id'      ,
                                  quote_media.name_$lang                  AS 'qm_name'    ,
                                  quote_media.name_en                     AS 'qm_name_en' ,
                                  quote_media.name_fr                     AS 'qm_name_fr' ,
                                  quote_media.year_published              AS 'qm_year'    ,
                                  COALESCE(quote_data.quote_count, 0)     AS 'q_count'    ,
                                  COALESCE(author_data.author_count, 0)   AS 'qa_count'   ,
                                  COALESCE(author_data.author_names, '')  AS 'qa_names'

                      FROM   quote_media

                      LEFT JOIN
                      (
                        SELECT    quotes.fk_quote_media AS 'media_id',
                                  COUNT(quotes.id)       AS 'quote_count'
                        FROM      quotes
                        GROUP BY  quotes.fk_quote_media
                      )
                      AS quote_data
                      ON quote_data.media_id = quote_media.id

                      LEFT JOIN
                      (
                        SELECT    quote_media_authors.fk_quote_media  AS 'media_id',
                                  COUNT(quote_media_authors.id)       AS 'author_count',
                                  GROUP_CONCAT(
                                    quote_authors.name_$lang
                                    ORDER BY quote_authors.name_$lang ASC
                                    SEPARATOR '|||'
                                  )                                   AS 'author_names'
                        FROM      quote_media_authors
                        JOIN      quote_authors
                        ON        quote_authors.id = quote_media_authors.fk_quote_authors
                        GROUP BY  quote_media_authors.fk_quote_media
                      )
                      AS author_data
                      ON author_data.media_id = quote_media.id

                      ORDER BY quote_media.name_$lang ASC  ");

  // Prepare the data for display
  for($i = 0; $row = query_row($media); $i++)
  {
    // Quote media data
    $data[$i]['id']       = sanitize_output($row['qm_id']);
    $data[$i]['name']     = sanitize_output($row['qm_name']);
    $data[$i]['sname']    = sanitize_output(string_truncate($row['qm_name'], 25, '...'));
    $data[$i]['name_en']  = sanitize_output($row['qm_name_en']);
    $data[$i]['name_fr']  = sanitize_output($row['qm_name_fr']);
    $data[$i]['year']     = sanitize_output($row['qm_year']);
    $data[$i]['authors']  = sanitize_output($row['qa_count']);
    $data[$i]['quotes']   = sanitize_output($row['q_count']);

    // Quote authors
    $author_names = sanitize_output($row['qa_names']);
    $data[$i]['authors_list'] = str_replace('|||', '<br>', $author_names);
  }

  // Add the number of rows to the returned data
  $data['rows'] = $i;

  // Return the prepared data
  return $data;
}




/**
 * Adds a quote media to the database.
 *
 * @param   array  $data  An array containing data on the quote media.
 *
 * @return  int           The ID of the added quote media.
 */

function quote_media_add( array $data ) : int
{
  // Sanitize the data
  $name_en    = sanitize_array_element($data, 'name_en', 'string');
  $name_fr    = sanitize_array_element($data, 'name_fr', 'string');
  $desc_en    = sanitize_array_element($data, 'desc_en', 'string');
  $desc_fr    = sanitize_array_element($data, 'desc_fr', 'string');
  $source_en  = sanitize_array_element($data, 'source_en', 'string');
  $source_fr  = sanitize_array_element($data, 'source_fr', 'string');
  $year       = sanitize_array_element($data, 'year', 'int');

  // Generate a slug for the quote media
  $slug = str_replace(' ', '_', string_truncate($name_en, 100));
  $slug = sanitize(string_change_case(preg_replace('/[^a-z0-9_]/i', '', $slug), 'lowercase'), 'string');

  // Make sure the slug is unique
  $underscores = '';
  while(database_entry_exists('quote_media', 'slug', $slug.$underscores))
    $underscores .= '_';
  $slug .= $underscores;

  // Add the quote media to the database
  query(" INSERT INTO quote_media
          SET         quote_media.slug            = '$slug'       ,
                      quote_media.name_en         = '$name_en'    ,
                      quote_media.name_fr         = '$name_fr'    ,
                      quote_media.description_en  = '$desc_en'    ,
                      quote_media.description_fr  = '$desc_fr'    ,
                      quote_media.source_en       = '$source_en'  ,
                      quote_media.source_fr       = '$source_fr'  ,
                      quote_media.year_published  = '$year'       ");

  // Fetch the newly created quote media's ID
  $quote_media_id = query_id();

  // Return the quote media's ID
  return $quote_media_id;
}




/**
 * Edits a quote media.
 *
 * @param   int    $media_id  The ID of the quote media to edit.
 * @param   array  $data      An array containing data on the quote media.
 *
 * @return  void
*/

function quote_media_edit(  int   $media_id  ,
                              array $data      ) : void
{
  // Sanitize the data
  $media_id    = sanitize($media_id, 'int');
  $name_en     = sanitize_array_element($data, 'name_en', 'string');
  $name_fr     = sanitize_array_element($data, 'name_fr', 'string');
  $desc_en     = sanitize_array_element($data, 'desc_en', 'string');
  $desc_fr     = sanitize_array_element($data, 'desc_fr', 'string');
  $source_en   = sanitize_array_element($data, 'source_en', 'string');
  $source_fr   = sanitize_array_element($data, 'source_fr', 'string');
  $year        = sanitize_array_element($data, 'year', 'int');

  // Stop here if the media does not exist
  if(!$media_id || !database_row_exists('quote_media', $media_id))
    return;

  // Get rid of the old slug
  query ("  UPDATE  quote_media
            SET     quote_media.slug = ''
            WHERE   quote_media.id   = '$media_id' ");

  // Generate a new slug for the quote media
  $slug = str_replace(' ', '_', string_truncate($name_en, 100));
  $slug = sanitize(string_change_case(preg_replace('/[^a-z0-9_]/i', '', $slug), 'lowercase'), 'string');

  // Edit the quote media
  query(" UPDATE  quote_media
          SET     quote_media.slug            = '$slug'       ,
                  quote_media.name_en         = '$name_en'    ,
                  quote_media.name_fr         = '$name_fr'    ,
                  quote_media.description_en  = '$desc_en'    ,
                  quote_media.description_fr  = '$desc_fr'    ,
                  quote_media.source_en       = '$source_en'  ,
                  quote_media.source_fr       = '$source_fr'  ,
                  quote_media.year_published  = '$year'
          WHERE   quote_media.id              = '$media_id' ");
}




/**
 * Updates the authors attached to a quote media.
 *
 * @param   int    $media_id  The ID of the quote media.
 * @param   array  $authors   An array of author IDs to attach to the quote media.
 *
 * @return  void
 */

function quote_media_edit_authors(  int   $media_id ,
                                    array $authors  ) : void
{
  // Sanitize the media ID
  $media_id = sanitize($media_id, 'int');

  // Stop here if the media does not exist
  if(!$media_id || !database_row_exists('quote_media', $media_id))
    return;

  // Sanitize, validate, and deduplicate the author IDs
  $valid_author_ids = array();
  foreach($authors as $author_id)
  {
    $author_id = sanitize($author_id, 'int');
    if($author_id && database_row_exists('quote_authors', $author_id) && !in_array($author_id, $valid_author_ids))
      $valid_author_ids[] = $author_id;
  }

  // Remove author-media links that should no longer exist
  if(count($valid_author_ids) > 0)
  {
    $valid_author_ids_sql = implode(',', $valid_author_ids);
    query(" DELETE FROM quote_media_authors
            WHERE       quote_media_authors.fk_quote_media        = '$media_id'
            AND         quote_media_authors.fk_quote_authors NOT IN ($valid_author_ids_sql) ");
  }

  // Or remove all author-media links if none are provided
  else
  {
    query(" DELETE FROM quote_media_authors
            WHERE       quote_media_authors.fk_quote_media = '$media_id' ");
  }

  // Add any missing author-media links
  foreach($valid_author_ids as $author_id)
  {
    // Look for missing link
    $check_link = query(" SELECT  COUNT(*) AS 'link_count'
                          FROM    quote_media_authors
                          WHERE   quote_media_authors.fk_quote_media   = '$media_id'
                          AND     quote_media_authors.fk_quote_authors = '$author_id' ",
                          fetch_row: true);

    // Create missing link
    if($check_link['link_count'] == 0)
    {
      query(" INSERT INTO quote_media_authors
              SET         quote_media_authors.fk_quote_media   = '$media_id'  ,
                          quote_media_authors.fk_quote_authors = '$author_id' ");
    }
  }
}




/**
 * Deletes a quote media.
 *
 * @param   int    $media_id  The ID of the quote media to delete.
 *
 * @return  bool              Whether the quote media was deleted successfully.
 */

function quote_media_delete( int $media_id ) : bool
{
  // Sanitize the data
  $media_id = sanitize($media_id, 'int');

  // Check whether the media is linked to any quotes
  $quotes = query(" SELECT COUNT(DISTINCT quotes.id) AS 'q_id'
                    FROM   quotes
                    WHERE  quotes.fk_quote_media = '$media_id' ",
                    fetch_row: true);

  // Return false if there are still quotes linked to the media
  if($quotes['q_id'] > 0)
    return false;

  // Delete any links between the media and authors
  query(" DELETE FROM quote_media_authors
          WHERE       quote_media_authors.fk_quote_media = '$media_id' ");

  // Delete the quote media
  query(" DELETE FROM quote_media
          WHERE       quote_media.id = '$media_id' ");

  // The media has been deleted
  return true;
}




/**
 * Fetches a quote tag.
 *
 * @param   int    $tag_id  The ID of the quote tag.
 *
 * @return  array           An array containing data on the quote tag.
 */

function quote_tags_get( int $tag_id ) : ?array
{
  // Sanitize the data
  $tag_id = sanitize($tag_id, 'int');

  // Stop here if the tag does not exist
  if(!$tag_id || !database_row_exists('quote_tags', $tag_id))
    return null;

  // Fetch the tag's data
  $tag = query("  SELECT  quote_tags.slug           AS 'qt_slug'      ,
                          quote_tags.sorting_order  AS 'qt_sort'      ,
                          quote_tags.name_en        AS 'qt_name_en'   ,
                          quote_tags.name_fr        AS 'qt_name_fr'
                  FROM    quote_tags
                  WHERE   quote_tags.id = '$tag_id' ",
                  fetch_row: true);

  // Prepare the data for display
  $data['id']       = sanitize_output($tag_id);
  $data['slug']     = sanitize_output($tag['qt_slug']);
  $data['sort']     = sanitize_output($tag['qt_sort']);
  $data['name_en']  = sanitize_output($tag['qt_name_en']);
  $data['name_fr']  = sanitize_output($tag['qt_name_fr']);

  // Return the prepared data
  return $data;
}




/**
 * Fetches quote tags.
 *
 * @return  array  An array of quote tags.
 */

function quote_tags_list() : array
{
  // Get the user's current language
  $lang = string_change_case(user_get_language(), 'lowercase');

  // Fetch the tags
  $tags = query(" SELECT      quote_tags.id             AS 'qt_id'      ,
                              quote_tags.slug           AS 'qt_slug'    ,
                              quote_tags.sorting_order  AS 'qt_sort'    ,
                              quote_tags.name_$lang     AS 'qt_name'    ,
                              quote_tags.name_en        AS 'qt_name_en' ,
                              quote_tags.name_fr        AS 'qt_name_fr' ,
                              COUNT(quote_tag_links.id) AS 'ql_count'
                    FROM      quote_tags
                    LEFT JOIN quote_tag_links ON quote_tag_links.fk_quote_tags = quote_tags.id
                    GROUP BY  quote_tags.id
                    ORDER BY  quote_tags.sorting_order ASC ");

  // Prepare the data for display
  for($i = 0; $row = query_row($tags); $i++)
  {
    $data[$i]['id']       = sanitize_output($row['qt_id']);
    $data[$i]['slug']     = sanitize_output($row['qt_slug']);
    $data[$i]['sort']     = sanitize_output($row['qt_sort']);
    $data[$i]['name']     = sanitize_output($row['qt_name']);
    $data[$i]['sname']    = sanitize_output(string_truncate($row['qt_name'], 25, '...'));
    $data[$i]['quotes']   = sanitize_output($row['ql_count']);
    $data[$i]['name_en']  = sanitize_output($row['qt_name_en']);
    $data[$i]['name_fr']  = sanitize_output($row['qt_name_fr']);
  }

  // Add the number of rows to the returned data
  $data['rows'] = $i;

  // Return the prepared data
  return ($data ?? []);
}




/**
 * Adds a quote tag to the database.
 *
 * @param   array  $data  An array containing data on the quote tag.
 *
 * @return  int           The ID of the added quote tag.
 */

function quote_tags_add( array $data ) : int
{
  // Sanitize the data
  $sort     = sanitize_array_element($data, 'sort', 'int');
  $name_en  = sanitize_array_element($data, 'name_en', 'string');
  $name_fr  = sanitize_array_element($data, 'name_fr', 'string');

  // Generate a slug for the quote tag
  $slug = str_replace(' ', '_', string_truncate($name_en, 100));
  $slug = sanitize(string_change_case(preg_replace('/[^a-z0-9_]/i', '', $slug), 'lowercase'), 'string');

  // Make sure the slug is unique
  $underscores = '';
  while(database_entry_exists('quote_tags', 'slug', $slug.$underscores))
    $underscores .= '_';
  $slug .= $underscores;

  // Add the quote tag to the database
  query(" INSERT INTO quote_tags
          SET         quote_tags.slug           = '$slug'       ,
                      quote_tags.sorting_order  = '$sort'       ,
                      quote_tags.name_en        = '$name_en'    ,
                      quote_tags.name_fr        = '$name_fr'    ");

  // Fetch the newly created quote tag's ID
  $quote_tag_id = query_id();

  // Return the quote tag's ID
  return $quote_tag_id;
}




/**
 * Edits a quote tag.
 *
 * @param   int    $tag_id  The ID of the quote tag to edit.
 * @param   array  $data    An array containing data on the quote tag.
 *
 * @return  void
 */

function quote_tags_edit( int   $tag_id ,
                          array $data   ) : void
{
  // Sanitize the data
  $tag_id    = sanitize($tag_id, 'int');
  $sort      = sanitize_array_element($data, 'sort', 'int');
  $name_en   = sanitize_array_element($data, 'name_en', 'string');
  $name_fr   = sanitize_array_element($data, 'name_fr', 'string');

  // Stop here if the tag does not exist
  if(!$tag_id || !database_row_exists('quote_tags', $tag_id))
    return;

  // Get rid of the old slug
  query ("  UPDATE  quote_tags
            SET     quote_tags.slug = ''
            WHERE   quote_tags.id   = '$tag_id' ");

  // Generate a new slug for the quote tag
  $slug = str_replace(' ', '_', string_truncate($name_en, 100));
  $slug = sanitize(string_change_case(preg_replace('/[^a-z0-9_]/i', '', $slug), 'lowercase'), 'string');

  // Edit the quote tag
  query(" UPDATE  quote_tags
          SET     quote_tags.slug           = '$slug'       ,
                  quote_tags.sorting_order  = '$sort'       ,
                  quote_tags.name_en        = '$name_en'    ,
                  quote_tags.name_fr        = '$name_fr'
          WHERE   quote_tags.id             = '$tag_id' ");
}




/**
 * Deletes a quote tag.
 *
 * @param   int    $tag_id  The ID of the quote tag to delete.
 *
 * @return  bool            Whether the quote tag was deleted successfully.
 */

function quote_tags_delete( int $tag_id ) : bool
{
  // Sanitize the data
  $tag_id = sanitize($tag_id, 'int');

  // Check whether the tag is linked to any quotes
  $quotes = query(" SELECT COUNT(DISTINCT quote_tag_links.id) AS 'ql_id'
                    FROM   quote_tag_links
                    WHERE  quote_tag_links.fk_quote_tags = '$tag_id' ",
                    fetch_row: true);

  // Return false if there are still quotes linked to the tag
  if($quotes['ql_id'] > 0)
    return false;

  // Delete the quote tag
  query(" DELETE FROM quote_tags
          WHERE       quote_tags.id = '$tag_id' ");

  // The tag has been deleted
  return true;
}