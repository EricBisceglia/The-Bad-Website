<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic management
include_once './../lang/comics.lang.php';   # Admin translations

// Page summary
$page_url       = "pages/comics";
$page_title_en  = "Comics";
$page_title_fr  = "Comics";




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
      <a href="<?=$path?>pages/comics_list">
        <img src="<?=$path?>img/banners/comics/full_list_<?=$lang?>.png" alt="<?=__('comics_list_all')?>" title="<?=__('comics_list_all')?>">
      </a>
    </div>
    <div class="flex">
      <a href="<?=$path?>pages/comics_list">
        <img src="<?=$path?>img/banners/comics/search_<?=$lang?>.png" alt="<?=__('comics_list_search')?>" title="<?=__('comics_list_search')?>">
      </a>
    </div>
  </div>

  <div class="flexcontainer smallpadding_bot">
    <div class="flex smallspaced_right">
      <a href="<?=$path?>pages/comics_categories">
        <img src="<?=$path?>img/banners/comics/categories_<?=$lang?>.png" alt="<?=__('comics_list_categories')?>" title="<?=__('comics_list_categories')?>">
      </a>
    </div>
    <div class="flex smallspaced_right">
      <a href="<?=$path?>pages/comics_random">
        <img src="<?=$path?>img/banners/comics/random_<?=$lang?>.png" alt="<?=__('comics_nav_random')?>" title="<?=__('comics_nav_random')?>">
      </a>
    </div>
    <div class="flex">
      <a href="<?=$path?>pages/comics_tags">
        <img src="<?=$path?>img/banners/comics/tags_<?=$lang?>.png" alt="<?=__('comics_list_tags')?>" title="<?=__('comics_list_tags')?>">
      </a>
    </div>
  </div>

  <div class="align_center">
    <?php for($i = 0; $i < $comics_list['rows']; $i++): ?>
    <?php if($i < 20): ?>
    <div class="smallpadding_bot<?=$comics_list[$i]['blur']?>">
      <a href="<?=$path?>comic/<?=$comics_list[$i]['slug']?>">
        <?php if($comics_list[$i]['preview']) : ?>
        <img src="<?=$path?>img/comics/<?=$comics_list[$i]['preview']?>" alt="<?=$comics_list[$i]['title']?>" title="<?=$comics_list[$i]['title']?>" loading="lazy"<?=$comics_list[$i]['unblur']?>>
        <?php else: ?>
        <img src="<?=$path?>img/templates/preview_<?=$lang?>.png" alt="<?=$comics_list[$i]['title']?>" title="<?=$comics_list[$i]['title']?>" loading="lazy">
        <?php endif; ?>
      </a>
    </div>
    <?php endif; ?>
    <?php endfor; ?>
  </div>

</div>


<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/**********************************************************************************/ include './../inc/footer.inc.php';