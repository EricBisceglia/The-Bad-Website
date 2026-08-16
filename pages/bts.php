<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../lang/videos.lang.php';   # Translations
include_once './../actions/videos.act.php'; # Video management

// Page summary
$page_url       = "stuff/bts";
$page_title_en  = "Behind the scenes";
$page_title_fr  = "Coulisses";

// Enforce the url
page_enforce_url($page_url);




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch behind the scenes videos

$bts_videos = videos_bts_list();



/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50">

  <a href="<?=$path?>stuff/list">
    <img src="<?=$path?>img/website/categories/bts_<?=$lang_lower?>.png" alt="<?=__('videos_bts_title')?>" title="<?=__('videos_bts_title')?>">
  </a>

  <div class="smallpadding_top smallpadding_bot">
    <blockquote><?=__('videos_bts_desc')?></blockquote>
  </div>

  <?php for($i = 0; $i < $bts_videos['rows']; $i++): ?>
  <div class="padding_top">
    <?php if($bts_videos[$i]['title']): ?>
    <h4 class="smallpadding_bot align_center">
      <?=$bts_videos[$i]['title']?>
    </h4>
    <?php endif; if($bts_videos[$i]['desc']): ?>
    <div class="smallpadding_bot italics align_center">
      <?= $bts_videos[$i]['desc'] ?>
    </div>
    <?php endif; ?>
    <div class="smallpadding_top">
      <div class="comic_youtube_container">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?=$bts_videos[$i]['youtube']?>?rel=0" class="comic_youtube_embed" loading="lazy"></iframe>
      </div>
    </div>
  </div>
  <?php endfor; ?>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;