<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic management
include_once './../lang/comics.lang.php';   # Admin translations




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
  exit(header("Location: ./comics_categories"));

// Get the comic type's ID
$comic_type_id = $comic_type_data['id'];

// Get the list of comics in the category
$comics_list = comics_list( search:     array('type' => $comic_type_id) ,
                            is_public:  true                            );

// Update the page sumary
$page_url       = "pages/comics_category?type=".$comic_type;
$page_title_en  = $comic_type_data['page_en'];
$page_title_fr  = $comic_type_data['page_fr'];




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/*******************************************************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50 align_center">

  <div class="smallpadding_bot">
    <a href="<?=$path?>pages/comics_categories">
      <img src="<?=$path.$comic_type_data['banner']?>" alt="<?=__('comics_list_categories')?>" title="<?=__('comics_nav_next')?>">
    </a>
  </div>

  <?php if($comic_type_data['desc']): ?>
  <div class="smallpadding_bot">
    <blockquote><?=$comic_type_data['desc']?></blockquote>
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