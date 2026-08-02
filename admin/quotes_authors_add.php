<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/quotes.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/quotes_authors_add";
$page_title_en  = "Admin - Quote authors";
$page_title_fr  = "Admin - Auteurs de citations";

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
    <?=__link('admin/quotes_authors', __('admin_quotes_authors_add_title'), 'text_light', path: $path)?>
  </h2>

  <form action="quotes_authors" method="POST">
    <fieldset>

      <div class="flexcontainer smallpadding_bot">
        <div style="flex: 8">

          <div class="smallpadding_bot">
            <label for="quote_author_name_en"><?=__('admin_quotes_authors_add_name_en')?></label>
            <input class="indiv" type="text" name="quote_author_name_en" id="quote_author_name_en">
          </div>

          <div class="smallpadding_bot">
            <label for="quote_author_desc_en"><?=__('admin_quotes_authors_add_desc_en')?></label>
            <textarea class="indiv" name="quote_author_desc_en" id="quote_author_desc_en"></textarea>
          </div>

          <div class="smallpadding_bot">
            <label for="quote_author_birth"><?=__('admin_quotes_authors_add_birth')?></label>
            <input class="indiv" type="text" name="quote_author_birth" id="quote_author_birth">
          </div>

        </div>
        <div style="flex: 1">
          &nbsp;
        </div>
        <div style="flex: 8">

          <div class="smallpadding_bot">
            <label for="quote_author_name_fr"><?=__('admin_quotes_authors_add_name_fr')?></label>
            <input class="indiv" type="text" name="quote_author_name_fr" id="quote_author_name_fr">
          </div>

          <div class="smallpadding_bot">
            <label for="quote_author_desc_fr"><?=__('admin_quotes_authors_add_desc_fr')?></label>
            <textarea class="indiv" name="quote_author_desc_fr" id="quote_author_desc_fr"></textarea>
          </div>

          <div class="smallpadding_bot">
            <label for="quote_author_death"><?=__('admin_quotes_authors_add_death')?></label>
            <input class="indiv" type="text" name="quote_author_death" id="quote_author_death">
          </div>

        </div>
      </div>

      <input type="submit" name="quote_author_add" value="<?=__('admin_quotes_authors_add_submit')?>">

    </fieldset>
  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;