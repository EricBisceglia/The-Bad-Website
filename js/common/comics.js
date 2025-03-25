/*********************************************************************************************************************/
/*                                                                                                                   */
/*  show_comic_transcripts     Shows a comic's transcripts.                                                          */
/*                                                                                                                   */
/*********************************************************************************************************************/

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