<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*  root_path                           Returns the path to the root of the website                                  */
/*                                                                                                                   */
/*  page_enforce_url                    Enforce a single url for the page                                            */
/*                                                                                                                   */
/*  database_row_exists                 Checks whether a row exists in a table.                                      */
/*  database_entry_exists               Checks whether an entry exists in a table.                                   */
/*                                                                                                                   */
/*  page_is_fetched_dynamically         Is the page being fetched dynamically.                                       */
/*  page_must_be_fetched_dynamically    Throws a 404 if the page is not being fetched dynamically.                   */
/*                                                                                                                   */
/*  has_file_been_included              Checks whether a specific file has been included.                            */
/*  require_included_file               Requires a file to be included or exits the script.                          */
/*                                                                                                                   */
/*  form_fetch_element                  Fetches the unsanitized value or returns the existence of submitted user data*/
/*                                                                                                                   */
/*  string_truncate                     Truncates a string if it is longer than a specified length.                  */
/*  string_change_case                  Changes the case of a string.                                                */
/*  string_remove_accents               Removes accentuated latin characters from a string.                          */
/*  string_increment                    Increments the last character of a string.                                   */
/*                                                                                                                   */
/*  date_to_text                        Transforms a MySQL date or a timestamp into a plaintext date.                */
/*  date_to_ddmmyy                      Converts a mysql date to the DD/MM/YY format.                                */
/*  date_to_mysql                       Converts a date to the mysql date format.                                    */
/*  date_to_aware_datetime              Converts a timestamp to an aware datetime.                                   */
/*                                                                                                                   */
/*  time_since                          Returns in plain text how long ago a timestamp happened.                     */
/*                                                                                                                   */
/*  user_get_language                   Returns the current user's language.                                         */
/*                                                                                                                   */
/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                   GENERIC TOOLS                                                   */
/*                                                                                                                   */
/*********************************************************************************************************************/

/**
 * Returns the path to the root of the website.
 *
 * @return  string  The path to the root of the website.
 */

function root_path() : string
{
  // Define where to look for URLs: account for the two slashes in http://, then add extra folders from local settings
  $uri_base_slashes = 2 + $GLOBALS['extra_folders'];

  // Check how far removed from the project root the current path is
  $uri_length = count(explode( '/', $_SERVER['REQUEST_URI']));

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

  // Return the current root path
  return $path;
}



/**
 * Enforce a single url for the page.
 *
 * @param   string  $url  The url to enforce.
 */

function page_enforce_url( string $enforced_url ) : void
{
  // Get the current requested URL path
  $requested_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

  // Remove any extra folders
  $segments       = explode('/', ltrim($requested_url, '/'));
  $segments       = array_slice($segments, $GLOBALS['extra_folders']);
  $requested_url  = implode('/', $segments);

  // If the enforced url isn't the requested url, redirect to it
  if ($enforced_url !== $requested_url) {
    exit(header("Location: ./../$enforced_url", true, 301));
  }
}



/**
 * Checks whether a row exists in a table.
 *
 * @param   string  $table  Name of the table.
 * @param   int     $id     ID of the row.
 *
 * @return  bool            Whether the row exists or not.
 */

function database_row_exists( string  $table  ,
                              int     $id     ) : bool
{
  // Sanitize the data before running the query
  $table  = sanitize($table, 'string');
  $id     = sanitize($id, 'int', 0);

  // Check whether the row exists
  $dcheck = query(" SELECT  $table.id AS 'r_id'
                    FROM    $table
                    WHERE   $table.id = '$id' ",
                    fetch_row: true);

  // Return the result
  return (isset($dcheck['r_id']));
}




/**
 * Checks whether an entry exists in a table.
 *
 * @param   string  $table                  Name of the table.
 * @param   string  $field                  Name of the field.
 * @param   mixed   $value                  Data value to look for.
 * @param   bool    $sanitize  (OPTIONAL)   Sanitize the value before looking it up.
 *
 * @return  int                             The id of the row containing the entry, or 0 if it does not exist.
 */

