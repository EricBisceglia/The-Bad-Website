<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php'; # Core
include_once './../lang/main.lang.php';   # Translations

// Page summary
$page_lang        = array('FR', 'EN');
$page_url         = "pages/videos";
$page_description = "Hi, this is Bad, and you're on the wrong website.";




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/*******************************************************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50">

  <img src="<?=$path?>img/website/videos_intro_<?=$lang?>.png" alt="<?=__('videos_comics_intro')?>" title="<?=__('videos_comics_intro')?>">

  <img src="<?=$path?>img/website/videos_future_<?=$lang?>.png" alt="<?=__('videos_comics_future')?>" title="<?=__('videos_comics_future')?>">

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/**********************************************************************************/ include './../inc/footer.inc.php';