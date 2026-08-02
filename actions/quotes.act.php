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
  $data['id']       = sanitize_output($author_id);
  $data['slug']     = sanitize_output($author['qa_slug']);
  $data['name_en']  = sanitize_output($author['qa_name_en']);
  $data['name_fr']  = sanitize_output($author['qa_name_fr']);
  $data['birth']    = sanitize_output($author['qa_birth']);
  $data['death']    = sanitize_output($author['qa_death']);
  $data['desc_en']  = sanitize_output($author['qa_desc_en'], preserve_line_breaks: true);
  $data['desc_fr']  = sanitize_output($author['qa_desc_fr'], preserve_line_breaks: true);

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
  $authors = query(" SELECT     quote_authors.id          AS 'qa_id'    ,
                                quote_authors.slug        AS 'qa_slug'  ,
                                quote_authors.name_$lang  AS 'qa_name'  ,
                                quote_authors.name_en     AS 'qa_name_en'  ,
                                quote_authors.name_fr     AS 'qa_name_fr'  ,
                                quote_authors.year_birth  AS 'qa_birth' ,
                                quote_authors.year_death  AS 'qa_death'
                      FROM      quote_authors
                      ORDER BY  quote_authors.name_$lang ASC ");

  // Prepare the data for display
  for($i = 0; $row = query_row($authors); $i++)
  {
    $data[$i]['id']       = sanitize_output($row['qa_id']);
    $data[$i]['slug']     = sanitize_output($row['qa_slug']);
    $data[$i]['name']     = sanitize_output($row['qa_name']);
    $data[$i]['sname']    = sanitize_output(string_truncate($row['qa_name'], 25, '...'));
    $data[$i]['name_en']  = sanitize_output($row['qa_name_en']);
    $data[$i]['name_fr']  = sanitize_output($row['qa_name_fr']);
    $data[$i]['birth']    = sanitize_output($row['qa_birth']);
    $data[$i]['death']    = sanitize_output($row['qa_death']);
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
  query ("  UPDATE quote_authors
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