function database_entry_exists( string  $table            ,
                                string  $field            ,
                                mixed   $value            ,
                                bool    $sanitize = false ) : int
{
  // Sanitize the data before running the query
  $table  = sanitize($table, 'string');
  $field  = sanitize($field, 'string');
  $value  = ($sanitize) ? sanitize($value, 'string') : $value;

  // Check whether the entry exists
  $dcheck = query(" SELECT  $table.id AS 'r_id'
                    FROM    $table
                    WHERE   $table.$field = '$value' ",
                    fetch_row: true);

  // Return the result
  return (isset($dcheck['r_id'])) ? $dcheck['r_id'] : 0;
}




/**
 * Is the page being fetched dynamically.
 *
 * @return  bool  Whether the page is being called through fetch or not.
 */

function page_is_fetched_dynamically() : bool
{
  // Return whether the fetched header is set
  return isset($_SERVER['HTTP_FETCHED']);
}




/**
 * Throws a 404 if the page is not being fetched dynamically.
 *
 * @return void
 */

function page_must_be_fetched_dynamically() : void
{
  // Fetch the path to the website's root
  $path = root_path();

  // If the fetched header is not set, throw a 404
  if(!page_is_fetched_dynamically())
    exit(header("Location: ".$path."404"));
}




/**
 * Checks whether a specific file has been included.
 *
 * @param   string  $file_name  The name of the file that should have been included.
 *
 * @return  bool                Whether the file has currently been included or not.
 */

function has_file_been_included( string $file_name ) : bool
{
  // Fetch all included files
  $included_files = get_included_files();

  // Check if the requested file has been included
  foreach($included_files as $included_file)
  {
    // If the file has been included, return 1
    if(basename($included_file) === $file_name)
      return 1;
  }

  // If the file has not been included, return 0
  return 0;
}




/**
 * Requires a file to be included or exits the script.
 *
 * @param   string  $file_name  The name of the file that must be included.
 *
 * @return  void
 */

function require_included_file( string $file_name ) : void
{
  // If the file has not been included, exit the script
  if(!has_file_been_included($file_name))
    exit($file_name.' is required for this page to work as intended');
}




/**
 * Fetches the unsanitized value or returns the existence of submitted user data.
 *
 * @param   string  $element_name               The name of the element.
 * @param   mixed   $default_value  (OPTIONAL)  Value to return if the element does not exist.
 * @param   bool    $element_exists (OPTIONAL)  Only returns whether the element exists (eg. checkbox).
 * @param   string  $request_type   (OPTIONAL)  The type of request ('POST', 'GET', 'FILES').
 *
 * @return  mixed                               The unsanitized value of the element (or default).
 */

function form_fetch_element(  string  $element_name             ,
                              mixed   $default_value  = NULL    ,
                              bool    $element_exists = false   ,
                              string  $request_type   = 'POST'  ) : mixed
{
  // If the goal is only to check existence, just return whether the element exists or not
  if($element_exists)
  {
    if($request_type === 'GET')
      return (isset($_GET[$element_name]));
    else if($request_type === 'FILES')
      return (isset($_FILES[$element_name]));
    else
      return (isset($_POST[$element_name]));
  }

  // Otherwise return the unsanitized value of the element if it exists
  else
  {
    if($request_type === 'GET')
      return (isset($_GET[$element_name])) ? $_GET[$element_name] : $default_value;
    else if($request_type === 'FILES')
      return (isset($_FILES[$element_name])) ? $_FILES[$element_name] : $default_value;
    else
      return (isset($_POST[$element_name])) ? $_POST[$element_name] : $default_value;
  }
}




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                STRING MANIPULATION                                                */
/*                                                                                                                   */
/*********************************************************************************************************************/

