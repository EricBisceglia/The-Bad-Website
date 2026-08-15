<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/quotes.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/quote";
$page_title_en  = "Admin - Quote";
$page_title_fr  = "Admin - Citation";

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
// Fetch quote data

// Fetch the quote's ID
$admin_quote_id = (int)form_fetch_element('quote_id', request_type: 'GET');

// Fetch the quote's data
$quote_data = quotes_get($admin_quote_id);

// Stop here if the quote does not exist
if(!$quote_data)
  exit(header("Location: ".$path."admin/quotes"));




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="align_center padding_bot">
    <?php if($quote_data['title']): ?>
    <?=__link('admin/quotes', $quote_data['title'], 'text_light', path: $path)?>
    <?php else: ?>
    <?=__link('admin/quotes', __('admin_quote_title'), 'text_light', path: $path)?>
    <?php endif; ?>
    <?=__icon('edit', href: 'admin/quotes_edit?quote_id='.$admin_quote_id, alt: 'E', title: __('admin_quote_edit'), path: $path) ?>
  </h2>

  <h5 class="align_center padding_bot">
    <?php if($quote_data['media_name']): ?>
    <?=$quote_data['media_name']?><br>
    <?php endif; if($quote_data['authors_full']): ?>
    <?=$quote_data['authors_full']?><br>
    <?php endif; if($quote_data['published']): ?>
    <?=$quote_data['published']?>
    <?php endif; ?>
  </h5>

  <?php if($quote_data['authors']['portraits']) : ?>
  <div class="padding_bot align_center flexcontainer">
    <div style="flex: <?=$quote_data['authors_count']?>;">
      <?php for($i = 0; $i < $quote_data['authors_count']; $i++): ?>
      <a href="<?=$path?>admin/quotes_farm?author=<?=$quote_data['authors']['id'][$i]?>">
        <img src="<?=$path?><?=$quote_data['authors']['portrait'][$i]?>" alt="<?=$quote_data['authors']['name'][$i]?>" title="<?=$quote_data['authors']['name'][$i]?>" class="admin_quote_portraits">
      </a>
      <?php endfor; ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if($quote_data['desc']): ?>
  <div class="smallpadding_bot italics">
    <?=$quote_data['desc']?>
  </div>
  <?php endif; ?>

  <blockquote><?=$quote_data['body']?></blockquote>

  <div class="italics smallpadding_top small">
    <?=$quote_data['origin']?>
  </div>

  <?php if($quote_data['source']): ?>
  <div class="italics smallpadding_top small">
    <?=__('admin_quote_source').__(':').' '.$quote_data['source']?>
  </div>
  <?php elseif($quote_data['media_source']): ?>
  <div class="italics smallpadding_top small">
    <?=__('admin_quote_source').__(':').' '.__link($quote_data['media_source'], $quote_data['media_source'], style: 'text_light underlined', popup: true, is_internal: false)?>
  </div>
  <?php endif; ?>


  <?php if($quote_data['tags_list']): ?>
  <div class="smallpadding_top small">
    <?=__('admin_quote_tags').__(':').' '.$quote_data['tags_list']?>
  </div>
  <?php endif; ?>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;