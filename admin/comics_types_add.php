<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/comics";
$page_title_en  = "Admin - Comic types";
$page_title_fr  = "Admin - Types de comics";

// Admin menu selection
$admin_menu['comics'] = 1;

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
    <?=__link('admin/comics_types', __('admin_comic_types_add_title'), 'text_light', path: root_path())?>
  </h2>

  <form action="comics_types" method="POST">
    <fieldset>

      <div class="smallpadding_bot">
        <label for="comic_type_sort"><?=__('admin_comic_types_add_order')?></label>
        <input class="indiv" type="text" name="comic_type_sort">
      </div>

      <div class="smallpadding_bot">
        <label for="comic_type_name_en"><?=__('admin_comic_types_add_name_en')?></label>
        <input class="indiv" type="text" name="comic_type_name_en">
      </div>

      <div class="smallpadding_bot">
        <label for="comic_type_name_fr"><?=__('admin_comic_types_add_name_fr')?></label>
        <input class="indiv" type="text" name="comic_type_name_fr">
      </div>

      <div class="smallpadding_bot">
        <label for="comic_type_banner_en"><?=__('admin_comic_types_add_banner_en')?></label>
        <input class="indiv" type="text" name="comic_type_banner_en">
      </div>

      <div class="smallpadding_bot">
        <label for="comic_type_banner_fr"><?=__('admin_comic_types_add_banner_en')?></label>
        <input class="indiv" type="text" name="comic_type_banner_fr">
      </div>

      <div class="smallpadding_bot">
        <label for="comic_type_desc_en"><?=__('admin_comic_types_add_desc_en')?></label>
        <textarea class="indiv" type="text" name="comic_type_desc_en"></textarea>
      </div>

      <div class="smallpadding_bot">
        <label for="comic_type_desc_fr"><?=__('admin_comic_types_add_desc_fr')?></label>
        <textarea class="indiv" type="text" name="comic_type_desc_fr"></textarea>
      </div>

      <div class="tinypadding_top smallpadding_bot">
        <input type="checkbox" class="align_left" name="comic_type_major">
        <label for="comic_type_major" class="label_inline"><?=__('admin_comic_types_add_major')?></label>
      </div>

      <input type="submit" name="comic_type_add" value="<?=__('admin_comic_types_add_submit')?>">

    </fieldset>
  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;