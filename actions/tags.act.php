<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*  tags_get                      Fetches a tag                                                                      */
/*  tags_list                     Lists tags                                                                         */
/*  tags_add                      Adds a tag                                                                         */
/*  tags_edit                     Edits a tag                                                                        */
/*  tags_delete                   Deletes a tag                                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/


/**
 * Fetches a tag.
 *
 * @param   int         $tag_id   The tag's ID
 *
 * @return  array|null            An array containing the tag's data
 */

function tags_get( int $tag_id ) : ?array
{
  // Sanitize the data
  $tag_id = sanitize($tag_id, 'int');

  // Stop here if the tag does not exist
  if(!database_row_exists('tags', $tag_id))
    return null;

  // Get the user's current language
  $lang = string_change_case(user_get_language(), 'lowercase');

  // Fetch the tag's data
  $tag_data = query(" SELECT    tags.id             AS 't_id'         ,
                                tags.sorting_order  AS 't_sort'       ,
                                tags.name           AS 't_name'       ,
                                tags.banner_$lang   AS 't_banner'     ,
                                tags.banner_en      AS 't_banner_en'  ,
                                tags.banner_fr      AS 't_banner_fr'  ,
                                tags.title_en       AS 't_title_en'   ,
                                tags.title_fr       AS 't_title_fr'   ,
                                tags.description_en AS 't_desc_en'    ,
                                tags.description_fr AS 't_desc_fr'
                      FROM      tags
                      WHERE     tags.id = '$tag_id' ",
                      fetch_row: true);

  // Prepare the data for display
  $data['id']         = sanitize_output($tag_data['t_id']);
  $data['sort']       = sanitize_output($tag_data['t_sort']);
  $data['name']       = sanitize_output($tag_data['t_name']);
  $data['banner_en']  = sanitize_output($tag_data['t_banner_en']);
  $data['banner_fr']  = sanitize_output($tag_data['t_banner_fr']);
  $data['title_en']   = sanitize_output($tag_data['t_title_en']);
  $data['title_fr']   = sanitize_output($tag_data['t_title_fr']);
  $data['desc_en']    = sanitize_output($tag_data['t_desc_en']);
  $data['desc_fr']    = sanitize_output($tag_data['t_desc_fr']);

  // Get the correct banner images
  $root = root_path();
  if($tag_data['t_banner'] && file_exists($root."img/banners/comics/tags/".$tag_data['t_banner']))
    $data['banner'] = "img/banners/comics/tags/".$tag_data['t_banner'];
  else
    $data['banner']= "img/templates/tag_".$lang;

  // Return the prepared data
  return $data;
}





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
                            tags.banner_$lang  AS 't_banner'    ,
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

    // Get the correct banner images
    $root = root_path();
    if($row['t_banner'] && file_exists($root."img/banners/comics/tags/".$row['t_banner']))
      $data[$i]['banner'] = "img/banners/comics/tags/".$row['t_banner'];
    else
      $data[$i]['banner']= "img/templates/tag_".$lang;
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
  $tag_name = str_replace(' ', '', $tag_name);

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




/**
 * Edits a tag.
 *
 * @param   int     $tag_id    The id of the tag to edit.
 * @param   array   $data      The data to update the tag with.
 *
 * @return  void
 */

function tags_edit( int   $tag_id  ,
                    array $data     ) : void
{
  // Sanitize the data
  $tag_id        = sanitize($tag_id, 'int');
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
  $tag_name = str_replace(' ', '', $tag_name);

  // Stop here if the tag does not exist
  if(!database_row_exists('tags', $tag_id))
    return;

  // Edit the tag
  query(" UPDATE  tags
          SET     tags.sorting_order   = '$tag_sort'      ,
                  tags.name            = '$tag_name'      ,
                  tags.title_en        = '$tag_title_en'  ,
                  tags.title_fr        = '$tag_title_fr'  ,
                  tags.banner_en       = '$tag_banner_en' ,
                  tags.banner_fr       = '$tag_banner_fr' ,
                  tags.description_en  = '$tag_desc_en'   ,
                  tags.description_fr  = '$tag_desc_fr'
          WHERE   tags.id              = '$tag_id' ");
}




/**
 * Delete a tag.
 *
 * @param   int     $tag_id  The id of the tag to delete.
 *
 * @return  void
 */

function tags_delete( int $tag_id )
{
  // Sanitize the tag's id
  $tag_id = sanitize($tag_id, 'int');

  // Delete the tag
  query(" DELETE FROM tags
          WHERE       tags.id = '$tag_id' ");

  // Remove any links to the deleted tag
  query(" DELETE FROM comic_tags
          WHERE       comic_tags.fk_tags = '$tag_id' ");
}