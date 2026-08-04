<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/quotes.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/quotes_media_edit";
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
// Fetch media data

// Fetch the media's ID
$admin_media_id = (int)form_fetch_element('quote_media_id', request_type: 'GET');

// Fetch the media data
$admin_media_data = quote_media_get($admin_media_id);

// Stop here if the media does not exist
if(!$admin_media_data)
  exit(header("Location: ".$path."admin/quotes_media"));




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="padding_bot">
    <?=__link('admin/quotes_media', __('admin_quotes_media_edit_title'), 'text_light', path: $path)?>
  </h2>

  <form action="quotes_media" method="POST">
    <fieldset>

      <input type="hidden" name="quote_media_id" value="<?=$admin_media_data['id']?>">

      <div class="flexcontainer">
        <div style="flex: 8">

          <div class="smallpadding_bot">
            <label for="quote_media_name_en"><?=__('admin_quotes_media_add_name_en')?></label>
            <input class="indiv" type="text" name="quote_media_name_en" id="quote_media_name_en" value="<?=$admin_media_data['name_en']?>">
          </div>

          <div class="smallpadding_bot">
            <label for="quote_media_desc_en"><?=__('admin_quotes_media_add_desc_en')?></label>
            <textarea class="indiv" name="quote_media_desc_en" id="quote_media_desc_en"><?=$admin_media_data['description_en']?></textarea>
          </div>

          <div class="smallpadding_bot">
            <label for="quote_media_source_en"><?=__('admin_quotes_media_add_source_en')?></label>
            <input class="indiv" type="text" name="quote_media_source_en" id="quote_media_source_en" value="<?=$admin_media_data['source_en']?>">
          </div>

        </div>
        <div style="flex: 1">
          &nbsp;
        </div>
        <div style="flex: 8">

          <div class="smallpadding_bot">
            <label for="quote_media_name_fr"><?=__('admin_quotes_media_add_name_fr')?></label>
            <input class="indiv" type="text" name="quote_media_name_fr" id="quote_media_name_fr" value="<?=$admin_media_data['name_fr']?>">
          </div>

          <div class="smallpadding_bot">
            <label for="quote_media_desc_fr"><?=__('admin_quotes_media_add_desc_fr')?></label>
            <textarea class="indiv" name="quote_media_desc_fr" id="quote_media_desc_fr"><?=$admin_media_data['description_fr']?></textarea>
          </div>

          <div class="smallpadding_bot">
            <label for="quote_media_source_fr"><?=__('admin_quotes_media_add_source_fr')?></label>
            <input class="indiv" type="text" name="quote_media_source_fr" id="quote_media_source_fr" value="<?=$admin_media_data['source_fr']?>">
          </div>

        </div>
      </div>

      <div class="tinypadding_top padding_bot">
        <label for="quote_media_year"><?=__('admin_quotes_media_add_year')?></label>
        <input class="indiv" type="text" name="quote_media_year" id="quote_media_year" value="<?=$admin_media_data['year']?>">
      </div>

      <input type="submit" name="quote_media_edit" value="<?=__('admin_quotes_media_edit_submit')?>">

    </fieldset>
  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;