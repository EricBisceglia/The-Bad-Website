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




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/**********************************************************************************/ include './inc/header.inc.php'; ?>

<div class="width_50">

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

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/*************************************************************************************/ include './inc/footer.inc.php';