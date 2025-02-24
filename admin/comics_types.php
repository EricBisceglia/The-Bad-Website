<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/comics";
$page_title_en  = "Admin - Comic types";
$page_title_fr  = "Admin - Types de comics";

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
// Fetch a list of all comic types

$comic_types_list = comic_types_list();



/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_30 padding_top">

  <h2 class="align_center padding_bot">
    <?=__link('admin/comics', __('admin_comic_types_title'), style: 'text_light', path: root_path())?>
    <?=__icon('add', alt: '+', title: __('add'), title_case: 'initials', href: 'admin/comics_types_add', path: root_path())?>
  </h2>

  <table>
    <thead>

      <tr class="uppercase">
        <th class="align_center">
          <?=__('admin_comic_types_order')?>
        </th>
        <th>
          <?=__('act')?>
        </th>
      </tr>

    </thead>

    <tbody class="altc2 nowrap" id="admin_arsenal_difficulties_tbody">

      <?php endif; ?>

      <tr>
        <td colspan="2" class="uppercase text_light dark bold align_center">
          <?=__('admin_comic_types_count', preset_values: array($comic_types_list['rows']), amount: $comic_types_list['rows'])?>
        </td>
      </tr>

      <?php for($i = 0; $i < $comic_types_list['rows']; $i++): ?>

      <tr id="comit_types_list_row_<?=$comic_types_list[$i]['id']?>">

        <td class="align_center nowrap bold">
          <?=$comic_types_list[$i]['sort']?>
        </td>

        <td class="align_center nowrap bold tooltip_container">
          <span class="uppercase"><?=$comic_types_list[$i]['name']?></span>
          <div class="tooltip">
            <?=$comic_types_list[$i]['name_en']?><br>
            <?=$comic_types_list[$i]['name_fr']?>
          </div>
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