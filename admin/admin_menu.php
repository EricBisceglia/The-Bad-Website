<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./404")); die(); }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Prepare the menu entries

// Set up the admin menu
$admin_menu_entries = array('index', 'ideas', 'comics', 'images', 'tags', 'searches', 'queries');

// Select the correct menu entry
foreach($admin_menu_entries as $admin_menu_entry)
  $admin_menu[$admin_menu_entry] = isset($admin_menu[$admin_menu_entry]) ? ' selected' : '';


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Display the menu                                                                                                  ?>

<div class="nopadding_top padding_bot align_center admin_menu">
  <fieldset>
    <h5>
      <select class="inh" id="admin_menu" name="admin_menu" onchange="admin_menu();">
        <?php foreach($admin_menu_entries as $admin_menu_entry): ?>
          <option value="<?=$admin_menu_entry?>"<?=$admin_menu[$admin_menu_entry]?>>
            <?=__('admin_menu_'.$admin_menu_entry)?>
          </option>
        <?php endforeach; ?>
      </select>
    </h5>
  </fieldset>
</div>

<hr>