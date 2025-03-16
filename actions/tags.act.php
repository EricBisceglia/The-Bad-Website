<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*  tags_list                     Lists tags                                                                         */
/*                                                                                                                   */
/*********************************************************************************************************************/


/**
 * Lists comic types.
 *
 * @return  array   An array containing the comic types.
 */

function tags_list() : array
{
  // Fetch the user's current language
  $lang = string_change_case(user_get_language(), 'lowercase');

  // Fetch the comic types
  $tags = query(" SELECT    tags.id            AS 't_id'        ,
                            tags.sorting_order AS 't_sort'      ,
                            tags.name          AS 't_name'      ,
                            tags.banner_en     AS 't_banner_en' ,
                            tags.banner_fr     AS 't_banner_fr' ,
                            tags.title_$lang   AS 't_title'     ,
                            tags.title_en      AS 't_title_en'  ,
                            tags.title_fr      AS 't_title_fr'
                  FROM      tags
                  ORDER BY  tags.sorting_order ASC ");

  // Prepare the data for display
  for($i = 0; $row = query_row($tags); $i++)
  {
    $data[$i]['id']         = sanitize_output($row['t_id']);
    $data[$i]['sort']       = sanitize_output($row['t_sort']);
    $data[$i]['name']       = sanitize_output($row['t_name']);
    $data[$i]['banner_en']  = sanitize_output($row['t_banner_en']);
    $data[$i]['banner_fr']  = sanitize_output($row['t_banner_fr']);
    $data[$i]['title']      = sanitize_output($row['t_title']);
    $data[$i]['title_en']   = sanitize_output($row['t_title_en']);
    $data[$i]['title_fr']   = sanitize_output($row['t_title_fr']);
  }

  // Add the number of rows to the returned data
  $data['rows'] = $i;

  // Return the prepared data
  return $data;
}