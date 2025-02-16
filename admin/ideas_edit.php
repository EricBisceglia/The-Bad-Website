<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';  # Core
include_once './../actions/admin.act.php'; # Admin actions
include_once './../lang/admin.lang.php';   # Admin translations

// Page summary
$page_url       = "admin/index";
$page_title_en  = "Admin";
$page_title_fr  = "Admin";

// Admin menu selection
$admin_menu['index'] = 1;

// Extra CSS & JS
$css  = array('admin');
$js   = array('admin/admin');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch idea data

// Check whether the idea exists
if(!isset($_GET['id']) || !is_numeric($_GET['id']))
  exit(header("Location: ./index"));

// Fetch the idea
$admin_idea_id  = sanitize($_GET['id'], 'int');
$admin_idea     = admin_ideas_get($admin_idea_id);

// Exit if the idea doesn't exist
if(is_null($admin_idea['title']))
  exit(header("Location: ./index"));




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Update idea

if(isset($_POST['admin_ideas_edit']))
{
  // Fetch the data
  $admin_idea_title = form_fetch_element('admin_ideas_title');
  $admin_idea_body  = form_fetch_element('admin_ideas_body');

  // Update the idea
  admin_ideas_edit( $admin_idea_id                      ,
                    array('title' => $admin_idea_title  ,
                          'body'  => $admin_idea_body  ));

  // Redirect to the idea list
  exit(header("Location: ./index#ideas_".$admin_idea_id));
}




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top padding_bot">

  <form method="POST">

    <h2 class="padding_bot">
      <?=__link('admin/', __('admin_ideas_edit'), path: $path, style: 'text_light')?>
    </h2>

    <div class="smallpadding_bot">
      <label for="admin_ideas_title"><?=__('admin_ideas_title')?></label>
      <input type="text" name="admin_ideas_title" class="indiv" value="<?=$admin_idea['title']?>">
    </div>

    <div class="tinypadding_bot">
      <label for="admin_ideas_body"><?=__('admin_ideas_new_body')?></label>
      <textarea class="padding_bot" name="admin_ideas_body"><?=$admin_idea['body']?></textarea>
    </div>

    <div class="tinypadding_top">
      <input type="submit" name="admin_ideas_edit" value="<?=__('admin_ideas_edit')?>">
    </div>

  </form>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;