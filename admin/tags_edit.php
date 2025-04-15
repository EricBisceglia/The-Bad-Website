<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php'; # Core
include_once './../actions/tags.act.php'; # Tag actions
include_once './../lang/admin.lang.php';  # Admin translations

// Page summary
$page_url       = "admin/tags_edit";
$page_title_en  = "Admin - Tags";
$page_title_fr  = "Admin - Tags";

// Admin menu selection
$admin_menu['tags'] = 1;

// Extra CSS & JS
$css  = array('admin');
$js   = array('admin/admin');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch tag data

// Fetch the tag's ID
$admin_tag_id = (int)form_fetch_element('tag_id', request_type: 'GET');

// Fetch the tag data
$admin_tag_data = tags_get($admin_tag_id);

// Stop here if the tag does not exist
if(!$admin_tag_data)
  exit(header("Location: ".$path."admin/tags"));




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="padding_bot">
    <?=__link('admin/tags', __('admin_tags_edit_title'), 'text_light', path: root_path())?>
  </h2>

  <form action="tags" method="POST">
    <fieldset>

      <input type="hidden" name="tag_id" value="<?=$admin_tag_id?>">

      <div class="smallpadding_bot">
        <label for="tag_sort"><?=__('admin_tags_add_order')?></label>
        <input class="indiv" type="text" name="tag_sort" value="<?=$admin_tag_data['sort']?>">
      </div>

      <div class="smallpadding_bot">
        <label for="tag_name"><?=__('admin_tags_add_name')?></label>
        <input class="indiv" type="text" name="tag_name" value="<?=$admin_tag_data['name']?>">
      </div>

      <div class="smallpadding_bot">
        <label for="tag_title_en"><?=__('admin_tags_add_title_en')?></label>
        <input class="indiv" type="text" name="tag_title_en" value="<?=$admin_tag_data['title_en']?>">
      </div>

      <div class="smallpadding_bot">
        <label for="tag_title_fr"><?=__('admin_tags_add_title_fr')?></label>
        <input class="indiv" type="text" name="tag_title_fr" value="<?=$admin_tag_data['title_fr']?>">
      </div>

      <div class="smallpadding_bot">
        <label for="tag_banner_en"><?=__('admin_tags_add_banner_en')?></label>
        <input class="indiv" type="text" name="tag_banner_en" value="<?=$admin_tag_data['banner_en']?>">
      </div>

      <div class="smallpadding_bot">
        <label for="tag_banner_fr"><?=__('admin_tags_add_banner_fr')?></label>
        <input class="indiv" type="text" name="tag_banner_fr" value="<?=$admin_tag_data['banner_fr']?>">
      </div>

      <div class="smallpadding_bot">
        <label for="tag_desc_en"><?=__('admin_tags_add_desc_en')?></label>
        <textarea class="indiv" type="text" name="tag_desc_en"><?=$admin_tag_data['desc_en']?></textarea>
      </div>

      <div class="smallpadding_bot">
        <label for="tag_desc_fr"><?=__('admin_tags_add_desc_fr')?></label>
        <textarea class="indiv" type="text" name="tag_desc_fr"><?=$admin_tag_data['desc_fr']?></textarea>
      </div>

      <input type="submit" name="tag_edit" value="<?=__('admin_tags_edit_submit')?>">

    </fieldset>
  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;