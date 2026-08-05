<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/quotes.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/quotes_tags_edit";
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
// Fetch author data

// Fetch the author's ID
$admin_tag_id = (int)form_fetch_element('quote_tag_id', request_type: 'GET');

// Fetch the author data
$admin_tag_data = quote_tags_get($admin_tag_id);

// Stop here if the tag does not exist
if(!$admin_tag_data)
  exit(header("Location: ".$path."admin/quotes_tags"));




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="padding_bot">
    <?=__link('admin/quotes_tags', __('admin_quotes_tags_edit_title'), 'text_light', path: $path)?>
  </h2>

  <form action="quotes_tags" method="POST">
    <fieldset>

      <input type="hidden" name="quote_tag_id" value="<?=$admin_tag_id?>">

      <div class="smallpadding_bot">
        <label for="quote_tag_sort"><?=__('admin_quotes_tags_add_sort')?></label>
        <input class="indiv" type="text" name="quote_tag_sort" id="quote_tag_sort" value="<?=$admin_tag_data['sort']?>">
      </div>

      <div class="smallpadding_bot">
        <label for="quote_tag_name_en"><?=__('admin_quotes_tags_add_name_en')?></label>
        <input class="indiv" type="text" name="quote_tag_name_en" id="quote_tag_name_en" value="<?=$admin_tag_data['name_en']?>">
      </div>

      <div class="padding_bot">
        <label for="quote_tag_name_fr"><?=__('admin_quotes_tags_add_name_fr')?></label>
        <input class="indiv" type="text" name="quote_tag_name_fr" id="quote_tag_name_fr" value="<?=$admin_tag_data['name_fr']?>">
      </div>

      <input type="submit" name="quote_tag_edit" value="<?=__('admin_quotes_tags_edit_submit')?>">

    </fieldset>
  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;