<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../404")); die(); }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Let's begin by opening the session

secure_session_start();




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Language management

// If there is no language in the session, assign one
if(!isset($_SESSION['lang']))
{
  // If there is no language cookie, then the default language is fetched from the browser's accept language headers
  if(!isset($_COOKIE['bad_website_language']))
  {
    // Fetch the language settings (default to english if it isn't french or if it isn't found)
    if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
      $language_header  = (substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) === 'fr') ? 'FR' : 'EN';
    else
      $language_header  = 'EN';

    // Create the cookie and the session variable
    $_SESSION['lang'] = $language_header;
    setcookie(  "bad_website_language"      ,
                $language_header            ,
              [ 'expires'   => 2147483647   ,
                'path'      => '/'          ,
                'samesite'  => 'None'       ,
                'secure'    => true         ]);
  }

  // If the language cookie exists, set the session language to the one in the cookie
  else
    $_SESSION['lang'] = $_COOKIE['bad_website_language'];
}

// If the user clicks on the language flag, change the language accordingly
if(isset($_POST['change_language']))
{
  // Get the language that the user is currently not using
  $changelang = ($_SESSION['lang'] === 'EN') ? 'FR' : 'EN';

  // Change the cookie and session language to the new one
  $_SESSION['lang'] = $changelang;
  setcookie(  "bad_website_language"      ,
              $changelang                 ,
            [ 'expires'   => 2147483647   ,
              'path'      => '/'          ,
              'samesite'  => 'None'       ,
              'secure'    => true         ]);
}

// Use the $lang variable to store the language for the duration of the session (the header and other pages need it)
$lang = (!isset($_SESSION['lang'])) ? 'EN' : $_SESSION['lang'];




/**
 * Starts a session.
 *
 * Look, I just don't trust PHP sessions. I'm not a fan of them, ok? Call this instead of session_start().
 * A new session token is generated on every page load, to ensure full regen of everything.
 *
 * @return void
 */

function secure_session_start() : void
{
  // This public token will be used to identify the session name
  $session_name = 'bad_website';

  // This is where it gets tricky: force this session to only use cookies or block execution of the application
  if (ini_set('session.use_only_cookies', 1) === FALSE) {
      exit('<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body>Can not start secure session. Please enable cookies.</body></html>');
  }

  // Fetch the current cookie
  $cookieParams = session_get_cookie_params();

  // Prepare a session cookie every time a new page is loaded
  session_set_cookie_params(  $cookieParams["lifetime"]                 ,
                              $cookieParams["path"].';SameSite=Strict;' ,
                              $cookieParams["domain"]                   ,
                              true                                      ,  // Enforce HTTPS
                              true                                      ); // Ensures it can't be caught by js

  // Start the session, for real this time
  session_name($session_name);
  session_start();
  session_regenerate_id();
}