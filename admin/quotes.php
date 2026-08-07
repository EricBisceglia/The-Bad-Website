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
                            'quote_year'      => form_fetch_element('quote_year')       ,
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




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Delete a quote

if(isset($_POST['quotes_delete']))
{
  // Delete the quote from the database
  $quote_delete = quotes_delete(form_fetch_element('quotes_delete'));
}





///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch the quotes

$quotes_list = quotes_list();




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_60 padding_top">

  <h2 class="align_center padding_bot">
    <?=__link('admin/quotes', __('admin_quotes_title'), 'text_light', path: $path)?>
    <?=__icon('add', alt: '+', title: __('add'), title_case: 'initials', href: 'admin/quotes_add', path: $path)?>
  </h2>

  <table>
    <thead>

      <tr class="uppercase">
        <th class="align_center">
          <?=__('admin_quotes_year')?>
        </th>
        <th class="align_center">
          <?=__link('admin/quotes_authors', __('admin_quotes_author'), path: $path)?>
        </th>
        <th class="align_center">
          <?=__link('admin/quotes_media', __('admin_quotes_source'), path: $path)?>
        </th>
        <th class="align_center">
          <?=__('admin_quotes_name')?>
        </th>
        <th class="align_center">
          <?=__('admin_quotes_quote')?>
        </th>
        <th class="align_center">
          <?=__link('admin/quotes_tags', __('admin_quotes_tags'), path: $path)?>
        </th>
        <th>
          <?=__('act')?>
        </th>
      </tr>

    </thead>

    <tbody class="altc2 nowrap" id="admin_quotes_tbody">

      <?php endif; ?>

      <tr>
        <td colspan="7" class="uppercase text_light dark bold align_center">
          <?=__('admin_quotes_count', preset_values: array($quotes_list['rows']), amount: $quotes_list['rows'])?>
        </td>
      </tr>

      <?php for($i = 0; $i < $quotes_list['rows']; $i++): ?>

      <tr>

        <td class="align_left nowrap bold">
          <?=$quotes_list[$i]['year']?>
        </td>

        <td class="align_left nowrap bold tooltip_container">
          <?=$quotes_list[$i]['sauthors_full']?>
          <span class="tooltip">
            <?=$quotes_list[$i]['authors_full']?>
          </span>
        </td>

        <td class="align_left nowrap bold tooltip_container">
          <?=$quotes_list[$i]['smedia']?>
          <span class="tooltip">
            <?=$quotes_list[$i]['media_en']?><br>
            <?=$quotes_list[$i]['media_fr']?>
          </span>
        </td>

        <td class="align_left nowrap bold tooltip_container">
          <?=$quotes_list[$i]['stitle']?>
          <span class="tooltip">
            <?=$quotes_list[$i]['title_en']?><br>
            <?=$quotes_list[$i]['title_fr']?>
          </span>
        </td>

        <td class="align_center nowrap">
          <span class="tooltip_container">
            <?=__icon('speech_bubble', is_small: true, alt: 'Q', title: __('admin_quotes_quote_full'), title_case: 'initials')?>
            <div class="tooltip dowrap">
              <?php if($quotes_list[$i]['body_en']): ?>
              <div class="smallpadding_top smallpadding_bot spaced">
                <?=$quotes_list[$i]['body_en']?>
              </div>
              <?php endif; if($quotes_list[$i]['body_en'] && $quotes_list[$i]['body_fr']): ?>
              <hr class="spaced_top">
              <?php endif; if($quotes_list[$i]['body_fr']): ?>
              <div class="smallpadding_top smallpadding_bot spaced">
                <?=$quotes_list[$i]['body_fr']?>
              </div>
              <?php endif; ?>
            </div>
          </span>
          <?php if($quotes_list[$i]['sort']): ?>
          <span class="tooltip_container">
            <?=__icon('random', is_small: true, alt: 'S', title: __('admin_quotes_sort'), title_case: 'initials')?>
            <div class="tooltip dowrap">
              <?=$quotes_list[$i]['sort']?>
            </div>
          </span>
          <?php endif; ?>
        </td>

        <?php if($quotes_list[$i]['tags']): ?>
        <td class="align_center nowrap tooltip_container">
          <?=__icon('tag', is_small: true, alt: 'T', title: __('admin_quotes_tags'), title_case: 'initials')?>
          <div class="tooltip dowrap">
            <?=$quotes_list[$i]['tags_list']?>
          </div>
        </td>
        <?php else: ?>
        <td class="align_center nowrap">
          &nbsp;
        </td>
        <?php endif; ?>

        <td class="align_center nowrap admin_action_icons">
          <?=__icon('edit', is_small: true, class: 'valign_middle pointer spaced_right', alt: 'M', title: __('edit'), title_case: 'initials', href: 'admin/quotes_edit?quote_id='.$quotes_list[$i]['id'], path: $path)?>
          <?=__icon('delete', is_small: true, class: 'valign_middle pointer', alt: 'X', title: __('delete'), title_case: 'initials', onclick: "admin_quotes_delete('".$quotes_list[$i]['id']."','".__('admin_quotes_delete_confirm')."')", path: $path)?>
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