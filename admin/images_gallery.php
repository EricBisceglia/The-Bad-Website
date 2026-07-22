<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/images.act.php'; # Image management
include_once './../actions/comics.act.php'; # Comic management
include_once './../actions/tags.act.php';   # Tag management
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/images_gallery";
$page_title_en  = "Admin - Gallery";
$page_title_fr  = "Admin - Galerie";

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

// Fetch comic types
$comic_types_list = comic_types_list();

// Fetch tag list
$tags_list = tags_list();

// Grab the search query
if(isset($_POST['admin_images_gallery_go']))
  $admin_images_search = array( 'name'  => form_fetch_element('admin_images_search_name')   ,
                                'type'  => form_fetch_element('admin_images_search_type')   ,
                                'tag'   => form_fetch_element('admin_images_search_tag')    ,
                                'none'  => false );
else
  $admin_images_search = array( 'none'  => true );

// Fetch the images for the gallery
$images_list_gallery = images_list_gallery( search: $admin_images_search );




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top align_center">

  <h2 class="smallpadding_bot">
    <?=__link('admin/images', __('admin_images_gallery_title'), style: 'text_light', path: root_path())?>
  </h2>
  <h5 class="smallpadding_bot">
    <select id="admin_images_gallery_type">
      <option value="0">&nbsp;</option>
      <?php for($i = 0; $i < $comic_types_list['rows']; $i++): ?>
      <option value="<?=$comic_types_list[$i]['id']?>"><?=$comic_types_list[$i]['name']?></option>
      <?php endfor; ?>
    </select>
    <select id="admin_images_gallery_tag">
      <option value="0">&nbsp;</option>
      <?php for($i = 0; $i < $tags_list['rows']; $i++): ?>
      <option value="<?=$tags_list[$i]['id']?>"><?=$tags_list[$i]['title']?></option>
      <?php endfor; ?>
    </select>
  </h5>
  <h5 class="smallpadding_bot">
    <input type="text" name="admin_images_gallery_name" id="admin_images_gallery_name" value="">
    <button class="bold" name="admin_images_gallery_go" value="<?=__('admin_images_gallery_search')?>" onclick="admin_image_gallery_search();"><?=__('admin_images_gallery_search')?></button>
  </h5>

</div>

<div class="width_30 align_center" id="admin_images_gallery">
<?php endif; ?>

  <?php if(isset($_POST['admin_images_gallery_go'])): ?>
  <h5 class="smallpadding_bot align_center">
    <?=__('admin_images_gallery_count', preset_values: array($images_list_gallery['rows']), amount: $images_list_gallery['rows'])?>
  </h5>
  <?php endif; ?>

  <?php for($i = 0; $i < $images_list_gallery['rows']; $i++): ?>
  <?php if($i > 0 && $images_list_gallery[$i]['slug'] !== $images_list_gallery[$i - 1]['slug']): ?>
  <div class="nopadding_top">
    &nbsp;
  </div>
  <?php endif; ?>
  <a href="<?=$path?>comic/<?=$images_list_gallery[$i]['slug']?>" target="_blank">
    <img src="<?=$path?>img/comics/<?=$images_list_gallery[$i]['name']?>">
  </a>
  <?php endfor; ?>

<?php if(!page_is_fetched_dynamically()): ?>
</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;