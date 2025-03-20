<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/images.act.php'; # Image management
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
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch image data

// Fetch the image's ID
$admin_image_id = (int)form_fetch_element('id', request_type: 'GET');

// Fetch the image's data
$admin_image_data = images_get($admin_image_id);

// Stop here if the image does not exist
if(!$admin_image_data)
  exit(header("Location: ".$path."admin/images"));




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch image types

// Fetch a list of all image types
$image_types_list = image_types_list();

// Select the image's type
for($i = 0; $i < $image_types_list['rows']; $i++)
{
  $image_type_selected[$i] = '';
  if($image_types_list[$i]['id'] === $admin_image_data['type'])
    $image_type_selected[$i] = ' selected';
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Prepare form values

// Language
$image_lang_en_selected = ($admin_image_data['lang'] === 'EN') ? ' selected' : '';
$image_lang_fr_selected = ($admin_image_data['lang'] === 'FR') ? ' selected' : '';

// NSFW
$image_nsfw_checked = ($admin_image_data['nsfw']) ? ' checked' : '';

// Focus the transcript form if the image has none
if(!$admin_image_data['trans'])
  $onload = "image_trans.focus(); ";




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="padding_bot">
    <?=__link('admin/images', __('admin_images_edit_title'), 'text_light', path: root_path())?>
  </h2>

  <form action="images" method="POST">
    <fieldset>

      <input type="hidden" name="image_id" value="<?=$admin_image_id?>">

      <div class="smallpadding_bot">
        <label for="image_name"><?=__('admin_images_add_name')?></label>
        <input class="indiv" type="text" name="image_name" id="image_name" value="<?=$admin_image_data['name']?>">
      </div>

      <div class="smallpadding_bot">
        <label for="image_type"><?=__('admin_images_add_type')?></label>
        <select class="indiv align_left" name="image_type" id="image_type">
          <?php for($i = 0; $i < $image_types_list['rows']; $i++) { ?>
          <option value="<?=$image_types_list[$i]['id']?>"<?=$image_type_selected[$i]?>><?=$image_types_list[$i]['name']?></option>
          <?php } ?>
        </select>
      </div>

      <div class="smallpadding_bot">
        <label for="image_lang"><?=__('admin_images_add_lang')?></label>
        <select class="indiv align_left" name="image_lang" id="image_lang">
          <option value="EN"<?=$image_lang_en_selected?>>EN</option>
          <option value="FR"<?=$image_lang_fr_selected?>>FR</option>
        </select>
      </div>

      <div class="smallpadding_bot">
        <label for="image_date"><?=__('admin_images_edit_date')?></label>
        <input class="indiv" type="text" name="image_date" id="image_date" value="<?=$admin_image_data['date']?>">
      </div>

      <div class="smallpadding_bot" id="image_transcript">
        <label for="image_trans"><?=__('admin_images_add_transcript')?></label>
        <textarea class="indiv" name="image_trans" id="image_trans"><?=$admin_image_data['trans']?></textarea>
      </div>

      <div class="tinypadding_top smallpadding_bot">
        <input type="checkbox" class="align_left" name="image_nsfw"<?=$image_nsfw_checked?>>
        <label for="image_nsfw" class="label_inline"><?=__('admin_images_add_nsfw')?></label>
      </div>

      <input type="submit" name="image_edit" value="<?=__('admin_images_edit_submit')?>">

    </fieldset>
  </form>

</div>

<div class="width_100 bigpadding_top align_center">

  <img src="<?=$path?>img/comics/<?=$admin_image_data['name']?>" alt="<?=$admin_image_data['name']?>" title="<?=$admin_image_data['name']?>">

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;