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
// Get the list of comics

$comics_list = comics_list( sort_by:    'date'  ,
                            is_public:  true    ,
                            is_major:   true    );




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

  <div class="flexcontainer smallpadding_bot">
    <div class="flex smallspaced_right">
      <a href="<?=$path?>comics/categories">
        <img src="<?=$path?>img/banners/comics/categories_<?=$lang_lower?>.png" alt="<?=__('comics_list_categories')?>" title="<?=__('comics_list_categories')?>">
      </a>
    </div>
    <div class="flex smallspaced_right">
      <a href="<?=$path?>comics/random?type=1">
        <img src="<?=$path?>img/banners/comics/random_<?=$lang_lower?>.png" alt="<?=__('comics_nav_random')?>" title="<?=__('comics_nav_random')?>">
      </a>
    </div>
    <div class="flex">
      <a href="<?=$path?>comics/tags">
        <img src="<?=$path?>img/banners/comics/tags_<?=$lang_lower?>.png" alt="<?=__('comics_list_tags')?>" title="<?=__('comics_list_tags')?>">
      </a>
    </div>
  </div>

  <div class="smallpadding_bot">
    <img src="<?=$path?>img/banners/comics/latest_comics_<?=$lang_lower?>.png" alt="<?=__('comics_list_latest')?>" title="<?=__('comics_list_latest')?>">
  </div>

  <div class="align_center">
    <?php for($i = 0; $i < $comics_list['rows']; $i++): ?>
    <div class="smallpadding_bot<?=$comics_list[$i]['blur']?>">
      <a href="<?=$path?>comic/<?=$comics_list[$i]['slug']?>">
        <?php if($comics_list[$i]['preview']) : ?>
        <img src="<?=$path?>img/comics/<?=$comics_list[$i]['preview']?>" alt="<?=$comics_list[$i]['alt']?>" title="<?=$comics_list[$i]['title']?>" loading="lazy"<?=$comics_list[$i]['unblur']?>>
        <?php else: ?>
        <img src="<?=$path?>img/templates/preview_<?=$lang_lower?>.png" alt="<?=$comics_list[$i]['alt']?>" title="<?=$comics_list[$i]['title']?>" loading="lazy">
        <?php endif; ?>
      </a>
    </div>
    <?php endfor; ?>
  </div>

</div>


<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/**********************************************************************************/ include './../inc/footer.inc.php';