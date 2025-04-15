<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';  # Core
include_once './../actions/admin.act.php'; # Admin actions
include_once './../lang/admin.lang.php';   # Admin translations

// Page summary
$page_url       = "admin/ideas_types";
$page_title_en  = "Admin - Ideas";
$page_title_fr  = "Admin - Idées";

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
// Add an idea type

if(isset($_POST['idea_type_add']))
{
  // Assemble an array with the postdata
  $idea_type_add_data = array(  'sort'    => form_fetch_element('idea_type_sort')     ,
                                'name_en' => form_fetch_element('idea_type_name_en')  ,
                                'name_fr' => form_fetch_element('idea_type_name_fr')  );

  // Add the idea type to the database
  admin_idea_types_add($idea_type_add_data);
}




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_30 padding_top">

  <h2 class="align_center padding_bot">
    <?=__link('admin/ideas', __('admin_idea_types_title'), style: 'text_light', path: root_path())?>
    <?=__icon('add', alt: '+', title: __('add'), title_case: 'initials', href: 'admin/ideas_types_add', path: root_path())?>
  </h2>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;