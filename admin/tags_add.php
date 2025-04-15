<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php'; # Core
include_once './../actions/tags.act.php'; # Tag actions
include_once './../lang/admin.lang.php';  # Admin translations

// Page summary
$page_url       = "admin/tags_add";
$page_title_en  = "Admin - Tags";
$page_title_fr  = "Admin - Tags";

// Admin menu selection
$admin_menu['tags'] = 1;

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
    <?=__link('admin/tags', __('admin_tags_add_title'), 'text_light', path: root_path())?>
  </h2>

  <form action="tags" method="POST">
    <fieldset>

      <div class="smallpadding_bot">
        <label for="tag_sort"><?=__('admin_tags_add_order')?></label>
        <input class="indiv" type="text" name="tag_sort">
      </div>

      <div class="smallpadding_bot">
        <label for="tag_name"><?=__('admin_tags_add_name')?></label>
        <input class="indiv" type="text" name="tag_name">
      </div>

      <div class="smallpadding_bot">
        <label for="tag_title_en"><?=__('admin_tags_add_title_en')?></label>
        <input class="indiv" type="text" name="tag_title_en">
      </div>

      <div class="smallpadding_bot">
        <label for="tag_title_fr"><?=__('admin_tags_add_title_fr')?></label>
        <input class="indiv" type="text" name="tag_title_fr">
      </div>

      <div class="smallpadding_bot">
        <label for="tag_banner_en"><?=__('admin_tags_add_banner_en')?></label>
        <input class="indiv" type="text" name="tag_banner_en">
      </div>

      <div class="smallpadding_bot">
        <label for="tag_banner_fr"><?=__('admin_tags_add_banner_fr')?></label>
        <input class="indiv" type="text" name="tag_banner_fr">
      </div>

      <div class="smallpadding_bot">
        <label for="tag_desc_en"><?=__('admin_tags_add_desc_en')?></label>
        <textarea class="indiv" type="text" name="tag_desc_en"></textarea>
      </div>

      <div class="smallpadding_bot">
        <label for="tag_desc_fr"><?=__('admin_tags_add_desc_fr')?></label>
        <textarea class="indiv" type="text" name="tag_desc_fr"></textarea>
      </div>

      <input type="submit" name="tag_add" value="<?=__('admin_tags_add_submit')?>">

    </fieldset>
  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;