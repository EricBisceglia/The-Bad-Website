/*********************************************************************************************************************/
/*                                                                                                                   */
/*  admin_menu                              Navigates between admin pages.                                           */
/*                                                                                                                   */
/*  admin_ideas_sort                        Sorts the list of smug ideas.                                            */
/*  admin_ideas_delete                      Triggers the deletion of an idea.                                        */
/*                                                                                                                   */
/*  admin_image_upload                      Fills out the image upload form when an image is submitted.              */
/*  admin_image_list_search                 Triggers a search in the image list.                                     */
/*  admin_image_list_delete                 Triggers the deletion of an image.                                       */
/*                                                                                                                   */
/*  admin_comic_list_search                 Triggers a search in the comic list.                                     */
/*  admin_comic_list_delete                 Triggers the deletion of a comic.                                        */
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
 * Fills out the image upload form when an image is submitted.
 *
 * @returns {void}
 */

function image_file_upload()
{
  // Hide the error message in case it was previously displayed
  if(document.getElementById('image_error'))
    toggle_element_oneway('image_error', false);

  // Fetch the submitted image's name
  image = document.getElementById('image_file').value;

  // Get rid of the path in the image's name
  position = image.lastIndexOf('\\');
  if(position >= 0)
    image = image.substring(position + 1);

  // Clean up the image's name by removing spaces and caps
  image = image.split(" ").join("_").toLowerCase();

  // Display the suggested file name
  document.getElementById('image_name').value = image;
}




/**
 * Triggers a search in the image list.
 *
 * @param   {string}  [sort]  Change the order in which the data will be sorted.
 *
 * @returns {void}
*/

function admin_image_list_search( sort = null )
{
  // Update the data sort input if requested
  if(sort)
    document.getElementById('admin_images_sort').value = sort;

  // Assemble the postdata
  postdata  = 'admin_images_sort='          + fetch_sanitize_id('admin_images_sort');
  postdata += '&admin_images_search_name='  + fetch_sanitize_id('admin_images_search_name');
  postdata += '&admin_images_search_type='  + fetch_sanitize_id('admin_images_search_type');
  postdata += '&admin_images_search_lang='  + fetch_sanitize_id('admin_images_search_lang');
  postdata += '&admin_images_search_comic=' + fetch_sanitize_id('admin_images_search_comic');
  postdata += '&admin_images_search_nsfw='  + fetch_sanitize_id('admin_images_search_nsfw');

  // Submit the search
  fetch_page('images', 'admin_images_tbody', postdata);
}




/**
 * Triggers the deletion of an image.
 *
 * @param   {int}     id        The id of the image to delete.
 * @param   {string}  message   The message to display before deleting the image.
 */

function admin_image_list_delete(  id      ,
                                   message )
{
  // Assemble the postdata
  postdata = 'admin_images_delete=' + fetch_sanitize(id);

  // Make sure the user knows what they're doing and trigger the deletion
  if(confirm(message))
    fetch_page('images', 'admin_images_tbody', postdata);
}




/**
 * Triggers a search in the comics list.
 *
 * @param   {string}  [sort]  Change the order in which the data will be sorted.
 *
 * @returns {void}
*/

function admin_comic_list_search( sort = null )
{
  // Update the data sort input if requested
  if(sort)
    document.getElementById('admin_comics_sort').value = sort;

  // Assemble the postdata
  postdata  = 'admin_comics_sort='            + fetch_sanitize_id('admin_comics_sort');
  postdata += '&admin_comics_search_body='    + fetch_sanitize_id('admin_comics_search_body');
  postdata += '&admin_comics_search_title='   + fetch_sanitize_id('admin_comics_search_title');
  postdata += '&admin_comics_search_type='    + fetch_sanitize_id('admin_comics_search_type');
  postdata += '&admin_comics_search_private=' + fetch_sanitize_id('admin_comics_search_private');
  postdata += '&admin_comics_search_images='  + fetch_sanitize_id('admin_comics_search_images');
  postdata += '&admin_comics_search_tag_id='  + fetch_sanitize_id('admin_comics_search_tags');

  // Submit the search
  fetch_page('comics', 'admin_comics_tbody', postdata);
}




/**
 * Triggers the deletion of a comic.
 *
 * @param   {int}     id        The id of the comic to delete.
 * @param   {string}  message   The message to display before deleting the comic.
 */

function admin_comic_list_delete(  id      ,
                                   message )
{
  // Assemble the postdata
  postdata = 'admin_comics_delete=' + fetch_sanitize(id);

  // Make sure the user knows what they're doing and trigger the deletion
  if(confirm(message))
    fetch_page('comics', 'admin_comics_tbody', postdata);
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