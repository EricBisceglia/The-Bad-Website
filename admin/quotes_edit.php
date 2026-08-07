<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/quotes.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/quotes_edit";
$page_title_en  = "Admin - Edit Quote";
$page_title_fr  = "Admin - Modifier une citation";

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
// Fetch quote data

// Fetch the quote's ID
$admin_quote_id = (int)form_fetch_element('quote_id', request_type: 'GET');

// Fetch the author data
$quote_data = quotes_get($admin_quote_id);

// Stop here if the quote does not exist
if(!$quote_data)
  exit(header("Location: ".$path."admin/quotes"));





///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch form data

// Quote media
$quote_media = quote_media_list( sort_by_author: true );

// Quote authors
$quote_authors = quote_authors_list();

// Quote origins
$quote_origins = quote_list_origins();

// Quote tags
$quote_tags = quote_tags_list();




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Prepare page elements

// Hide the media or author field if the quote has one but not the other
$quote_media_hide  = ($quote_data['media_id'] && !$quote_data['author_id']) ? '' : ' hidden';
$quote_author_hide = ($quote_data['author_id'] && !$quote_data['media_id']) ? '' : ' hidden';

// Select the correct quote media
for($i = 0; $i < $quote_media['rows']; $i++)
  $quote_media[$i]['selected'] = ($quote_media[$i]['id'] == $quote_data['media_id']) ? ' selected' : '';

// Select the correct quote author
for($i = 0; $i < $quote_authors['rows']; $i++)
  $quote_authors[$i]['selected'] = ($quote_authors[$i]['id'] == $quote_data['author_id']) ? ' selected' : '';

// Select the correct quote origins
for($i = 0; $i < $quote_origins['count']; $i++)
{
  $quote_origins['selected_en'][$i] = ($i == $quote_data['origin_en']) ? ' selected' : '';
  $quote_origins['selected_fr'][$i] = ($i == $quote_data['origin_fr']) ? ' selected' : '';
}

// Check the correct quote tags
for($i = 0; $i < $quote_tags['rows']; $i++)
{
  $admin_quote_tag_checked[$quote_tags[$i]['id']] = '';
  for($j = 0; $j < $quote_data['tags']['rows']; $j++)
  {
    if($quote_data['tags']['id'][$j] === $quote_tags[$i]['id'])
      $admin_quote_tag_checked[$quote_tags[$i]['id']] = ' checked';
  }
}





