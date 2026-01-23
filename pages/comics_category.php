<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic management
include_once './../lang/comics.lang.php';   # Translations




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get the category and its comics

// Fetch the comic type
$comic_type = form_fetch_element('type', request_type: 'GET');

// Fetch the comic type data
$comic_type_data = comic_types_get( comic_type_slug: $comic_type );

// Stop here if the comic type does not exist
if(!$comic_type_data)
  exit(header("Location: ./../comics/list"));

// Get the comic type's ID
$comic_type_id = $comic_type_data['id'];

// Get the list of comics in the category
$comics_list = comics_list( search:     array('type' => $comic_type_id) ,
                            is_public:  true                            );

// Update the page sumary
$page_url       = "category/".$comic_type;
$page_title_en  = $comic_type_data['page_en'];
$page_title_fr  = $comic_type_data['page_fr'];

// Enforce the url
page_enforce_url($page_url);




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/*******************************************************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50 align_center">

  <div class="smallpadding_bot">
    <?php if($comic_type_data['major']): ?>
    <a href="<?=$path?>comics/list">
    <?php else: ?>
    <a href="<?=$path?>stuff/list">
    <?php endif; ?>
      <img src="<?=$path.$comic_type_data['banner']?>" alt="<?=__('comics_list_categories')?>" title="<?=__('comics_nav_next')?>">
    </a>
  </div>

  <?php if($comic_type_data['desc']): ?>
  <div class="smallpadding_bot">
    <blockquote><?=$comic_type_data['desc']?></blockquote>
  </div>
  <?php endif; ?>

  <div class="smallpadding_bot">
    <img src="<?=$path?>img/banners/comics/latest_comics_<?=$lang_lower?>.png" alt="<?=__('comics_list_latest')?>" title="<?=__('comics_list_latest')?>">
  </div>

  <div class="align_center">
    <?php for($i = 0; $i < $comics_list['rows']; $i++): ?>
    <div class="smallpadding_bot<?=$comics_list[$i]['blur']?>">
      <div class="desktop smallpadding_bot indiv uppercase bold comic_preview_title">
        <a class="text_light" href="<?=$path?>comic/<?=$comics_list[$i]['slug']?>">
          <?=$comics_list[$i]['title']?>
        </a>
      </div>
      <div class="mobile smallpadding_bot indiv uppercase bold comic_preview_title">
        <a class="text_light" href="<?=$path?>comic/<?=$comics_list[$i]['slug']?>">
          <?=$comics_list[$i]['mtitle']?>
        </a>
      </div>
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