<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic management
include_once './../lang/comics.lang.php';   # Translations

// Page summary
$page_url       = "stuff/list";
$page_title_en  = "Stuff";
$page_title_fr  = "Trucs";

// Enforce the url
page_enforce_url($page_url);




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Page data

// Get the list of comic types
$comic_types_list = comic_types_list( is_minor: true );




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/*******************************************************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50">

  <div class="nopadding_bot">
    <img src="<?=$path?>img/website/stuff_<?=$lang_lower?>.png" alt="<?=__('stuff_list_header')?>" title="<?=__('stuff_list_header')?>">
  </div>

  <?php for($i = 0; $i < $comic_types_list['rows']; $i++): ?>
  <div class="nopadding_bot">
    <a href="<?=$path?>category/<?=$comic_types_list[$i]['slug']?>">
      <img src="<?=$path.$comic_types_list[$i]['banner']?>" alt="<?=$comic_types_list[$i]['name']?>" title="<?=$comic_types_list[$i]['name']?>" loading="lazy">
    </a>
  </div>
  <?php endfor; ?>

  <div class="nopadding_bot">
    <a href="<?=$path?>stuff/emojis">
      <img src="<?=$path?>img/banners/comics/category_emojis_<?=$lang_lower?>.png" alt="<?=__('comics_list_emojis')?>" title="<?=__('comics_list_emojis')?>">
    </a>
  </div>

  <div class="nopadding_bot">
    <a href="<?=$path?>stuff/templates">
      <img src="<?=$path?>img/banners/comics/category_templates_<?=$lang_lower?>.png" alt="<?=__('comics_list_templates')?>" title="<?=__('comics_list_templates')?>">
    </a>
  </div>

</div>


<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/**********************************************************************************/ include './../inc/footer.inc.php';