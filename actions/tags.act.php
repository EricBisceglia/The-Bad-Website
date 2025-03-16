<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*  tags_list                     Lists tags                                                                         */
/*  tags_add                      Adds a tag                                                                         */
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




/**
 * Adds a tag.
 *
 * @param   array   $data   An array containing the tag's data
 *
 * @return  void
 */

function tags_add( array $data ) : void
{
  // Sanitize the data
  $tag_sort      = sanitize_array_element($data, 'sort', 'int');
  $tag_name      = sanitize_array_element($data, 'name', 'string');
  $tag_title_en  = sanitize_array_element($data, 'title_en', 'string');
  $tag_title_fr  = sanitize_array_element($data, 'title_fr', 'string');
  $tag_banner_en = sanitize_array_element($data, 'banner_en', 'string');
  $tag_banner_fr = sanitize_array_element($data, 'banner_fr', 'string');
  $tag_desc_en   = sanitize_array_element($data, 'desc_en', 'string');
  $tag_desc_fr   = sanitize_array_element($data, 'desc_fr', 'string');

  // The tag name should only contain lowercase letters and no spaces
  $tag_name = preg_replace('/[^a-z ]/', '', mb_strtolower($tag_name));

  // Add the tag to the database
  query(" INSERT INTO tags
          SET         tags.sorting_order   = '$tag_sort'      ,
                      tags.name            = '$tag_name'      ,
                      tags.title_en        = '$tag_title_en'  ,
                      tags.title_fr        = '$tag_title_fr'  ,
                      tags.banner_en       = '$tag_banner_en' ,
                      tags.banner_fr       = '$tag_banner_fr' ,
                      tags.description_en  = '$tag_desc_en'   ,
                      tags.description_fr  = '$tag_desc_fr'   ");
}