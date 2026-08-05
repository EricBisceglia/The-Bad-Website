<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/quotes.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/quotes_tags";
$page_title_en  = "Admin - Quote tags";
$page_title_fr  = "Admin - Tags de citations";

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
// Add a quote tag

if(isset($_POST['quote_tags_add']))
{
  // Assemble an array with the postdata
  $quote_tags_add_data = array( 'sort'    => form_fetch_element('quote_tags_sort')  ,
                                'name_en' => form_fetch_element('quote_tags_name_en')  ,
                                'name_fr' => form_fetch_element('quote_tags_name_fr')  );

  // Add the quote tag to the database
  $quote_tags_add = quote_tags_add( $quote_tags_add_data );
}




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_40 padding_top">

  <h2 class="align_center padding_bot">
    <?=__link('admin/quotes', __('admin_quotes_tags_title'), 'text_light', path: $path)?>
    <?=__icon('add', alt: '+', title: __('add'), title_case: 'initials', href: 'admin/quotes_tags_add', path: $path)?>
  </h2>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;