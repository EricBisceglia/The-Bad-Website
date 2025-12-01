<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php'; # Core
include_once './../lang/main.lang.php';   # Translations

// Page summary
$page_lang        = array('FR', 'EN');
$page_url         = "pages/faq";
$page_title_en    = "FAQ";
$page_title_fr    = "FAQ";
$page_description = "Hi, this is Bad, and you're on the wrong website.";




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/*******************************************************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50">

  <div>
    <img src="<?=$path?>img/website/about_intro_<?=$lang_lower?>.png" alt="<?=__('about_comics_intro')?>" title="<?=__('about_comics_intro')?>">
  </div>

  <h5 class="hugepadding_top smallpadding_bot" id="quality">
    <?=__link('pages/faq#quality', __('about_quality_title'), path: root_path(), style: 'text_light')?>
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
    <?=__link('pages/faq#pastels', __('about_pastels_title'), path: root_path(), style: 'text_light')?>
  </h5>

  <p>
    <?=__('about_pastels_body_1')?>
  </p>

  <p>
    <?=__('about_pastels_body_2')?>
  </p>

  <h5 class="hugepadding_top smallpadding_bot" id="offended">
    <?=__link('pages/faq#offended', __('about_offended_title'), path: root_path(), style: 'text_light')?>
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

  <h5 class="hugepadding_top smallpadding_bot" id="credits">
    <?=__link('pages/faq#credits', __('about_credits_title'), path: root_path(), style: 'text_light')?>
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

  <p>
    <?=__('about_credits_body_4')?>
  </p>

  <h5 class="hugepadding_top smallpadding_bot" id="reuse">
    <?=__link('pages/faq#reuse', __('about_reuse_title'), path: root_path(), style: 'text_light')?>
  </h5>

  <p>
    <?=__('about_reuse_body_1')?>
  </p>

  <p>
    <?=__('about_reuse_body_2')?>
  </p>

  <p>
    <?=__('about_reuse_body_3')?>
  </p>

  <h5 class="hugepadding_top smallpadding_bot" id="follow">
    <?=__link('pages/faq#follow', __('about_follow_title'), path: root_path(), style: 'text_light')?>
  </h5>

  <p>
    <?=__('about_follow_body_1')?>
  </p>

  <p>
    <?=__('about_follow_body_2')?>
  </p>

  <h5 class="hugepadding_top smallpadding_bot" id="talk">
    <?=__link('pages/faq#talk', __('about_talk_title'), path: root_path(), style: 'text_light')?>
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
    <?=__link('pages/faq#merch', __('about_merch_title'), path: root_path(), style: 'text_light')?>
  </h5>

  <p>
    <?=__('about_merch_body_1')?>
  </p>

  <p>
    <?=__('about_merch_body_2')?>
  </p>

  <h5 class="hugepadding_top smallpadding_bot" id="source">
    <?=__link('pages/faq#source', __('about_source_title'), path: root_path(), style: 'text_light')?>
  </h5>

  <p>
    <?=__('about_source_body_1')?>
  </p>

  <p>
    <?=__('about_source_body_2')?>
  </p>

  <h5 class="hugepadding_top smallpadding_bot" id="cookies">
    <?=__link('pages/faq#cookies', __('about_cookies_title'), path: root_path(), style: 'text_light')?>
  </h5>

  <p>
    <?=__('about_cookies_body_1')?>
  </p>

  <p>
    <?=__('about_cookies_body_2')?>
  </p>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/**********************************************************************************/ include './../inc/footer.inc.php';