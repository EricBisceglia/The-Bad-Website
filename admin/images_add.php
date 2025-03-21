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
// Add the image

if(isset($_POST['image_add']))
{
  // Fetch the image file data
  $image_add_file = form_fetch_element('image_file', request_type: 'FILES');

  // Assemble an array with the postdata
  $image_add_data = array(  'name'  => form_fetch_element('image_name')                       ,
                            'comic' => form_fetch_element('image_comic')                      ,
                            'type'  => form_fetch_element('image_type')                       ,
                            'lang'  => form_fetch_element('image_lang')                       ,
                            'nsfw'  => form_fetch_element('image_nsfw', element_exists: true) );

  // Add the image to the database
  $images_add = images_add( $image_add_file ,
                            $image_add_data );

  // Redirect to the uploaded image
  if(is_int($images_add))
    exit(header("Location: ./images_edit?id=".$images_add."#image_transcript"));
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Prepare form values

// List image types
$image_types_list = image_types_list();

// Get current date
$image_upload_date = date('Y-m-d');

// List comics
$comics_list = comics_list();
for($i = 0; $i < $comics_list['rows']; $i++)
  $comics_list_selected[$i] = ($i === 0) ? ' selected' : '';




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="padding_bot">
    <?=__link('admin/images', __('admin_images_add_title'), 'text_light', path: root_path())?>
  </h2>

  <form action="images_add" enctype="multipart/form-data" method="POST">
    <fieldset>

      <?php if(isset($images_add)): ?>
      <div class="padding_bot" id="image_error">
        <p class="text_red uppercase bold bigger">
          <?=__('error').__(':').' '.$images_add?>
        </p>
      </div>
      <?php endif; ?>

      <div class="tinypadding_top smallpadding_bot">
        <label for="image_file"><?=__('admin_images_add_file')?></label>
        <input type="file" class="indiv align_left" name="image_file" id="image_file"  onchange="image_file_upload();">
      </div>

      <div class="smallpadding_bot">
        <label for="image_name"><?=__('admin_images_add_name')?></label>
        <input class="indiv" type="text" name="image_name" id="image_name">
      </div>

      <div class="smallpadding_bot">
        <label for="image_comic"><?=__('admin_images_add_comic')?></label>
        <select class="indiv align_left" name="image_comic" id="image_comic">
          <option value="0">&nbsp;</option>
          <?php for($i = 0; $i < $comics_list['rows']; $i++) { ?>
          <option value="<?=$comics_list[$i]['id']?>"<?=$comics_list_selected[$i]?>><?=$comics_list[$i]['ftitle']?></option>
          <?php } ?>
        </select>
      </div>

      <div class="smallpadding_bot">
        <label for="image_type"><?=__('admin_images_add_type')?></label>
        <select class="indiv align_left" name="image_type" id="image_type">
          <?php for($i = 0; $i < $image_types_list['rows']; $i++) { ?>
          <option value="<?=$image_types_list[$i]['id']?>"><?=$image_types_list[$i]['name']?></option>
          <?php } ?>
        </select>
      </div>

      <div class="smallpadding_bot">
        <label for="image_lang"><?=__('admin_images_add_lang')?></label>
        <select class="indiv align_left" name="image_lang" id="image_lang">
          <option value="EN">EN</option>
          <option value="FR">FR</option>
        </select>
      </div>

      <div class="tinypadding_top smallpadding_bot">
        <input type="checkbox" class="align_left" name="image_nsfw">
        <label for="image_nsfw" class="label_inline"><?=__('admin_images_add_nsfw')?></label>
      </div>

      <input type="submit" name="image_add" value="<?=__('admin_images_add_submit')?>">

    </fieldset>
  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;