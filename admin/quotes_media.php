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

  // Fetch the attached authors postdata
  $quote_media_authors = $_POST['quote_media_authors'] ?? array();
  if(!is_array($quote_media_authors))
    $quote_media_authors = array();

  // Add the quote media's authors
  quote_media_edit_authors( $quote_media_add, $quote_media_authors );
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Edit a media

if(isset($_POST['quote_media_edit']))
{
  // Fetch the media's ID
  $admin_media_id = (int)form_fetch_element('quote_media_id');

  // Assemble an array with the postdata
  $quote_media_edit_data = array( 'name_en'    => form_fetch_element('quote_media_name_en')    ,
                                  'name_fr'    => form_fetch_element('quote_media_name_fr')    ,
                                  'desc_en'    => form_fetch_element('quote_media_desc_en')    ,
                                  'desc_fr'    => form_fetch_element('quote_media_desc_fr')    ,
                                  'source_en'  => form_fetch_element('quote_media_source_en')  ,
                                  'source_fr'  => form_fetch_element('quote_media_source_fr')  ,
                                  'year'       => form_fetch_element('quote_media_year')       );

  // Edit the quote media
  quote_media_edit( $admin_media_id, $quote_media_edit_data );

  // Fetch the attached authors postdata
  $quote_media_authors = $_POST['quote_media_authors'] ?? array();
  if(!is_array($quote_media_authors))
    $quote_media_authors = array();

  // Update the quote media's authors
  quote_media_edit_authors( $admin_media_id, $quote_media_authors );
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Delete a media

if(isset($_POST['admin_quotes_media_delete']))
{
  // Fetch the media's ID
  $admin_media_id = (int)form_fetch_element('admin_quotes_media_delete');

  // Delete the quote media
  quote_media_delete( $admin_media_id );
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch quote media

$quote_media_list = quote_media_list();




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

  <table>
    <thead>

      <tr class="uppercase">
        <th class="align_center">
          <?=__('admin_quotes_media_name')?>
        </th>
        <th class="align_center">
          <?=__('admin_quotes_media_authors')?>
        </th>
        <th class="align_center">
          <?=__('admin_quotes_media_year')?>
        </th>
        <th class="align_center">
          <?=__('admin_quotes_media_quotes')?>
        </th>
        <th>
          <?=__('act')?>
        </th>
      </tr>

    </thead>

    <tbody class="altc2 nowrap" id="admin_quotes_media_tbody">

      <?php endif; ?>

      <tr>
        <td colspan="5" class="uppercase text_light dark bold align_center">
          <?=__('admin_quotes_media_count', preset_values: array($quote_media_list['rows']), amount: $quote_media_list['rows'])?>
        </td>
      </tr>

      <?php for($i = 0; $i < $quote_media_list['rows']; $i++): ?>

      <tr>

        <td class="nowrap bold tooltip_container">
          <?=$quote_media_list[$i]['sname']?>
          <span class="tooltip">
            <?=$quote_media_list[$i]['name_en']?><br>
            <?=$quote_media_list[$i]['name_fr']?>
          </span>
        </td>

        <?php if($quote_media_list[$i]['authors']): ?>
        <td class="align_center bold nowrap tooltip_container">
          <?=$quote_media_list[$i]['authors']?>
          <span class="tooltip">
            <?=$quote_media_list[$i]['authors_list']?>
          </span>
        </td>
        <?php else: ?>
        <td class="align_center">
          &nbsp;
        </td>
        <?php endif; ?>

        <td class="align_center nowrap">
          <?php if($quote_media_list[$i]['year']): ?>
          <?=$quote_media_list[$i]['year']?>
          <?php endif; ?>
        </td>

        <td class="align_center nowrap bold">
          <?php if($quote_media_list[$i]['quotes']): ?>
          <?=$quote_media_list[$i]['quotes']?>
          <?php else: ?>
          &nbsp;
          <?php endif; ?>
        </td>

        <td class="align_center nowrap admin_action_icons">
          <?=__icon('edit', is_small: true, class: 'valign_middle pointer spaced_right', alt: 'M', title: __('edit'), title_case: 'initials', href: 'admin/quotes_media_edit?quote_media_id='.$quote_media_list[$i]['id'], path: $path)?>
          <?php if($quote_media_list[$i]['quotes']): ?>
          <?=__icon('delete', is_small: true, class: 'valign_middle pointer', alt: 'X', title: __('delete'), title_case: 'initials', onclick: "alert('".__('admin_quotes_media_delete_quotes')."')", path: $path)?>
          <?php else: ?>
          <?=__icon('delete', is_small: true, class: 'valign_middle pointer', alt: 'X', title: __('delete'), title_case: 'initials', onclick: "admin_quotes_media_delete('".$quote_media_list[$i]['id']."','".__('admin_quotes_media_delete_confirm')."')", path: $path)?>
          <?php endif; ?>
        </td>

      </tr>

      <?php endfor; ?>

      <?php if(!page_is_fetched_dynamically()): ?>

    </tbody>
  </table>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;