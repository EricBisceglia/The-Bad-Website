<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/images.act.php'; # Image management
include_once './../actions/comics.act.php'; # Comic management
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/images";
$page_title_en  = "Admin - Images";
$page_title_fr  = "Admin - Images";

// Admin menu selection
$admin_menu['images'] = 1;

// Extra CSS & JS
$css  = array('admin');
$js   = array('admin/admin');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Edit an image

if(isset($_POST['image_edit']))
{
  // Fetch the image's ID
  $admin_image_id = (int)form_fetch_element('image_id');

  // Assemble an array with the postdata
  $admin_image_data = array(  'name'      => form_fetch_element('image_name')                           ,
                              'comic'     => form_fetch_element('image_comic')                          ,
                              'lang'      => form_fetch_element('image_lang')                           ,
                              'order'     => form_fetch_element('image_order')                          ,
                              'date'      => form_fetch_element('image_date')                           ,
                              'trans'     => form_fetch_element('image_trans')                          ,
                              'template'  => form_fetch_element('image_template', element_exists: true) ,
                              'emoji'     => form_fetch_element('image_emoji', element_exists: true)    ,
                              'preview'   => form_fetch_element('image_preview', element_exists: true)  ,
                              'full'      => form_fetch_element('image_full', element_exists: true)     ,
                              'old'       => form_fetch_element('image_old', element_exists: true)      ,
                              'nsfw'      => form_fetch_element('image_nsfw', element_exists: true)     );

  // Edit the image
  images_edit(  $admin_image_id   ,
                $admin_image_data );
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Delete an image

if(isset($_POST['admin_images_delete']))
  images_delete(form_fetch_element('admin_images_delete'));




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// List images

// Fetch comics
$comics_list = comics_list( sort_by: 'title' );

// Fetch the sorting order
$admin_images_sort = form_fetch_element('admin_images_sort', 'date');

// Assemble the search query
$admin_images_search = array( 'name'  => form_fetch_element('admin_images_search_name')   ,
                              'type'  => form_fetch_element('admin_images_search_type')   ,
                              'lang'  => form_fetch_element('admin_images_search_lang')   ,
                              'comic' => form_fetch_element('admin_images_search_comic')  ,
                              'nsfw'  => form_fetch_element('admin_images_search_nsfw')   );

// Fetch the images
$images_list = images_list( sort_by:  $admin_images_sort    ,
                            search:   $admin_images_search  );




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_60 padding_top">

  <h2 class="align_center padding_bot">
    <?=__link('admin/images', __('admin_images_title'), style: 'text_light', path: root_path())?>
    <?=__icon('image', alt: 'T', title: __('admin_images_list_templates'), title_case: 'initials', href: 'admin/images_info', path: root_path())?>
    <?=__icon('add', alt: '+', title: __('add'), title_case: 'initials', href: 'admin/images_add', path: root_path())?>
  </h2>

  <table>
    <thead>

      <tr class="uppercase">
        <th>
          <?=__('admin_images_list_name')?>
          <?=__icon('sort_down', is_small: true, alt: 'v', title: __('sort'), title_case: 'initials', path: root_path(), onclick: "admin_image_list_search('name');")?>
        </th>
        <th>
          <?=__('admin_images_list_type')?>
          <?=__icon('sort_down', is_small: true, alt: 'v', title: __('sort'), title_case: 'initials', path: root_path(), onclick: "admin_image_list_search('type');")?>
        </th>
        <th>
          <?=__('admin_images_list_language')?>
          <?=__icon('sort_down', is_small: true, alt: 'v', title: __('sort'), title_case: 'initials', path: root_path(), onclick: "admin_image_list_search('lang');")?>
        </th>
        <th>
          <?=__('admin_images_list_nsfw')?>
          <?=__icon('sort_down', is_small: true, alt: 'v', title: __('sort'), title_case: 'initials', path: root_path(), onclick: "admin_image_list_search('nsfw');")?>
        </th>
        <th>
          <?=__('admin_images_list_comic')?>
          <?=__icon('sort_down', is_small: true, alt: 'v', title: __('sort'), title_case: 'initials', path: root_path(), onclick: "admin_image_list_search('comic');")?>
        </th>
        <th>
          <?=__('admin_images_list_date')?>
          <?=__icon('sort_down', is_small: true, alt: 'v', title: __('sort'), title_case: 'initials', path: root_path(), onclick: "admin_image_list_search('date');")?>
        </th>
        <th>
          <?=__('act')?>
        </th>
      </tr>

      <tr>

        <th>
          <input type="hidden" name="admin_images_sort" id="admin_images_sort" value="<?=$admin_images_sort?>">
          <input type="text" class="table_search" name="admin_images_search_name" id="admin_images_search_name" value="" onkeyup="admin_image_list_search();">
        </th>

        <th>
          <select class="table_search" name="admin_images_search_type" id="admin_images_search_type" onchange="admin_image_list_search();">
            <option value="0">&nbsp;</option>
            <option value="1"><?=__('admin_images_list_type_comic')?></option>
            <option value="2"><?=__('admin_images_list_type_prev')?></option>
            <option value="3"><?=__('admin_images_list_type_templ')?></option>
            <option value="4"><?=__('admin_images_list_type_emoji')?></option>
            <option value="5"><?=__('admin_images_list_type_old')?></option>
            <option value="6"><?=__('admin_images_list_type_full')?></option>
          </select>
        </th>

        <th>
          <select class="table_search" name="admin_images_search_lang" id="admin_images_search_lang" onchange="admin_image_list_search();">
            <option value="0">&nbsp;</option>
            <option value="EN"><?=string_change_case(__('english'), 'initials')?></option>
            <option value="FR"><?=string_change_case(__('french'), 'initials')?></option>
            <option value="-1"><?=string_change_case(__('none'), 'initials')?></option>
          </select>
        </th>

        <th>
          <select class="table_search" name="admin_images_search_nsfw" id="admin_images_search_nsfw" onchange="admin_image_list_search();">
            <option value="0">&nbsp;</option>
            <option value="1"><?=__('admin_images_list_nsfw')?></option>
          </select>
        </th>

        <th>
          <select class="table_search" name="admin_images_search_comic" id="admin_images_search_comic" onchange="admin_image_list_search();">
            <option value="0">&nbsp;</option>
            <option value="-1"><?=__('admin_images_list_comic_n')?></option>
            <option value="-2"><?=__('admin_images_list_comic_y')?></option>
            <?php for($i = 0; $i < $comics_list['rows']; $i++): ?>
            <option value="<?=$comics_list[$i]['id']?>"><?=$comics_list[$i]['title']?></option>
            <?php endfor; ?>
          </select>
        </th>

        <th colspan="2">
          &nbsp;
        </th>

      </tr>
    </thead>

    <tbody class="altc2 nowrap" id="admin_images_tbody">

      <?php endif; ?>

      <tr>
        <td colspan="7" class="uppercase text_light dark bold align_center">
          <?=__('admin_images_list_count', preset_values: array($images_list['rows']), amount: $images_list['rows'])?>
        </td>
      </tr>

      <?php for($i = 0; $i < $images_list['rows']; $i++): ?>
      <tr>

        <td class="tooltip_container">
          <a href="<?=$path?>img/comics/<?=$images_list[$i]['name_full']?>" target="_blank">
            <?=$images_list[$i]['name']?>
          </a>
          <div class="tooltip">
            <p class="align_center bold tinypadding_bot">
              <?=$images_list[$i]['name_full']?>
            </p>
            <a href="<?=$path?>img/comics/<?=$images_list[$i]['name_full']?>" target="_blank">
              <img src="<?=$path?>img/comics/<?=$images_list[$i]['name_full']?>" alt="<?=$images_list[$i]['name_full']?>" title="<?=$images_list[$i]['name_full']?>" loading="lazy">
            </a>
          </div>
        </td>

        <td class="align_center nowrap bold">
          <?php if($images_list[$i]['old']): ?>
          <?=__icon('clock', is_small: true, alt: 'O', title: __('admin_images_list_type_old'), path: root_path())?>
          <?php endif; if($images_list[$i]['full']): ?>
          <?=__icon('done', is_small: true, alt: 'F', title: __('admin_images_list_type_full'), path: root_path())?>
          <?php endif; ?>
          <?php if($images_list[$i]['preview']): ?>
          <?=__icon('duplicate', is_small: true, alt: 'C', title: __('admin_images_list_type_prev'), path: root_path())?>
          <?php elseif($images_list[$i]['template']): ?>
          <?=__icon('image', is_small: true, alt: 'T', title: __('admin_images_list_type_templ'), path: root_path())?>
          <?php elseif($images_list[$i]['emoji']): ?>
          <?=__icon('user', is_small: true, alt: 'E', title: __('admin_images_list_type_emoji'), path: root_path())?>
          <?php elseif(!$images_list[$i]['old'] && !$images_list[$i]['full']): ?>
          &nbsp;
          <?php endif; ?>
        </td>

        <td class="align_center nowrap bold">
          <?=$images_list[$i]['lang']?>
        </td>

        <td class="align_center nowrap">
          <?php if($images_list[$i]['nsfw'] === '1'): ?>
          <?=__icon('warning', is_small: true, alt: 'N', title: __('admin_images_list_nsfw'), path: root_path())?>
          <?php else: ?>
          &nbsp;
          <?php endif; ?>
        </td>

        <?php if($images_list[$i]['comic'] !== ''): ?>
        <td class="align_center nowrap">
          <span class="tooltip_container">
            <?=__icon('image', is_small: true, alt: 'Y', title: $images_list[$i]['comic'], path: root_path())?>
            <div class="tooltip">
              <?=$images_list[$i]['comic']?>
            </div>
          </span>
          <?php if($images_list[$i]['order'] > 0): ?>
          <span class="tooltip_container">
            <?=__icon('graph', is_small: true, alt: 'O', title: $images_list[$i]['order'], path: root_path())?>
            <div class="tooltip">
              <?=$images_list[$i]['order']?>
            </div>
          </span>
          <?php endif; ?>
        </td>
        <?php else: ?>
        <td class="align_center nowrap">
          &nbsp;
        </td>
        <?php endif; ?>

        <td class="align_center nowrap tooltip_container">
          <?=$images_list[$i]['date']?>
          <div class="tooltip">
            <?=$images_list[$i]['date_full']?>
          </div>
        </td>

        <td class="align_center nowrap admin_action_icons">
          <?=__icon('edit', is_small: true, class: 'valign_middle pointer spaced_right', alt: 'M', title: __('edit'), title_case: 'initials', href: 'admin/images_edit?id='.$images_list[$i]['id'], path: root_path())?>
          <?=__icon('delete', is_small: true, class: 'valign_middle pointer', alt: 'X', title: __('delete'), title_case: 'initials', onclick: "admin_image_list_delete('".$images_list[$i]['id']."','".__('admin_images_delete_confirm')."')", path: root_path())?>
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