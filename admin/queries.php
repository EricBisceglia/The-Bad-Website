<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './queries_sql.inc.php';     # SQL queries
include_once './../inc/includes.inc.php'; # Core
include_once './../lang/admin.lang.php';  # Admin translations

// Page summary
$page_url       = "pages/admin/queries";
$page_title_en  = "Admin: Queries";
$page_title_fr  = "Admin : Requêtes";

// Admin menu selection
$admin_menu['queries'] = 1;

// Extra CSS & JS
$css  = array('admin');
$js   = array('admin/admin');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/*******************************************/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top align_center">
  <div class="green text_white bold biggest uppercase">
    &nbsp;<br>
    <?=__('admin_query_ok')?><br>
    &nbsp;
  </div>
</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/**********************************************************************************/ include './../inc/footer.inc.php';