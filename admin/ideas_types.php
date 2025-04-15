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



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Edit an idea type

if(isset($_POST['idea_type_edit']))
{
  // Fetch the idea type's ID
  $admin_idea_type_id = (int)form_fetch_element('idea_type_id');

  // Assemble an array with the postdata
  $idea_type_edit_data = array( 'order'   => form_fetch_element('idea_type_sort')     ,
                                'name_en' => form_fetch_element('idea_type_name_en')  ,
                                'name_fr' => form_fetch_element('idea_type_name_fr')  );

  // Edit the idea type
  admin_idea_types_edit( $admin_idea_type_id  ,
                         $idea_type_edit_data );
}



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch a list of all idea types

$idea_types_list = admin_idea_types_list();




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

  <table>
    <thead>

      <tr class="uppercase">
        <th class="align_center">
          <?=__('admin_idea_types_order')?>
        </th>
        <th class="align_center">
          <?=__('admin_idea_types_name')?>
        </th>
        <th>
          <?=__('act')?>
        </th>
      </tr>

    </thead>

    <tbody class="altc2 nowrap" id="admin_idea_types_tbody">

      <?php endif; ?>

      <tr>
        <td colspan="3" class="uppercase text_light dark bold align_center">
          <?=__('admin_idea_types_count', preset_values: array($idea_types_list['rows']), amount: $idea_types_list['rows'])?>
        </td>
      </tr>

      <?php for($i = 0; $i < $idea_types_list['rows']; $i++): ?>

      <tr id="idea_types_list_row_<?=$idea_types_list[$i]['id']?>">

        <td class="align_center nowrap bold">
          <?=$idea_types_list[$i]['sort']?>
        </td>

        <td class="align_center nowrap bold">
          <span class="uppercase"><?=$idea_types_list[$i]['name']?></span>
        </td>

        <td class="align_center nowrap admin_action_icons">
          <?=__icon('edit', is_small: true, class: 'valign_middle pointer spaced_right', alt: 'M', title: __('edit'), title_case: 'initials', href: 'admin/ideas_types_edit?type_id='.$idea_types_list[$i]['id'], path: root_path())?>
          <?=__icon('delete', is_small: true, class: 'valign_middle pointer', alt: 'X', title: __('delete'), title_case: 'initials', onclick: "admin_idea_type_delete('".$idea_types_list[$i]['id']."','".__('admin_idea_types_delete_confirm')."')", path: root_path())?>
        </td>

      </tr>

      <?php endfor; ?>

    </tbody>

    <?php if(!page_is_fetched_dynamically()): ?>

  </table>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;