/**
 * Truncates a string if it is longer than a specified length.
 *
 * @param   string  $string               The string that will be truncated.
 * @param   int     $length               The length above which the string will be truncated.
 * @param   string  $suffix   (OPTIONAL)  Appends text to the end of the string if it has been truncated.
 *
 * @return  string                        The string, truncated if necessary.
 */

function string_truncate( ?string $string       ,
                          int     $length       ,
                          string  $suffix = ''  ) : ?string
{
  // If the string is null, return null
  if(is_null($string))
    return null;

  // If the string needs to be truncated, then do it and apply the suffix, else return the string as is
  return (mb_strlen($string, 'UTF-8') > $length) ? mb_substr($string, 0, $length, 'UTF-8').$suffix : $string;
}




/**
 * Changes the case of a string.
 *
 * @param   string  $string   The string that will have its case changed.
 * @param   string  $case     The case to apply to the string ('uppercase', 'lowercase', 'initials')
 *
 * @return  string            The string, with its case changed.
 */

function string_change_case(  ?string $string ,
                              string  $case   ) : string
{
  // Changes the string to all uppercase
  if($case === 'uppercase')
    return mb_convert_case((string)$string, MB_CASE_UPPER, "UTF-8");

  // Changes the string to all lowercase
  else if($case === 'lowercase')
    return mb_convert_case((string)$string, MB_CASE_LOWER, "UTF-8");

  // Changes the first character of the string to uppercase, ignores the rest
  else if($case === 'initials')
    return mb_substr(mb_convert_case((string)$string, MB_CASE_UPPER, "UTF-8"), 0, 1, 'utf-8').mb_substr((string)$string, 1, 65536, 'utf-8');

  // Return nothing otherwise
  else
    return '';
}




/**
 * Removes accentuated latin characters from a string.
 *
 * @param   string  $string   The string which is about to lose its latin accents.
 *
 * @return  string            The string, without its latin accents.
 */

function string_remove_accents( string $string ) : string
{
  // Simply enough, prepare two arrays: accents and their non accentuated equivalents
  $accents    = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,ø,Ø,Å,Á,À,Â,Ä,È,É,Ê,Ë,Í,Î,Ï,Ì,Ò,Ó,Ô,Ö,Ú,Ù,Û,Ü,Ÿ,Ç,Æ,Œ");
  $no_accents = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,o,O,A,A,A,A,A,E,E,E,E,I,I,I,I,O,O,O,O,U,U,U,U,Y,C,AE,OE");

  // Replace any occurence of the first set of characters by its equivalent in the second
  return str_replace($accents, $no_accents, $string);
}




/**
 * Increments the last character of a string.
 *
 * This is mainly meant to increment versioning strings (eg. rc1, beta3, etc.).
 * If the string does not end in a number, then the number 1 will be appended to the end of the string.
 *
 * @param   string  $string   The string to increment.
 *
 * @return  string            The incremented string.
 */

function string_increment( string $string ) : string
{
  // If the string is empty, return one
  if(!$string)
    return 1;

  // Get the last character of the string
  $last_character =  substr($string, -1);

  // If that character is a number, increment it
  if(is_numeric($last_character))
    return substr($string, 0, -1).($last_character + 1);

  // Otherwise, append an 1 to the end of the string
  return $string.'1';
}




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                             DATE FORMAT MANIPULATION                                              */
/*                                                                                                                   */
/*********************************************************************************************************************/

