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

  <h5 class="hugepadding_top smallpadding_bot" id="quality">
    <?=__link('pages/about#quality', __('about_quality_title'), path: root_path(), style: 'text_light')?>
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

  <h5 class="hugepadding_top smallpadding_bot" id="pastels">
    <?=__link('pages/about#pastels', __('about_pastels_title'), path: root_path(), style: 'text_light')?>
  </h5>

  <p>
    <?=__('about_pastels_body_1')?>
  </p>

  <p>
    <?=__('about_pastels_body_2')?>
  </p>

  <h5 class="hugepadding_top smallpadding_bot" id="offended">
    <?=__link('pages/about#offended', __('about_offended_title'), path: root_path(), style: 'text_light')?>
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

  <h5 class="hugepadding_top smallpadding_bot" id="credits">
    <?=__link('pages/about#credits', __('about_credits_title'), path: root_path(), style: 'text_light')?>
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

  <h5 class="hugepadding_top smallpadding_bot" id="follow">
    <?=__link('pages/about#follow', __('about_follow_title'), path: root_path(), style: 'text_light')?>
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

  <h5 class="hugepadding_top smallpadding_bot" id="talk">
    <?=__link('pages/about#talk', __('about_talk_title'), path: root_path(), style: 'text_light')?>
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

  <h5 class="hugepadding_top smallpadding_bot" id="merch">
    <?=__link('pages/about#merch', __('about_merch_title'), path: root_path(), style: 'text_light')?>
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