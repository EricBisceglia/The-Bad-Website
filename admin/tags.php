<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php'; # Core
include_once './../actions/tags.act.php'; # Tag actions
include_once './../lang/admin.lang.php';  # Admin translations

// Page summary
$page_url       = "admin/tags";
$page_title_en  = "Admin - Tags";
$page_title_fr  = "Admin - Tags";

// Admin menu selection
$admin_menu['tags'] = 1;

// Extra CSS & JS
$css  = array('admin');
$js   = array('admin/admin');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Add a tag

if(isset($_POST['tag_add']))
{
  // Assemble an array with the postdata
  $tag_add_data = array(  'sort'      => form_fetch_element('tag_sort')       ,
                          'name'      => form_fetch_element('tag_name')       ,
                          'title_en'  => form_fetch_element('tag_title_en')   ,
                          'title_fr'  => form_fetch_element('tag_title_fr')   ,
                          'banner_en' => form_fetch_element('tag_banner_en')  ,
                          'banner_fr' => form_fetch_element('tag_banner_fr')  ,
                          'desc_en'   => form_fetch_element('tag_desc_en')    ,
                          'desc_fr'   => form_fetch_element('tag_desc_fr')    );

  // Add the comic type to the database
  tags_add($tag_add_data);
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Edit a tag

if(isset($_POST['tag_edit']))
{
  // Fetch the tag's ID
  $admin_tag_id = (int)form_fetch_element('tag_id');

  // Assemble an array with the postdata
  $tag_edit_data = array(  'sort'      => form_fetch_element('tag_sort')       ,
                           'name'      => form_fetch_element('tag_name')       ,
                           'title_en'  => form_fetch_element('tag_title_en')   ,
                           'title_fr'  => form_fetch_element('tag_title_fr')   ,
                           'banner_en' => form_fetch_element('tag_banner_en')  ,
                           'banner_fr' => form_fetch_element('tag_banner_fr')  ,
                           'desc_en'   => form_fetch_element('tag_desc_en')    ,
                           'desc_fr'   => form_fetch_element('tag_desc_fr')    );

  // Edit the tag
  tags_edit($admin_tag_id, $tag_edit_data);
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Delete a tag

if(isset($_POST['admin_tags_delete']))
{
  // Fetch the tag's ID
  $admin_tag_id = (int)form_fetch_element('admin_tags_delete');

  // Delete the tag
  tags_delete($admin_tag_id);
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch a list of tags

$tags_list = tags_list();



/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_40 padding_top">

  <h2 class="align_center padding_bot">
    <?=__('admin_tags_title')?>
    <?=__icon('add', alt: '+', title: __('add'), title_case: 'initials', href: 'admin/tags_add', path: root_path())?>
  </h2>

  <table>
    <thead>

      <tr class="uppercase">
        <th class="align_center">
          <?=__('admin_tags_order')?>
        </th>
        <th class="align_center">
          <?=__('admin_tags_name')?>
        </th>
        <th class="align_center nowrap">
          <?=__('admin_tags_tagtitle')?>
        </th>
        <th class="align_center">
          <?=__('admin_tags_banner')?>
        </th>
        <th>
          <?=__('act')?>
        </th>
      </tr>

    </thead>

    <tbody class="altc2 nowrap" id="admin_tags_tbody">

      <?php endif; ?>

      <tr>
        <td colspan="5" class="uppercase text_light dark bold align_center">
          <?=__('admin_tags_count', preset_values: array($tags_list['rows']), amount: $tags_list['rows'])?>
        </td>
      </tr>

      <?php for($i = 0; $i < $tags_list['rows']; $i++): ?>

      <tr id="tag_types_list_row_<?=$tags_list[$i]['id']?>">

        <td class="align_center nowrap bold">
          <?=$tags_list[$i]['sort']?>
        </td>

        <td class="align_center nowrap bold">
          <?=$tags_list[$i]['name']?>
        </td>

        <td class="align_center nowrap bold tooltip_container">
          <span class="uppercase"><?=$tags_list[$i]['title']?></span>
          <div class="tooltip">
            <?=$tags_list[$i]['title_en']?><br>
            <?=$tags_list[$i]['title_fr']?>
          </div>
        </td>

        <td class="align_center nowrap bold">
          <div class="tooltip_container">
          <?=__icon('image', is_small: true, alt: 'P', title: __('image'), title_case: 'initials', path: root_path())?>
          <div class="tooltip">
            <img src="<?=$path?>img/banners/comics/tags/<?=$tags_list[$i]['banner_en']?>" alt="<?=$tags_list[$i]['title_en']?>" title="<?=$tags_list[$i]['title_en']?>"><br>
            <img src="<?=$path?>img/banners/comics/tags/<?=$tags_list[$i]['banner_fr']?>" alt="<?=$tags_list[$i]['title_fr']?>" title="<?=$tags_list[$i]['title_fr']?>">
          </div>
        </td>

        <td class="align_center nowrap admin_action_icons">
          <?=__icon('edit', is_small: true, class: 'valign_middle pointer spaced_right', alt: 'M', title: __('edit'), title_case: 'initials', href: 'admin/tags_edit?tag_id='.$tags_list[$i]['id'], path: root_path())?>
          <?=__icon('delete', is_small: true, class: 'valign_middle pointer', alt: 'X', title: __('delete'), title_case: 'initials', onclick: "admin_tags_delete('".$tags_list[$i]['id']."','".__('admin_tags_delete_confirm')."')", path: root_path())?>
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