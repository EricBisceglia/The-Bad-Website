<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic management
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/comics";
$page_title_en  = "Admin - Comics";
$page_title_fr  = "Admin - Comics";

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
// Prepare form values

// List comic types
$comic_types_list = comic_types_list();

// Get current datetime
$image_upload_date = date('Y-m-d');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="padding_bot">
    <?=__link('admin/comics', __('admin_comics_add_title'), 'text_light', path: root_path())?>
  </h2>

  <form action="comics" method="POST">
    <fieldset>

      <div class="smallpadding_bot">
        <label for="comic_type"><?=__('admin_comics_add_type')?></label>
        <select class="indiv align_left" name="comic_type" id="comic_type">
          <?php for($i = 0; $i < $comic_types_list['rows']; $i++) { ?>
          <option value="<?=$comic_types_list[$i]['id']?>"><?=$comic_types_list[$i]['name']?></option>
          <?php } ?>
        </select>
      </div>

      <div class="smallpadding_bot">
        <label for="comic_title_en"><?=__('admin_comics_add_title_en')?></label>
        <input class="indiv" type="text" name="comic_title_en" id="comic_title_en">
      </div>

      <div class="padding_bot">
        <label for="comic_title_fr"><?=__('admin_comics_add_title_fr')?></label>
        <input class="indiv" type="text" name="comic_title_fr" id="comic_title_fr">
      </div>

      <input type="submit" name="comic_add" value="<?=__('admin_comics_add_submit')?>">

    </fieldset>
  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;