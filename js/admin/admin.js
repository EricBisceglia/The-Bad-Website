/*********************************************************************************************************************/
/*                                                                                                                   */
/*  admin_menu                              Navigates between admin pages.                                           */
/*                                                                                                                   */
/*  admin_ideas_search                      Searches the list of smug ideas.                                         */
/*  admin_ideas_delete                      Triggers the deletion of an idea.                                        */
/*  admin_idea_type_delete                  Triggers the deletion of an idea type.                                   */
/*                                                                                                                   */
/*  admin_image_upload                      Fills out the image upload form when an image is submitted.              */
/*  admin_image_list_search                 Triggers a search in the image list.                                     */
/*  admin_image_list_load_preview           Loads a preview of an image in the list.                                 */
/*  admin_image_gallery_search              Triggers a search in the image gallery.                                  */
/*                                                                                                                   */
/*  admin_comic_list_search                 Triggers a search in the comic list.                                     */
/*  admin_comic_type_delete                 Triggers the deletion of a comic type.                                   */
/*                                                                                                                   */
/*  admin_tags_delete                       Triggers the deletion of a tag.                                          */
/*                                                                                                                   */
/*  admin_quotes_hide_media_or_author       Hides the quote media or author dropdowns when one is selected.          */
/*  admin_quotes_list_search                Triggers a search in the quote list.                                     */
/*  admin_quotes_farm_search                Triggers a search in the quote farm.                                     */
/*  admin_quotes_authors_delete             Triggers the deletion of a quote author.                                 */
/*  admin_quotes_media_delete               Triggers the deletion of a quote media.                                  */
/*  admin_quotes_media_authors_update       Keeps an author dropdown at the bottom of the quote media edit form.     */
/*  admin_quotes_tags_delete                Triggers the deletion of a quote tag.                                    */
/*                                                                                                                   */
/*  admin_user_searches_clear               Triggers the deletion of the user search history.                        */
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
 * Searches the list of smug ideas.
 *
 * @param   {string}  sort_by   How the ideas should be sorted.
 *
 * @returns {void}
 */

function admin_ideas_search( sort_by )
{
  // Assemble the postdata
  postdata =  'admin_ideas_category=' + fetch_sanitize_id('admin_ideas_category');
  postdata += '&admin_ideas_sort=' + fetch_sanitize(sort_by);

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
    fetch_page('ideas', 'ideas_'+id, postdata);
}




/**
 * Triggers the deletion of an idea type.
 *
 * @param   {int}     id        The id of the idea type to delete.
 * @param   {string}  message   The message to display before deleting the idea type.
 */

function admin_idea_type_delete(  id      ,
                                  message )
{
  // Assemble the postdata
  postdata = 'admin_idea_types_delete=' + fetch_sanitize(id);

  // Make sure the user knows what they're doing and trigger the deletion
  if(confirm(message))
    fetch_page('ideas_types', 'admin_idea_types_tbody', postdata);
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
 * @param   {string}  [sort]            Change the order in which the data will be sorted.
 * @param   {string}  [delete_id]       Trigger the deletion of an image.
 * @param   {string}  [delete_message]  The message to display before deleting the image.
 *
 * @returns {void}
*/

function admin_image_list_search( sort            = null  ,
                                  delete_id       = null  ,
                                  delete_message  = null  )
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

  // Delete an image if requested
  if(delete_id && confirm(delete_message))
    postdata += '&admin_images_delete=' + fetch_sanitize(delete_id);

  // Submit the search
  fetch_page('images', 'admin_images_tbody', postdata);
}




/**
 * Loads a preview of an image in the list.
 *
 * @param   {HTMLElement}  container  The tooltip container in which an image is waiting to be loaded.
 *
 * @returns {void}
 */

function admin_image_list_load_preview( container )
{
  // Fetch the unloaded image
  const image = container.querySelector('img[data-src]');

  // Stop if the image has already been loaded
  if(!image)
    return;

  // Load the image
  image.src = image.dataset.src;

  // Prevent the image from being loaded again
  image.removeAttribute('data-src');
}





