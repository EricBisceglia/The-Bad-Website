<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*  videos_bts_list             Lists all behind the scenes videos                                                   */
/*  videos_bts_add              Adds a behind the scenes video                                                       */
/*                                                                                                                   */
/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                             BEHIND THE SCENES VIDEOS                                              */
/*                                                                                                                   */
/*********************************************************************************************************************/

/**
 * Lists all behind the scenes videos.
 *
 * @return  array  An array containing all behind the scenes videos.
 */

function videos_bts_list() : array
{
  // Get the user's current language
  $lang = string_change_case(user_get_language(), 'lowercase');

  // Fetch the videos
  $videos = query(" SELECT    video_bts.id                AS 'vbts_id'      ,
                              video_bts.sorting_order     AS 'vbts_sort'    ,
                              video_bts.date_added        AS 'vbts_date'    ,
                              video_bts.youtube_id        AS 'vbts_youtube' ,
                              video_bts.title_$lang       AS 'vbts_title'   ,
                              video_bts.description_$lang AS 'vbts_desc'
                    FROM      video_bts
                    GROUP BY  video_bts.id
                    ORDER BY  video_bts.sorting_order ASC ");

  // Prepare the data for display
  for($i = 0; $row = query_row($videos); $i++)
  {
    $data[$i]['id']       = sanitize_output($row['vbts_id']);
    $data[$i]['sort']     = sanitize_output($row['vbts_sort']);
    $data[$i]['date']     = sanitize_output($row['vbts_date']);
    $data[$i]['youtube']  = sanitize_output($row['vbts_youtube']);
    $data[$i]['title']    = sanitize_output($row['vbts_title']);
    $data[$i]['stitle']   = sanitize_output(string_truncate($row['vbts_title'], 30));
    $data[$i]['desc']     = sanitize_output($row['vbts_desc']);
  }

  // Add the number of rows to the returned data
  $data['rows'] = $i;

  // Return the prepared data
  return ($data ?? []);
}




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