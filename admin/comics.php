<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic related actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/comics";
$page_title_en  = "Admin - Comics";
$page_title_fr  = "Admin - Comics";

// Admin menu selection
$admin_menu['comics'] = 1;

// Extra CSS & JS
$css  = array('admin');
$js   = array('admin/admin');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Add a comic

if(isset($_POST['comic_add']))
{
  // Fetch the comic data
  $comic_add_data = array( 'title_en' => form_fetch_element('comic_title_en') ,
                           'title_fr' => form_fetch_element('comic_title_fr') ,
                           'type'     => form_fetch_element('comic_type')     );

  // Add the comic to the database
  $comics_add = comics_add($comic_add_data);

  // Redirect to the newly created comic
  if(is_int($comics_add))
    exit(header("Location: ./comics_edit?id=".$comics_add));
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// List comics

$comics_list = comics_list();




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_40 padding_top">

  <h5>
    <?=__('admin_comics_management').__(':')?>
  </h5>

  <ul class="tinypadding_top bigpadding_bot">
    <li>
      <?=__link('admin/comics_types', __('admin_comics_management_types'), path: root_path())?>
    </li>
  </ul>

  <h2 class="align_center padding_bot">
    <?=__link('admin/comics', __('admin_comics_title'), style: 'text_light', path: root_path())?>
    <?=__icon('add', alt: '+', title: __('add'), title_case: 'initials', href: 'admin/comics_add', path: root_path())?>
  </h2>

  <table>
    <thead>

      <tr class="uppercase">
        <th>
          <?=__('admin_comics_list_title')?>
        </th>
        <th>
          <?=__('admin_comics_list_type')?>
        </th>
        <th>
          <?=__('admin_comics_list_date')?>
        </th>
        <th>
          <?=__('admin_comics_list_private')?>
        </th>
        <th>
          <?=__('act')?>
        </th>

      </tr>
    </thead>

    <tbody class="altc2 nowrap" id="admin_comics_tbody">

      <?php endif; ?>

      <tr>
        <td colspan="6" class="uppercase text_light dark bold align_center">
          <?=__('admin_comics_list_count', preset_values: array($comics_list['rows']), amount: $comics_list['rows'])?>
        </td>
      </tr>

      <?php for($i = 0; $i < $comics_list['rows']; $i++): ?>
      <tr>

        <td class="align_left nowrap tooltip_container">
          <?=$comics_list[$i]['title']?>
          <div class="tooltip">
            <?=$comics_list[$i]['title_en']?><br>
            <?=$comics_list[$i]['title_fr']?>
          </div>
        </td>

        <td class="align_center nowrap">
          <?=$comics_list[$i]['type']?>
        </td>

        <td class="align_center nowrap tooltip_container">
          <?=$comics_list[$i]['date']?>
          <div class="tooltip">
            <?=$comics_list[$i]['date_full']?>
          </div>
        </td>

        <td class="align_center nowrap">
          <?php if($comics_list[$i]['private']): ?>
          <?=__icon('x', is_small: true, alt: 'X', title: __('admin_comics_list_private'), title_case: 'initials', path: root_path())?>
          <?php else: ?>
          &nbsp;
          <?php endif; ?>
        </td>

        <td class="align_center nowrap">
          <?=__icon('edit', is_small: true, class: 'valign_middle pointer spaced_right', alt: 'M', title: __('edit'), title_case: 'initials', href: 'admin/comics_edit?id='.$comics_list[$i]['id'], path: root_path())?>
          <?=__icon('delete', is_small: true, class: 'valign_middle pointer', alt: 'X', title: __('delete'), title_case: 'initials', onclick: "admin_comic_list_delete('".$comics_list[$i]['id']."','".__('admin_comics_delete_confirm')."')", path: root_path())?>
        </td>

      </tr>
      <?php endfor; ?>

      <?php if(!page_is_fetched_dynamically()): ?>
    </tbody>
  </table>

</div>


<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;