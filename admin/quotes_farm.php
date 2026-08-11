<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/quotes.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/quotes_farm";
$page_title_en  = "Admin - Quotes farm";
$page_title_fr  = "Admin - Ferme à citations";

// Admin menu selection
$admin_menu['quotes'] = 1;

// Extra CSS & JS
$css  = array('admin');
$js   = array('admin/admin');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// List quotes

// Preselected author
$admin_quotes_search_author = (isset($_POST['admin_quotes_search_author']))
                            ? (int)form_fetch_element('admin_quotes_search_author')
                            : (int)form_fetch_element('author', request_type: 'GET');

// Fetch quote authors
$quote_authors_list = quote_authors_list();

// Preselect the correct author
for($i = 0; $i < $quote_authors_list['rows']; $i++)
  $quote_authors_selected[$i] = ($quote_authors_list[$i]['id'] == $admin_quotes_search_author) ? ' selected' : '';

// Fetch quote media
$quote_media_list = quote_media_list( sort_by_author: true );

// Fetch quote tags
$quote_tags_list = quote_tags_list();

// Assemble the search query
$admin_quotes_search = array( 'author'  => $admin_quotes_search_author                      ,
                              'media'   => form_fetch_element('admin_quotes_search_media')  ,
                              'body'    => form_fetch_element('admin_quotes_search_body')   ,
                              'tag'     => form_fetch_element('admin_quotes_search_tags')   );

// Fetch the quotes
$quotes_list = quotes_list( sort_by:  'default'             ,
                            search:   $admin_quotes_search  );




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_30 padding_top">

  <h2 class="align_center padding_bot">
    <?=__link('admin/quotes', __('admin_quotes_farm_title'), 'text_light', path: $path)?>
  </h2>

  <h5 class="tinypadding_bot">
    <select id="admin_quotes_search_author" class="indiv align_left">
      <option value="0">&nbsp;</option>
      <?php for($i = 0; $i < $quote_authors_list['rows']; $i++): ?>
      <option value="<?=$quote_authors_list[$i]['id']?>"<?=$quote_authors_selected[$i]?>><?=$quote_authors_list[$i]['name']?></option>
      <?php endfor; ?>
    </select>
  </h5>

  <h5 class="tinypadding_bot">
    <select id="admin_quotes_search_media" class="indiv align_left">
      <option value="0">&nbsp;</option>
      <?php for($i = 0; $i < $quote_media_list['rows']; $i++): ?>
      <option value="<?=$quote_media_list[$i]['id']?>"><?=$quote_media_list[$i]['full_name']?></option>
      <?php endfor; ?>
    </select>
  </h5>

  <h5 class="tinypadding_bot">
    <select id="admin_quotes_search_tags" class="indiv align_left">
      <option value="0">&nbsp;</option>
      <?php for($i = 0; $i < $quote_tags_list['rows']; $i++): ?>
      <option value="<?=$quote_tags_list[$i]['id']?>"><?=$quote_tags_list[$i]['name']?></option>
      <?php endfor; ?>
    </select>
  </h5>

  <h5 class="smallpadding_bot">
    <input type="text" name="admin_quotes_search_body" id="admin_quotes_search_body" value="">
    <button class="bold" name="admin_quotes_search_go" value="<?=__('admin_quotes_farm_search')?>" onclick="admin_quotes_farm_search();"><?=__('admin_quotes_farm_search')?></button>
  </h5>

</div>

<div class="width_50 align_center" id="admin_quotes_farm_list">
  <?php endif; ?>

  <?php if(isset($_POST['admin_quotes_search_go']) || isset($_GET['author']) && $quotes_list['rows']): ?>
  <div class="smallpadding_top">
    <?php for($i = 0; $i < $quotes_list['rows']; $i++): ?>

    <div class="smallpadding_top smallpadding_bot">
      <hr>
    </div>

    <h3 class="align_center padding_bot">
      <?php if($quotes_list[$i]['title']): ?>
      <?=__link('admin/quote?quote_id='.$quotes_list[$i]['id'], $quotes_list[$i]['title'], 'text_light', path: $path)?>
      <?php else: ?>
      <?=__link('admin/quote?quote_id='.$quotes_list[$i]['id'], __('admin_quote_title'), 'text_light', path: $path)?>
      <?php endif; ?>
      <?=__icon('edit', alt: 'M', title: __('edit'), title_case: 'initials', href: 'admin/quotes_edit?quote_id='.$quotes_list[$i]['id'], path: $path)?>
    </h3>

    <h5 class="align_center padding_bot">
      <?php if($quotes_list[$i]['media']): ?>
      <?=$quotes_list[$i]['media']?><br>
      <?php endif; if($quotes_list[$i]['authors_full']): ?>
      <?=$quotes_list[$i]['authors_full']?><br>
      <?php endif; if($quotes_list[$i]['year']): ?>
      <?=$quotes_list[$i]['year']?>
      <?php endif; ?>
    </h5>

    <div class="smallpadding_bot">
      <?php if($quotes_list[$i]['body_en'] && $quotes_list[$i]['body_fr']): ?>
      <div class="flexcontainer">
        <div class="flex" style="flex: 10;">
          <blockquote><?=$quotes_list[$i]['body_en']?></blockquote>
        </div>
        <div class="flex">
          &nbsp;
        </div>
        <div class="flex" style="flex: 10;">
          <blockquote><?=$quotes_list[$i]['body_fr']?></blockquote>
        </div>
      </div>
      <?php elseif($quotes_list[$i]['body_en']): ?>
      <blockquote><?=$quotes_list[$i]['body_en']?></blockquote>
      <?php elseif($quotes_list[$i]['body_fr']): ?>
      <blockquote><?=$quotes_list[$i]['body_fr']?></blockquote>
      <?php endif; ?>
    </div>

    <?php endfor; ?>
  </div>
  <div class="smallpadding_top">
    <hr>
  </div>
  <?php endif; ?>

  <?php if(!page_is_fetched_dynamically()): ?>
</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;