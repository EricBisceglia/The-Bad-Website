<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic management
include_once './../lang/comics.lang.php';   # Translations

// Extra JS
$js = array('common/comics');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     BACK END                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch the comic

// Grab the comic's data
$comic_slug = form_fetch_element('slug', request_type: 'GET');

// Stop here if there is no slug
if(!$comic_slug)
  exit(header("Location: ".$path."404"));

// Get the comic's ID
$comic_id = comics_get_id($comic_slug);

// Stop here if the comic does not exist
if(!$comic_id)
  exit(header("Location: ".$path."404"));

// Fetch the comic's data
$comic_data = comics_get( comic_id: $comic_id );

// Stop here if the comic does not exist
if(!$comic_data)
  exit(header("Location: ".$path."404"));

// Stop here if the comic is private
if($comic_data['private'])
  exit(header("Location: ".$path."404"));

// Update the page sumary
$page_url         = "comic/".$comic_slug;
$page_title_en    = $comic_data['page_en'];
$page_title_fr    = $comic_data['page_fr'];
$page_description = $comic_data['page_en'];
$page_is_a_comic  = true;
$page_image       = $comic_data['preview_url'];

// Increment the comic's view count
comics_increment_view_count($comic_id);




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/*******************************************************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50 padding_bot">

  <a href="<?=$path?>category/<?=$comic_data['type_slug']?>">
    <img src="<?=$path.$comic_data['type_banner']?>" alt="<?=$comic_data['type_name']?>" title="<?=$comic_data['type_name']?>">
  </a>

  <div class="flexcontainer smallpadding_bot">
    <div class="flex smallspaced_right">
      <?php if($comic_data['previous']): ?>
      <a href="<?=$path?>comic/<?=$comic_data['previous']?>">
        <img src="<?=$path?>img/banners/comics/previous_<?=$lang_lower?>.png" alt="<?=__('comics_nav_previous')?>" title="<?=__('comics_nav_previous')?>">
      </a>
      <?php else: ?>
      &nbsp;
      <?php endif; ?>
    </div>
    <div class="flex smallspaced_right">
      <a href="<?=$path?>comics/random?exclude=<?=$comic_slug?>&type=<?=$comic_data['type_id']?>">
        <img src="<?=$path?>img/banners/comics/random_<?=$lang_lower?>.png" alt="<?=__('comics_nav_random')?>" title="<?=__('comics_nav_random')?>">
      </a>
    </div>
    <div class="flex">
      <?php if($comic_data['next']): ?>
      <a href="<?=$path?>comic/<?=$comic_data['next']?>">
        <img src="<?=$path?>img/banners/comics/next_<?=$lang_lower?>.png" alt="<?=__('comics_nav_next')?>" title="<?=__('comics_nav_next')?>">
      </a>
      <?php else: ?>
      &nbsp;
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="align_center width_80">

  <h1 class="tinypadding_bot">
    <?=__link('comics/list', $comic_data['title'], path: root_path(), style: 'text_light')?>
  </h1>
  <h5 class="bigpadding_bot">
    <?=__link('comics/all', $comic_data['date_full'], path: root_path(), style: 'text_light')?>
  </h5>

  <?php for($i = 0; $i < $comic_data['images']['rows']; $i++): ?>
  <?php if(!$comic_data['images']['old'][$i] && !$comic_data['images']['full'][$i]): ?>
  <div class="padding_bot tinypadding_top">
    <div class="comic_container<?=$comic_data['images']['blur'][$i]?>">
      <img src="<?=$path?>img/comics/<?=$comic_data['images']['name'][$i]?>" alt="<?=$comic_data['images']['ftrans'][$i]?>" title="<?=__('comics_title_tag')?>"<?=$comic_data['images']['unblur'][$i]?>>
    </div>
  </div>
  <?php endif; ?>
  <?php endfor; ?>

  <?php if($comic_data['images']['olds']): ?>
  <div class="padding_bot align_center">
    <button class="button" id="image_old_button" onclick="show_comic_old();"><?=__('comics_old_button')?></button>
  </div>
  <div class="hidden" id="image_old_versions">
    <?php for($i = 0; $i < $comic_data['images']['rows']; $i++): ?>
    <?php if($comic_data['images']['old'][$i]): ?>
    <div class="padding_bot tinypadding_top">
      <div class="comic_container<?=$comic_data['images']['blur'][$i]?>">
        <img src="<?=$path?>img/comics/<?=$comic_data['images']['name'][$i]?>" alt="<?=$comic_data['images']['ftrans'][$i]?>" title="<?=__('comics_title_tag')?>"<?=$comic_data['images']['unblur'][$i]?>>
      </div>
    </div>
    <?php endif; ?>
    <?php endfor; ?>
  </div>
  <?php endif; ?>

  <?php if($comic_data['images']['fulls']): ?>
  <div class="padding_bot align_center">
    <button class="button" id="image_full_button" onclick="show_comic_full();"><?=__('comics_full_button')?></button>
  </div>
  <div class="hidden" id="image_full_versions">
    <?php for($i = 0; $i < $comic_data['images']['rows']; $i++): ?>
    <?php if($comic_data['images']['full'][$i] && !$comic_data['images']['old'][$i]): ?>
    <div class="padding_bot tinypadding_top">
      <div class="comic_container<?=$comic_data['images']['blur'][$i]?>">
        <img src="<?=$path?>img/comics/<?=$comic_data['images']['name'][$i]?>" alt="<?=$comic_data['images']['ftrans'][$i]?>" title="<?=__('comics_title_tag')?>"<?=$comic_data['images']['unblur'][$i]?>>
      </div>
    </div>
    <?php endif; ?>
    <?php endfor; ?>
  </div>
  <?php endif; ?>

</div>

<div class="width_50 padding_top">

  <?php if($comic_data['youtube_'.$lang_lower]): ?>
  <div class="bigpadding_bot">
    <h5 class="smallpadding_bot">
      <?=__('comics_youtube')?>
    </h5>
    <div class="comic_youtube_container">
      <iframe src="https://www.youtube.com/embed/<?=$comic_data['youtube_'.$lang_lower]?>?rel=0" class="comic_youtube_embed"></iframe>
    </div>
  </div>
  <?php endif; ?>

  <?php if($comic_data['desc']): ?>
  <div class="padding_bot">
    <h5 class="smallpadding_bot">
      <?=__('comics_description')?>
    </h5>
    <blockquote><?=$comic_data['desc']?></blockquote>
  </div>
  <?php endif; ?>

  <?php if($comic_data['images']['transcripts']): ?>
  <div class="padding_bot">
    <div class="smallpadding_bot align_center">
      <button class="button" id="image_transcripts_button" onclick="show_comic_transcripts();"><?=__('comics_trans_button')?></button>
    </div>
    <div class="hidden" id="image_transcripts">
      <h5 class="smallpadding_bot">
        <?=__('comics_transcript')?>
      </h5>
      <?php for($i = 0; $i < $comic_data['images']['rows']; $i++): ?>
      <?php if($comic_data['images']['trans'][$i] && !$comic_data['images']['old'][$i] && !$comic_data['images']['full'][$i]): ?>
      <div class="smallpadding_bot">
        <blockquote><?=$comic_data['images']['trans'][$i]?></blockquote>
      </div>
      <?php endif; ?>
      <?php endfor; ?>
    </div>
  </div>
  <?php endif; ?>

  <?php for($i = 0; $i < $comic_data['tags']['rows']; $i++): ?>
  <a href="<?=$path?>tag/<?=$comic_data['tags']['name'][$i]?>">
    <img src="<?=$path.$comic_data['tags']['banner'][$i]?>" alt="<?=$comic_data['tags']['title'][$i]?>" title="<?=$comic_data['tags']['title'][$i]?>">
  </a>
  <?php endfor; ?>

  <div class="flexcontainer smallpadding_bot">
    <div class="flex smallspaced_right">
      <?php if($comic_data['previous']): ?>
      <a href="<?=$path?>comic/<?=$comic_data['previous']?>">
        <img src="<?=$path?>img/banners/comics/previous_<?=$lang_lower?>.png" alt="<?=__('comics_nav_previous')?>" title="<?=__('comics_nav_previous')?>">
      </a>
      <?php else: ?>
      &nbsp;
      <?php endif; ?>
    </div>
    <div class="flex smallspaced_right">
      <a href="<?=$path?>comics/random?exclude=<?=$comic_slug?>&type=<?=$comic_data['type_id']?>">
        <img src="<?=$path?>img/banners/comics/random_<?=$lang_lower?>.png" alt="<?=__('comics_nav_random')?>" title="<?=__('comics_nav_random')?>">
      </a>
    </div>
    <div class="flex">
      <?php if($comic_data['next']): ?>
      <a href="<?=$path?>comic/<?=$comic_data['next']?>">
        <img src="<?=$path?>img/banners/comics/next_<?=$lang_lower?>.png" alt="<?=__('comics_nav_next')?>" title="<?=__('comics_nav_next')?>">
      </a>
      <?php else: ?>
      &nbsp;
      <?php endif; ?>
    </div>
  </div>

</div>


<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/**********************************************************************************/ include './../inc/footer.inc.php';