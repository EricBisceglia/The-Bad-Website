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

// Prepare the correct RSS link
$rss_link = ($lang === 'EN') ? 'rss' : 'rss_fr';

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

  <?php if($GLOBALS['website_url'] !== 'http://127.0.0.1/thebadwebsite/'): ?>

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

  <?php else: ?>

  <img src="<?=$path?>img/website/homepage_intro_<?=$lang?>.png" alt="<?=__('home_comics_intro')?>" title="<?=__('home_comics_intro')?>">

  <img src="<?=$path?>img/website/homepage_satire_<?=$lang?>.png" alt="<?=__('home_comics_satire')?>" title="<?=__('home_comics_satire')?>">

  <div class="flexcontainer">
    <div class="flex spaced_right">
      <a href="<?=$path?>pages/faq">
        <img src="<?=$path?>img/website/homepage_questions_<?=$lang?>.png" alt="<?=__('home_comics_questions')?>" title="<?=__('home_comics_questions')?>">
      </a>
    </div>
    <div class="flex">
      <a href="<?=$path?>pages/comics">
        <img src="<?=$path?>img/website/homepage_comics_<?=$lang?>.png" alt="<?=__('home_comics_comics')?>" title="<?=__('home_comics_comics')?>">
      </a>
    </div>
  </div>

  <img src="<?=$path?>img/website/homepage_language_<?=$lang?>.png" alt="<?=__('home_comics_language')?>" title="<?=__('home_comics_language')?>">

  <div class="flexcontainer">
    <div class="flex spaced_right">
      <a href="https://bsky.app/profile/thebad.website" target="_blank">
        <img src="<?=$path?>img/website/homepage_bluesky_<?=$lang?>.png" alt="<?=__('home_comics_bluesky')?>" title="<?=__('home_comics_bluesky')?>">
      </a>
    </div>
    <div class="flex">
      <a href="<?=$path.$rss_link?>" target="_blank">
        <img src="<?=$path?>img/website/homepage_rss_<?=$lang?>.png" alt="<?=__('home_comics_rss')?>" title="<?=__('home_comics_rss')?>">
      </a>
    </div>
  </div>

  <?php endif; ?>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/*************************************************************************************/ include './inc/footer.inc.php';