/**
 * Transforms a MySQL date or a timestamp into a plaintext date.
 *
 * MySQL gives us dates in the YYYY-MM-DD format, and we often want to display them in plaintext.
 * We store a lot of our dates in timestamps aswell, this function can work with a timestamp as an input too.
 * If no date is specified, it returns the current date instead.
 *
 * @param   string|int  $date           (OPTIONAL)  The MySQL date or timestamp that we want to transform.
 * @param   int         $strip_day      (OPTIONAL)  If 1, strips the day's name. If 2, strips the whole day.
 * @param   int         $include_time   (OPTIONAL)  If 1, will add the time after the date. If 2, strips seconds.
 * @param   bool        $strip_year     (OPTIONAL)  If set, omits the year from the returned data.
 * @param   string      $lang           (OPTIONAL)  The language used, defaults to current lang.
 *
 * @return  string                                  The required date, in plaintext.
 */

function date_to_text(  mixed   $date         = ''    ,
                        int     $strip_day    = 0     ,
                        int     $include_time = 0     ,
                        bool    $strip_year   = false ,
                        string  $lang         = ''    ) : string
{
  // If no date has been entered, use the current timestamp instead
  $date = (!$date) ? time() : $date;

  // If we are dealing with a MySQL date, transform it into a timestamp
  $date = (!is_numeric($date)) ? strtotime($date) : $date;

  // Fetch the user's language if none was specified
  $lang = (!$lang) ? user_get_language() : $lang;
  $lang = string_change_case($lang, 'lowercase');

  // Decompose the date
  $day      = date('j', $date);
  $weekday  = date('N', $date);
  $month    = date('n', $date);
  $year     = date('Y', $date);
  $time     = date('H:i', $date);
  $seconds  = date('s', $date);

  // Prepare an empty return string
  $return = '';

  // Add the plaintext day to the return string
  if(!$strip_day)
  {
    $return .= __('day_'.$weekday.'_'.$lang);
    $return .= ($lang === 'en') ? "," : "";
  }

  // Add the month to the return string if the date is in english
  if($lang === 'en')
    $return .= " ".__('month_'.$month.'_en');

  // Add the day's number to the return string
  if($strip_day < 2)
    $return .= " ".date('j', $date);

  // Add the day's ordinal to the return string
  if($strip_day < 2 && $lang === 'en')
  {
    $ordinal = __('ordinal_0_en');
    $ordinal = (($day % 10) === 1 && $day <> 11) ? __('ordinal_1_en') : $ordinal;
    $ordinal = (($day % 10) === 2 && $day <> 12) ? __('ordinal_2_en') : $ordinal;
    $ordinal = (($day % 10) === 3 && $day <> 13) ? __('ordinal_3_en') : $ordinal;
    $return .= $ordinal;
  }
  else if($strip_day < 2 && $lang === 'fr')
    $return .= ($day === 1) ? __('ordinal_1_fr') : '';

  // Add the month to the return string if the date is in french
  if($lang === 'fr')
    $return .= " ".string_change_case(__('month_'.$month.'_fr'), 'lowercase');

  // Add the year to the return string
  if(!$strip_year)
    $return .= " ".$year;

  // Add the time to the return string
  if($include_time)
  {
    $return .= " ".__('time_indicator_'.$lang);
    $return .= " ".$time;
    $return .= ($include_time === 1) ? ":".$seconds : '';
  }

  // Return the formatted date
  return $return;
}




/**
 * Converts a mysql date to the DD/MM/YY format.
 *
 * MySQL gives us dates in the YYYY-MM-DD format, and we often want to display them in the DD/MM/YY format.
 * If any american reading this is unhappy with my use of DD/MM/YY over MM/DD/YY, sorry not sorry get used to it :)
 * If no date is specified or the mysql date is '0000-00-00', then we return nothing.
 *
 * @param   string        $date   The MySQL date that will be converted.
 *
 * @return  string|null           The converted MySQL date.
 */

function date_to_ddmmyy( string $date ) : mixed
{
  // If the date is not set or '0000-00-00', return null
  if(!$date || $date === '0000-00-00')
    return NULL;

  // Else, return the date in the DD/MM/YY format
  return date('d/m/y',strtotime($date));
}




