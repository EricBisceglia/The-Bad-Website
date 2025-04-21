/*********************************************************************************************************************/
/*                                                                                                                   */
/*  show_comic_full            Shows a comic's full version.                                                         */
/*  show_comic_old             Shows a comic's old version.                                                          */
/*  show_comic_transcripts     Shows a comic's transcripts.                                                          */
/*                                                                                                                   */
/*********************************************************************************************************************/

/**
 * Shows a comic's full version.
 *
 * @returns {void}
 */

function show_comic_full()
{
  // Show the full version
  toggle_element_oneway('image_full_versions', 1);

  // Hide the full version button
  toggle_element_oneway('image_full_button', 0);
}




/**
 * Shows a comic's old version.
 *
 * @returns {void}
 */

function show_comic_old()
{
  // Show the old version
  toggle_element_oneway('image_old_versions', 1);

  // Hide the old version button
  toggle_element_oneway('image_old_button', 0);
}




/**
 * Shows a comic's transcripts.
 *
 * @returns {void}
 */

function show_comic_transcripts()
{
  // Show the transcripts
  toggle_element_oneway('image_transcripts', 1);

  // Hide the transcripts button
  toggle_element_oneway('image_transcripts_button', 0);
}