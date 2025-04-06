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
// Add a comic type

if(isset($_POST['comic_type_add']))
{
  // Assemble an array with the postdata
  $comic_type_add_data = array( 'sort'      => form_fetch_element('comic_type_sort')                        ,
                                'name_en'   => form_fetch_element('comic_type_name_en')                     ,
                                'name_fr'   => form_fetch_element('comic_type_name_fr')                     ,
                                'banner_en' => form_fetch_element('comic_type_banner_en')                   ,
                                'banner_fr' => form_fetch_element('comic_type_banner_fr')                   ,
                                'desc_en'   => form_fetch_element('comic_type_desc_en')                     ,
                                'desc_fr'   => form_fetch_element('comic_type_desc_fr')                     ,
                                'major'     => form_fetch_element('comic_type_major', element_exists: true) );

  // Add the comic type to the database
  comic_types_add($comic_type_add_data);
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Edit a comic type

if(isset($_POST['comic_type_edit']))
{
  // Gather the comic type's id
  $comic_type_edit_id = form_fetch_element('comic_type_id');

  // Assemble an array with the postdata
  $comic_type_edit_data = array(  'order'     => form_fetch_element('comic_type_sort')                        ,
                                  'name_en'   => form_fetch_element('comic_type_name_en')                     ,
                                  'name_fr'   => form_fetch_element('comic_type_name_fr')                     ,
                                  'banner_en' => form_fetch_element('comic_type_banner_en')                   ,
                                  'banner_fr' => form_fetch_element('comic_type_banner_fr')                   ,
                                  'desc_en'   => form_fetch_element('comic_type_desc_en')                     ,
                                  'desc_fr'   => form_fetch_element('comic_type_desc_fr')                     ,
                                  'major'     => form_fetch_element('comic_type_major', element_exists: true) );

  // Edit the comic type
  comic_types_edit(  $comic_type_edit_id    ,
                     $comic_type_edit_data  );
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Delete a comic type

if(isset($_POST['admin_comic_types_delete']))
  comic_types_delete(form_fetch_element('admin_comic_types_delete'));




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
        <th class="align_center">
          <?=__('admin_comic_types_name')?>
        </th>
        <th class="align_center">
          <?=__('admin_comic_types_banner')?>
        </th>
        <th>
          <?=__('act')?>
        </th>
      </tr>

    </thead>

    <tbody class="altc2 nowrap" id="admin_comics_types_tbody">

      <?php endif; ?>

      <tr>
        <td colspan="4" class="uppercase text_light dark bold align_center">
          <?=__('admin_comic_types_count', preset_values: array($comic_types_list['rows']), amount: $comic_types_list['rows'])?>
        </td>
      </tr>

      <?php for($i = 0; $i < $comic_types_list['rows']; $i++): ?>

      <tr id="comit_types_list_row_<?=$comic_types_list[$i]['id']?>">

        <td class="align_center nowrap bold">
          <?=$comic_types_list[$i]['sort'].$comic_types_list[$i]['major_p']?>
        </td>

        <td class="align_center nowrap bold tooltip_container">
          <span class="uppercase"><?=$comic_types_list[$i]['name']?></span>
          <div class="tooltip">
            <?=$comic_types_list[$i]['name_en']?><br>
            <?=$comic_types_list[$i]['name_fr']?>
          </div>
        </td>

        <td class="align_center nowrap bold">
          <div class="tooltip_container">
          <?=__icon('image', is_small: true, alt: 'P', title: __('image'), title_case: 'initials', path: root_path())?>
          <div class="tooltip">
            <img src="<?=$path?>img/banners/comics/types/<?=$comic_types_list[$i]['banner_en']?>" alt="<?=$comic_types_list[$i]['name_en']?>" title="<?=$comic_types_list[$i]['name_en']?>"><br>
            <img src="<?=$path?>img/banners/comics/types/<?=$comic_types_list[$i]['banner_fr']?>" alt="<?=$comic_types_list[$i]['name_fr']?>" title="<?=$comic_types_list[$i]['name_fr']?>">
          </div>
        </td>

        <td class="align_center nowrap">
          <?=__icon('edit', is_small: true, class: 'valign_middle pointer spaced_right', alt: 'M', title: __('edit'), title_case: 'initials', href: 'admin/comics_types_edit?type_id='.$comic_types_list[$i]['id'], path: root_path())?>
          <?=__icon('delete', is_small: true, class: 'valign_middle pointer', alt: 'X', title: __('delete'), title_case: 'initials', onclick: "admin_comic_type_delete('".$comic_types_list[$i]['id']."','".__('admin_comic_types_delete_confirm')."')", path: root_path())?>
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