<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';  # Core
include_once './../actions/admin.act.php'; # Admin actions
include_once './../lang/admin.lang.php';   # Admin translations

// Page summary
$page_url       = "admin/ideas_types_add";
$page_title_en  = "Admin - Ideas";
$page_title_fr  = "Admin - Idées";

// Admin menu selection
$admin_menu['ideas'] = 1;

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
    <?=__link('admin/ideas_types', __('admin_idea_types_add_title'), 'text_light', path: root_path())?>
  </h2>

  <form action="ideas_types" method="POST">
    <fieldset>

      <div class="smallpadding_bot">
        <label for="idea_type_sort"><?=__('admin_idea_types_add_order')?></label>
        <input class="indiv" type="text" name="idea_type_sort">
      </div>

      <div class="smallpadding_bot">
        <label for="idea_type_name_en"><?=__('admin_idea_types_add_name_en')?></label>
        <input class="indiv" type="text" name="idea_type_name_en">
      </div>

      <div class="padding_bot">
        <label for="idea_type_name_fr"><?=__('admin_idea_types_add_name_fr')?></label>
        <input class="indiv" type="text" name="idea_type_name_fr">
      </div>

      <input type="submit" name="idea_type_add" value="<?=__('admin_idea_types_add_submit')?>">

    </fieldset>
  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;