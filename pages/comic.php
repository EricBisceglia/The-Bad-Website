<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic management
include_once './../lang/comics.lang.php';   # Admin translations

// Page summary
$page_url       = "comic/";
$page_title_en  = "";
$page_title_fr  = "";




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch the comic

// Grab the comic's data
$comic_slug = form_fetch_element('slug', request_type: 'GET');

// Get the comic's ID
$comic_id = comics_get_id($comic_slug);

// Stop here if the comic does not exist
if(!$comic_id)
  exit(header("Location: ".$path."404"));

// Fetch the comic's data
$comic_data = comics_get( comic_id: $comic_id );

// Stop here if the comic does not exist
if(!$comic_data)
  exit(header("Location: ".$path."404"));




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/*******************************************************************************/ include './../inc/header.inc.php'; ?>

<div class="align_center">

  <h1 class="tinypadding_bot">
    <?=$comic_data['title']?>
  </h1>
  <h5 class="bigpadding_bot">
    <?=$comic_data['date_full']?>
  </h5>

  <?php for($i = 0; $i < $comic_data['images']['rows']; $i++): ?>
  <div class="padding_bot tinypadding_top">
    <div class="comic_container">
      <img src="<?=$path?>img/comics/<?=$comic_data['images']['name'][$i]?>" alt="<?=$comic_data['images']['name'][$i]?>" title="<?=$comic_data['images']['name'][$i]?>">
    </div>
  </div>
  <?php endfor; ?>

</div>

<div class="width_50 padding_top">

  <?php if($comic_data['desc']): ?>
  <div class="padding_bot">
    <h5 class="smallpadding_bot">
      <?=__('comics_description')?>
    </h5>
    <blockquote><?=$comic_data['desc']?></blockquote>
  </div>
  <?php endif; ?>

  <?php if($comic_data['images']['transcripts']): ?>
  <div class="padding_bot">
    <h5 class="smallpadding_bot">
      <?=__('comics_transcript')?>
    </h5>
    <?php for($i = 0; $i < $comic_data['images']['rows']; $i++): ?>
    <div class="smallpadding_bot">
      <blockquote><?=$comic_data['images']['trans'][$i]?></blockquote>
    </div>
    <?php endfor; ?>
  </div>
  <?php endif; ?>

  <div class="flexcontainer smallpadding_bot">
    <div class="flex">
      <img src="<?=$path?>img/banners/comics/previous_<?=$lang?>" alt="<?=__('comics_nav_previous')?>" title="<?=__('comics_nav_previous')?>">
    </div>
    <div class="flex smallspaced_left smallspaced_right">
      <img src="<?=$path?>img/banners/comics/random_<?=$lang?>" alt="<?=__('comics_nav_random')?>" title="<?=__('comics_nav_random')?>">
    </div>
    <div class="flex">
      <img src="<?=$path?>img/banners/comics/next_<?=$lang?>" alt="<?=__('comics_nav_next')?>" title="<?=__('comics_nav_next')?>">
    </div>
  </div>

  <img src="<?=$path?>img/banners/comics/types/<?=$comic_data['type_banner']?>" alt="<?=$comic_data['type_name']?>" title="<?=$comic_data['type_name']?>">
  <?php for($i = 0; $i < $comic_data['tags']['rows']; $i++): ?>
  <img src="<?=$path?>img/banners/comics/tags/<?=$comic_data['tags']['banner'][$i]?>" alt="<?=$comic_data['tags']['title'][$i]?>" title="<?=$comic_data['tags']['title'][$i]?>">
  <?php endfor; ?>

</div>


<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/**********************************************************************************/ include './../inc/footer.inc.php';