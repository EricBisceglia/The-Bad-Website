/*********************************************************************************************************************/
/*                                                                                                                   */
/*  admin_menu                              Navigates between admin pages.                                           */
/*                                                                                                                   */
/*  admin_ideas_sort                        Sorts the list of smug ideas.                                            */
/*  admin_ideas_delete                      Triggers the deletion of an idea.                                        */
/*                                                                                                                   */
/*  admin_comic_type_delete                 Triggers the deletion of a comic type.                                   */
/*                                                                                                                   */
/*  admin_tags_delete                       Triggers the deletion of a tag.                                          */
/*                                                                                                                   */
/*********************************************************************************************************************/

/**
 * Navigates between adminpages.
 *
 * @returns {void}
 */

function admin_menu()
{
  // Fetch the requested page
  page = document.getElementById('admin_menu').value;

  // Go to the requested page
  window.location.href = page;
}




/**
 * Sorts the list of smug ideas.
 *
 * @param   {string}  sort_by  How the ideas should be sorted.
 *
 * @returns {void}
 */

function admin_ideas_sort( sort_by )
{
  // Assemble the postdata
  postdata = 'admin_ideas_sort=' + fetch_sanitize(sort_by);

  // Go to the ideas list
  fetch_page('ideas', 'ideas_list', postdata);
}




/**
 * Triggers the deletion of an idea.
 *
 * @param   {int}     id        The id of the idea to delete.
 * @param   {string}  message   The message to display before deleting the idea.
 */

function admin_ideas_delete(  id      ,
                              message )
{
  // Assemble the postdata
  postdata = 'admin_ideas_delete=' + fetch_sanitize(id);

  // Make sure the user knows what they're doing and trigger the deletion
  if(confirm(message))
    fetch_page('ideas', 'ideas_list', postdata);
}




/**
 * Triggers the deletion of a comic type.
 *
 * @param   {int}     id        The id of the comic type to delete.
 * @param   {string}  message   The message to display before deleting the comic type.
 */

function admin_comic_type_delete(  id      ,
                                   message )
{
  // Assemble the postdata
  postdata = 'admin_comic_types_delete=' + fetch_sanitize(id);

  // Make sure the user knows what they're doing and trigger the deletion
  if(confirm(message))
    fetch_page('comics_types', 'admin_comics_types_tbody', postdata);
}




/**
 * Triggers the deletion of a tag.
 *
 * @param   {int}     id        The id of the tag to delete.
 * @param   {string}  message   The message to display before deleting the tag.
 */

function admin_tags_delete(  id      ,
                             message )
{
  // Assemble the postdata
  postdata = 'admin_tags_delete=' + fetch_sanitize(id);

  // Make sure the user knows what they're doing and trigger the deletion
  if(confirm(message))
    fetch_page('tags', 'admin_tags_tbody', postdata);
}