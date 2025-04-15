<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';  # Core
include_once './../actions/admin.act.php'; # Admin actions
include_once './../lang/admin.lang.php';   # Admin translations

// Page summary
$page_url       = "admin/index";
$page_title_en  = "Admin";
$page_title_fr  = "Admin";

// Admin menu selection
$admin_menu['index'] = 1;

// Extra CSS & JS
$css  = array('admin');
$js   = array('admin/admin');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Update admin notes

if(isset($_POST['admin_notes_update']))
  admin_notes_update( form_fetch_element('admin_notes_tasks') );




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch admin notes

$admin_notes = admin_notes_get();




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top padding_bot">

  <form method="POST">

    <h5>
      <?=__('admin_notes_tasks')?>
    </h5>

    <div class="tinypadding_bot">
      <textarea class="padding_bot admin_tasks_textarea" name="admin_notes_tasks"><?=$admin_notes['tasks']?></textarea>
    </div>

    <div class="tinypadding_top">
      <input type="submit" name="admin_notes_update" value="<?=__('admin_notes_update')?>">
    </div>

  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;