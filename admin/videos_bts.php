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




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
if(!page_is_fetched_dynamically()): /*******/ include './../inc/header.inc.php';  /****/ include './admin_menu.php'; ?>

<div class="width_50 padding_top">

  <h2 class="align_center padding_bot">
    <?=__link('admin/videos', __('admin_videos_bts_title'), 'text_light', path: $path)?>
    <?=__icon('add', alt: '+', title: __('add'), title_case: 'initials', href: 'admin/videos_bts_add', path: $path)?>
  </h2>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/***************************************************************************/ include './../inc/footer.inc.php'; endif;