<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/quotes.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/quotes_authors_edit";
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
// Fetch author data

// Fetch the author's ID
$admin_author_id = (int)form_fetch_element('quote_author_id', request_type: 'GET');

// Fetch the author data
$admin_author_data = quotes_authors_get($admin_author_id);

// Stop here if the author does not exist
if(!$admin_author_data)
  exit(header("Location: ".$path."admin/quotes_authors"));




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="padding_bot">
    <?=__link('admin/quotes_authors', __('admin_quotes_authors_edit_title'), 'text_light', path: $path)?>
  </h2>

  <form action="quotes_authors" method="POST">
    <fieldset>

      <input type="hidden" name="quote_author_id" value="<?=$admin_author_id?>">

      <div class="flexcontainer smallpadding_bot">
        <div style="flex: 8">

          <div class="smallpadding_bot">
            <label for="quote_author_name_en"><?=__('admin_quotes_authors_add_name_en')?></label>
            <input class="indiv" type="text" name="quote_author_name_en" id="quote_author_name_en" value="<?=$admin_author_data['name_en']?>">
          </div>

          <div class="smallpadding_bot">
            <label for="quote_author_desc_en"><?=__('admin_quotes_authors_add_desc_en')?></label>
            <textarea class="indiv" name="quote_author_desc_en" id="quote_author_desc_en"><?=$admin_author_data['desc_en_raw']?></textarea>
          </div>

          <div class="smallpadding_bot">
            <label for="quote_author_birth"><?=__('admin_quotes_authors_add_birth')?></label>
            <input class="indiv" type="text" name="quote_author_birth" id="quote_author_birth" value="<?=$admin_author_data['birth']?>">
          </div>

        </div>
        <div style="flex: 1">
          &nbsp;
        </div>
        <div style="flex: 8">

          <div class="smallpadding_bot">
            <label for="quote_author_name_fr"><?=__('admin_quotes_authors_add_name_fr')?></label>
            <input class="indiv" type="text" name="quote_author_name_fr" id="quote_author_name_fr" value="<?=$admin_author_data['name_fr']?>">
          </div>

          <div class="smallpadding_bot">
            <label for="quote_author_desc_fr"><?=__('admin_quotes_authors_add_desc_fr')?></label>
            <textarea class="indiv" name="quote_author_desc_fr" id="quote_author_desc_fr"><?=$admin_author_data['desc_fr_raw']?></textarea>
          </div>

          <div class="smallpadding_bot">
            <label for="quote_author_death"><?=__('admin_quotes_authors_add_death')?></label>
            <input class="indiv" type="text" name="quote_author_death" id="quote_author_death" value="<?=$admin_author_data['death']?>">
          </div>

        </div>
      </div>

      <input type="submit" name="quote_author_edit" value="<?=__('admin_quotes_authors_edit_submit')?>">

    </fieldset>
  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;