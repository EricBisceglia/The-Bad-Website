<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*  admin_notes_get                     Returns admin notes                                                          */
/*  admin_notes_update                  Updates admin notes                                                          */
/*                                                                                                                   */
/*  admin_ideas_get                     Returns an individual idea                                                   */
/*  admin_ideas_list                    Returns a list of ideas                                                      */
/*  admin_ideas_add                     Adds an idea to the database                                                 */
/*  admin_ideas_edit                    Edits an idea                                                                */
/*  admin_ideas_delete                  Deletes an idea from the database                                            */
/*                                                                                                                   */
/*  admin_idea_types_get                Returns an individual idea type                                              */
/*  admin_idea_types_list               Returns a list of idea types                                                 */
/*  admin_idea_types_add                Adds an idea type to the database                                            */
/*  admin_idea_types_edit               Edits an idea type                                                           */
/*  admin_idea_types_delete             Deletes an idea type from the database                                       */
/*                                                                                                                   */
/*  admin_user_searches_list            Returns a list of user searches                                              */
/*  admin_user_searches_clear           Clears the user search history                                               */
/*                                                                                                                   */
/*********************************************************************************************************************/

/**
 * Returns admin notes.
 *
 * @return  array   An array containing admin notes.
 */

function admin_notes_get() : array
{
  // Fetch the notes
  $notes = query("  SELECT  notes.tasks  AS 'n_tasks'
                    FROM    notes",
                    fetch_row: true);

  // Prepare the data
  $data['tasks']  = sanitize_output($notes['n_tasks']);

  // Return the data
  return $data;
}




/**
 * Updates admin notes.
 *
 * @param   string  $tasks   Tasks.
 *
 * @return  void
 */

