<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/quotes.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/quotes_tags_add";
$page_title_en  = "Admin - Quote tags";
$page_title_fr  = "Admin - Tags de citations";

// Admin menu selection
$admin_menu['quotes'] = 1;

// Extra CSS & JS
$css  = array('admin');
$js   = array('admin/admin');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="padding_bot">
    <?=__link('admin/quotes_tags', __('admin_quotes_tags_add_title'), 'text_light', path: $path)?>
  </h2>

  <form action="quotes_tags" method="POST">
    <fieldset>

      <div class="smallpadding_bot">
        <label for="quote_tags_sort"><?=__('admin_quotes_tags_add_sort')?></label>
        <input class="indiv" type="text" name="quote_tags_sort" id="quote_tags_sort">
      </div>

      <div class="smallpadding_bot">
        <label for="quote_tags_name_en"><?=__('admin_quotes_tags_add_name_en')?></label>
        <input class="indiv" type="text" name="quote_tags_name_en" id="quote_tags_name_en">
      </div>

      <div class="padding_bot">
        <label for="quote_tags_name_fr"><?=__('admin_quotes_tags_add_name_fr')?></label>
        <input class="indiv" type="text" name="quote_tags_name_fr" id="quote_tags_name_fr">
      </div>

      <input type="submit" name="quote_tags_add" value="<?=__('admin_quotes_tags_add_submit')?>">

    </fieldset>
  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;