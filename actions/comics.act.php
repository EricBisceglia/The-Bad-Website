<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*  comic_types_list              Lists comic types                                                                  */
/*  comic_types_add               Adds a comic type                                                                  */
/*                                                                                                                   */
/*********************************************************************************************************************/


/**
 * Lists comic types.
 *
 * @return  array   An array containing the arsenal difficulty levels.
 */

function comic_types_list() : array
{
  // Fetch the user's current language
  $lang = string_change_case(user_get_language(), 'lowercase');

  // Fetch the comic types
  $comic_types = query("  SELECT  comic_types.id            AS 'ct_id'      ,
                                  comic_types.sorting_order AS 'ct_sort'    ,
                                  comic_types.name_$lang    AS 'ct_name'    ,
                                  comic_types.name_en       AS 'ct_name_en' ,
                                  comic_types.name_fr       AS 'ct_name_fr'
                          FROM    comic_types
                          ORDER BY comic_types.sorting_order ASC ");

  // Prepare the data for display
  for($i = 0; $row = query_row($comic_types); $i++)
  {
    $data[$i]['id']       = sanitize_output($row['ct_id']);
    $data[$i]['sort']     = sanitize_output($row['ct_sort']);
    $data[$i]['name']     = sanitize_output($row['ct_name']);
    $data[$i]['name_en']  = sanitize_output($row['ct_name_en']);
    $data[$i]['name_fr']  = sanitize_output($row['ct_name_fr']);
  }

  // Add the number of rows to the returned data
  $data['rows'] = $i;

  // Return the prepared data
  return $data;
}




/**
 * Adds a comic type.
 *
 * @param   array   $data   An array containing the comic type's data
 *
 * @return  void
 */

function comic_types_add( array $data ) : void
{
  // Sanitize the data
  $comic_type_sort      = sanitize_array_element($data, 'sort', 'int');
  $comic_type_name_en   = sanitize_array_element($data, 'name_en', 'string');
  $comic_type_name_fr   = sanitize_array_element($data, 'name_fr', 'string');
  $comic_type_banner_en = sanitize_array_element($data, 'banner_en', 'string');
  $comic_type_banner_fr = sanitize_array_element($data, 'banner_fr', 'string');
  $comic_type_desc_en   = sanitize_array_element($data, 'desc_en', 'string');
  $comic_type_desc_fr   = sanitize_array_element($data, 'desc_fr', 'string');

  // Add the comic type to the database
  query(" INSERT INTO comic_types
          SET         comic_types.sorting_order   = '$comic_type_sort'      ,
                      comic_types.name_en         = '$comic_type_name_en'   ,
                      comic_types.name_fr         = '$comic_type_name_fr'   ,
                      comic_types.banner_en       = '$comic_type_banner_en' ,
                      comic_types.banner_fr       = '$comic_type_banner_fr' ,
                      comic_types.description_en  = '$comic_type_desc_en'   ,
                      comic_types.description_fr  = '$comic_type_desc_fr'   ");
}