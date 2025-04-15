<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';  # Core
include_once './../actions/admin.act.php'; # Admin actions
include_once './../lang/admin.lang.php';   # Admin translations

// Page summary
$page_url       = "admin/ideas";
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
// Add idea

if(isset($_POST['admin_ideas_add']))
{
  // Sanitize the data
  $admin_ideas_data = array(  'title' => form_fetch_element('admin_ideas_title')  ,
                              'body'  => form_fetch_element('admin_ideas_body')   ,
                              'type'  => form_fetch_element('admin_ideas_type')   );

  // Add the idea
  admin_ideas_add($admin_ideas_data);
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Delete idea

if(isset($_POST['admin_ideas_delete']))
  admin_ideas_delete(form_fetch_element('admin_ideas_delete'));




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch ideas

// Fetch the category
$admin_ideas_category = (int)form_fetch_element('admin_ideas_category', default_value: 0);

// Fetch the sort order
$admin_ideas_sort = form_fetch_element('admin_ideas_sort', default_value: 'random');

// Fetch the ideas
$admin_ideas = admin_ideas_list(  category: $admin_ideas_category ,
                                  sort_by:  $admin_ideas_sort     );




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch idea types

$admin_idea_types = admin_idea_types_list();




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h3 class="padding_bot">
    <?=__('admin_ideas_filters').__(':')?>
    <select name="admin_ideas_category" id="admin_ideas_category" class="align_left bold" onchange="admin_ideas_search();">
      <?php for($i = 0; $i < $admin_idea_types['rows']; $i++): ?>
      <option value="<?=$admin_idea_types[$i]['id']?>"><?=$admin_idea_types[$i]['name']?></option>
      <?php endfor; ?>
    </select>
    <?=__icon('refresh', alt: 'R', title: __('admin_ideas_sort_random'), title_case: 'initials', path: root_path(), class: 'valign_middle pointer spaced_left', onclick: "admin_ideas_search('random');")?>
    <?=__icon('done', alt: 'A', title: __('admin_ideas_sort_title'), title_case: 'initials', path: root_path(), class: 'valign_middle pointer spaced_left', onclick: "admin_ideas_search('title');")?>
    <?=__icon('sort_down', alt: 'D', title: __('admin_ideas_sort_newest'), title_case: 'initials', path: root_path(), class: 'valign_middle pointer spaced_left', onclick: "admin_ideas_search('newest');")?>
    <?=__icon('sort_up', alt: 'U', title: __('admin_ideas_sort_oldest'), title_case: 'initials', path: root_path(), class: 'valign_middle pointer spaced_left', onclick: "admin_ideas_search('oldest');")?>
  </h3>

  <?php endif; ?>

  <div id="ideas_list">

    <h2 class="padding_bot smallpadding_top">
      <?=__('admin_ideas_list', preset_values: array($admin_ideas['rows']), amount: $admin_ideas['rows'])?>
      <?=__icon('add', alt: '+', title: __('add'), title_case: 'initials', href: 'admin/ideas_add', path: root_path())?>
    </h2>

    <?php for($i = 0; $i < $admin_ideas['rows']; $i++): ?>

      <div class="bigpadding_bot" id="ideas_<?=$admin_ideas['ideas'][$i]['id']?>">

        <h5 class="smallpadding_bot bold text_orange">
          <?=$admin_ideas['ideas'][$i]['title']?>
          <?=__icon('edit', is_small: true, alt: '+', title: __('edit'), title_case: 'initials', href: 'admin/ideas_edit?id='.$admin_ideas['ideas'][$i]['id'], path: $path)?>
          <?=__icon('delete', is_small: true, alt: '-', title: __('delete'), title_case: 'initials', path: $path, onclick: 'admin_ideas_delete('.$admin_ideas['ideas'][$i]['id'].', \''.__('admin_ideas_delete').'\')')?>
        </h5>

        <blockquote>
          <?=$admin_ideas['ideas'][$i]['body']?>
        </blockquote>

      </div>

    <?php endfor; ?>

  </div>

  <?php if(!page_is_fetched_dynamically()): ?>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;