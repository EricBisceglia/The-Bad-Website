<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/videos.act.php'; # Admin actions
include_once './../lang/admin.lang.php';    # Admin translations

// Page summary
$page_url       = "admin/videos_bts";
$page_title_en  = "Admin - BTS videos";
$page_title_fr  = "Admin - Vidéos BTS";

// Admin menu selection
$admin_menu['videos'] = 1;

// Extra CSS & JS
$css  = array('admin');
$js   = array('admin/admin');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Add a BTS video

if(isset($_POST['videos_bts_add']))
{
  // Assemble an array with the postdata
  $videos_bts_add_data = array( 'youtube_id'  => form_fetch_element('videos_bts_youtube_id')  ,
                                'sort_order'  => form_fetch_element('videos_bts_order')       ,
                                'title_en'    => form_fetch_element('videos_bts_name_en')     ,
                                'title_fr'    => form_fetch_element('videos_bts_name_fr')     ,
                                'desc_en'     => form_fetch_element('videos_bts_desc_en')     ,
                                'desc_fr'     => form_fetch_element('videos_bts_desc_fr')     );

  // Add the BTS video to the database
  $videos_bts_add = videos_bts_add( $videos_bts_add_data );
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch the videos

$bts_videos = videos_bts_list();




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_30 padding_top">

  <h3 class="align_center padding_bot">
    <?=__link('admin/videos', __('admin_videos_bts_title'), 'text_light', path: $path)?>
    <?=__icon('add', alt: '+', title: __('add'), title_case: 'initials', href: 'admin/videos_bts_add', path: $path)?>
  </h3>

  <table>
    <thead>

      <tr class="uppercase">
        <th class="align_center">
          <?=__('admin_videos_bts_order')?>
        </th>
        <th class="align_center">
          <?=__('admin_videos_bts_name')?>
        </th>
        <th>
          <?=__('act')?>
        </th>
      </tr>

      </thead>

    <tbody class="altc2 nowrap" id="admin_quotes_tags_tbody">

      <?php endif; ?>

      <tr>
        <td colspan="4" class="uppercase text_light dark bold align_center">
          <?=__('admin_videos_bts_count', preset_values: array($bts_videos['rows']), amount: $bts_videos['rows'])?>
        </td>
      </tr>

      <?php for($i = 0; $i < $bts_videos['rows']; $i++): ?>

      <tr>

        <td class="align_center bold nowrap">
          <?=$bts_videos[$i]['sort']?>
        </td>

        <td class="align_center bold nowrap">
          <?=$bts_videos[$i]['stitle']?>
        </td>

        <td class="align_center nowrap admin_action_icons">
          <?=__icon('edit', is_small: true, class: 'valign_middle pointer spaced_right', alt: 'M', title: __('edit'), title_case: 'initials', href: 'admin/videos_bts_edit?bts_video_id='.$bts_videos[$i]['id'], path: $path)?>
          <?=__icon('delete', is_small: true, class: 'valign_middle pointer', alt: 'X', title: __('delete'), title_case: 'initials', onclick: "admin_videos_bts_delete('".$bts_videos[$i]['id']."','".__('admin_videos_bts_delete_confirm')."')", path: $path)?>
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