/**
 * Converts a date to the mysql date format.
 *
 * MySQL stores dates in the YYYY-MM-DD format, and user input is often in DD/MM/YY, so we have to adapt to it.
 * This function's goal is to directly transform user input into a ready to use MySQL formatted date string.
 * If the person entering the date is american and inputs MM/DD/YY, well, too bad. Can't do anything about it.
 *
 * @param   string  $date     The date that will be converted - can be DD/MM/YY or DD/MM/YYYY.
 * @param   string  $default  The default date to use if the format is incorrect.
 *
 * @return  string            The converted date in MySQL date format.
 */

function date_to_mysql( string  $date                   ,
                        string  $default = '0000-00-00' ) : string
{
  // If the date is DD/MM/YYYY, convert it to the correct format
  if(strlen($date) === 10)
    $date = date('Y-m-d', strtotime(str_replace('/', '-', $date)));

  // Same thing if the date is DD/MM/YY
  else if(strlen($date) === 8)
    $date = date('Y-m-d', strtotime(substr($date,6,2).'-'.substr($date,3,2).'-'.substr($date,0,2)));

  // Otherwise, return the absence of a MySQL date
  else
    return $default;

  // If the converted date is incorrect, also return the absence of a MySQL date
  if($date === '1970-01-01')
    return $default;

  // Return the converted date
  return $date;
}




/**
 * Converts a timestamp to an aware datetime.
 *
 * @param   int     $timestamp  The timestamp which will be converted.
 *
 * @param   array               An array containing enough information to be an aware datetime.
 */


function date_to_aware_datetime( int $timestamp ) : array
{
  // Assemble an array with the datetime and its timezone
  $datetime['datetime'] = date('c', $timestamp);
  $datetime['timezone'] = $GLOBALS['timezone'];

  // Convert and return the timestamp
  return $datetime;
}




/**
 * Returns in plain text how long ago a timestamp happened.
 *
 * @param   int     $timestamp  The timestamp at which the event happened.
 *
 * @return  string              A plain text description of how long ago the event happened.
 */

function time_since( int $timestamp ) : string
{
  // Base the result on the difference between the event and the current timestamp
  $time_since = time() - $timestamp;

  // Return the time difference in plain text
  if($time_since < 0)
    return __('time_diff_past_future');
  else if ($time_since === 0)
    return __('time_diff_past_now');
  else if ($time_since === 1)
    return __('time_diff_past_second');
  else if ($time_since <= 60)
    return __('time_diff_past_seconds', $time_since, 0, 0, array($time_since));
  else if ($time_since <= 120)
    return __('time_diff_past_minute');
  else if ($time_since <= 3600)
    return __('time_diff_past_minutes', $time_since, 0, 0, array(floor($time_since/60)));
  else if ($time_since <= 7200)
    return __('time_diff_past_hour');
  else if ($time_since <= 86400)
    return __('time_diff_past_hours', $time_since, 0, 0, array(floor($time_since/3600)));
  else if ($time_since <= 172800)
    return __('time_diff_past_day');
  else if ($time_since <= 259200)
    return __('time_diff_past_2days');
  else if ($time_since <= 31536000)
    return __('time_diff_past_days', $time_since, 0, 0, array(floor($time_since/86400)));
  else if ($time_since <= 63072000)
    return __('time_diff_past_year');
  else if ($time_since <= 3153600000)
    return __('time_diff_past_years', $time_since, 0, 0, array(floor($time_since/31536000)));
  else if ($time_since <= 6307200000)
    return __('time_diff_past_century');
  else
    return __('time_diff_past_long');
}




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                       USERS                                                       */
/*                                                                                                                   */
/*********************************************************************************************************************/

/**
 * Returns the current user's language.
 *
 * @return  string  The user's language, defaults to english if not found.
 */

function user_get_language() : string
{
  // Returns the language settings stored in the session - or english if none
  return (!isset($_SESSION['lang'])) ? 'EN' : $_SESSION['lang'];
}
