<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php'; # Core
include_once './../lang/main.lang.php';   # Translations

// Page summary
$page_lang        = array('FR', 'EN');
$page_url         = "about/faq";
$page_title_en    = "FAQ";
$page_title_fr    = "FAQ";
$page_description = "Hi, this is Bad, and you're on the wrong website.";

// Enforce the url
page_enforce_url($page_url);




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/*******************************************************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50 padding_bot">

  <div>
    <img src="<?=$path?>img/website/faq_intro_<?=$lang_lower?>.png" alt="<?=__('about_comics_intro')?>" title="<?=__('about_comics_intro')?>">
  </div>

  <ul class="padding_top big_desktop">
    <li>
      <?=__link('about/faq#stickmen', __('about_quality_title'), path: root_path())?>
    </li>
    <li>
      <?=__link('about/faq#colors', __('about_pastels_title'), path: root_path())?>
    </li>
    <li>
      <?=__link('about/faq#offended', __('about_offended_title'), path: root_path())?>
    </li>
    <li>
      <?=__link('about/faq#credits', __('about_credits_title'), path: root_path())?>
    </li>
    <li>
      <?=__link('about/faq#reuse', __('about_reuse_title'), path: root_path())?>
    </li>
    <li>
      <?=__link('about/faq#follow', __('about_follow_title'), path: root_path())?>
    </li>
    <li>
      <?=__link('about/faq#talk', __('about_talk_title'), path: root_path())?>
    </li>
    <li>
      <?=__link('about/faq#merch', __('about_merch_title'), path: root_path())?>
    </li>
    <li>
      <?=__link('about/faq#source', __('about_source_title'), path: root_path())?>
    </li>
    <li>
      <?=__link('about/faq#cookies', __('about_cookies_title'), path: root_path())?>
    </li>
  </ul>

  <h5 class="hugepadding_top smallpadding_bot" id="stickmen">
    <?=__link('about/faq#stickmen', __('about_quality_title'), path: root_path(), style: 'text_light')?>
  </h5>

  <p>
    <?=__('about_quality_body_1')?>
  </p>

  <p>
    <?=__('about_quality_body_2')?>
  </p>

  <h5 class="hugepadding_top smallpadding_bot" id="colors">
    <?=__link('about/faq#colors', __('about_pastels_title'), path: root_path(), style: 'text_light')?>
  </h5>

  <p>
    <?=__('about_pastels_body_1')?>
  </p>

  <p>
    <?=__('about_pastels_body_2')?>
  </p>

  <h5 class="hugepadding_top smallpadding_bot" id="offended">
    <?=__link('about/faq#offended', __('about_offended_title'), path: root_path(), style: 'text_light')?>
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
    <?=__link('about/faq#credits', __('about_credits_title'), path: root_path(), style: 'text_light')?>
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
    <?=__link('about/faq#reuse', __('about_reuse_title'), path: root_path(), style: 'text_light')?>
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
    <?=__link('about/faq#follow', __('about_follow_title'), path: root_path(), style: 'text_light')?>
  </h5>

  <p>
    <?=__('about_follow_body_1')?>
  </p>

  <p>
    <?=__('about_follow_body_2')?>
  </p>

  <h5 class="hugepadding_top smallpadding_bot" id="talk">
    <?=__link('about/faq#talk', __('about_talk_title'), path: root_path(), style: 'text_light')?>
  </h5>

  <p>
    <?=__('about_talk_body_1')?>
  </p>

  <p>
    <?=__('about_talk_body_2')?>
  </p>

  <h5 class="hugepadding_top smallpadding_bot" id="merch">
    <?=__link('about/faq#merch', __('about_merch_title'), path: root_path(), style: 'text_light')?>
  </h5>

  <p>
    <?=__('about_merch_body_1')?>
  </p>

  <p>
    <?=__('about_merch_body_2')?>
  </p>

  <h5 class="hugepadding_top smallpadding_bot" id="source">
    <?=__link('about/faq#source', __('about_source_title'), path: root_path(), style: 'text_light')?>
  </h5>

  <p>
    <?=__('about_source_body_1')?>
  </p>

  <p>
    <?=__('about_source_body_2')?>
  </p>

  <p>
    <?=__('about_source_body_3')?>
  </p>

  <h5 class="hugepadding_top smallpadding_bot" id="cookies">
    <?=__link('about/faq#cookies', __('about_cookies_title'), path: root_path(), style: 'text_light')?>
  </h5>

  <p>
    <?=__('about_cookies_body_1')?>
  </p>

  <p>
    <?=__('about_cookies_body_2')?>
  </p>

  <p>
    <?=__('about_cookies_body_3')?>
  </p>

  <p>
    <?=__('about_cookies_body_4')?>
  </p>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/**********************************************************************************/ include './../inc/footer.inc.php';