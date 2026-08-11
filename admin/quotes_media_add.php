<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/quotes.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/quotes_media_add";
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
// Fetch quote authors

$admin_quote_authors = quote_authors_list();




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="padding_bot">
    <?=__link('admin/quotes_media', __('admin_quotes_media_add_title'), 'text_light', path: $path)?>
  </h2>

  <form action="quotes_media" method="POST">
    <fieldset>

      <div class="flexcontainer">
        <div style="flex: 8">

          <div class="smallpadding_bot">
            <label for="quote_media_name_en"><?=__('admin_quotes_media_add_name_en')?></label>
            <input class="indiv" type="text" name="quote_media_name_en" id="quote_media_name_en">
          </div>

          <div class="smallpadding_bot">
            <label for="quote_media_desc_en"><?=__('admin_quotes_media_add_desc_en')?></label>
            <textarea class="indiv" name="quote_media_desc_en" id="quote_media_desc_en"></textarea>
          </div>

          <div class="smallpadding_bot">
            <label for="quote_media_source_en"><?=__('admin_quotes_media_add_source_en')?></label>
            <input class="indiv" type="text" name="quote_media_source_en" id="quote_media_source_en">
          </div>

        </div>
        <div style="flex: 1">
          &nbsp;
        </div>
        <div style="flex: 8">

          <div class="smallpadding_bot">
            <label for="quote_media_name_fr"><?=__('admin_quotes_media_add_name_fr')?></label>
            <input class="indiv" type="text" name="quote_media_name_fr" id="quote_media_name_fr">
          </div>

          <div class="smallpadding_bot">
            <label for="quote_media_desc_fr"><?=__('admin_quotes_media_add_desc_fr')?></label>
            <textarea class="indiv" name="quote_media_desc_fr" id="quote_media_desc_fr"></textarea>
          </div>

          <div class="smallpadding_bot">
            <label for="quote_media_source_fr"><?=__('admin_quotes_media_add_source_fr')?></label>
            <input class="indiv" type="text" name="quote_media_source_fr" id="quote_media_source_fr">
          </div>

        </div>
      </div>

      <div class="smallpadding_bot">
        <label for="quote_media_year"><?=__('admin_quotes_media_add_year')?></label>
        <input class="indiv" type="text" name="quote_media_year" id="quote_media_year">
      </div>

      <div class="smallpadding_bot">
        <label for="quote_media_authors">
          <?=__link('admin/quotes_authors', __('admin_quotes_media_add_authors'), path: $path, popup: true)?>
        </label>

        <div id="quote_media_authors">
          <div class="smallpadding_bot quote_media_author">
            <select class="indiv align_left" name="quote_media_authors[]" onchange="admin_quotes_media_authors_update()">
              <option value="" selected="selected"></option>
              <?php for($i = 0; $i < $admin_quote_authors['rows']; $i++): ?>
              <option value="<?=$admin_quote_authors[$i]['id']?>"><?=$admin_quote_authors[$i]['name']?></option>
              <?php endfor; ?>

            </select>
          </div>

        </div>
      </div>

      <input type="submit" name="quote_media_add" value="<?=__('admin_quotes_media_add_submit')?>">

    </fieldset>
  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;