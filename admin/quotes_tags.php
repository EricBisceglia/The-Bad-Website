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




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Edit a quote tag

if(isset($_POST['quote_tag_edit']))
{
  // Fetch the quote tag's ID
  $quote_tag_id = (int)form_fetch_element('quote_tag_id');

  // Assemble an array with the postdata
  $quote_tag_edit_data = array( 'id'      => form_fetch_element('quote_tag_id')       ,
                                'sort'    => form_fetch_element('quote_tag_sort')     ,
                                'name_en' => form_fetch_element('quote_tag_name_en')  ,
                                'name_fr' => form_fetch_element('quote_tag_name_fr')  );

  // Edit the quote tag in the database
  quote_tags_edit( $quote_tag_id, $quote_tag_edit_data );
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Delete a quote tag

if(isset($_POST['quote_tag_delete']))
{
  // Fetch the quote tag's ID
  $quote_tag_id = (int)form_fetch_element('quote_tag_delete');

  // Delete the quote tag from the database
  quote_tags_delete( $quote_tag_id );
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch the tags

$quote_tags = quote_tags_list();




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_30 padding_top">

  <h2 class="align_center padding_bot">
    <?=__link('admin/quotes', __('admin_quotes_tags_title'), 'text_light', path: $path)?>
    <?=__icon('add', alt: '+', title: __('add'), title_case: 'initials', href: 'admin/quotes_tags_add', path: $path)?>
  </h2>

  <table>
    <thead>

      <tr class="uppercase">
        <th class="align_center">
          <?=__('admin_quotes_tags_name')?>
        </th>
        <th class="align_center">
          <?=__('admin_quotes_tags_quotes')?>
        </th>
        <th class="align_center">
          <?=__('admin_quotes_tags_sort')?>
        </th>
        <th>
          <?=__('act')?>
        </th>
      </tr>

      </thead>

    <tbody class="altc2 nowrap" id="admin_quotes_tags_tbody">

      <?php endif; ?>

      <tr>
        <td colspan="5" class="uppercase text_light dark bold align_center">
          <?=__('admin_quotes_tags_count', preset_values: array($quote_tags['rows']), amount: $quote_tags['rows'])?>
        </td>
      </tr>

      <?php for($i = 0; $i < $quote_tags['rows']; $i++): ?>

      <tr>

        <td class="align_left nowrap bold tooltip_container">
          <?=$quote_tags[$i]['sname']?>
          <span class="tooltip">
            <?=$quote_tags[$i]['name_en']?><br>
            <?=$quote_tags[$i]['name_fr']?>
          </span>
        </td>

        <td class="align_center bold nowrap">
          <?php if($quote_tags[$i]['quotes']): ?>
          <?=$quote_tags[$i]['quotes']?>
          <?php else: ?>
          &nbsp;
          <?php endif; ?>
        </td>

        <td class="align_center bold nowrap">
          <?=$quote_tags[$i]['sort']?>
        </td>

        <td class="align_center nowrap admin_action_icons">
          <?=__icon('edit', is_small: true, class: 'valign_middle pointer spaced_right', alt: 'M', title: __('edit'), title_case: 'initials', href: 'admin/quotes_tags_edit?quote_tag_id='.$quote_tags[$i]['id'], path: $path)?>
          <?php if($quote_tags[$i]['quotes']): ?>
          <?=__icon('delete', is_small: true, class: 'valign_middle pointer', alt: 'X', title: __('delete'), title_case: 'initials', onclick: "alert('".__('admin_quotes_tags_delete_quotes')."')", path: $path)?>
          <?php else: ?>
          <?=__icon('delete', is_small: true, class: 'valign_middle pointer', alt: 'X', title: __('delete'), title_case: 'initials', onclick: "admin_quotes_tags_delete('".$quote_tags[$i]['id']."','".__('admin_quotes_tags_delete_confirm')."')", path: $path)?>
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