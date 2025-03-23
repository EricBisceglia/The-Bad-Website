<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic management
include_once './../actions/images.act.php'; # Image management
include_once './../actions/tags.act.php';   # Tag management
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
// Fetch a list of all tags and images

$tags_list = tags_list();




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
// Edit a comic

if(isset($_POST['comic_edit']))
{
  // Fetch the comic's ID
  $admin_comic_id = (int)form_fetch_element('comic_id');

  // Go through the tag list
  for($i = 0; $i < $tags_list['rows']; $i++)
    $admin_comic_tags[$tags_list[$i]['id']] = (isset($_POST['comic_tag_'.$tags_list[$i]['id']])) ? 1 : 0;

  // Assemble an array with the postdata
  $admin_comic_data = array(  'title_en'  => form_fetch_element('comic_title_en')                       ,
                              'title_fr'  => form_fetch_element('comic_title_fr')                       ,
                              'desc_en'   => form_fetch_element('comic_desc_en')                        ,
                              'desc_fr'   => form_fetch_element('comic_desc_fr')                        ,
                              'type'      => form_fetch_element('comic_type')                           ,
                              'date'      => form_fetch_element('comic_date')                           ,
                              'private'   => form_fetch_element('comic_private', element_exists: true)  ,
                              'tags'      => $admin_comic_tags                                          );

  // Edit the comic
  comics_edit(  $admin_comic_id   ,
                $admin_comic_data );
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Delete a comic

if(isset($_POST['admin_comics_delete']))
  comics_delete(form_fetch_element('admin_comics_delete'));




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// List comics

// Fetch comic types
$comic_types = comic_types_list();

// Fetch the sorting order
$admin_comics_sort = form_fetch_element('admin_comics_sort', 'date');

// Assemble the search query
$admin_comics_search = array( 'body'    => form_fetch_element('admin_comics_search_body')     ,
                              'title'   => form_fetch_element('admin_comics_search_title')    ,
                              'type'    => form_fetch_element('admin_comics_search_type')     ,
                              'private' => form_fetch_element('admin_comics_search_private')  ,
                              'images'  => form_fetch_element('admin_comics_search_images')   ,
                              'tag_id'  => form_fetch_element('admin_comics_search_tag_id')   );

// Fetch the comics
$comics_list = comics_list( sort_by:  $admin_comics_sort    ,
                            search:   $admin_comics_search  );




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="align_center smallpadding_bot">
    <?=__link('admin/comics', __('admin_comics_title'), style: 'text_light', path: root_path())?>
    <?=__icon('add', alt: '+', title: __('add'), title_case: 'initials', href: 'admin/comics_add', path: root_path())?>
  </h2>

  <div class="padding_bot">
    <label for="admin_comics_search_body"><?=__('admin_comics_search_body').__(':')?></label>
    <input class="indiv" type="text" name="admin_comics_search_body" id="admin_comics_search_body" value="" onkeyup="admin_comic_list_search();">
  </div>

  <table>
    <thead>

      <tr class="uppercase">
        <th>
          <?=__('admin_comics_list_title')?>
          <?=__icon('sort_down', is_small: true, alt: 'v', title: __('sort'), title_case: 'initials', path: root_path(), onclick: "admin_comic_list_search('title');")?>
        </th>
        <th>
          <?=__link('admin/comics_types', __('admin_comics_list_type'), path: root_path())?>
          <?=__icon('sort_down', is_small: true, alt: 'v', title: __('sort'), title_case: 'initials', path: root_path(), onclick: "admin_comic_list_search('type');")?>
        </th>
        <th>
          <?=__('admin_comics_list_date')?>
          <?=__icon('sort_down', is_small: true, alt: 'v', title: __('sort'), title_case: 'initials', path: root_path(), onclick: "admin_comic_list_search('date');")?>
        </th>
        <th>
          <?=__('admin_comics_list_private')?>
          <?=__icon('sort_down', is_small: true, alt: 'v', title: __('sort'), title_case: 'initials', path: root_path(), onclick: "admin_comic_list_search('private');")?>
        </th>
        <th>
          <?=__('admin_comics_list_images')?>
          <?=__icon('sort_down', is_small: true, alt: 'v', title: __('sort'), title_case: 'initials', path: root_path(), onclick: "admin_comic_list_search('images');")?>
        </th>
        <th>
          <?=__('admin_comics_list_tags')?>
          <?=__icon('sort_down', is_small: true, alt: 'v', title: __('sort'), title_case: 'initials', path: root_path(), onclick: "admin_comic_list_search('tags');")?>
        </th>
        <th>
          <?=__('act')?>
        </th>
      </tr>

      <tr>

        <th>
          <input type="hidden" name="admin_comics_sort" id="admin_comics_sort" value="<?=$admin_comics_sort?>">
          <input type="text" class="table_search" name="admin_comics_search_title" id="admin_comics_search_title" value="" onkeyup="admin_comic_list_search();">
        </th>

        <th>
          <select class="table_search" name="admin_comics_search_type" id="admin_comics_search_type" onchange="admin_comic_list_search();">
            <option value="0">&nbsp;</option>
            <?php for($i = 0; $i < $comic_types['rows']; $i++): ?>
            <option value="<?=$comic_types[$i]['id']?>"><?=$comic_types[$i]['name']?></option>
            <?php endfor; ?>
          </select>
        </th>

        <th>
          &nbsp;
        </th>

        <th>
          <select class="table_search" name="admin_comics_search_private" id="admin_comics_search_private" onchange="admin_comic_list_search();">
            <option value="0">&nbsp;</option>
            <option value="1"><?=__('admin_comics_list_private')?></option>
          </select>
        </th>

        <th>
          <select class="table_search" name="admin_comics_search_images" id="admin_comics_search_images" onchange="admin_comic_list_search();">
            <option value="0">&nbsp;</option>
            <option value="-1"><?=__('admin_comics_list_images_n')?></option>
            <option value="1"><?=__('admin_comics_list_images_y')?></option>
          </select>
        </th>

        <th>
          <select class="table_search" name="admin_comics_search_tags" id="admin_comics_search_tags" onchange="admin_comic_list_search();">
            <option value="0">&nbsp;</option>
            <?php for($i = 0; $i < $tags_list['rows']; $i++): ?>
            <option value="<?=$tags_list[$i]['id']?>"><?=$tags_list[$i]['title']?></option>
            <?php endfor; ?>
          </select>
        </th>

        <th>
          &nbsp;
        </th>

      </tr>

    </thead>

    <tbody class="altc2 nowrap" id="admin_comics_tbody">

      <?php endif; ?>

      <tr>
        <td colspan="8" class="uppercase text_light dark bold align_center">
          <?=__('admin_comics_list_count', preset_values: array($comics_list['rows']), amount: $comics_list['rows'])?>
        </td>
      </tr>

      <?php for($i = 0; $i < $comics_list['rows']; $i++): ?>
      <tr>

        <td class="align_left nowrap tooltip_container">
          <?=__link('comic/'.$comics_list[$i]['slug'], $comics_list[$i]['title'], path: root_path())?>
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

        <?php if($comics_list[$i]['nimages']): ?>
        <td class="align_center nowrap tooltip_container">
          <?=$comics_list[$i]['nimages']?>
          <div class="tooltip">
            <?=str_replace(', ', '<br>', $comics_list[$i]['images'])?>
          </div>
        </td>
        <?php else: ?>
        <td class="align_center nowrap">
          &nbsp;
        </td>
        <?php endif; ?>

        <?php if($comics_list[$i]['ntags']): ?>
        <td class="align_center nowrap tooltip_container">
          <?=$comics_list[$i]['ntags']?>
          <div class="tooltip">
            <?=str_replace(', ', '<br>', $comics_list[$i]['tags'])?>
          </div>
        </td>
        <?php else: ?>
        <td class="align_center nowrap">
          &nbsp;
        </td>
        <?php endif; ?>

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