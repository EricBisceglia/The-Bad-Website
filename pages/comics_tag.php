<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic management
include_once './../actions/tags.act.php';   # Tag management
include_once './../lang/comics.lang.php';   # Admin translations




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get the tag and its comics

// Fetch the tag
$comic_tag = (int)form_fetch_element('theme', request_type: 'GET');

// Fetch the comic type data
$comic_tag_data = tags_get($comic_tag);

// Stop here if the comic type does not exist
if(!$comic_tag_data)
  exit(header("Location: ./comic_tags"));

// Get the list of comics in the tag
$comics_list = comics_list( search:     array('tag_id' => $comic_tag) ,
                            is_public:  true                          );

// Update the page sumary
$page_url       = "pages/comic_tag?theme=".$comic_tag;
$page_title_en  = $comic_tag_data['title_en'];
$page_title_fr  = $comic_tag_data['title_fr'];




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/*******************************************************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50 align_center">

  <div class="smallpadding_bot">
    <a href="<?=$path?>pages/comics_tags">
      <img src="<?=$path.$comic_tag_data['banner']?>" alt="<?=__('comics_list_tags')?>" title="<?=__('comics_nav_next')?>">
    </a>
  </div>

  <?php if($comic_tag_data['desc']): ?>
  <div class="smallpadding_bot">
    <blockquote><?=$comic_tag_data['desc']?></blockquote>
  </div>
  <?php endif; ?>

  <div class="align_center">
    <?php for($i = 0; $i < $comics_list['rows']; $i++): ?>
    <div class="smallpadding_bot">
      <a href="<?=$path?>comic/<?=$comics_list[$i]['slug']?>">
        <?php if($comics_list[$i]['preview']) : ?>
        <img src="<?=$path?>img/comics/<?=$comics_list[$i]['preview']?>" alt="<?=$comics_list[$i]['title']?>" title="<?=$comics_list[$i]['title']?>" loading="lazy">
        <?php else: ?>
        <img src="<?=$path?>img/templates/preview_<?=$lang?>" alt="<?=$comics_list[$i]['title']?>" title="<?=$comics_list[$i]['title']?>" loading="lazy">
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