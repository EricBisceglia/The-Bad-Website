<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic management
include_once './../actions/tags.act.php';   # Tag management
include_once './../lang/comics.lang.php';   # Translations

// Page summary
$page_url       = "comics/tags";
$page_title_en  = "Tags";
$page_title_fr  = "Thèmes";

// Enforce the url
page_enforce_url($page_url);




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get the list of tags

$tags_list = tags_list();




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/*******************************************************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50 align_center">

  <div class="smallpadding_bot">
    <a href="<?=$path?>comics/list">
      <img src="<?=$path?>img/website/pages/tags_header_<?=$lang_lower?>.png" alt="<?=__('comics_list_tags')?>" title="<?=__('comics_list_tags')?>">
    </a>
  </div>

  <?php for($i = 0; $i < $tags_list['rows']; $i++): ?>
  <div class="nopadding_bot">
    <a href="<?=$path?>tag/<?=$tags_list[$i]['name']?>">
      <img src="<?=$path.$tags_list[$i]['banner']?>" alt="<?=$tags_list[$i]['title']?>" title="<?=$tags_list[$i]['title']?>" loading="lazy">
    </a>
  </div>
  <?php endfor; ?>

</div>


<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/**********************************************************************************/ include './../inc/footer.inc.php';