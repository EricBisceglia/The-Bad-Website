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




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/**********************************************************************************/ include './inc/header.inc.php'; ?>

<div class="width_50">

  <img src="<?=$path?>img/website/homepage_intro_<?=$lang_lower?>.png" alt="<?=__('home_comics_intro')?>" title="<?=__('home_comics_intro')?>">

  <img src="<?=$path?>img/website/homepage_satire_<?=$lang_lower?>.png" alt="<?=__('home_comics_satire')?>" title="<?=__('home_comics_satire')?>">

  <div class="flexcontainer">
    <div class="flex spaced_right">
      <a href="<?=$path?>comics/list">
        <img src="<?=$path?>img/website/homepage_comics_<?=$lang_lower?>.png" alt="<?=__('home_comics_comics')?>" title="<?=__('home_comics_comics')?>">
      </a>
    </div>
    <div class="flex">
      <a href="<?=$path?>about/faq">
        <img src="<?=$path?>img/website/homepage_questions_<?=$lang_lower?>.png" alt="<?=__('home_comics_questions')?>" title="<?=__('home_comics_questions')?>">
      </a>
    </div>
  </div>

  <img src="<?=$path?>img/website/homepage_language_<?=$lang_lower?>.png" alt="<?=__('home_comics_language')?>" title="<?=__('home_comics_language')?>">

  <a href="<?=$path?>about/socials">
    <img src="<?=$path?>img/website/homepage_socials_<?=$lang_lower?>.png" alt="<?=__('home_comics_satire')?>" title="<?=__('home_comics_socials')?>">
  </a>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/*************************************************************************************/ include './inc/footer.inc.php';