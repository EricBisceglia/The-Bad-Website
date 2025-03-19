<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*  images_add                    Adds an image to the database                                                      */
/*                                                                                                                   */
/*  image_types_list              Lists image types                                                                  */
/*                                                                                                                   */
/*  images_format_file_name       Formats an image's file name                                                       */
/*                                                                                                                   */
/*********************************************************************************************************************/

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
    $name_raw   = images_format_file_name($underscores.$image_data['name']);
    $name       = sanitize($name_raw, 'string');
    $file_path = root_path().'img/comics/'.$name_raw;
    $underscores .= '_';
  }

  // Sanitize and prepare the rest of the contents
  $image_type = sanitize($image_data['type'], 'string');
  $image_lang = sanitize($image_data['lang'], 'string');
  $image_nsfw = sanitize($image_data['nsfw'], 'int');
  $image_date = sanitize(date('Y-m-d'), 'string');

  // Upload the image
  if(move_uploaded_file($tmp_name, $file_path))
  {
    // Create the image entry
    query(" INSERT INTO images
            SET         images.name           = '$name'       ,
                        images.fk_image_types = '$image_type' ,
                        images.language       = '$image_lang' ,
                        images.is_nsfw        = '$image_nsfw' ,
                        images.upload_date    = '$image_date'  ");

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