<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';  # Core
include_once './../actions/admin.act.php'; # Admin actions
include_once './../lang/admin.lang.php';   # Admin translations

// Page summary
$page_url       = "admin/searches";
$page_title_en  = "Admin - Searches";
$page_title_fr  = "Admin - Recherches";

// Admin menu selection
$admin_menu['searches'] = 1;

// Extra CSS & JS
$css  = array('admin');
$js   = array('admin/admin');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Clear search history

if(isset($_POST['admin_user_searches_clear']))
  admin_user_searches_clear();




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch searches

$admin_user_searches = admin_user_searches_list();




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top" id="ideas_list">

  <h2 class="padding_bot">
    <?=__('admin_user_searches_list')?>
    <?=__icon('delete', alt: 'X', title: __('admin_user_searches_clear'), title_case: 'initials', path: root_path(), class: 'valign_middle pointer spaced_left', onclick: "admin_user_searches_clear('".__('admin_user_searches_clear')."')")?>
  </h2>

  <div id="admin_user_searches_list">

    <?php endif; ?>

    <?php for($i = 0; $i < count($admin_user_searches); $i++): ?>
    <?=$admin_user_searches[$i]?><br>
    <?php endfor; ?>

    <?php if(count($admin_user_searches) === 0): ?>
    <p class="text_red uppercase bold bigger">
      <?=__('admin_user_searches_list_empty')?>
    </p>
    <?php endif; ?>

    <?php if(!page_is_fetched_dynamically()): ?>

  </div>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;