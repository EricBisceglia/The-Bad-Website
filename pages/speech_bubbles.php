<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../lang/comics.lang.php';   # Translations
include_once './../actions/images.act.php'; # Image management

// Page summary
$page_url       = "stuff/bubbles";
$page_title_en  = "Speech bubbles";
$page_title_fr  = "Bulles de texte";

// Enforce the url
page_enforce_url($page_url);




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch all speech bubbles

$bubbles_list = images_list( search: array('bubble' => 1) ,
                             sort_by:  'order'            );




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50">

  <a href="<?=$path?>stuff/list">
    <img src="<?=$path?>img/website/categories/bubbles_<?=$lang_lower?>.png" alt="<?=__('comics_list_bubbles')?>" title="<?=__('comics_list_bubbles')?>">
  </a>

  <div class="smallpadding_top smallpadding_bot">
    <blockquote><?=__('comics_bubbles_desc')?></blockquote>
  </div>

  <div class="tinypadding_top padding_bot" style="column-count: 2;">
    <?php for($i = 0; $i < $bubbles_list['rows']; $i++): ?>
    <a href="<?=$path?>img/comics/<?=$bubbles_list[$i]['name_full']?>" target="_blank">
      <img src="<?=$path?>img/comics/<?=$bubbles_list[$i]['name_full']?>" alt="<?=$bubbles_list[$i]['name_full']?>" title="<?=$bubbles_list[$i]['name_full']?>" class="indiv">
    </a>
    <?php endfor; ?>
  </div>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;