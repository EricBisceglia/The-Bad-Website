<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './inc/includes.inc.php';  # Core
include_once './lang/main.lang.php'; # Translations

// Page summary
$page_lang        = array('FR', 'EN');
$page_url         = "index";
$page_description = "Hi, this is Bad, and you're on the wrong website.";

// Hide header and footer except in local dev mode
if($GLOBALS['website_url'] !== 'http://127.0.0.1/thebadwebsite/')
{
  $hide_header = true;
  $hide_footer = true;
}




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/**********************************************************************************/ include './inc/header.inc.php'; ?>

<div class="width_50">

  <h1 class="gigapadding_top bigpadding_bot align_center">
    <?=__link('https://bsky.app/profile/thebad.website', __('home_intro_title'), 'text_light', is_internal: false)?>
  </h1>

  <p class="align_center big">
    <?=__link('https://bsky.app/profile/thebad.website', __('home_intro_text'), 'text_light', is_internal: false)?>
  </p>

  <p class="bigpadding_top align_center big">
    <?=__link('https://bsky.app/profile/thebad.website', __('home_intro_bsky'), 'text_light', is_internal: false)?>
  </p>

  <p class="align_center hugepadding_top">
    <a href="https://bsky.app/profile/thebad.website">
      <img style="height: 6.0rem; width: 6.0rem;" src="<?=$path?>img/icons/bluesky_page.png" alt="Bluesky" title="Bluesky">
    </a>
  </p>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/*************************************************************************************/ include './inc/footer.inc.php';