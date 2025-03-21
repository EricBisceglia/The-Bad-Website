<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*  images_get                    Fetches an image's data                                                            */
/*  images_list                   Lists images                                                                       */
/*  images_add                    Adds an image to the database                                                      */
/*  images_edit                   Modifies an existing image                                                         */
/*  images_delete                 Deletes an existing image                                                          */
/*                                                                                                                   */
/*  image_types_list              Lists image types                                                                  */
/*                                                                                                                   */
/*  images_format_file_name       Formats an image's file name                                                       */
/*                                                                                                                   */
/*********************************************************************************************************************/

/**
 * Returns data related to an image.
 *
 * @param   int         $image_id  The image's ID
 *
 * @return  array|null             An array containing the image's data, or null if it doesn't exist.
 */

function images_get( int $image_id ) : array|null
{
  // Sanitize the image's id
  $image_id = sanitize($image_id, 'int');

  // Return null if the image does not exist
  if(!database_row_exists('images', $image_id))
    return null;

  // Fetch the image's data
  $image_data = query(" SELECT  images.name           AS 'i_name'   ,
                                images.fk_image_types AS 'i_type'   ,
                                images.fk_comics      AS 'i_comic'  ,
                                images.image_order    AS 'i_order'  ,
                                images.upload_date    AS 'i_date'   ,
                                images.is_nsfw        AS 'i_nsfw'   ,
                                images.language       AS 'i_lang'   ,
                                images.transcript     AS 'i_trans'
                        FROM    images
                        WHERE   images.id = '$image_id' ",
                        fetch_row: true);

  // Sanitize the data for display
  $data['name']   = sanitize_output($image_data['i_name']);
  $data['type']   = sanitize_output($image_data['i_type']);
  $data['comic']  = sanitize_output($image_data['i_comic']);
  $data['order']  = sanitize_output($image_data['i_order']);
  $data['lang']   = sanitize_output($image_data['i_lang']);
  $data['date']   = sanitize_output($image_data['i_date']);
  $data['nsfw']   = sanitize_output($image_data['i_nsfw']);
  $data['trans']  = sanitize_output($image_data['i_trans']);

  // Return the image's data
  return $data;
}




/**
 * Lists images.
 *
 * @param   array   $sort_by   How the images should be sorted.
 * @param   array   $search    The search query.
 *
 * @return  array   An array containing the images.
 */

