<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic management
include_once './../lang/comics.lang.php';   # Translations

// Page summary
$page_url       = "comics/list";
$enforce_url    = true;
$page_title_en  = "Comics";
$page_title_fr  = "Comics";

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
$comic_types_list = comic_types_list();

// Get the latest smuggie's slug
$latest_comic_slug = comics_get_latest_comic_slug( enforce_type: 'smuggies' );




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/*******************************************************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50">

  <div class="flexcontainer nopadding_bot">
    <div class="flex smallspaced_right">
      <a href="<?=$path?>comics/all">
        <img src="<?=$path?>img/banners/comics/full_list_<?=$lang_lower?>.png" alt="<?=__('comics_list_all')?>" title="<?=__('comics_list_all')?>">
      </a>
    </div>
    <div class="flex">
      <a href="<?=$path?>comics/all">
        <img src="<?=$path?>img/banners/comics/search_<?=$lang_lower?>.png" alt="<?=__('comics_list_search')?>" title="<?=__('comics_list_search')?>">
      </a>
    </div>
  </div>

  <div class="flexcontainer">
    <div class="flex smallspaced_right">
      <a href="<?=$path?>comics/tags">
        <img src="<?=$path?>img/banners/comics/tags_<?=$lang_lower?>.png" alt="<?=__('comics_list_tags')?>" title="<?=__('comics_list_tags')?>">
      </a>
    </div>
    <div class="flex smallspaced_right">
      <a href="<?=$path?>comics/random?type=1">
        <img src="<?=$path?>img/banners/comics/random_full_<?=$lang_lower?>.png" alt="<?=__('comics_nav_random')?>" title="<?=__('comics_nav_random')?>">
      </a>
    </div>
    <div class="flex">
      <a href="<?=$path?>comic/<?=$latest_comic_slug?>">
        <img src="<?=$path?>img/banners/comics/latest_<?=$lang_lower?>.png" alt="<?=__('comics_list_new')?>" title="<?=__('comics_list_latest')?>">
      </a>
    </div>
  </div>

  <?php for($i = 0; $i < $comic_types_list['rows']; $i++): ?>
  <div class="nopadding_bot">
    <a href="<?=$path?>category/<?=$comic_types_list[$i]['slug']?>">
      <img src="<?=$path.$comic_types_list[$i]['banner']?>" alt="<?=$comic_types_list[$i]['name']?>" title="<?=$comic_types_list[$i]['name']?>" loading="lazy">
    </a>
  </div>
  <?php endfor; ?>

  <div class="nopadding_bot">
    <a href="<?=$path?>memes/templates">
      <img src="<?=$path?>img/banners/comics/category_templates_<?=$lang_lower?>.png" alt="<?=__('comics_list_templates')?>" title="<?=__('comics_list_templates')?>">
    </a>
  </div>

</div>


<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/**********************************************************************************/ include './../inc/footer.inc.php';