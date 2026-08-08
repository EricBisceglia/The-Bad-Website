<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/quotes.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/quotes_authors_gallery";
$page_title_en  = "Admin - Quote gallery";
$page_title_fr  = "Admin - Galerie de citations";

// Admin menu selection
$admin_menu['quotes'] = 1;

// Extra CSS & JS
$css  = array('admin');
$js   = array('admin/admin');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch the authors

$quote_authors = quote_authors_list();




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="align_center padding_bot">
    <?=__link('admin/quotes', __('admin_quotes_authors_gallery_title'), 'text_light', path: $path)?>
  </h2>

  <div style="column-count: 4;">
    <?php for($i = 0; $i < $quote_authors['rows']; $i++): ?>
    <?php if($quote_authors[$i]['has_portrait']): ?>
    <div class="smallpadding_bot">
      <a href="<?=$path?>admin/quotes_farm?author=<?=$quote_authors[$i]['id']?>">
        <img src="<?=$path?><?=$quote_authors[$i]['portrait']?>" alt="<?=$quote_authors[$i]['name']?>" title="<?=$quote_authors[$i]['name']?>" class="admin_quote_gallery">
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
/***************************************************************************/ include './../inc/footer.inc.php'; endif;