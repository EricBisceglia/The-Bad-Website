<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/videos.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/videos_bts_edit";
$page_title_en  = "Admin - Edit BTS video";
$page_title_fr  = "Admin - Modifier une vidéo BTS";

// Admin menu selection
$admin_menu['videos'] = 1;

// Extra CSS & JS
$css  = array('admin');
$js   = array('admin/admin');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch BTS video data

// Fetch the video's ID
$admin_bts_id = (int)form_fetch_element('bts_video_id', request_type: 'GET');

// Fetch the video's data
$admin_bts_data = videos_bts_get($admin_bts_id);

// Stop here if the video does not exist
if(!$admin_bts_data)
  exit(header("Location: ".$path."admin/videos_bts"));




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="padding_bot">
    <?=__link('admin/videos_bts', __('admin_videos_bts_edit_title'), 'text_light', path: $path)?>
  </h2>

  <form action="videos_bts" method="POST">
    <fieldset>

      <input type="hidden" name="videos_bts_id" value="<?=$admin_bts_id?>">

      <div class="smallpadding_bot">
        <label for="videos_bts_youtube_id"><?=__('admin_videos_bts_add_youtube_id')?></label>
        <input class="indiv" type="text" name="videos_bts_youtube_id" id="videos_bts_youtube_id" value="<?=$admin_bts_data['youtube_id']?>">
      </div>

      <div class="smallpadding_bot">
        <label for="videos_bts_order"><?=__('admin_videos_bts_add_order')?></label>
        <input class="indiv" type="text" name="videos_bts_order" id="videos_bts_order" value="<?=$admin_bts_data['sort']?>">
      </div>

      <div class="flexcontainer tinypadding_bot">
        <div style="flex: 8">

          <div class="smallpadding_bot">
            <label for="videos_bts_name_en"><?=__('admin_videos_bts_add_name_en')?></label>
            <input class="indiv" type="text" name="videos_bts_name_en" id="videos_bts_name_en" value="<?=$admin_bts_data['title_en']?>">
          </div>

          <div class="smallpadding_bot">
            <label for="videos_bts_desc_en"><?=__('admin_videos_bts_add_desc_en')?></label>
            <textarea class="indiv shorter" name="videos_bts_desc_en" id="videos_bts_desc_en"><?=$admin_bts_data['desc_en']?></textarea>
          </div>

        </div>
        <div style="flex: 1">
          &nbsp;
        </div>
        <div style="flex: 8">

          <div class="smallpadding_bot">
            <label for="videos_bts_name_fr"><?=__('admin_videos_bts_add_name_fr')?></label>
            <input class="indiv" type="text" name="videos_bts_name_fr" id="videos_bts_name_fr" value="<?=$admin_bts_data['title_fr']?>">
          </div>

          <div class="smallpadding_bot">
            <label for="videos_bts_desc_fr"><?=__('admin_videos_bts_add_desc_fr')?></label>
            <textarea class="indiv shorter" name="videos_bts_desc_fr" id="videos_bts_desc_fr"><?=$admin_bts_data['desc_fr']?></textarea>
          </div>

        </div>
      </div>

      <input type="submit" name="videos_bts_edit" value="<?=__('admin_videos_bts_edit_submit')?>">

    </fieldset>
  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;