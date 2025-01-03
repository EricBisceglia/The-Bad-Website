<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../404")); die(); }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Main configuration

// Require PHP8
if(version_compare(phpversion(), '8.0.0', '<'))
  exit("The Bad Website requires at least PHP8 to run properly.");

// Include the local configuration file
if(file_exists(dirname(__FILE__).'/../conf/main.conf.php'))
  include_once dirname(__FILE__).'/../conf/main.conf.php';
else
  exit("The Bad Website is incorrectly installed: The local configuration file is missing.");

// If no MySQL password is provided, then it's not even worth trying to do anything
if(!isset($GLOBALS['mysql_pass']))
  exit("The Bad Website is incorrectly installed: The local configuration file is incorrect.");

// Give global variables a default value if they're unset
$bad_website_url = "https://thebad.website/";
$GLOBALS['website_url']   = isset($GLOBALS['website_url'])    ? $GLOBALS['website_url']   : $bad_website_url;
$GLOBALS['domain_name']   = isset($GLOBALS['domain_name'])    ? $GLOBALS['domain_name']   : 'thebad.website';
$GLOBALS['mysql_host']    = isset($GLOBALS['mysql_host'])     ? $GLOBALS['mysql_host']    : 'localhost';
$GLOBALS['mysql_user']    = isset($GLOBALS['mysql_user'])     ? $GLOBALS['mysql_user']    : 'thebadwebsite';
$GLOBALS['timezone']      = isset($GLOBALS['timezone'])       ? $GLOBALS['timezone']      : 'Europe/Paris';
$GLOBALS['extra_folders'] = isset($GLOBALS['extra_folders'])  ? $GLOBALS['extra_folders'] : 0;

// Enforce a global timezone on the server side
date_default_timezone_set($GLOBALS['timezone']);

// Use english as the locale for everything
setlocale(LC_ALL, "en_EN@euro", "en_EN");

// Make var_dumps unlimited in size
ini_set('xdebug.var_display_max_depth', '-1');
ini_set('xdebug.var_display_max_children', '-1');
ini_set('xdebug.var_display_max_data', '-1');




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Definition of the $path variable, which will be used to build URLs all over the website

// Define where to look for URLs: account for the two slashes in http://, then add extra folders from local settings
$uri_base_slashes = 2 + $GLOBALS['extra_folders'];

// Check how far removed from the project root the current path is
$request_uri  = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : $root_path;
$uri_length   = count(explode( '/', $request_uri));

// If we are at the project root, then there is no $path
if($uri_length <= $uri_base_slashes)
  $path = "";

// Otherwise, increment the $path for each folder that must be ../ until reaching the root at ./
else
{
  $path = "./";
  for ($i = 0 ; $i < ($uri_length - $uri_base_slashes) ; $i++)
    $path .= "../";
}