function images_list( $sort_by = 'date'   ,
                      $search  = array()  ) : array
{
  // Get the user's language
  $lang = user_get_language();

  // Sanitize the search parameters
  $search_name  = sanitize_array_element($search, 'name', 'string');
  $search_type  = sanitize_array_element($search, 'type', 'int');
  $search_lang  = sanitize_array_element($search, 'lang', 'string');
  $search_comic = sanitize_array_element($search, 'comic', 'int');
  $search_nsfw  = sanitize_array_element($search, 'nsfw', 'int');

  // Search through the data
  $query_search  = ($search_name) ? " AND images.name          LIKE '%$search_name%'  " : "";
  $query_search .= ($search_type) ? " AND images.fk_image_types   = $search_type      " : "";
  $query_search .= ($search_lang && $search_lang !== '-1') ?
                                    " AND images.language      LIKE '$search_lang'    " : "";
  $query_search .= ($search_lang === '-1') ?
                                    " AND images.language  NOT LIKE 'EN'
                                      AND images.language  NOT LIKE 'FR'              " : "";
  $query_search .= ($search_comic === -1) ?
                                    " AND images.fk_comics        = 0                 " : "";
  $query_search .= ($search_comic === 1) ?
                                    " AND images.fk_comics       != 0                 " : "";
  $query_search .= ($search_nsfw) ? " AND images.is_nsfw          = $search_nsfw      " : "";

  // Sort the data
  $query_sort = match($sort_by)
  {
    'name'    => "  ORDER BY    images.name         ASC   ",
    'type'    => "  ORDER BY    image_types.name    ASC   ,
                                images.upload_date  DESC  ,
                                images.name         ASC   ",
    'lang'    => "  ORDER BY    images.language     ASC   ,
                                images.upload_date  DESC  ,
                                images.name         ASC   ",
    'nsfw'    => "  ORDER BY    images.is_nsfw      DESC  ,
                                images.upload_date  DESC  ,
                                images.name         ASC   ",
    'comic'   => "  ORDER BY    images.fk_comics    != 0  ,
                                comics.upload_date  DESC  ,
                                comics.title_$lang  ASC   ,
                                images.upload_date  DESC  ,
                                images.name         ASC   "  ,
    default   => "  ORDER BY    images.upload_date  DESC  ,
                                images.name         ASC"  ,
  };

  // Fetch the images
  $images = query("   SELECT    images.id             AS 'i_id'     ,
                                images.name           AS 'i_name'   ,
                                images.image_order    AS 'i_order'  ,
                                images.upload_date    AS 'i_date'   ,
                                images.is_nsfw        AS 'i_nsfw'   ,
                                images.language       AS 'i_lang'   ,
                                image_types.name      AS 'i_type'   ,
                                comics.title_$lang    AS 'c_title'
                      FROM      images
                      LEFT JOIN image_types
                      ON        images.fk_image_types = image_types.id
                      LEFT JOIN comics
                      ON        images.fk_comics = comics.id
                      WHERE     1 = 1
                                $query_search
                                $query_sort ");

  // Prepare the data for display
  for($i = 0; $row = query_row($images); $i++)
  {
    $data[$i]['name']       = string_truncate(sanitize_output($row['i_name']), 30, '...');
    $data[$i]['name_full']  = sanitize_output($row['i_name']);
    $data[$i]['id']         = sanitize_output($row['i_id']);
    $data[$i]['type']       = sanitize_output($row['i_type']);
    $data[$i]['comic']      = sanitize_output($row['c_title']);
    $data[$i]['order']      = sanitize_output($row['i_order']);
    $data[$i]['lang']       = sanitize_output($row['i_lang']);
    $data[$i]['date']       = time_since(sanitize_output(strtotime($row['i_date'])));
    $data[$i]['date_full']  = date_to_text(sanitize_output(strtotime($row['i_date'])));
    $data[$i]['nsfw']       = sanitize_output($row['i_nsfw']);
  }

  // Add the number of rows to the returned data
  $data['rows'] = $i;

  // Return the prepared data
  return $data;
}




/**
 * Adds an image to the database.
 *
 * @param   array       $image_file   An array containing the image's file data.
 * @param   array       $image_data   An array containing the image's data.
 *
 * @return  int|string                The image's id, or a string if an error happened.
 */

function images_add(  array $image_file ,
                      array $image_data ) : int|string
{
  // Stop here if no file was uploaded
  if(!isset($image_file['name'])      || !$image_file['name']
  || !isset($image_file['type'])      || !$image_file['type']
  || !isset($image_file['tmp_name'])  || !$image_file['tmp_name']
  || !isset($image_file['error'])     || $image_file['error'])
    return __('admin_images_add_error_file');

  // File name must be specified
  if(!isset($image_data['name']) || !$image_data['name'])
    return __('admin_images_add_error_name');

  // Sanitize and prepare the image
  $name_raw   = images_format_file_name($image_data['name']);
  $name       = sanitize($name_raw, 'string');
  $file_path  = root_path().'img/comics/'.$name_raw;
  $tmp_name   = $image_file['tmp_name'];

  // Stop here is the file name is incorrect
  if(!$name)
    return __('admin_images_add_error_misnamed');

  // Update the file name until it is available
  $underscores = '_';
  while(file_exists($file_path))
  {
    $name_raw     = images_format_file_name($underscores.$image_data['name']);
    $name         = sanitize($name_raw, 'string');
    $file_path    = root_path().'img/comics/'.$name_raw;
    $underscores .= '_';
  }

  // Sanitize and prepare the rest of the contents
  $image_comic  = sanitize($image_data['comic'], 'int');
  $image_type   = sanitize($image_data['type'], 'string');
  $image_lang   = sanitize($image_data['lang'], 'string');
  $image_order  = sanitize($image_data['order'], 'int');
  $image_nsfw   = sanitize($image_data['nsfw'], 'int');
  $image_date   = sanitize(date('Y-m-d'), 'string');

  // Upload the image
  if(move_uploaded_file($tmp_name, $file_path))
  {
    // Create the image entry
    query(" INSERT INTO images
            SET         images.name           = '$name'         ,
                        images.fk_image_types = '$image_type'   ,
                        images.fk_comics      = '$image_comic'  ,
                        images.image_order    = '$image_order'  ,
                        images.language       = '$image_lang'   ,
                        images.is_nsfw        = '$image_nsfw'   ,
                        images.upload_date    = '$image_date'   ");

    // Fetch the newly created image's id
    $image_id = query_id();
  }

  // Upload failed
  else
    return __('admin_images_add_error_failed');

  // Temporary return value
  return $image_id;
}




/**
 * Edits an existing image.
 *
 * @param   int     $image_id  The id of the image to edit.
 * @param   array   $data      The data to update the image with.
 *
 * @return  void
 */

function images_edit( int   $image_id ,
                      array $data     ) : void
{
  // Sanitize the image's id
  $image_id = sanitize($image_id, 'int');

  // Stop here if the image does not exist
  if(!database_row_exists('images', $image_id))
    return;

  // File name must be specified
  if(!isset($data['name']))
    return;

  // Fetch the image's current data
  $image_data = images_get($image_id);
  if(!$image_data)
    return;

  // Sanitize and prepare the file name
  $name_raw   = images_format_file_name($data['name']);
  $name       = sanitize($name_raw, 'string');
  $new_path   = root_path().'img/comics/'.$name_raw;
  $old_path   = root_path().'img/comics/'.$image_data['name'];

  // Rename the file if necessary
  if($new_path !== $old_path)
  {
    // The file must exist
    if(!file_exists($old_path))
      return;

    // Update the file name until it is available
    $underscores = '_';
    while(file_exists($new_path))
    {
      $name_raw     = images_format_file_name($underscores.$data['name']);
      $name         = sanitize($name_raw, 'string');
      $new_path     = root_path().'img/comics/'.$name_raw;
      $underscores .= '_';
    }

    // Move the image
    rename($old_path, $new_path);
  }

  // Sanitize the rest of the data
  $image_type   = sanitize($data['type'], 'int');
  $image_comic  = sanitize($data['comic'], 'int');
  $image_order  = sanitize($data['order'], 'int');
  $image_lang   = sanitize($data['lang'], 'string');
  $image_date   = sanitize($data['date'], 'string');
  $image_nsfw   = sanitize($data['nsfw'], 'int');
  $image_trans  = sanitize($data['trans'], 'string');

  // Edit the image
  query(" UPDATE  images
          SET     images.name           = '$name'         ,
                  images.fk_image_types = '$image_type'   ,
                  images.fk_comics      = '$image_comic'  ,
                  images.image_order    = '$image_order'  ,
                  images.language       = '$image_lang'   ,
                  images.upload_date    = '$image_date'   ,
                  images.is_nsfw        = '$image_nsfw'   ,
                  images.transcript     = '$image_trans'
          WHERE   images.id             = '$image_id'     ");
}




/**
 * Delete an existing image.
 *
 * @param   int     $image_id  The id of the image to delete.
 *
 * @return  void
 */

function images_delete( int $image_id )
{
  // Sanitize the image's id
  $image_id = sanitize($image_id, 'int');

  // Grab the image's data
  $image_data = images_get($image_id);

  // Delete the image
  query(" DELETE FROM images
          WHERE       images.id = '$image_id' ");

  // Delete the image's file
  $file_path = root_path().'img/comics/'.$image_data['name'];
  if(file_exists($file_path))
    unlink($file_path);
}




/**
 * Lists image types.
 *
 * @return  array   An array containing the image types.
 */

function image_types_list() : array
{
  // Fetch the image types
  $image_types = query("  SELECT    image_types.id    AS 'it_id' ,
                                    image_types.name  AS 'it_name'
                          FROM      image_types
                          ORDER BY  image_types.name ASC ");

  // Prepare the data for display
  for($i = 0; $row = query_row($image_types); $i++)
  {
    $data[$i]['id']   = sanitize_output($row['it_id']);
    $data[$i]['name'] = sanitize_output($row['it_name']);
  }

  // Add the number of rows to the returned data
  $data['rows'] = $i;

  // Return the prepared data
  return $data;
}




/**
 * Formats an image's file name.
 *
 * @param   string  $name   The image's file name.
 *
 * @return  string          The formatted image's file name.
 */

function images_format_file_name( ?string $name ) : string
{
  // Change the name to lowercase
  $name = string_change_case($name, 'lowercase');

  // Replace spaces with underscores
  $name = str_replace(' ', '_', $name);

  // Remove forbidden characters
  $name = str_replace('%', '', $name);
  $name = str_replace('/', '', $name);
  $name = str_replace('\\', '', $name);
  $name = str_replace('|', '', $name);
  $name = str_replace('"', '', $name);
  $name = str_replace('<', '', $name);
  $name = str_replace('>', '', $name);
  $name = str_replace('*', '', $name);
  $name = str_replace('+', '', $name);
  $name = str_replace('#', '', $name);
  $name = str_replace('&', '', $name);
  $name = str_replace('?', '', $name);

  // Return the formatted name
  return $name;
}