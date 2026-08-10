<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/quotes.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/quote";
$page_title_en  = "Admin - Quote BBCodes";
$page_title_fr  = "Admin - BBCodes des citations";

// Admin menu selection
$admin_menu['quotes'] = 1;

// Extra CSS & JS
$css  = array('admin');
$js   = array('admin/admin');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 nopadding_top spaced">

  <p class="align_center bold">
    <?=__('admin_quotes_bbcode_title')?>
  </p>

  <p>
    <?=__('admin_quotes_bbcode_link')?><br>
    <?=__('admin_quotes_bbcode_link_2')?><br>
  </p>

  <p>
    <?=__('admin_quotes_bbcode_bold')?><br>
    <?=__('admin_quotes_bbcode_italics')?><br>
    <?=__('admin_quotes_bbcode_underline')?><br>
    <?=__('admin_quotes_bbcode_strike')?>
  </p>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;