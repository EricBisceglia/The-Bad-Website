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
/*  database_row_exists                 Checks whether a row exists in a table.                                      */
/*  database_entry_exists               Checks whether an entry exists in a table.                                   */
/*                                                                                                                   */
/*  system_variable_fetch               Fetches a system variable's value.                                           */
/*  system_variable_update              Updates a system variable's value.                                           */
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
/*  diff_raw_string_arrays              Returns a raw diff between two string arrays.                                */
/*  diff_strings                        Returns a human readable list of differences between two strings.            */
/*                                                                                                                   */
/*  search_string_context               Searches for a string in a text, along with the words surrounding said string*/
/*  string_wrap_in_html_tags            Wraps HTML tags around every occurence of a string in a text.                */
/*                                                                                                                   */
/*  page_section_selector               Initializes the use of a page section selector.                              */
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
 * Fetches a system variable's value.
 *
 * @param   string  $var_name   Name of the system variable.
 *
 * @return  mixed               The value of the variable, or null if it doesn't exist.
 */

function system_variable_fetch( string $var_name ) : mixed
{
  // Sanitize the data before running the query
  $var_name = sanitize($var_name, 'string');

  // Fetch the list of global variables
  $qdescribe = query(" DESCRIBE system_variables");

  // Run through the list of global variables
  while($ddescribe = query_row($qdescribe))
  {
    // If the variable exists, fetch its value and return it
    if($ddescribe['Field'] === $var_name)
    {
      $dvar = query(" SELECT  system_variables.".$var_name." AS 'v_value'
                      FROM    system_variables ",
                      fetch_row: true);
      return ($dvar['v_value']);
    }
  }

  // If the variable does not exist, return null
  return null;
}




/**
 * Updates a system variable's value.
 *
 * @param   string  $var_name   Name of the system variable.
 * @param   string  $value      The value to give the system variable.
 * @param   string  $type       The variable type (int, float or string)
 *
 * @return  bool                1 if it went well, 0 if something went wrong.
 */

