<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../lang/comics.lang.php';   # Translations
include_once './../actions/images.act.php'; # Image management

// Page summary
$page_url       = "stuff/emojis";
$page_title_en  = "Emojis";
$page_title_fr  = "Emojis";

// Enforce the url
page_enforce_url($page_url);




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch all emojis

$emojis_list = images_list( search: array('emoji' => 1) ,
                            sort_by:  'name'            );



/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50">

  <a href="<?=$path?>stuff/list">
    <img src="<?=$path?>img/banners/comics/category_emojis_<?=$lang_lower?>.png" alt="<?=__('comics_list_emojis')?>" title="<?=__('comics_list_emojis')?>">
  </a>

  <div class="smallpadding_top smallpadding_bot">
    <blockquote><?=__('comics_emojis_desc')?></blockquote>
  </div>

  <div class="desktop">

    <div class="tinypadding_top padding_bot" style="column-count: 6;">
      <?php for($i = 0; $i < $emojis_list['rows']; $i++): ?>
      <a href="<?=$path?>img/comics/<?=$emojis_list[$i]['name_full']?>" target="_blank">
        <img src="<?=$path?>img/comics/<?=$emojis_list[$i]['name_full']?>" alt="<?=$emojis_list[$i]['name_full']?>" title="<?=$emojis_list[$i]['name_full']?>" class="indiv">
      </a>
      <?php endfor; ?>
    </div>

    <div class="tinypadding_top padding_bot" style="column-count: 15;">
      <?php for($i = 0; $i < $emojis_list['rows']; $i++): ?>
      <a href="<?=$path?>img/comics/<?=$emojis_list[$i]['name_full']?>" target="_blank">
        <img src="<?=$path?>img/comics/<?=$emojis_list[$i]['name_full']?>" alt="<?=$emojis_list[$i]['name_full']?>" title="<?=$emojis_list[$i]['name_full']?>" class="indiv">
      </a>
      <?php endfor; ?>
    </div>

  </div>
  <div class="mobile">

    <div class="tinypadding_top padding_bot" style="column-count: 4;">
      <?php for($i = 0; $i < $emojis_list['rows']; $i++): ?>
      <a href="<?=$path?>img/comics/<?=$emojis_list[$i]['name_full']?>" target="_blank">
        <img src="<?=$path?>img/comics/<?=$emojis_list[$i]['name_full']?>" alt="<?=$emojis_list[$i]['name_full']?>" title="<?=$emojis_list[$i]['name_full']?>" class="indiv">
      </a>
      <?php endfor; ?>
    </div>

    <div class="tinypadding_top padding_bot" style="column-count: 8;">
      <?php for($i = 0; $i < $emojis_list['rows']; $i++): ?>
      <a href="<?=$path?>img/comics/<?=$emojis_list[$i]['name_full']?>" target="_blank">
        <img src="<?=$path?>img/comics/<?=$emojis_list[$i]['name_full']?>" alt="<?=$emojis_list[$i]['name_full']?>" title="<?=$emojis_list[$i]['name_full']?>" class="indiv">
      </a>
      <?php endfor; ?>
    </div>

  </div>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;