<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php'; # Core
include_once './../lang/main.lang.php';   # Translations

// Page summary
$page_lang        = array('FR', 'EN');
$page_url         = "about/copyright";
$page_title_en    = "Intellectual property";
$page_title_fr    = "Propriété intellectuelle";
$page_description = "The Bad Website - Intellectual property";

// Enforce the url
page_enforce_url($page_url);




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/*******************************************************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50">

  <h2>
    <?=__('intellectual_property_title')?>
  </h2>

  <p>
    <?=__('intellectual_property_body_1')?>
  </p>

  <p>
    <?=__('intellectual_property_body_2')?>
  </p>

  <p>
    <?=__('intellectual_property_body_3')?>
  </p>

  <p>
    <?=__('intellectual_property_body_4')?>
  </p>

  <p>
    <?=__('intellectual_property_body_5', preset_values: array(date('Y')))?>
  </p>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/**********************************************************************************/ include './../inc/footer.inc.php';