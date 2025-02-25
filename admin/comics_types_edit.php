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
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch comic type data

// Fetch the comic type's ID
$admin_comic_type_id = (int)form_fetch_element('type_id', request_type: 'GET');

// Fetch the comic type data
$admin_comic_type_data = comic_types_get($admin_comic_type_id);

// Stop here if the comic type does not exist
if(!$admin_comic_type_data)
  exit(header("Location: ".$path."admin/comics_types"));




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="padding_bot">
    <?=__link('admin/comics_types', __('admin_comic_types_edit_title'), 'text_light', path: root_path())?>
  </h2>

  <form action="comics_types" method="POST">
    <fieldset>

      <input type="hidden" name="comic_type_id" value="<?=$admin_comic_type_data['id']?>">

      <div class="smallpadding_bot">
        <label for="comic_type_sort"><?=__('admin_comic_types_add_order')?></label>
        <input class="indiv" type="text" name="comic_type_sort" value="<?=$admin_comic_type_data['order']?>">
      </div>

      <div class="smallpadding_bot">
        <label for="comic_type_name_en"><?=__('admin_comic_types_add_name_en')?></label>
        <input class="indiv" type="text" name="comic_type_name_en" value="<?=$admin_comic_type_data['name_en']?>">
      </div>

      <div class="smallpadding_bot">
        <label for="comic_type_name_fr"><?=__('admin_comic_types_add_name_fr')?></label>
        <input class="indiv" type="text" name="comic_type_name_fr" value="<?=$admin_comic_type_data['name_fr']?>">
      </div>

      <div class="smallpadding_bot">
        <label for="comic_type_banner_en"><?=__('admin_comic_types_add_banner_en')?></label>
        <input class="indiv" type="text" name="comic_type_banner_en" value="<?=$admin_comic_type_data['banner_en']?>">
      </div>

      <div class="smallpadding_bot">
        <label for="comic_type_banner_fr"><?=__('admin_comic_types_add_banner_en')?></label>
        <input class="indiv" type="text" name="comic_type_banner_fr" value="<?=$admin_comic_type_data['banner_fr']?>">
      </div>

      <div class="smallpadding_bot">
        <label for="comic_type_desc_en"><?=__('admin_comic_types_add_desc_en')?></label>
        <textarea class="indiv" type="text" name="comic_type_desc_en"><?=$admin_comic_type_data['desc_en']?></textarea>
      </div>

      <div class="padding_bot">
        <label for="comic_type_desc_fr"><?=__('admin_comic_types_add_desc_fr')?></label>
        <textarea class="indiv" type="text" name="comic_type_desc_fr"><?=$admin_comic_type_data['desc_fr']?></textarea>
      </div>

      <input type="submit" name="comic_type_edit" value="<?=__('admin_comic_types_edit_submit')?>">

    </fieldset>
  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;