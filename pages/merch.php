<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/images.act.php'; # Images
include_once './../lang/comics.lang.php';   # Text

// Page summary
$page_url       = "merch/gallery";
$page_title_en  = "Merch";
$page_title_fr  = "Goodies";

// Enforce the url
page_enforce_url($page_url);




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Fetch merch images
$merch_gallery = merch_get_images();



/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50">

  <a href="<?=$path?>stuff/list">
    <img src="<?=$path?>img/banners/comics/category_merch_<?=$lang_lower?>.png" alt="<?=__('comics_list_merch')?>" title="<?=__('comics_list_merch')?>">
  </a>

  <div class="smallpadding_top smallpadding_bot">
    <blockquote><?=__('comics_merch_desc')?></blockquote>
  </div>

  <?php for($i = 0; $i < count($merch_gallery); $i++): ?>
  <div class="nopadding_bot">
    <a href="<?=$path?>img/merch/photos/<?=$merch_gallery[$i]?>" target="_blank">
      <img src="<?=$path?>img/merch/photos/<?=$merch_gallery[$i]?>" alt="<?=$merch_gallery[$i]?>" title="<?=$merch_gallery[$i]?>" class="indiv">
    </a>
  </div>
  <?php endfor; ?>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;