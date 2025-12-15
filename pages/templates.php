<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../lang/comics.lang.php';   # Translations
include_once './../actions/images.act.php'; # Image management

// Page summary
$page_url       = "memes/templates";
$page_title_en  = "Templates";
$page_title_fr  = "Modèles";




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch all template images

// Templates
$template_list = images_list( search: array('template' => 1) ,
                              sort_by:  'name'                 ,);



/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50">

  <a href="<?=$path?>comics/list">
    <img src="<?=$path?>img/banners/comics/category_templates_<?=$lang_lower?>.png" alt="<?=__('comics_list_templates')?>" title="<?=__('comics_list_templates')?>">
  </a>

  <div class="smallpadding_top smallpadding_bot">
    <blockquote><?=__('comics_templates_desc')?></blockquote>
  </div>

  <div class="padding_bot" style="column-count: 3;">
    <?php for($i = 0; $i < $template_list['rows']; $i++): ?>
    <a href="<?=$path?>img/comics/<?=$template_list[$i]['name_full']?>" target="_blank">
      <img src="<?=$path?>img/comics/<?=$template_list[$i]['name_full']?>" alt="<?=$template_list[$i]['name_full']?>" title="<?=$template_list[$i]['name_full']?>" class="indiv">
    </a>
    <?php endfor; ?>
  </div>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;