/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="padding_bot">
    <?=__link('admin/quotes', __('admin_quotes_edit_title'), 'text_light', path: $path)?>
  </h2>

  <form action="quotes" method="POST">
    <fieldset>

      <input type="hidden" name="quote_id" value="<?=$admin_quote_id?>">

      <div class="smallpadding_bot<?=$quote_media_hide?>" id="quote_media_container">
        <label for="quote_media"><?=__link('admin/quotes_media', __('admin_quotes_add_media'), path: $path, popup: true)?></label>
        <select class="indiv align_left" name="quote_media" id="quote_media" onchange="admin_quotes_hide_media_or_author('media')">
          <option value="0">&nbsp;</option>
          <?php for($i = 0; $i < $quote_media['rows']; $i++): ?>
          <option value="<?=$quote_media[$i]['id']?>"<?=$quote_media[$i]['selected']?>><?=$quote_media[$i]['full_name']?></option>
          <?php endfor; ?>
        </select>
      </div>

      <div class="smallpadding_bot<?=$quote_author_hide?>" id="quote_author_container">
        <label for="quote_author"><?=__link('admin/quotes_authors', __('admin_quotes_add_author'), path: $path, popup: true).__('admin_quotes_add_nomedia')?></label>
        <select class="indiv align_left" name="quote_author" id="quote_author" onchange="admin_quotes_hide_media_or_author('author')">
          <option value="0">&nbsp;</option>
          <?php for($i = 0; $i < $quote_authors['rows']; $i++): ?>
          <option value="<?=$quote_authors[$i]['id']?>"<?=$quote_authors[$i]['selected']?>><?=$quote_authors[$i]['name']?></option>
          <?php endfor; ?>
        </select>
      </div>

      <div class="smallpadding_bot<?=$quote_author_hide?>" id="quote_year_container">
        <label for="quote_year"><?=__('admin_quotes_add_year').__('admin_quotes_add_nomedia')?></label>
        <input class="indiv" type="text" name="quote_year" id="quote_year" value="<?=$quote_data['year']?>">
      </div>

      <div class="smallpadding_bot">
        <label for="quote_sort"><?=__('admin_quotes_add_sort')?></label>
        <input class="indiv" type="text" name="quote_sort" id="quote_sort" value="<?=$quote_data['sort']?>">
      </div>

      <div class="flexcontainer tinypadding_bot">
        <div style="flex: 8">

          <div class="smallpadding_bot">
            <label for="quote_origin_en"><?=__('admin_quotes_add_origin_en')?></label>
            <select class="indiv align_left" name="quote_origin_en" id="quote_origin_en">
              <?php for($i = 0; $i < $quote_origins['count']; $i++): ?>
              <option value="<?=$i?>"<?=$quote_origins['selected_en'][$i]?>><?=$quote_origins['short'][$i]?></option>
              <?php endfor; ?>
            </select>
          </div>

          <div class="smallpadding_bot">
            <label for="quote_title_en"><?=__('admin_quotes_add_title_en')?></label>
            <input class="indiv" type="text" name="quote_title_en" id="quote_title_en" value="<?=$quote_data['title_en']?>">
          </div>

          <div class="smallpadding_bot">
            <label for="quote_body_en"><?=__('admin_quotes_add_body_en')?></label>
            <textarea class="indiv higher" name="quote_body_en" id="quote_body_en"><?=$quote_data['body_en_raw']?></textarea>
          </div>

          <div class="smallpadding_bot">
            <label for="quote_desc_en"><?=__('admin_quotes_add_desc_en')?></label>
            <textarea class="indiv shorter" name="quote_desc_en" id="quote_desc_en"><?=$quote_data['desc_en_raw']?></textarea>
          </div>

          <div class="smallpadding_bot">
            <label for="quote_source_en"><?=__('admin_quotes_add_source_en')?></label>
            <input class="indiv" type="text" name="quote_source_en" id="quote_source_en" value="<?=$quote_data['source_en']?>">
          </div>

        </div>
        <div style="flex: 1">
          &nbsp;
        </div>
        <div style="flex: 8">

          <div class="smallpadding_bot">
            <label for="quote_origin_fr"><?=__('admin_quotes_add_origin_fr')?></label>
            <select class="indiv align_left" name="quote_origin_fr" id="quote_origin_fr">
              <?php for($i = 0; $i < $quote_origins['count']; $i++): ?>
              <option value="<?=$i?>"<?=$quote_origins['selected_fr'][$i]?>><?=$quote_origins['short'][$i]?></option>
              <?php endfor; ?>
            </select>
          </div>

          <div class="smallpadding_bot">
            <label for="quote_title_fr"><?=__('admin_quotes_add_title_fr')?></label>
            <input class="indiv" type="text" name="quote_title_fr" id="quote_title_fr" value="<?=$quote_data['title_fr']?>">
          </div>

          <div class="smallpadding_bot">
            <label for="quote_body_fr"><?=__('admin_quotes_add_body_fr')?></label>
            <textarea class="indiv higher" name="quote_body_fr" id="quote_body_fr"><?=$quote_data['body_fr_raw']?></textarea>
          </div>

          <div class="smallpadding_bot">
            <label for="quote_desc_fr"><?=__('admin_quotes_add_desc_fr')?></label>
            <textarea class="indiv shorter" name="quote_desc_fr" id="quote_desc_fr"><?=$quote_data['desc_fr_raw']?></textarea>
          </div>

          <div class="smallpadding_bot">
            <label for="quote_source_fr"><?=__('admin_quotes_add_source_fr')?></label>
            <input class="indiv" type="text" name="quote_source_fr" id="quote_source_fr" value="<?=$quote_data['source_fr']?>">
          </div>

        </div>
      </div>

      <div class="smallpadding_bot">
        <label class="micropadding_bot"><?=__link('admin/quotes_tags', __('admin_quotes_add_tags'), path: $path, popup: true)?></label>
        <?php for($i = 0; $i < $quote_tags['rows']; $i++): ?>
        <input type="checkbox" name="quote_tag_<?=$quote_tags[$i]['id']?>"<?=$admin_quote_tag_checked[$quote_tags[$i]['id']]?>>
        <label class="label_inline" for="quote_tag_<?=$quote_tags[$i]['id']?>"><?=$quote_tags[$i]['name']?></label><br>
        <?php endfor; ?>
      </div>

      <input type="submit" name="quote_edit" value="<?=__('admin_quotes_edit_submit')?>">

    </fieldset>
  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;