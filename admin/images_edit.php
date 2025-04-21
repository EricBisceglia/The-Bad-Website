<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/images.act.php'; # Image management
include_once './../actions/comics.act.php'; # Comic management
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/images_edit";
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
// Fetch comics

// Fetch a list of all comics
$comics_list = comics_list();

// Select the linked comic
for($i = 0; $i < $comics_list['rows']; $i++)
{
  $comic_selected[$i] = '';
  if($comics_list[$i]['id'] === $admin_image_data['comic'])
    $comic_selected[$i] = ' selected';
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Prepare form values

// Language
$image_lang_en_selected = ($admin_image_data['lang'] === 'EN') ? ' selected' : '';
$image_lang_fr_selected = ($admin_image_data['lang'] === 'FR') ? ' selected' : '';

// NSFW
$image_nsfw_checked = ($admin_image_data['nsfw']) ? ' checked' : '';

// Reusable image
$image_reusable_checked = ($admin_image_data['reusable']) ? ' checked' : '';

// Template
$image_template_checked = ($admin_image_data['template']) ? ' checked' : '';

// Preview
$image_preview_checked = ($admin_image_data['preview']) ? ' checked' : '';

// Full
$image_full_checked = ($admin_image_data['full']) ? ' checked' : '';

// Old
$image_old_checked = ($admin_image_data['old']) ? ' checked' : '';

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
        <label for="image_comic"><?=__('admin_images_add_comic')?></label>
        <select class="indiv align_left" name="image_comic" id="image_comic">
          <option value="0">&nbsp;</option>
          <?php for($i = 0; $i < $comics_list['rows']; $i++) { ?>
          <option value="<?=$comics_list[$i]['id']?>"<?=$comic_selected[$i]?>><?=$comics_list[$i]['ftitle']?></option>
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
        <label for="image_order"><?=__('admin_images_add_order')?></label>
        <input class="indiv" type="text" name="image_order" id="image_order" value="<?=$admin_image_data['order']?>">
      </div>

      <div class="smallpadding_bot">
        <label for="image_date"><?=__('admin_images_edit_date')?></label>
        <input class="indiv" type="text" name="image_date" id="image_date" value="<?=$admin_image_data['date']?>">
      </div>

      <div class="tinypadding_top">
        <input type="checkbox" class="align_left" name="image_preview"<?=$image_preview_checked?>>
        <label for="image_preview" class="label_inline"><?=__('admin_images_add_preview')?></label>
      </div>

      <div>
        <input type="checkbox" class="align_left" name="image_full"<?=$image_full_checked?>>
        <label for="image_full" class="label_inline"><?=__('admin_images_add_full')?></label>
      </div>

      <div>
        <input type="checkbox" class="align_left" name="image_old"<?=$image_old_checked?>>
        <label for="image_old" class="label_inline"><?=__('admin_images_add_old')?></label>
      </div>

      <div class="smallpadding_top">
        <input type="checkbox" class="align_left" name="image_reusable"<?=$image_reusable_checked?>>
        <label for="image_reusable" class="label_inline"><?=__('admin_images_add_reusable')?></label>
      </div>

      <div>
        <input type="checkbox" class="align_left" name="image_template"<?=$image_template_checked?>>
        <label for="image_template" class="label_inline"><?=__('admin_images_add_template')?></label>
      </div>

      <div class="smallpadding_top smallpadding_bot">
        <input type="checkbox" class="align_left" name="image_nsfw"<?=$image_nsfw_checked?>>
        <label for="image_nsfw" class="label_inline"><?=__('admin_images_add_nsfw')?></label>
      </div>

      <div class="smallpadding_bot" id="image_transcript">
        <label for="image_trans"><?=__('admin_images_add_transcript')?></label>
        <textarea class="indiv" name="image_trans" id="image_trans"><?=$admin_image_data['trans']?></textarea>
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