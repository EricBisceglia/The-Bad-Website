<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/quotes.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/quotes_add";
$page_title_en  = "Admin - Add Quote";
$page_title_fr  = "Admin - Ajouter une citation";

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
// Fetch form data

// Quote media
$quote_media = quote_media_list();

// Quote authors
$quote_authors = quote_authors_list();

// Quote origins
$quote_origins = quote_list_origins();

// Quote tags
$quote_tags = quote_tags_list();




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="padding_bot">
    <?=__link('admin/quotes', __('admin_quotes_add_title'), 'text_light', path: $path)?>
  </h2>

  <form action="quotes" method="POST">
    <fieldset>

      <div class="flexcontainer tinypadding_bot">
        <div style="flex: 8">

          <div class="smallpadding_bot" id="quote_media_container">
            <label for="quote_media"><?=__link('admin/quotes_media', __('admin_quotes_add_media'), path: $path, popup: true)?></label>
            <select class="indiv align_left" name="quote_media" id="quote_media" onchange="admin_quotes_hide_media_or_author('media')">
              <option value="0">&nbsp;</option>
              <?php for($i = 0; $i < $quote_media['rows']; $i++): ?>
              <option value="<?=$quote_media[$i]['id']?>"><?=$quote_media[$i]['name'].' - '.$quote_media[$i]['authors_text']?></option>
              <?php endfor; ?>
            </select>
          </div>

          </div>
          <div style="flex: 1">
            &nbsp;
          </div>
          <div style="flex: 8">

          <div class="smallpadding_bot" id="quote_author_container">
            <label for="quote_author"><?=__link('admin/quotes_authors', __('admin_quotes_add_author'), path: $path, popup: true).__('admin_quotes_add_author_2')?></label>
            <select class="indiv align_left" name="quote_author" id="quote_author" onchange="admin_quotes_hide_media_or_author('author')">
              <option value="0">&nbsp;</option>
              <?php for($i = 0; $i < $quote_authors['rows']; $i++): ?>
              <option value="<?=$quote_authors[$i]['id']?>"><?=$quote_authors[$i]['name']?></option>
              <?php endfor; ?>
            </select>
          </div>

        </div>
      </div>

      <div class="smallpadding_bot">
        <label for="quote_sort"><?=__('admin_quotes_add_sort')?></label>
        <input class="indiv" type="text" name="quote_sort" id="quote_sort">
      </div>

      <div class="flexcontainer tinypadding_bot">
        <div style="flex: 8">

          <div class="smallpadding_bot">
            <label for="quote_origin_en"><?=__('admin_quotes_add_origin_en')?></label>
            <select class="indiv align_left" name="quote_origin_en" id="quote_origin_en">
              <?php for($i = 0; $i < $quote_origins['count']; $i++): ?>
              <option value="<?=$i?>"><?=$quote_origins['short'][$i]?></option>
              <?php endfor; ?>
            </select>
          </div>

          <div class="smallpadding_bot">
            <label for="quote_source_en"><?=__('admin_quotes_add_source_en')?></label>
            <input class="indiv" type="text" name="quote_source_en" id="quote_source_en">
          </div>

          <div class="smallpadding_bot">
            <label for="quote_title_en"><?=__('admin_quotes_add_title_en')?></label>
            <input class="indiv" type="text" name="quote_title_en" id="quote_title_en">
          </div>

          <div class="smallpadding_bot">
            <label for="quote_desc_en"><?=__('admin_quotes_add_desc_en')?></label>
            <textarea class="indiv shorter" name="quote_desc_en" id="quote_desc_en"></textarea>
          </div>

          <div class="smallpadding_bot">
            <label for="quote_body_en"><?=__('admin_quotes_add_body_en')?></label>
            <textarea class="indiv higher" name="quote_body_en" id="quote_body_en"></textarea>
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
              <option value="<?=$i?>"><?=$quote_origins['short'][$i]?></option>
              <?php endfor; ?>
            </select>
          </div>

          <div class="smallpadding_bot">
            <label for="quote_source_fr"><?=__('admin_quotes_add_source_fr')?></label>
            <input class="indiv" type="text" name="quote_source_fr" id="quote_source_fr">
          </div>

          <div class="smallpadding_bot">
            <label for="quote_title_fr"><?=__('admin_quotes_add_title_fr')?></label>
            <input class="indiv" type="text" name="quote_title_fr" id="quote_title_fr">
          </div>

          <div class="smallpadding_bot">
            <label for="quote_desc_fr"><?=__('admin_quotes_add_desc_fr')?></label>
            <textarea class="indiv shorter" name="quote_desc_fr" id="quote_desc_fr"></textarea>
          </div>

          <div class="smallpadding_bot">
            <label for="quote_body_fr"><?=__('admin_quotes_add_body_fr')?></label>
            <textarea class="indiv higher" name="quote_body_fr" id="quote_body_fr"></textarea>
          </div>

        </div>
      </div>

      <div class="smallpadding_bot">
        <label class="micropadding_bot"><?=__link('admin/quotes_tags', __('admin_quotes_add_tags'), path: $path, popup: true)?></label>
        <?php for($i = 0; $i < $quote_tags['rows']; $i++): ?>
        <input type="checkbox" name="quote_tag_<?=$quote_tags[$i]['id']?>">
        <label class="label_inline" for="quote_tag_<?=$quote_tags[$i]['id']?>"><?=$quote_tags[$i]['name']?></label><br>
        <?php endfor; ?>
      </div>

      <input type="submit" name="quote_add" value="<?=__('admin_quotes_add_submit')?>">

    </fieldset>
  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;