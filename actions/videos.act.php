<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*  videos_bts_add              Adds a behind the scenes video                                                       */
/*                                                                                                                   */
/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                             BEHIND THE SCENES VIDEOS                                              */
/*                                                                                                                   */
/*********************************************************************************************************************/

/**
 * Adds a behind the scenes video.
 *
 * @param   array  $data  An array containing data on the behind the scenes video.
 *
 * @return  int           The ID of the added behind the scenes video.
 */

function videos_bts_add( array $data ) : int
{
  // Sanitize the data
  $sort_order = sanitize_array_element($data, 'sort_order', 'int');
  $youtube_id = sanitize_array_element($data, 'youtube_id', 'string');
  $title_en   = sanitize_array_element($data, 'title_en', 'string');
  $title_fr   = sanitize_array_element($data, 'title_fr', 'string');
  $desc_en    = sanitize_array_element($data, 'desc_en', 'string');
  $desc_fr    = sanitize_array_element($data, 'desc_fr', 'string');
  $date       = sanitize(date('Y-m-d'), 'string');

  // Add the video to the database
  query(" INSERT INTO video_bts
          SET         video_bts.sorting_order     = '$sort_order' ,
                      video_bts.date_added        = '$date'       ,
                      video_bts.youtube_id        = '$youtube_id' ,
                      video_bts.title_en          = '$title_en'   ,
                      video_bts.title_fr          = '$title_fr'   ,
                      video_bts.description_en    = '$desc_en'    ,
                      video_bts.description_fr    = '$desc_fr' ");

  // Fetch the newly created video's ID
  $video_bts_id = query_id();

  // Return the video's ID
  return $video_bts_id;
}