<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';  # Core
include_once './../actions/admin.act.php'; # Admin actions
include_once './../lang/admin.lang.php';   # Admin translations

// Page summary
$page_url       = "admin/ideas_add";
$page_title_en  = "Admin";
$page_title_fr  = "Admin";

// Admin menu selection
$admin_menu['ideas'] = 1;

// Extra CSS & JS
$css  = array('admin');
$js   = array('admin/admin');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Idea types list

$admin_idea_types = admin_idea_types_list();




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="padding_bot">
    <?=__link('admin/ideas', __('admin_ideas_add_title'), path: $path, style: 'text_light')?>
  </h2>

  <form method="POST" action="ideas" class="bigpadding_bot">

    <div class="tinypadding_bot">
      <label for="admin_ideas_title"><?=__('admin_ideas_new_title')?></label>
      <input type="text" name="admin_ideas_title" class="indiv">
    </div>

    <div class="tinypadding_bot">
      <a href="./ideas_types">
        <label for="admin_ideas_type" class="pointer"><?=__('admin_ideas_type')?></label>
      </a>
      <select name="admin_ideas_type" class="indiv align_left">
        <?php for($i = 0; $i < $admin_idea_types['rows']; $i++): ?>
        <option value="<?=$admin_idea_types[$i]['id']?>"><?=$admin_idea_types[$i]['name']?></option>
        <?php endfor; ?>
      </select>
    </div>

    <div class="tinypadding_bot">
      <label for="admin_ideas_body"><?=__('admin_ideas_new_body')?></label>
      <textarea class="padding_bot" name="admin_ideas_body"></textarea>
    </div>

    <div class="tinypadding_top">
      <input type="submit" name="admin_ideas_add" value="<?=__('admin_ideas_add')?>">
    </div>

  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;