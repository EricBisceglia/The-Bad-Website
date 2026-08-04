<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/quotes.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/quotes_media";
$page_title_en  = "Admin - Quote media";
$page_title_fr  = "Admin - Médias de citations";

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
// Add a media

if(isset($_POST['quote_media_add']))
{
  // Assemble an array with the postdata
  $quote_media_add_data = array( 'name_en'    => form_fetch_element('quote_media_name_en')    ,
                                 'name_fr'    => form_fetch_element('quote_media_name_fr')    ,
                                 'desc_en'    => form_fetch_element('quote_media_desc_en')    ,
                                 'desc_fr'    => form_fetch_element('quote_media_desc_fr')    ,
                                 'source_en'  => form_fetch_element('quote_media_source_en')  ,
                                 'source_fr'  => form_fetch_element('quote_media_source_fr')  ,
                                 'year'       => form_fetch_element('quote_media_year')       );

  // Add the quote media to the database
  $quote_media_add = quote_media_add( $quote_media_add_data );
}




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_40 padding_top">

  <h2 class="align_center padding_bot">
    <?=__link('admin/quotes', __('admin_quotes_media_title'), 'text_light', path: $path)?>
    <?=__icon('add', alt: '+', title: __('add'), title_case: 'initials', href: 'admin/quotes_media_add', path: $path)?>
  </h2>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;