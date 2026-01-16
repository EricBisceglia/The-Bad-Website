<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic management
include_once './../actions/tags.act.php';   # Tag management
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/comics_share";
$page_title_en  = "Admin - ";
$page_title_fr  = "Admin - ";

// Admin menu selection
$admin_menu['comics'] = 1;

// Extra CSS & JS
$css  = array('admin');
$js   = array('admin/admin');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch comic data

// Fetch the comic's ID
$admin_comic_id = (int)form_fetch_element('id', request_type: 'GET');

// Fetch the image's data
$admin_comic_data = comics_get( comic_id:         $admin_comic_id ,
                                show_all_images:  true            );

// Stop here if the image does not exist
if(!$admin_comic_data)
  exit(header("Location: ".$path."admin/comics"));

// Update the page's title
$page_title_en  .= $admin_comic_data['page_en'];
$page_title_fr  .= $admin_comic_data['page_fr'];




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="bigpadding_bot">
    <?=__link('admin/comics?edit', __('admin_comics_list_share'), 'text_light', path: root_path())?>
    <?=__icon('edit', alt: 'M', title: __('edit'), path: root_path(), href: 'admin/comics_edit?id='.$admin_comic_id, popup: true, class: 'valign_middle pointer tinyspaced_left')?>
  </h2>

  <?php if($admin_comic_data['private']): ?>
  <div class="bigpadding_bot">
    <div class="text_white red bold bigger uppercase tinypadding_top tinypadding_bot align_center">
      <?=__('admin_comics_share_private')?>
    </div>
  </div>
  <?php endif; ?>

  <h5 class="smallpadding_bot">
    <?=__('admin_comics_share_link').__(':')?>
  </h5>
  <div class="smallpadding_bot">
    <blockquote><?=$GLOBALS['website_url'].'comic/'.$admin_comic_data['slug']?></blockquote>
  </div>

  <h5 class="smallpadding_bot padding_top">
    <?=__('admin_comics_share_title').__(':')?>
  </h5>
  <?php if($admin_comic_data['title_en']): ?>
  <div class="smallpadding_bot">
    <blockquote><?=$admin_comic_data['title_en']?></blockquote>
  </div>
  <?php endif; ?>
  <?php if($admin_comic_data['title_fr']): ?>
  <div class="smallpadding_bot">
    <blockquote><?=$admin_comic_data['title_fr']?></blockquote>
  </div>
  <?php endif; ?>

  <?php if($admin_comic_data['youtube_en'] || $admin_comic_data['youtube_fr']): ?>
  <h5 class="padding_top smallpadding_bot">
    <?=__('admin_comics_share_youtube').__(':')?>
  </h5>
  <?php if($admin_comic_data['youtube_en']): ?>
  <div class="smallpadding_bot">
    <blockquote>https://youtu.be/<?=$admin_comic_data['youtube_en']?></blockquote>
  </div>
  <?php endif; ?>
  <?php if($admin_comic_data['youtube_fr']): ?>
  <div class="smallpadding_bot">
    <blockquote>https://youtu.be/<?=$admin_comic_data['youtube_fr']?></blockquote>
  </div>
  <?php endif; ?>
  <?php endif; ?>

  <?php if($admin_comic_data['images']['rows'] > 0): ?>
  <h5 class="padding_top smallpadding_bot">
    <?=__('admin_comics_share_transcript').__(':')?>
  </h5>
  <?php for($i = 0; $i < $admin_comic_data['images']['rows']; $i++): ?>
  <?php if($i > 0 && $admin_comic_data['images']['lang'][$i] !== $admin_comic_data['images']['lang'][$i-1]): ?>
  <br>
  <?php endif; ?>
  <?php if($admin_comic_data['images']['preview'][$i] === 'Comic' && !$admin_comic_data['images']['old'][$i] && !$admin_comic_data['images']['full'][$i]): ?>
  <div class="smallpadding_bot">
    <blockquote><?=$admin_comic_data['images']['trans'][$i]?></blockquote>
  </div>
  <?php endif; ?>
  <?php endfor; ?>
  </h5>
  <?php endif; ?>

  <?php if($admin_comic_data['images']['transcript_text_en'] || $admin_comic_data['images']['transcript_text_fr']): ?>
  <h5 class="padding_top smallpadding_bot">
    <?=__('admin_comics_share_markdown').__(':')?>
  </h5>
  <?php if($admin_comic_data['images']['transcript_text_en']): ?>
  <div class="smallpadding_bot">
    <blockquote><?=$admin_comic_data['images']['transcript_md_en']?></blockquote>
  </div>
  <?php endif; ?>
  <?php if($admin_comic_data['images']['transcript_text_fr']): ?>
  <div class="smallpadding_bot">
    <blockquote><?=$admin_comic_data['images']['transcript_md_fr']?></blockquote>
  </div>
  <?php endif; ?>
  <?php endif; ?>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;