<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php'; # Core
include_once './../lang/main.lang.php';   # Translations

// Page summary
$page_lang        = array('FR', 'EN');
$page_url         = "pages/legal";
$page_title_en    = "Legal notice";
$page_title_fr    = "Mentions légales";
$page_description = "The Bad Website - Legal notice and privacy policy";




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/*******************************************************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50">

  <h2>
    <?=__('legal_notice_title')?>
  </h2>

  <p>
    <?=__('legal_notice_body_1')?>
  </p>

  <p>
    <?=__('legal_notice_body_2')?>
  </p>

  <p>
    <?=__('legal_notice_body_3')?>
  </p>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/**********************************************************************************/ include './../inc/footer.inc.php';