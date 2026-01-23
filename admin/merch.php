<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/admin.act.php';  # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations
include_once './../actions/images.act.php'; # Images

// Page summary
$page_url       = "admin/merch";
$page_title_en  = "Admin - Merch";
$page_title_fr  = "Admin - Merch";

// Admin menu selection
$admin_menu['merch'] = 1;

// Extra CSS & JS
$css  = array('admin');
$js   = array('admin/admin');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Fetch merch templates
$merch_gallery = merch_get_images(get_templates: true);



/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <div style="column-count: 3;">
    <?php for($i = 0; $i < count($merch_gallery); $i++): ?>
    <div class="nopadding_bot">
      <a href="<?=$path?>img/merch/templates/<?=$merch_gallery[$i]?>" target="_blank">
        <img src="<?=$path?>img/merch/templates/<?=$merch_gallery[$i]?>" alt="<?=$merch_gallery[$i]?>" title="<?=$merch_gallery[$i]?>" class="indiv">
      </a>
    </div>
    <?php endfor; ?>
  </div>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;