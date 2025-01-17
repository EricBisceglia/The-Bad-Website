<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                   PAGE SETTINGS                                                   */
/*                                                                                                                   */
// Inclusions /*******************************************************************************************************/
include_once './inc/includes.inc.php'; # Core

// Page summary
$page_lang        = array('FR', 'EN');
$page_url         = "404";
$page_title_en    = "Page not found";
$page_title_fr    = "Page non trouvée";
$page_description = "Error 404: Page not found…";

// Extra CSS & JS
$css = array('404');

// Hide the footer
$hide_footer = 1;



/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Make the page a hard 404
header("HTTP/1.0 404 Not Found");

// Inform the header that this is a 404
$this_page_is_a_404 = '';

// Get the user's language
$lang_404 = string_change_case(user_get_language(), 'lowercase');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/**********************************************************************************/ include './inc/header.inc.php'; ?>

<div class="width_50 align_center">
  <a href="<?=$path?>index">
    <img src="img/website/404_<?=$lang_404?>.png" alt="404">
  </a>
</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/*************************************************************************************/ include './inc/footer.inc.php';