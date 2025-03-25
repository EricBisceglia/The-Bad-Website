<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic management
include_once './../lang/comics.lang.php';   # Admin translations

// Page summary
$page_url       = "pages/comics_categories";
$page_title_en  = "Categories";
$page_title_fr  = "Categories";




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get the list of comic types

$comic_types_list = comic_types_list();




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/*******************************************************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50 align_center">

  <div class="smallpadding_bot">
    <a href="<?=$path?>pages/comics">
      <img src="<?=$path?>img/banners/comics/categories_header_<?=$lang_lower?>.png" alt="<?=__('comics_list_categories')?>" title="<?=__('comics_list_categories')?>">
    </a>
  </div>

  <?php for($i = 0; $i < $comic_types_list['rows']; $i++): ?>
  <div class="nopadding_bot">
    <a href="<?=$path?>pages/comics_category?type=<?=$comic_types_list[$i]['id']?>">
      <img src="<?=$path.$comic_types_list[$i]['banner']?>" alt="<?=$comic_types_list[$i]['name']?>" title="<?=$comic_types_list[$i]['name']?>" loading="lazy">
    </a>
  </div>
  <?php endfor; ?>

</div>


<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/**********************************************************************************/ include './../inc/footer.inc.php';