function admin_notes_update( string $tasks = '' ) : void
{
  // Sanitize the data
  $tasks = sanitize($tasks, 'string');

  // Update the notes
  query(" UPDATE  notes
          SET     notes.tasks  = '$tasks' ");
}




/**
 * Returns an individual idea.
 *
 * @param   int     $idea_id  The id of the idea to fetch.
 *
 * @return  array   An array containing the idea's data
 */

function admin_ideas_get( int $idea_id ) : ?array
{
  // Sanitize the data
  $idea_id = sanitize($idea_id, 'int');

  // Fetch the idea
  $idea = query("  SELECT   ideas.id    AS 'i_id'  ,
                            ideas.title AS 'i_title'  ,
                            ideas.body  AS 'i_body'
                    FROM    ideas
                    WHERE   ideas.id = '$idea_id' ",
                    fetch_row: true);

  // If the idea doesn't exist, return null
  if(!isset($idea['i_id']))
    return null;

  // Prepare the data
  $data['title'] = sanitize_output($idea['i_title']);
  $data['body']  = sanitize_output($idea['i_body']);

  // Return the data
  return $data;
}




/**
 * Returns a list of ideas.
 *
 * @param   string  $sort_by  How the ideas should be sorted.
 *
 * @return  array   An array containing ideas.
 */

function admin_ideas_list( string $sort_by = 'random' ) : array
{
  // Sanitize the data
  $sort_by = sanitize($sort_by, 'string');

  // Prepare the sorting
  switch($sort_by)
  {
    case 'title':
      $sort_by = 'ideas.title ASC';
      break;
    case 'newest':
      $sort_by = 'ideas.id DESC';
      break;
    case 'oldest':
      $sort_by = 'ideas.id ASC';
      break;
    default:
      $sort_by = 'RAND()';
  }

  // Fetch the ideas
  $ideas = query("  SELECT    ideas.id    AS 'i_id'  ,
                              ideas.title AS 'i_title'  ,
                              ideas.body  AS 'i_body'
                    FROM      ideas
                    ORDER BY  $sort_by ");

  // Prepare the data
  for($i = 0; $row = query_row($ideas); $i++)
  {
    $data['ideas'][$i]['id']    = $row['i_id'];
    $data['ideas'][$i]['title'] = sanitize_output($row['i_title']);
    $data['ideas'][$i]['body']  = sanitize_output($row['i_body'], preserve_line_breaks: true);
  }

  // Add the number of rows to the data
  $data['rows'] = $i;

  // Return the data
  return $data;
}




/**
 * Adds an idea to the database.
 *
 * @param   string  $title   The title of the idea.
 * @param   string  $body    The description of the idea.
 *
 * @return  void
 */

function admin_ideas_add( string $title ,
                          string $body  ) : void
{
  // Sanitize the data
  $title  = sanitize($title, 'string');
  $body   = sanitize($body,  'string');

  // Add the idea
  query(" INSERT INTO ideas
          SET         ideas.title = '$title'  ,
                      ideas.body  = '$body'   ");
}




/**
 * Edits an idea.
 *
 * @param   int     $idea_id  The id of the idea to edit.
 * @param   array   $data     The data to update the idea with.
 *
 * @return  void
 */

function admin_ideas_edit( int    $idea_id ,
                           array  $data    ) : void
{
  // Sanitize the data
  $idea_id    = sanitize($idea_id, 'int');
  $idea_title = sanitize_array_element($data, 'title', 'string');
  $idea_body  = sanitize_array_element($data, 'body', 'string');

  // Make sure the idea exists
  if(!isset($idea_id) && !database_row_exists('ideas', $idea_id))
    return;

  // Update the idea
  query(" UPDATE  ideas
          SET     ideas.title = '$idea_title'  ,
                  ideas.body  = '$idea_body'
          WHERE   ideas.id    = '$idea_id'     ");
}




/**
 * Deletes an idea from the database.
 *
 * @param   int     $idea_id  The id of the idea to delete.
 */

function admin_ideas_delete( int $idea_id ) : void
{
  // Sanitize the data
  $idea_id = sanitize($idea_id, 'int');

  // Delete the idea
  query(" DELETE FROM ideas
          WHERE       ideas.id = '$idea_id' ");
}




/**
 * Returns an individual idea type.
 *
 * @param   int     $idea_type_id  The id of the idea type to fetch.
 *
 * @return  array|null              An array containing the idea type's data, or null if it doesn't exist.
 */

function admin_idea_types_get( int $idea_type_id ) : ?array
{
  // Sanitize the idea type's id
  $idea_type_id = sanitize($idea_type_id, 'int');

  // Return null if the idea type does not exist
  if(!database_row_exists('idea_types', $idea_type_id))
    return null;

  // Fetch the idea types's data
  $idea_type_data = query(" SELECT  idea_types.id             AS 'it_id'      ,
                                    idea_types.sorting_order  AS 'it_sort'    ,
                                    idea_types.name_en        AS 'it_name_en' ,
                                    idea_types.name_fr        AS 'it_name_fr'
                            FROM    idea_types
                            WHERE   idea_types.id = '$idea_type_id' ",
                            fetch_row: true);

  // Sanitize the data for display
  $data['id']         = sanitize_output($idea_type_data['it_id']);
  $data['order']      = sanitize_output($idea_type_data['it_sort']);
  $data['name_en']    = sanitize_output($idea_type_data['it_name_en']);
  $data['name_fr']    = sanitize_output($idea_type_data['it_name_fr']);

  // Return the idea type's data
  return $data;
}




/**
 * Returns a list of idea types.
 *
 * @return  array   An array containing idea types.
 */

function admin_idea_types_list() : array
{
  // Get the user's current language
  $lang = string_change_case(user_get_language(), 'lowercase');

  // Fetch the idea types
  $idea_types = query(" SELECT    idea_types.id             AS 'it_id'    ,
                                  idea_types.sorting_order  AS 'it_sort'  ,
                                  idea_types.name_$lang     AS 'it_name'
                        FROM      idea_types
                        ORDER BY  idea_types.sorting_order ASC ");

  // Prepare the data for display
  for($i = 0; $row = query_row($idea_types); $i++)
  {
    $data[$i]['id']   = sanitize_output($row['it_id']);
    $data[$i]['sort'] = sanitize_output($row['it_sort']);
    $data[$i]['name'] = sanitize_output($row['it_name']);
  }

  // Add the number of rows to the returned data
  $data['rows'] = $i;

  // Return the prepared data
  return $data;
}




/**
 * Adds an idea type to the database.
 *
 * @param   array   $data   An array containing the idea type's data.
 *
 * @return  void
 */

function admin_idea_types_add( array $data ) : void
{
  // Sanitize the data
  $idea_type_sort     = sanitize_array_element($data, 'sort', 'int');
  $idea_type_name_en  = sanitize_array_element($data, 'name_en', 'string');
  $idea_type_name_fr  = sanitize_array_element($data, 'name_fr', 'string');

  // Add the idea type to the database
  query(" INSERT INTO idea_types
          SET         idea_types.sorting_order  = '$idea_type_sort'     ,
                      idea_types.name_en        = '$idea_type_name_en'  ,
                      idea_types.name_fr        = '$idea_type_name_fr'  ");
}




/**
 * Edits an idea type.
 *
 * @param   int     $idea_type_id  The id of the idea type to edit.
 * @param   array   $data          The data to update the idea type with.
 *
 * @return  void
 */

function admin_idea_types_edit( int   $idea_type_id ,
                                array $data         ) : void
{
  // Sanitize the idea type's id
  $idea_type_id = sanitize($idea_type_id, 'int');

  // Stop here if the idea type does not exist
  if(!database_row_exists('idea_types', $idea_type_id))
    return;

  // Sanitize the data
  $idea_type_order     = sanitize_array_element($data, 'order', 'int');
  $idea_type_name_en   = sanitize_array_element($data, 'name_en', 'string');
  $idea_type_name_fr   = sanitize_array_element($data, 'name_fr', 'string');

  // Update the idea type
  query(" UPDATE  idea_types
          SET     idea_types.sorting_order  = '$idea_type_order'    ,
                  idea_types.name_en        = '$idea_type_name_en'  ,
                  idea_types.name_fr        = '$idea_type_name_fr'
          WHERE   idea_types.id             = '$idea_type_id' ");
}




/**
 * Deletes an idea type from the database.
 *
 * @param   int     $idea_type_id  The id of the idea type to delete.
 *
 * @return  void
 */

function admin_idea_types_delete( int $idea_type_id )
{
  // Sanitize the idea type's id
  $idea_type_id = sanitize($idea_type_id, 'int');

  // Delete the idea type
  query(" DELETE FROM idea_types
          WHERE       idea_types.id = '$idea_type_id' ");
}




/**
 * Returns a list of user searches.
 *
 * @return  array   An array containing user searches.
 */

function admin_user_searches_list() : array
{
  // Get the path to the user search file
  $root = root_path();
  $file_path = $root.'/admin/user_searches.txt';

  // Return an empty array if the file doesn't exist
  if(!file_exists($file_path))
    return array();

  // Fetch the contents of the user search file
  $user_searches = file_get_contents(root_path().'/admin/user_searches.txt');

  // Split the contents of the file into an array
  $user_searches = explode("\n", $user_searches);

  // Remove empty lines
  $user_searches = array_filter($user_searches);

  // Invert the arrray
  $user_searches = array_reverse($user_searches);

  // Return the array
  return $user_searches;
}




/**
 * Clears the user search history.
 *
 * @return  void
 */

function admin_user_searches_clear() : void
{
  // Get the path to the user search file
  $root = root_path();
  $file_path = $root.'/admin/user_searches.txt';

  // Delete the file if it exists
  if(file_exists($file_path))
    unlink($file_path);
}