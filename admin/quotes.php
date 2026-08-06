<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/quotes.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/quotes";
$page_title_en  = "Admin - Quotes";
$page_title_fr  = "Admin - Citations";

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
// Fetch a list of all quote tags

if(!page_is_fetched_dynamically())
  $quote_tags_list = quote_tags_list();




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Add a quote

if(isset($_POST['quote_add']))
{
  // Go through the tags list
  if($quote_tags_list['rows'])
  {
    for($i = 0; $i < $quote_tags_list['rows']; $i++)
      $admin_quote_tags[$quote_tags_list[$i]['id']] = (isset($_POST['quote_tag_'.$quote_tags_list[$i]['id']])) ? 1 : 0;
  }
  else
    $admin_quote_tags = array();

  // Assemble an array with the postdata
  $quote_add_data = array(  'quote_media'     => form_fetch_element('quote_media')      ,
                            'quote_author'    => form_fetch_element('quote_author')     ,
                            'quote_sort'      => form_fetch_element('quote_sort')       ,
                            'quote_origin_en' => form_fetch_element('quote_origin_en')  ,
                            'quote_origin_fr' => form_fetch_element('quote_origin_fr')  ,
                            'quote_source_en' => form_fetch_element('quote_source_en')  ,
                            'quote_source_fr' => form_fetch_element('quote_source_fr')  ,
                            'quote_title_en'  => form_fetch_element('quote_title_en')   ,
                            'quote_title_fr'  => form_fetch_element('quote_title_fr')   ,
                            'quote_desc_en'   => form_fetch_element('quote_desc_en')    ,
                            'quote_desc_fr'   => form_fetch_element('quote_desc_fr')    ,
                            'quote_body_en'   => form_fetch_element('quote_body_en')    ,
                            'quote_body_fr'   => form_fetch_element('quote_body_fr')    ,
                            'quote_tags'      => $admin_quote_tags                      );

  // Add the quote to the database
  $quote_add = quotes_add($quote_add_data);
}




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="align_center padding_bot">
    <?=__link('admin/quotes', __('admin_quotes_title'), 'text_light', path: $path)?>
    <?=__icon('emoji', alt: 'A', title: __('admin_quotes_authors_title'), title_case: 'initials', href: 'admin/quotes_authors', path: $path)?>
    <?=__icon('video', alt: 'M', title: __('admin_quotes_media_title'), title_case: 'initials', href: 'admin/quotes_media', path: $path)?>
    <?=__icon('tag', alt: 'T', title: __('admin_quotes_tags_title'), title_case: 'initials', href: 'admin/quotes_tags', path: $path)?>
    <?=__icon('add', alt: '+', title: __('add'), title_case: 'initials', href: 'admin/quotes_add', path: $path)?>
  </h2>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;