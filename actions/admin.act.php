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
 * @return  array   An array containing ideas.
 */

function admin_ideas_list() : array
{
  // Fetch the ideas
  $ideas = query("  SELECT    ideas.id    AS 'i_id'  ,
                              ideas.title AS 'i_title'  ,
                              ideas.body  AS 'i_body'
                    FROM      ideas
                    ORDER BY  ideas.title ASC ");

  // Prepare the data
  for($i = 0; $row = query_row($ideas); $i++)
  {
    $data['ideas'][$i]['id']    = $row['i_id'];
    $data['ideas'][$i]['title'] = sanitize_output($row['i_title']);
    $data['ideas'][$i]['body']  = sanitize_output($row['i_body'], preserve_line_breaks: true);
  }

  // Add the number of rows to the data
  $data['rows'] = count($data['ideas']);

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