/**
 * Triggers a search in the image gallery.
 *
 * @return {void}
 */

function admin_image_gallery_search()
{
  // Assemble the postdata
  postdata  = 'admin_images_search_name='  + fetch_sanitize_id('admin_images_gallery_name');
  postdata += '&admin_images_search_type=' + fetch_sanitize_id('admin_images_gallery_type');
  postdata += '&admin_images_search_tag='  + fetch_sanitize_id('admin_images_gallery_tag');
  postdata += '&admin_images_gallery_go=1';

  // Submit the search
  fetch_page('images_gallery', 'admin_images_gallery', postdata);
}




/**
 * Triggers a search in the comics list.
 *
 * @param   {string}  [sort]            Change the order in which the data will be sorted.
 * @param   {string}  [delete_id]       Trigger the deletion of a comic.
 * @param   {string}  [delete_message]  The message to display before deleting the comic.
 *
 * @returns {void}
*/

function admin_comic_list_search( sort           = null ,
                                  delete_id      = null ,
                                  delete_message = null )
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
  postdata += '&admin_comics_search_video='   + fetch_sanitize_id('admin_comics_search_video');
  postdata += '&admin_comics_search_tag_id='  + fetch_sanitize_id('admin_comics_search_tags');

  // Delete a comic if requested
  if(delete_id && confirm(delete_message))
    postdata += '&admin_comics_delete=' + fetch_sanitize(delete_id);

  // Submit the search
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




/**
 * Hides the quote media or author dropdowns when one is selected.
 *
 * @param   {string}  type  The type of dropdown that was selected ('media' or 'author').
 *
 * @returns {void}
 */

function admin_quotes_hide_media_or_author( type )
{
  // Hide the media dropdown if an author was selected and the author dropdown contains a value
  if(type === 'author' && document.getElementById('quote_author').value != 0)
    toggle_element_oneway('quote_media_container', false);

  // Hide the author & years dropdowns if media was selected and the media dropdown contains a value
  if(type === 'media' && document.getElementById('quote_media').value != 0)
  {
    toggle_element_oneway('quote_author_container', false);
    toggle_element_oneway('quote_year_container', false);
  }

  // Show the media dropdown if the author dropdown is empty
  if(type === 'author' && document.getElementById('quote_author').value == 0)
    toggle_element_oneway('quote_media_container', true);

  // Show the author & year dropdowns if the media dropdown is empty
  if(type === 'media' && document.getElementById('quote_media').value == 0)
  {
    toggle_element_oneway('quote_author_container', true);
    toggle_element_oneway('quote_year_container', true);
  }
}




/**
 * Triggers a search in the quotes list.
 *
 * @param   {string}  [sort]            Change the order in which the data will be sorted.
 * @param   {string}  [delete_id]       Trigger the deletion of a quote.
 * @param   {string}  [delete_message]  The message to display before deleting the quote.
 *
 * @returns {void}
*/

function admin_quotes_list_search(  sort            = null ,
                                    delete_id       = null ,
                                    delete_message  = null )
{
  // Update the data sort input if requested
  if(sort)
    document.getElementById('admin_quotes_sort').value = sort;

  // Assemble the postdata
  postdata  = 'admin_quotes_sort='            + fetch_sanitize_id('admin_quotes_sort');
  postdata += '&admin_quotes_search_year='    + fetch_sanitize_id('admin_quotes_search_year');
  postdata += '&admin_quotes_search_author='  + fetch_sanitize_id('admin_quotes_search_author');
  postdata += '&admin_quotes_search_media='   + fetch_sanitize_id('admin_quotes_search_media');
  postdata += '&admin_quotes_search_title='   + fetch_sanitize_id('admin_quotes_search_title');
  postdata += '&admin_quotes_search_body='    + fetch_sanitize_id('admin_quotes_search_body');
  postdata += '&admin_quotes_search_tags='    + fetch_sanitize_id('admin_quotes_search_tags');

  // Delete a quote if requested
  if(delete_id && confirm(delete_message))
    postdata += '&admin_quotes_delete=' + fetch_sanitize(delete_id);

  // Submit the search
  fetch_page('quotes', 'admin_quotes_tbody', postdata);
}





