<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic management
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
// Fetch comic data

// Fetch the comic's ID
$admin_comic_id = (int)form_fetch_element('id', request_type: 'GET');

// Fetch the image's data
$admin_comic_data = comics_get( comic_id:         $admin_comic_id ,
                                show_all_images:  true            );

// Stop here if the image does not exist
if(!$admin_comic_data)
  exit(header("Location: ".$path."admin/comics"));




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch comic types

// Fetch a list of all comic types
$comic_types_list = comic_types_list();

// Select the comic's type
for($i = 0; $i < $comic_types_list['rows']; $i++)
{
  $comic_type_selected[$i] = '';
  if($comic_types_list[$i]['id'] === $admin_comic_data['type'])
    $comic_type_selected[$i] = ' selected';
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch tags

// Fetch a list of all tags
$tags_list = tags_list();

// Check the checkboxes of the tags that are already assigned to the comic
for($i = 0; $i < $tags_list['rows']; $i++)
{
  $admin_comic_tag_checked[$tags_list[$i]['id']] = '';
  for($j = 0; $j < $admin_comic_data['tags']['rows']; $j++)
  {
    if($admin_comic_data['tags']['id'][$j] === $tags_list[$i]['id'])
      $admin_comic_tag_checked[$tags_list[$i]['id']] = ' checked';
  }
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Prepare form values

// Private
$comic_private_checked = ($admin_comic_data['private']) ? ' checked' : '';




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top padding_bot">

  <h2 class="padding_bot">
    <?=__link('admin/comics', __('admin_comics_edit_title'), 'text_light', path: root_path())?>
  </h2>

  <form action="comics" method="POST">
    <fieldset>

      <input type="hidden" name="comic_id" value="<?=$admin_comic_id?>">

      <div class="smallpadding_bot">
        <label for="comic_type"><?=__('admin_comics_add_type')?></label>
        <select class="indiv align_left" name="comic_type" id="comic_type">
          <?php for($i = 0; $i < $comic_types_list['rows']; $i++) { ?>
          <option value="<?=$comic_types_list[$i]['id']?>"<?=$comic_type_selected[$i]?>><?=$comic_types_list[$i]['name']?></option>
          <?php } ?>
        </select>
      </div>

      <div class="smallpadding_bot">
        <label for="comic_date"><?=__('admin_comics_edit_date')?></label>
        <input class="indiv" type="text" name="comic_date" id="comic_date" value="<?=$admin_comic_data['date']?>">
      </div>

      <div class="flexcontainer">
        <div style="flex: 8">

          <div class="smallpadding_bot">
            <label for="comic_title_en"><?=__('admin_comics_add_title_en')?></label>
            <input class="indiv" type="text" name="comic_title_en" id="comic_title_en" value="<?=$admin_comic_data['title_en']?>">
          </div>

          <div class="smallpadding_bot">
            <label for="comic_desc_en"><?=__('admin_comics_edit_desc_en')?></label>
            <textarea class="indiv" name="comic_desc_en" id="comic_desc_en"><?=$admin_comic_data['desc_en']?></textarea>
          </div>

        </div>
        <div style="flex: 1">
          &nbsp;
        </div>
        <div style="flex: 8">

          <div class="smallpadding_bot">
            <label for="comic_title_fr"><?=__('admin_comics_add_title_fr')?></label>
            <input class="indiv" type="text" name="comic_title_fr" id="comic_title_fr" value="<?=$admin_comic_data['title_fr']?>">
          </div>

          <div class="smallpadding_bot">
            <label for="comic_desc_fr"><?=__('admin_comics_edit_desc_fr')?></label>
            <textarea class="indiv" name="comic_desc_fr" id="comic_desc_fr"><?=$admin_comic_data['desc_fr']?></textarea>
          </div>

        </div>
      </div>

      <div class="tinypadding_bot">
        <label><?=__('admin_comics_edit_tags')?></label>
        <?php for($i = 0; $i < $tags_list['rows']; $i++): ?>
        <input type="checkbox" name="comic_tag_<?=$tags_list[$i]['id']?>"<?=$admin_comic_tag_checked[$tags_list[$i]['id']]?>>
        <label class="label_inline" for="comic_tag_<?=$tags_list[$i]['id']?>"><?=$tags_list[$i]['title']?></label><br>
        <?php endfor; ?>
      </div>

      <div class="tinypadding_top smallpadding_bot">
        <input type="checkbox" class="align_left" name="comic_private"<?=$comic_private_checked?>>
        <label for="comic_private" class="label_inline"><?=__('admin_comics_edit_private')?></label>
      </div>

      <input type="submit" name="comic_edit" value="<?=__('admin_comics_edit_submit')?>">

    </fieldset>
  </form>

</div>

<?php if($admin_comic_data['images']['count'] > 0): ?>

<hr>

<div class="width_30">

  <?php for($i = 0; $i < $admin_comic_data['images']['count']; $i++): ?>

    <div class="padding_top align_center">
      <h5 class="padding_bot">
        [<?=$admin_comic_data['images']['lang'][$i]?>]
        <?=string_change_case($admin_comic_data['images']['type'][$i], 'initials')?>
        <?=__icon('edit', alt: 'M', title: __('edit'), path: root_path(), href: 'admin/images_edit?id='.$admin_comic_data['images']['id'][$i], popup: true, class: 'valign_middle pointer tinyspaced_left')?>
      </h5>
      <img src="<?=$path?>img/comics/<?=$admin_comic_data['images']['name'][$i]?>" alt="<?=$admin_comic_data['images']['name'][$i]?>" title="<?=$admin_comic_data['images']['name'][$i]?>">
      <?php if($admin_comic_data['images']['trans'][$i]): ?>
      <blockquote>
        <?=$admin_comic_data['images']['trans'][$i]?>
      </blockquote>
      <?php endif; ?>
    </div>

  <?php endfor; ?>

</div>

<?php endif; ?>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;