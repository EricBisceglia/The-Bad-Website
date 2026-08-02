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
// Add an author

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




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Edit an author

if(isset($_POST['quote_author_edit']))
{
  // Fetch the author's ID
  $admin_author_id = (int)form_fetch_element('quote_author_id');

  // Assemble an array with the postdata
  $quote_author_edit_data = array( 'name_en'    => form_fetch_element('quote_author_name_en')  ,
                                   'name_fr'    => form_fetch_element('quote_author_name_fr')  ,
                                   'year_birth' => form_fetch_element('quote_author_birth')    ,
                                   'year_death' => form_fetch_element('quote_author_death')    ,
                                   'desc_en'    => form_fetch_element('quote_author_desc_en')  ,
                                   'desc_fr'    => form_fetch_element('quote_author_desc_fr')  );

  // Edit the quote author
  quote_authors_edit( $admin_author_id, $quote_author_edit_data );
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Delete an author

if(isset($_POST['admin_quotes_authors_delete']))
{
  // Fetch the author's ID
  $admin_author_id = (int)form_fetch_element('admin_quotes_authors_delete');

  // Delete the quote author
  quote_authors_delete( $admin_author_id );
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch the authors

$quote_authors = quote_authors_list();




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_40 padding_top">

  <h2 class="align_center padding_bot">
    <?=__link('admin/quotes', __('admin_quotes_authors_title'), 'text_light', path: $path)?>
    <?=__icon('add', alt: '+', title: __('add'), title_case: 'initials', href: 'admin/quotes_authors_add', path: $path)?>
  </h2>

  <table>
    <thead>

      <tr class="uppercase">
        <th class="align_center">
          <?=__('admin_quotes_authors_name')?>
        </th>
        <th class="align_center">
          <?=__('admin_quotes_authors_years')?>
        </th>
        <th class="align_center">
          <?=__('admin_quotes_authors_quotes')?>
        </th>
        <th>
          <?=__('act')?>
        </th>
      </tr>

    </thead>

    <tbody class="altc2 nowrap" id="admin_quotes_authors_tbody">

      <?php endif; ?>

      <tr>
        <td colspan="4" class="uppercase text_light dark bold align_center">
          <?=__('admin_quotes_authors_count', preset_values: array($quote_authors['rows']), amount: $quote_authors['rows'])?>
        </td>
      </tr>

      <?php for($i = 0; $i < $quote_authors['rows']; $i++): ?>

      <tr>

        <td class="align_center nowrap bold tooltip_container">
          <?=$quote_authors[$i]['sname']?>
          <span class="tooltip">
            <?=$quote_authors[$i]['name_en']?><br>
            <?=$quote_authors[$i]['name_fr']?>
          </span>
        </td>

        <td class="align_center nowrap">
          <?php if($quote_authors[$i]['birth']): ?>
          <?=$quote_authors[$i]['birth']?>
          <?php endif; if($quote_authors[$i]['birth'] && $quote_authors[$i]['death']): ?>
          -
          <?php endif; if($quote_authors[$i]['death']): ?>
          <?=$quote_authors[$i]['death']?>
          <?php endif; ?>
        </td>

        <td class="align_center nowrap">
          <?php if($quote_authors[$i]['used']): ?>
          <?=$quote_authors[$i]['used']?>
          <?php else: ?>
          &nbsp;
          <?php endif; ?>
        </td>

        <td class="align_center nowrap admin_action_icons">
          <?=__icon('edit', is_small: true, class: 'valign_middle pointer spaced_right', alt: 'M', title: __('edit'), title_case: 'initials', href: 'admin/quotes_authors_edit?quote_author_id='.$quote_authors[$i]['id'], path: $path)?>
          <?php if($quote_authors[$i]['quotes']): ?>
          <?=__icon('delete', is_small: true, class: 'valign_middle pointer', alt: 'X', title: __('delete'), title_case: 'initials', onclick: "alert('".__('admin_quotes_authors_delete_quotes')."')", path: $path)?>
          <?php elseif($quote_authors[$i]['media']): ?>
          <?=__icon('delete', is_small: true, class: 'valign_middle pointer', alt: 'X', title: __('delete'), title_case: 'initials', onclick: "alert('".__('admin_quotes_authors_delete_media')."')", path: $path)?>
          <?php else: ?>
          <?=__icon('delete', is_small: true, class: 'valign_middle pointer', alt: 'X', title: __('delete'), title_case: 'initials', onclick: "admin_quotes_authors_delete('".$quote_authors[$i]['id']."','".__('admin_quotes_authors_delete_confirm')."')", path: $path)?>
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