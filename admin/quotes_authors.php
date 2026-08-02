<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/quotes.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/quotes_authors";
$page_title_en  = "Admin - Quote authors";
$page_title_fr  = "Admin - Auteurs de citations";

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
// Add a quote author

if(isset($_POST['quote_author_add']))
{
  // Assemble an array with the postdata
  $quote_author_add_data = array( 'name_en'    => form_fetch_element('quote_author_name_en')  ,
                                  'name_fr'    => form_fetch_element('quote_author_name_fr')  ,
                                  'year_birth' => form_fetch_element('quote_author_birth')    ,
                                  'year_death' => form_fetch_element('quote_author_death')    ,
                                  'desc_en'    => form_fetch_element('quote_author_desc_en')  ,
                                  'desc_fr'    => form_fetch_element('quote_author_desc_fr')  );

  // Add the quote author to the database
  $quote_authors_add = quote_authors_add( $quote_author_add_data );
}




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  &nbsp;

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;