<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php'; # Core
include_once './../lang/main.lang.php';   # Translations

// Page summary
$page_lang        = array('FR', 'EN');
$page_url         = "pages/about";
$page_description = "Hi, this is Bad, and you're on the wrong website.";




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/*******************************************************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50">

  <div>
    <img src="<?=$path?>img/website/about_intro_<?=$lang?>.png" alt="<?=__('about_comics_intro')?>" title="<?=__('about_comics_intro')?>">
  </div>

  <h5 class="hugepadding_top smallpadding_bot">
    <?=__('about_quality_title')?>
  </h5>

  <p>
    <?=__('about_quality_body_1')?>
  </p>

  <p>
    <?=__('about_quality_body_2')?>
  </p>

  <p>
    <?=__('about_quality_body_3')?>
  </p>

  <h5 class="hugepadding_top smallpadding_bot">
    <?=__('about_pastels_title')?>
  </h5>

  <p>
    <?=__('about_pastels_body_1')?>
  </p>

  <p>
    <?=__('about_pastels_body_2')?>
  </p>

  <h5 class="hugepadding_top smallpadding_bot">
    <?=__('about_offended_title')?>
  </h5>

  <p>
    <?=__('about_offended_body_1')?>
  </p>

  <p>
    <?=__('about_offended_body_2')?>
  </p>

  <p>
    <?=__('about_offended_body_3')?>
  </p>

  <p>
    <?=__('about_offended_body_4')?>
  </p>

  <p>
    <?=__('about_offended_body_5')?>
  </p>

  <h5 class="hugepadding_top smallpadding_bot">
    <?=__('about_credits_title')?>
  </h5>

  <p>
    <?=__('about_credits_body_1')?>
  </p>

  <p>
    <?=__('about_credits_body_2')?>
  </p>

  <p>
    <?=__('about_credits_body_3')?>
  </p>

  <h5 class="hugepadding_top smallpadding_bot">
    <?=__('about_follow_title')?>
  </h5>

  <p>
    <?=__('about_follow_body_1')?>
  </p>

  <p>
    <?=__('about_follow_body_2')?>
  </p>

  <p>
    <?=__('about_follow_body_3')?>
  </p>

  <p>
    <?=__('about_follow_body_4')?>
  </p>

  <h5 class="hugepadding_top smallpadding_bot">
    <?=__('about_talk_title')?>
  </h5>

  <p>
    <?=__('about_talk_body_1')?>
  </p>

  <p>
    <?=__('about_talk_body_2')?>
  </p>

  <p>
    <?=__('about_talk_body_3')?>
  </p>

  <h5 class="hugepadding_top smallpadding_bot">
    <?=__('about_merch_title')?>
  </h5>

  <p>
    <?=__('about_merch_body_1')?>
  </p>

  <p>
    <?=__('about_merch_body_2')?>
  </p>

  <p>
    <?=__('about_merch_body_3')?>
  </p>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/**********************************************************************************/ include './../inc/footer.inc.php';