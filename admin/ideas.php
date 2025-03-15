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
  $admin_ideas_title = form_fetch_element('admin_ideas_title');
  $admin_ideas_body  = form_fetch_element('admin_ideas_body');

  // Add the idea
  admin_ideas_add($admin_ideas_title, $admin_ideas_body);
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Delete idea

if(isset($_POST['admin_ideas_delete']))
  admin_ideas_delete(form_fetch_element('admin_ideas_delete'));




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch ideas

// Fetch the sort order
$admin_ideas_sort = form_fetch_element('admin_ideas_sort', default_value: 'random');

// Fetch the ideas
$admin_ideas = admin_ideas_list( sort_by: $admin_ideas_sort );




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top" id="ideas_list">

  <?php endif; ?>

  <h2 class="padding_bot">
    <?=__('admin_ideas_list', preset_values: array($admin_ideas['rows']))?>
    <?=__icon('refresh', alt: 'R', title: __('admin_ideas_sort_random'), title_case: 'initials', path: root_path(), class: 'valign_middle pointer spaced_left', onclick: "admin_ideas_sort('random');")?>
    <?=__icon('done', alt: 'A', title: __('admin_ideas_sort_title'), title_case: 'initials', path: root_path(), class: 'valign_middle pointer spaced_left', onclick: "admin_ideas_sort('title');")?>
    <?=__icon('sort_down', alt: 'D', title: __('admin_ideas_sort_newest'), title_case: 'initials', path: root_path(), class: 'valign_middle pointer spaced_left', onclick: "admin_ideas_sort('newest');")?>
    <?=__icon('sort_up', alt: 'U', title: __('admin_ideas_sort_oldest'), title_case: 'initials', path: root_path(), class: 'valign_middle pointer spaced_left', onclick: "admin_ideas_sort('oldest');")?>
  </h2>

  <form method="POST" action="index#ideas_list" class="bigpadding_bot">

    <div class="tinypadding_bot">
      <label for="admin_ideas_title"><?=__('admin_ideas_new_title')?></label>
      <input type="text" name="admin_ideas_title" class="indiv">
    </div>

    <div class="tinypadding_bot">
      <label for="admin_ideas_body"><?=__('admin_ideas_new_body')?></label>
      <textarea class="padding_bot" name="admin_ideas_body"></textarea>
    </div>

    <div class="tinypadding_top">
      <input type="submit" name="admin_ideas_add" value="<?=__('admin_ideas_add')?>">
    </div>

  </form>

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

  <?php if(!page_is_fetched_dynamically()): ?>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;