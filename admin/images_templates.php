<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/images";
$page_title_en  = "Admin - Images";
$page_title_fr  = "Admin - Images";

// Admin menu selection
$admin_menu['images'] = 1;

// Extra CSS & JS
$css  = array('admin');
$js   = array('admin/admin');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="align_center padding_bot">
    <?=__link('admin/images', __('admin_images_templates_title'), style: 'text_light', path: root_path())?>
  </h2>

  <ul class="align_left bold padding_bot">
    <li class="light text_dark">
      <?=__('admin_images_templates_font')?>
    </li>
    <li style="background-color: #EFE4B0" class="text_dark">
      <?=__('admin_images_templates_color_1')?>
    </li>
    <li style="background-color: #C8BFE7" class="text_dark">
      <?=__('admin_images_templates_color_2')?>
    </li>
    <li style="background-color: #C2E7BF" class="text_dark">
      <?=__('admin_images_templates_color_3')?>
    </li>
    <li style="background-color: #99D9EA" class="text_dark">
      <?=__('admin_images_templates_color_4')?>
    </li>
    <li style="background-color: #C3C3C3" class="text_dark">
      <?=__('admin_images_templates_color_5')?>
    </li>
  </ul>

  <h5 class="smallpadding_bot align_center">
    <?=__('admin_images_templates_preview')?>
  </h5>
  <div class="padding_bot">
    <img src="<?=$path?>img/templates/preview_en.png">
    <img src="<?=$path?>img/templates/preview_fr.png">
  </div>

  <h5 class="smallpadding_bot align_center">
    <?=__('admin_images_templates_banner')?>
  </h5>
  <div class="padding_bot">
    <img src="<?=$path?>img/templates/comic_type_en.png">
    <img src="<?=$path?>img/templates/comic_type_fr.png">
  </div>

  <h5 class="smallpadding_bot align_center">
    <?=__('admin_images_templates_tag')?>
  </h5>
  <div>
    <img src="<?=$path?>img/templates/tag_en.png">
    <img src="<?=$path?>img/templates/tag_fr.png">
  </div>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;