/**
 * Triggers a search in the quote farm.
 *
 * @returns {void}
 */

function admin_quotes_farm_search()
{
  // Assemble the postdata
  postdata  = 'admin_quotes_search_author=' + fetch_sanitize_id('admin_quotes_search_author');
  postdata += '&admin_quotes_search_media=' + fetch_sanitize_id('admin_quotes_search_media');
  postdata += '&admin_quotes_search_tags='  + fetch_sanitize_id('admin_quotes_search_tags');
  postdata += '&admin_quotes_search_body='  + fetch_sanitize_id('admin_quotes_search_body');
  postdata += '&admin_quotes_search_go=1';

  // Submit the search
  fetch_page('quotes_farm', 'admin_quotes_farm_list', postdata);
}




/**
 * Triggers the deletion of a quote author.
 *
 * @param   {int}     id        The id of the quote author to delete.
 * @param   {string}  message   The message to display before deleting the quote author.
 */

function admin_quotes_authors_delete( id      ,
                                      message )
{
  // Assemble the postdata
  postdata = 'admin_quotes_authors_delete=' + fetch_sanitize(id);

  // Make sure the user knows what they're doing and trigger the deletion
  if(confirm(message))
    fetch_page('quotes_authors', 'admin_quotes_authors_tbody', postdata);
}




/**
 * Triggers the deletion of a quote media.
 *
 * @param   {int}     id        The id of the quote media to delete.
 * @param   {string}  message   The message to display before deleting the quote media.
 */

function admin_quotes_media_delete( id      ,
                                    message )
{
  // Assemble the postdata
  postdata = 'admin_quotes_media_delete=' + fetch_sanitize(id);

  // Make sure the user knows what they're doing and trigger the deletion
  if(confirm(message))
    fetch_page('quotes_media', 'admin_quotes_media_tbody', postdata);
}




/**
 * Keeps an author dropdown at the bottom of the quote media edit form.
 *
 * @returns {void}
 */

function admin_quotes_media_authors_update()
{
  // Fetch the form container
  const container = document.getElementById('quote_media_authors');
  if(!container)
    return;

  // Fetch all the author dropdowns
  const dropdowns = container.querySelectorAll('select[name="quote_media_authors[]"]');

  // Remove all empty dropdowns other than the final dropdown
  for(let i = dropdowns.length - 2; i >= 0; i--)
  {
    if(dropdowns[i].value === '')
      dropdowns[i].parentNode.remove();
  }

  // Add a new empty dropdown if the last one is filled
  const lastDropdown = dropdowns[dropdowns.length - 1];
  if(lastDropdown && lastDropdown.value !== '')
  {
    // Clone the last dropdown and reset its value
    const newDropdown = lastDropdown.cloneNode(true);
    newDropdown.value = '';

    // Wrap the new dropdown in a div to maintain spacing
    const wrapper = document.createElement('div');
    wrapper.classList.add('smallpadding_bot');
    wrapper.appendChild(newDropdown);
    container.appendChild(wrapper);
  }
}




/**
 * Triggers the deletion of a quote tag.
 *
 * @param   {int}     id        The id of the quote tag to delete.
 * @param   {string}  message   The message to display before deleting the quote tag.
 */

function admin_quotes_tags_delete(  id      ,
                                    message )
{
  // Assemble the postdata
  postdata = 'quote_tag_delete=' + fetch_sanitize(id);

  // Make sure the user knows what they're doing and trigger the deletion
  if(confirm(message))
    fetch_page('quotes_tags', 'admin_quotes_tags_tbody', postdata);
}




/**
 * Triggers the deletion of the user search history.
 *
 * @param   {string}  [message]  The message to display before deleting the idea.
 *
 * @returns {void}
 */

function admin_user_searches_clear( message )
{
  // Assemble the postdata
  postdata = 'admin_user_searches_clear=1';

  // Make sure the user knows what they're doing and trigger the deletion
  if(confirm(message))
    fetch_page('searches', 'admin_user_searches_list', postdata);
}