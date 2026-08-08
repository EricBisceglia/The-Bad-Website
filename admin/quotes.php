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
// Fetch a list of all quote authors, sources, and tags

// Fetch authors and sources
if(!page_is_fetched_dynamically())
{
  $quote_authors_list = quote_authors_list();
  $quote_media_list   = quote_media_list( sort_by_author: true );
}

// Fetch tags
if(!page_is_fetched_dynamically() || isset($_POST['quote_edit']))
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

  // If the quote was successfully added, redirect to it
  if($quote_add)
    exit(header("Location: ".$path."admin/quote?quote_id=".$quote_add));
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Edit a quote

if(isset($_POST['quote_edit']))
{
  // Fetch the quote's ID
  $admin_quote_id = (int)form_fetch_element('quote_id');

  // Go through the tag list
  if($quote_tags_list['rows'])
  {
    for($i = 0; $i < $quote_tags_list['rows']; $i++)
      $admin_quote_tags[$quote_tags_list[$i]['id']] = (isset($_POST['quote_tag_'.$quote_tags_list[$i]['id']])) ? 1 : 0;
  }
  else
    $admin_quote_tags = array();

  // Assemble an array with the postdata
  $admin_quote_data = array(  'quote_media'     => form_fetch_element('quote_media')      ,
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

  // Edit the quote
  quotes_edit(  $admin_quote_id   ,
                $admin_quote_data );
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Delete a quote

if(isset($_POST['admin_quotes_delete']))
{
  // Delete the quote from the database
  $quote_delete = quotes_delete(form_fetch_element('admin_quotes_delete'));
}





///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// List quotes

// Fetch the sorting order
$admin_quotes_sort = form_fetch_element('admin_quotes_sort', 'default');

// Assemble the search query
$admin_quotes_search = array( 'year'    => form_fetch_element('admin_quotes_search_year')   ,
                              'author'  => form_fetch_element('admin_quotes_search_author') ,
                              'media'   => form_fetch_element('admin_quotes_search_media')  ,
                              'title'   => form_fetch_element('admin_quotes_search_title')  ,
                              'body'    => form_fetch_element('admin_quotes_search_body')   ,
                              'tag'     => form_fetch_element('admin_quotes_search_tags')   );

// Fetch the quotes
$quotes_list = quotes_list( sort_by:  $admin_quotes_sort    ,
                            search:   $admin_quotes_search  );




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_60 padding_top">

  <form id="admin_quotes_search" onsubmit="admin_quotes_list_search(); return false;">

    <h2 class="align_center padding_bot">
      <?=__link('admin/quotes', __('admin_quotes_title'), 'text_light', path: $path)?>
      <?=__icon('template', alt: 'F', title: __('admin_quotes_farm_title'), title_case: 'initials', href: 'admin/quotes_farm', path: $path)?>
      <?=__icon('gallery', alt: 'G', title: __('admin_quotes_authors_gallery_title'), title_case: 'initials', href: 'admin/quotes_authors_gallery', path: $path)?>
      <?=__icon('add', alt: '+', title: __('add'), title_case: 'initials', href: 'admin/quotes_add', path: $path)?>
    </h2>

    <table>
      <thead>

        <tr class="uppercase">
          <th class="align_center">
            <?=__('admin_quotes_name')?>
            <?=__icon('sort_down', is_small: true, alt: 'v', title: __('sort'), title_case: 'initials', path: $path, onclick: "admin_quotes_list_search('title');")?>
          </th>
          <th class="align_center">
            <?=__('admin_quotes_quote')?>
          </th>
          <th class="align_center">
            <?=__link('admin/quotes_authors', __('admin_quotes_author'), path: $path)?>
            <?=__icon('sort_down', is_small: true, alt: 'v', title: __('sort'), title_case: 'initials', path: $path, onclick: "admin_quotes_list_search('author');")?>
          </th>
          <th class="align_center">
            <?=__link('admin/quotes_media', __('admin_quotes_source'), path: $path)?>
            <?=__icon('sort_down', is_small: true, alt: 'v', title: __('sort'), title_case: 'initials', path: $path, onclick: "admin_quotes_list_search('source');")?>
          </th>
          <th class="align_center">
            <?=__('admin_quotes_year')?>
            <?=__icon('sort_down', is_small: true, alt: 'v', title: __('sort'), title_case: 'initials', path: $path, onclick: "admin_quotes_list_search('year');")?>
          </th>
          <th class="align_center">
            <?=__link('admin/quotes_tags', __('admin_quotes_tags'), path: $path)?>
            <?=__icon('sort_down', is_small: true, alt: 'v', title: __('sort'), title_case: 'initials', path: $path, onclick: "admin_quotes_list_search('tags');")?>
          </th>
          <th>
            <?=__('act')?>
          </th>
        </tr>

        <tr>

          <th>
            <input type="text" class="table_search" name="admin_quotes_search_title" id="admin_quotes_search_title" value="">
          </th>

          <th>
            <input type="text" class="table_search" name="admin_quotes_search_body" id="admin_quotes_search_body" value="">
          </th>

          <th>
            <select class="table_search" name="admin_quotes_search_author" id="admin_quotes_search_author">
              <option value="0">&nbsp;</option>
              <?php for($i = 0; $i < $quote_authors_list['rows']; $i++): ?>
              <option value="<?=$quote_authors_list[$i]['id']?>"><?=$quote_authors_list[$i]['name']?></option>
              <?php endfor; ?>
            </select>
          </th>

          <th>
            <select class="table_search" name="admin_quotes_search_media" id="admin_quotes_search_media">
              <option value="0">&nbsp;</option>
              <?php for($i = 0; $i < $quote_media_list['rows']; $i++): ?>
              <option value="<?=$quote_media_list[$i]['id']?>"><?=$quote_media_list[$i]['full_name']?></option>
              <?php endfor; ?>
            </select>
          </th>

          <th>
            <input type="hidden" name="admin_quotes_sort" id="admin_quotes_sort" value="<?=$admin_quotes_sort?>">
            <select class="table_search" name="admin_quotes_search_year" id="admin_quotes_search_year">
              <option value="0">&nbsp;</option>
              <option value="1"><?=__('admin_quotes_search_year')?></option>
              <option value="-1"><?=__('admin_quotes_search_noyear')?></option>
            </select>
          </th>

          <th>
            <select class="table_search" name="admin_quotes_search_tags" id="admin_quotes_search_tags">
              <option value="0">&nbsp;</option>
              <option value="-1"><?=__('admin_quotes_search_notags')?></option>
              <?php for($i = 0; $i < $quote_tags_list['rows']; $i++): ?>
              <option value="<?=$quote_tags_list[$i]['id']?>"><?=$quote_tags_list[$i]['name']?></option>
              <?php endfor; ?>
            </select>
          </th>

          <th>
            <input type="submit" class="table_search bold" name="admin_quotes_search_go" value="<?=__('search')?>" onclick="admin_quotes_list_search();">
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
            <?php if($quotes_list[$i]['stitle']): ?>
            <?=__link('admin/quote?quote_id='.$quotes_list[$i]['id'], $quotes_list[$i]['stitle'], path: $path)?>
            <?php else: ?>
            <?=__icon('link', is_small: true, class: 'valign_middle pointer', alt: 'L', title: __('admin_quote_title'), title_case: 'initials', href: 'admin/quote?quote_id='.$quotes_list[$i]['id'], path: $path)?>
            <?php endif; ?>
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

          <?php if($quotes_list[$i]['sauthors_full']): ?>
          <td class="align_left nowrap bold tooltip_container">
            <?=$quotes_list[$i]['sauthors_full']?>
            <span class="tooltip">
              <?=$quotes_list[$i]['authors_full']?>
            </span>
          </td>
          <?php else: ?>
          <td>
            &nbsp;
          </td>
          <?php endif; ?>

          <?php if($quotes_list[$i]['smedia']): ?>
          <td class="align_left nowrap bold tooltip_container">
            <?=$quotes_list[$i]['smedia']?>
            <span class="tooltip">
              <?=$quotes_list[$i]['media_en']?><br>
              <?=$quotes_list[$i]['media_fr']?>
            </span>
          </td>
          <?php else: ?>
          <td>
            &nbsp;
          </td>
          <?php endif; ?>

          <td class="align_left nowrap bold">
            <?=$quotes_list[$i]['year']?>
          </td>

          <?php if($quotes_list[$i]['tags']): ?>
          <td class="align_center nowrap bold tooltip_container">
            <?=$quotes_list[$i]['tags']?>
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
            <?=__icon('delete', is_small: true, class: 'valign_middle pointer', alt: 'X', title: __('delete'), title_case: 'initials', onclick: "admin_quotes_list_search(null, '".$quotes_list[$i]['id']."','".__('admin_quotes_delete_confirm')."')", path: $path)?>
          </td>

        </tr>

        <?php endfor; ?>

        <?php if(!page_is_fetched_dynamically()): ?>

      </tbody>
    </table>

  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;