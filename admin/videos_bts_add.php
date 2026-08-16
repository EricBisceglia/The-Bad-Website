<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/videos.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/videos_bts_add";
$page_title_en  = "Admin - Add BTS video";
$page_title_fr  = "Admin - Ajouter une vidéo BTS";

// Admin menu selection
$admin_menu['videos'] = 1;

// Extra CSS & JS
$css  = array('admin');
$js   = array('admin/admin');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="padding_bot">
    <?=__link('admin/videos_bts', __('admin_videos_bts_add_title'), 'text_light', path: $path)?>
  </h2>

  <form action="videos_bts" method="POST">
    <fieldset>

      <div class="smallpadding_bot">
        <label for="videos_bts_youtube_id"><?=__('admin_videos_bts_add_youtube_id')?></label>
        <input class="indiv" type="text" name="videos_bts_youtube_id" id="videos_bts_youtube_id">
      </div>

      <div class="smallpadding_bot">
        <label for="videos_bts_order"><?=__('admin_videos_bts_add_order')?></label>
        <input class="indiv" type="text" name="videos_bts_order" id="videos_bts_order">
      </div>

      <div class="flexcontainer tinypadding_bot">
        <div style="flex: 8">

          <div class="smallpadding_bot">
            <label for="videos_bts_name_en"><?=__('admin_videos_bts_add_name_en')?></label>
            <input class="indiv" type="text" name="videos_bts_name_en" id="videos_bts_name_en">
          </div>

          <div class="smallpadding_bot">
            <label for="videos_bts_desc_en"><?=__('admin_videos_bts_add_desc_en')?></label>
            <textarea class="indiv shorter" name="videos_bts_desc_en" id="videos_bts_desc_en"></textarea>
          </div>

        </div>
        <div style="flex: 1">
          &nbsp;
        </div>
        <div style="flex: 8">

          <div class="smallpadding_bot">
            <label for="videos_bts_name_fr"><?=__('admin_videos_bts_add_name_fr')?></label>
            <input class="indiv" type="text" name="videos_bts_name_fr" id="videos_bts_name_fr">
          </div>

          <div class="smallpadding_bot">
            <label for="videos_bts_desc_fr"><?=__('admin_videos_bts_add_desc_fr')?></label>
            <textarea class="indiv shorter" name="videos_bts_desc_fr" id="videos_bts_desc_fr"></textarea>
          </div>

        </div>
      </div>

      <input type="submit" name="videos_bts_add" value="<?=__('admin_videos_bts_add_submit')?>">

    </fieldset>
  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;