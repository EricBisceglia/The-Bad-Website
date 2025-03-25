<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic management
include_once './../actions/tags.act.php';   # Tag management
include_once './../lang/comics.lang.php';   # Admin translations

// Page summary
$page_url       = "pages/comics_tags";
$page_title_en  = "Tags";
$page_title_fr  = "Thèmes";




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
    <a href="<?=$path?>pages/comics">
      <img src="<?=$path?>img/banners/comics/tags_header_<?=$lang_lower?>.png" alt="<?=__('comics_list_tags')?>" title="<?=__('comics_list_tags')?>">
    </a>
  </div>

  <?php for($i = 0; $i < $tags_list['rows']; $i++): ?>
  <div class="nopadding_bot">
    <a href="<?=$path?>pages/comics_tag?theme=<?=$tags_list[$i]['id']?>">
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