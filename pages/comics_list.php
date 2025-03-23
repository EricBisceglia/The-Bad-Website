<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic management
include_once './../lang/comics.lang.php';   # Admin translations

// Page summary
$page_url       = "pages/comics_list";
$page_title_en  = "Comics list";
$page_title_fr  = "Liste des comics";




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get the list of comics

$comics_list = comics_list( sort_by:    'date'  ,
                            is_public:  true    );




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50">

  <div class="padding_bot">
    <img src="<?=$path?>img/banners/comics/full_list_header_<?=$lang?>.png" alt="<?=__('comics_list_all')?>" title="<?=__('comics_list_all')?>">
  </div>

  <table>
    <thead>

      <tr class="uppercase">
        <th>
          <?=__('comics_list_type')?>
        </th>
        <th>
          <?=__('comics_list_title')?>
        </th>
        <th>
          <?=__('comics_list_date')?>
        </th>
      </tr>

    </thead>
    <tbody class="altc2 nowrap" id="admin_comics_tbody">

      <?php endif; ?>

      <tr>
        <td colspan="3" class="uppercase text_light dark bold align_center">
          <?=__('comics_list_count', preset_values: array($comics_list['rows']), amount: $comics_list['rows'])?>
        </td>
      </tr>

      <?php for($i = 0; $i < $comics_list['rows']; $i++): ?>
      <tr class="pointer" onclick="window.location.href='<?=$path?>comic/<?=$comics_list[$i]['slug']?>'">

        <td class="nowrap align_center">
          <?=$comics_list[$i]['type']?>
        </td>

        <td class="align_left nowrap bold">
          <?=__link('comic/'.$comics_list[$i]['slug'], $comics_list[$i]['ltitle'], path: root_path())?>
        </td>

        <td class="nowrap align_center">
          <?=$comics_list[$i]['date']?>
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