function system_variable_update(  string  $var_name ,
                                  string  $value    ,
                                  string  $type     ) : bool
{
  // Check that the variable type is allowed
  $type = sanitize($type, 'string');
  if(!in_array($type, array('int', 'float', 'string')))
    return 0;

  // Sanitize the data before running the query
  $var_name = sanitize($var_name, 'string');
  $value    = sanitize($value, $type);

  // Fetch the list of global variables
  $qdescribe = query(" DESCRIBE system_variables");

  // Run through the list of global variables
  while($ddescribe = query_row($qdescribe))
  {
    // If the variable exists, update its value and return 1
    if($ddescribe['Field'] === $var_name)
    {
      query(" UPDATE  system_variables
              SET     system_variables.".$var_name." = '$value' ");
      return 1;
    }
  }

  // If the variable does not exist, return null
  return 0;
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
    $ordinal = ($day === 1 || $day === 21 || $day === 31) ? __('ordinal_1_en') : $ordinal;
    $ordinal = (($day % 10) === 2) ? __('ordinal_2_en') : $ordinal;
    $ordinal = (($day % 10) === 3) ? __('ordinal_3_en') : $ordinal;
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
/*                                         SEARCHING AND DIFFERENCE CHECKING                                         */
/*                                                                                                                   */
/*********************************************************************************************************************/

/**
 * Returns a raw diff between two string arrays.
 *
 * This function is a prerequisite for the more useful diff_strings() function to work properly.
 * The core logic was taken from Paul Butler's simplediff through arrays method @ https://github.com/paulgb/simplediff.
 *
 * @param   array   $old  An array of strings, the older version of the texts being compared.
 * @param   array   $new  An array of strings, the newer version of the texts being compared.
 *
 * @return  array         An array of strings, showcasing the differences between the two arrays of strings.
 */

function diff_raw_string_arrays(  array $old  ,
                                  array $new  ) : array
{
  // Prepare the variables
  $matrix = array();
  $maxlen = 0;

  // Finds the largest substring in common between the two arrays
  foreach($old as $oindex => $ovalue)
  {
    $nkeys = array_keys($new, $ovalue);
    foreach($nkeys as $nindex)
    {
      $matrix[$oindex][$nindex] = isset($matrix[$oindex - 1][$nindex - 1]) ?
        $matrix[$oindex - 1][$nindex - 1] + 1 : 1;
      if($matrix[$oindex][$nindex] > $maxlen){
        $maxlen = $matrix[$oindex][$nindex];
        $omax = $oindex + 1 - $maxlen;
        $nmax = $nindex + 1 - $maxlen;
      }
    }
  }

  // If a difference has been found, return it in an array of arrays of strings
  // The deleted content is in an array called 'd', and the inserted content in an array called 'i'
  if($maxlen === 0) return array(array('d'=>$old, 'i'=>$new));

  // As long as there are differences, run this function recursively until all differences are identified
  // Content without differences is returned at the root of the returned array, not within a 'd' or 'i' sub-array
  return array_merge(
    diff_raw_string_arrays(array_slice($old, 0, $omax), array_slice($new, 0, $nmax)),
    array_slice($new, $nmax, $maxlen),
    diff_raw_string_arrays(array_slice($old, $omax + $maxlen), array_slice($new, $nmax + $maxlen))
  );
}




/**
 * Returns a human readable list of differences between two strings.
 *
 * The differences are treated word by word and not character by character.
 * The output contains HTML tags, as we use <del> and <ins> to highlight the differences.
 * The core logic was taken from Paul Butler's simplediff through arrays method @ https://github.com/paulgb/simplediff.
 *
 * @param   string  $old  The older version of the texts being compared.
 * @param   string  $new  The newer version of the texts being compared.
 *
 * @return  string        Human readable list of differences between the two arrays.
 */

function diff_strings(  string  $old  ,
                        string  $new  ) : string
{
  // Break both strings in arrays of words, then run diff_raw_string_arrays() on them
  $diff = diff_raw_string_arrays(preg_split("/[\s]+/", $old), preg_split("/[\s]+/", $new));

  // Initialize the future returned string
  $return = '';

  // Walk through the array of differences returned by diff_raw_string_arrays()
  foreach($diff as $k)
  {
    // If the element is an array, then there is a difference - wrap it between <del> or <ins> tags
    if(is_array($k))
        $return .= (!empty($k['d'])?" <del> ".implode(' ',$k['d'])." </del> ":'').(!empty($k['i'])?" <ins> ".implode(' ',$k['i'])." </ins> ":'');
    // Otherwise there's no difference, leave it as is
    else
      $return .= $k . ' ';
  }

  // Return the recomposed string
  return $return;
}




/**
 * Searches for a string in a text, along with the words surrounding said string.
 *
 * @param   string  $search                       The string being searched.
 * @param   string  $text                         The text in which to search for the string.
 * @param   int     $nb_words_around  (OPTIONAL)  Number of words to show around the string.
 *
 * @return  string                                The searched string and the words around it (or an empty string).
 */

function search_string_context( string  $search               ,
                                string  $text                 ,
                                int     $nb_words_around = 1  ) : string
{
  // Escape special characters
  $search = preg_quote($search, '/');
  $text   = preg_quote($text, '/');

  // Split the text into an array of words and make them all lowercase (this way the search becomes case insensitive)
  $words = preg_split('/\s+/u', string_change_case($text, 'lowercase'));

  // Search for the string in the array of words, and mark its positions in an array if found
  $fetch_words      = preg_grep("/".string_change_case($search, 'lowercase').".*/", $words);
  $words_positions  = array_keys($fetch_words);

  // Split the text into an array of words again, but without changing case this time
  $words = preg_split('/\s+/u', $text);

  // If the string has been found, fetch its first position
  if(count($words_positions))
    $position = $words_positions[0];

  // If the string has not been found, return an empty string
  if(!isset($position))
    return '';

  // Fetch the start and end positions based on the number of words that should be wrapped around the result
  $start  = (($position - $nb_words_around) > 0) ? $position - $nb_words_around : 0;
  $end    = ((($position + ($nb_words_around + 1)) < count($words)) ? $position + ($nb_words_around + 1) : count($words)) - $start;

  // Purge the useless array contents, keeping only the needed words (anything between start and end positions)
  $slice  = array_slice($words, $start, $end);

  // If needed, add suspension points at the beginning and/or end of the array
  $start  = ($start > 0) ? "..." : "";
  $end    = ($position + ($nb_words_around + 1) < count($words)) ? "..." : "";

  // Assemble this array of words into a string and return it
  return stripslashes($start.implode(' ', $slice).$end);
}




/**
 * Wraps HTML tags around every occurence of a string in a text.
 *
 * @param   string  $search     The string being searched.
 * @param   string  $text       The text in which the string is being searched.
 * @param   string  $open_tag   The tag to place before each occurence of the string.
 * @param   string  $close_tag  The tag to place after each occurence oft he string.
 *
 * @return  string              The result of the operation.
 */

function string_wrap_in_html_tags(  string  $search     ,
                                    string  $text       ,
                                    string  $open_tag   ,
                                    string  $close_tag  ) : string
{
  // Escape special characters
  $search = preg_quote($search, '/');
  $text   = preg_quote($text, '/');

  // Use a regex to do the trick and return the result
  return stripslashes(preg_replace("/($search)/i", "$open_tag$1$close_tag", $text));
}




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                    PAGE LAYOUT                                                    */
/*                                                                                                                   */
/*********************************************************************************************************************/

/**
 * Initializes the use of a page section selector.
 *
 * @param   array   $entries  The list of all menu entries.
 * @param   string  $default  The menu entry to use when none is being selected.
 *
 * @return  array             An array of data ready for use in assembling a page section selector.
 */

function page_section_selector( array   $entries  ,
                                string  $default  ) : array
{
  // Initialize the return array and the selected entry
  $data     = array();
  $selected = '';

  // Loop through the menu entries in order to find whether a selection is being made
  foreach($entries as $entry)
  {
    // Check whether the menu entry is being selected
    if(isset($_GET[$entry]))
      $selected = $entry;
  }

  // Add the selected menu entry to the returned data
  $data['selected'] = $selected;

  // Loop once again through the menu entries in order to prepare the data
  foreach($entries as $entry)
  {
    // Define which dropdown menu entry should be selected and which page sections should be hidden
    $data['menu'][$entry] = ($selected === $entry || (!$selected && $entry === $default)) ? ' selected' : '';
    $data['hide'][$entry] = ($selected === $entry || (!$selected && $entry === $default)) ? '' : ' hidden';
  }

  // Return the assembled data
  return $data;
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