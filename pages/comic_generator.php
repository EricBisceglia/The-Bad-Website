<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic management
include_once './../lang/comics.lang.php';   # Translations

// Page summary
$page_url       = "comics/generator";
$page_title_en  = "Smug generator";
$page_title_fr  = "Générateur d'arroganteries";

// Enforce the url
page_enforce_url($page_url);




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Generate the random smuggie's seed

$seed = (isset($_GET['seed']) ? (int)$_GET['seed'] : random_int(1, PHP_INT_MAX));




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/*******************************************************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50">

  <a href="<?=$path?>comics/list">
    <img src="<?=$path?>img/website/categories/generator_<?=$lang_lower?>.png" alt="<?=__('comics_list_generator')?>" title="<?=__('comics_list_generator')?>">
  </a>

  <div class="smallpadding_top smallpadding_bot align_center">
    <div class="comic_container">
      <a href="<?=$path?>./pages/random_smug.php?seed=<?=$seed?>" target="_blank">
        <img src="<?=$path?>./pages/random_smug.php?seed=<?=$seed?>" alt="<?=__('comics_generator_image')?>">
      </a>
    </div>
  </div>

  <div class="desktop">
    <blockquote>
      <?=__('comics_generator_desc', preset_values: array($GLOBALS['website_url'].'comics/generator?seed='.$seed))?>
    </blockquote>
  </div>
  <div class="mobile">
    <blockquote class="smallish">
      <?=__('comics_generator_desc', preset_values: array($GLOBALS['website_url'].'comics/generator?seed='.$seed))?>
    </blockquote>
  </div>

  <div class="smallpadding_top">
    <a href="<?=$path?>comics/generator">
      <img src="<?=$path?>img/website/pages/generator_roll_<?=$lang_lower?>.png" alt="<?=__('comics_generator_generate')?>" title="<?=__('comics_generator_generate')?>">
    </a>
  </div>

  <div>
    <a href="<?=$path?>about/socials">
      <img src="<?=$path?>img/website/pages/generator_follow_<?=$lang_lower?>.png" alt="<?=__('comics_list_generator')?>" title="<?=__('comics_list_generator')?>">
    </a>
  </div>

</div>


<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/**********************************************************************************/ include './../inc/footer.inc.php';