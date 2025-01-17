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

function admin_notes_update( $tasks = '' ) : void
{
  // Sanitize the data
  $tasks  = sanitize($tasks, 'string');

  // Update the notes
  query(" UPDATE  notes
          SET     notes.tasks  = '$tasks' ");
}