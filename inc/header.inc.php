<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                 THIS PAGE CAN ONLY BE USED IN SPECIFIC SITUATIONS                                 */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Restrictions and prerequisites

// If the user doesn't have a set language, stop here
if(!isset($lang))
  exit(__('error_forbidden'));

// Set a lowercase language variable
$lang_lower = string_change_case($lang, 'lowercase');




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Default variable values (those are required by the header but it's fine if they're not set)

// Check whether the page exists in the user's current language - if not, throw an error message
$lang_error = (isset($page_lang) && !in_array($lang, $page_lang));

// Determine the current url
$current_url = $_SERVER['REQUEST_URI'];




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                  HEADER CONTENTS                                                  */
/*                                                                                                                   */
/*********************************************************************************************************************/


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Page title

// Set the current page title based on the user's language
$page_title = ($lang === 'EN' && isset($page_title_en)) ? $page_title_en : '';
$page_title = ($lang === 'FR' && isset($page_title_fr)) ? $page_title_fr : $page_title;

// If the current page is unnamed, simply call it The Bad Website - or Devmode when in dev mode
$default_page_title = ($lang === 'EN') ? 'The Bad Website' : 'Le mauvais site';
$page_title = ($page_title) ? sanitize_meta_tags($page_title.' | '.$default_page_title) : $default_page_title;




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Page description

// If there is no description, use a default generic one
$page_description = (isset($page_description)) ? $page_description : $page_title_en." - See more by visiting this page on thebad.website";

// Shorten the description if it is too long
if(strlen($page_description) >= 155)
  $page_description = string_truncate($page_description, 150, '...');

// Make the page's description W3C meta tag compliant
$page_description = sanitize_meta_tags($page_description);

// Set the page description to default if it is too short
if(strlen($page_description) <= 25 && !isset($page_is_a_comic))
  $page_description = $page_title_en." - See more by visiting this page on thebad.website";
if(strlen($page_description) <= 25 && isset($page_is_a_comic))
  $page_description = $page_title_en." - A comic on The Bad Website";




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Header smuggies

// Pick a random smuggie
$header_smuggie = (isset($this_page_is_a_404)) ? '404_'.rand(1,8) : rand(1,12);




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Page image

// If there is no image, use a header smuggie
$page_image = (isset($page_image)) ? $page_image : $GLOBALS['website_url'].'img/website/header_smuggie_3.png';





/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                  FILE INCLUSIONS                                                  */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CSS stylesheets

// Include the default stylesheets (weird line breaks are for indentation)
$stylesheets = '<link rel="stylesheet" href="'.$path.'css/thebadwebsite.css" type="text/css">';

// If extra stylesheets are set, add them to the list
if(isset($css))
{
  // Loop through all extra sheets and include them
  for($i = 0; $i < count($css); $i++)
    $stylesheets .= '
    <link rel="stylesheet" href="'.$path.'css/'.$css[$i].'.css" type="text/css">';
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// JavaScript files

// Include the default javascript files (weird line breaks are for indentation)
$javascripts = '
    <script src="'.$path.'js/common/thebadwebsite.js"> </script>
    <script src="'.$path.'js/common/header.js"> </script>';

// If extra JS files are set, add them to the list
if (isset($js))
{
  // Loop through all files and include them
  for($i = 0; $i < count($js); $i++)
    $javascripts .= '
    <script src="'.$path.'js/'.$js[$i].'.js"> </script>';
}

// Add a line break at the end to preserve indentation
$javascripts .= '
';



/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                           DISPLAY THE HEADER AND MENUS                                            */
/*                                                                                                                   */
/******************************************************************************************************************/ ?>

<!DOCTYPE html>
<html lang="<?=string_change_case($lang,'lowercase')?>">
  <head>
    <title><?=$page_title?></title>
    <link rel="canonical" href="<?='https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>">
    <meta name="robots" content="index, follow">
    <link rel="shortcut icon" href="<?=$path?>favicon.ico">
    <link rel="icon" href="<?=$path?>favicon.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="<?=$page_description?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?=$page_title?>">
    <meta property="og:description" content="<?=$page_description?>">
    <meta property="og:url" content="<?='https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>">
    <meta property="og:site_name" content="The Bad Website">
    <meta property="og:image" content="<?=$page_image?>">
    <meta property="og:locale" content="en_US">
    <meta property="og:locale:alternate" content="fr_FR">
    <link rel="icon" href="<?=$path.'favicon.ico'?>">
    <?=$stylesheets?>
    <?=$javascripts?>
  </head>

  <?php if(isset($this_page_is_a_404)) { ?>
  <body id="body" onload="this_page_is_a_404();">
  <?php } else if(isset($onload)) { ?>
  <body id="body" onload="<?=$onload?>">
  <?php } else { ?>
  <body id="body">
  <?php } ?>

  <?php if(!isset($hide_header)) { ?>

  <input id="root_path" type="hidden" class="hidden" value="<?=$path?>">

    <div class="header_topbar">

      <div class="header_topmenu width_50">

        <div id="header_titles" class="header_topmenu_zone">

          <a href="<?=$path?>index">
            <div class="header_topmenu_title header_topmenu_smug" id="header_menu_title_home">
              <img src="<?=$path?>img/website/header_smuggie_<?=$header_smuggie?>.png" alt="Home" title="<?=__('menu_top_home')?>" class="header_topmenu_smuggie">
            </div>
          </a>

          <a href="<?=$path?>comics/list">
            <div class="header_topmenu_title" id="header_menu_title_comics">
              <?=__('menu_top_comics')?>
            </div>
          </a>

          <a href="<?=$path?>stuff/list">
            <div class="header_topmenu_title" id="header_menu_title_stuff">
              <?=__('menu_top_stuff')?>
            </div>
          </a>

          <a href="<?=$path?>about/faq">
            <div class="header_topmenu_title" id="header_menu_title_about">
              <?=__('menu_top_about')?>
            </div>
          </a>

          <a href="<?=$path?>about/socials">
            <div class="header_topmenu_title" id="header_menu_title_social">
              <?=__('menu_top_social')?>
            </div>
          </a>

        </div>

        <div class="header_topmenu_zone">

          <form id="language" method="post">
            <input type="hidden" name="change_language" value="change_language">
            <?php if($lang === 'FR') { ?>
            <img class="header_topmenu_icon header_topmenu_flag" src="<?=$path?>img/icons/lang_en.png" alt="EN" title="<?=string_change_case(__('english'), 'initials')?>" onclick="user_change_language();">
            <?php } else { ?>
            <img class="header_topmenu_icon header_topmenu_flag" src="<?=$path?>img/icons/lang_fr.png" alt="FR" title="<?=string_change_case(__('french'), 'initials')?>" onclick="user_change_language();">
            <?php } ?>
          </form>

        </div>
      </div>

    </div>


<?php /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//                                                                                                                   //
//                                             END HEADER AND BEGIN PAGE                                             //
//                                                                                                                   //
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////?>

    <div class="header_main_page">

      <?php } if($lang_error) { ?>

      <div class="align_center monospace bigpadding_bot">
        <?=__('header_language_error');?>
      </div>

      <?php } ?>