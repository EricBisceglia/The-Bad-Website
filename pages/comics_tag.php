<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic management
include_once './../actions/tags.act.php';   # Tag management
include_once './../lang/comics.lang.php';   # Translations




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get the tag and its comics

// Fetch the tag
$comic_tag = form_fetch_element('theme', request_type: 'GET');

// Fetch the comic type data
$comic_tag_data = tags_get( tag_slug: $comic_tag);

// Stop here if the comic type does not exist
if(!$comic_tag_data)
  exit(header("Location: ./comics_tags"));

// Get the tag's ID
$comic_tag_id = $comic_tag_data['id'];

// Get the list of comics in the tag
$comics_list = comics_list( search:     array('tag_id' => $comic_tag_id)  ,
                            is_public:  true                              );

// Update the page sumary
$page_url       = "tag/".$comic_tag;
$page_title_en  = $comic_tag_data['page_en'];
$page_title_fr  = $comic_tag_data['page_fr'];

// Enforce the url
page_enforce_url($page_url);




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/*******************************************************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50 align_center">

  <div class="smallpadding_bot">
    <a href="<?=$path?>comics/tags">
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