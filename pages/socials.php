<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php'; # Core
include_once './../lang/main.lang.php';   # Translations

// Page summary
$page_lang        = array('FR', 'EN');
$page_url         = "about/socials";
$page_title_en    = "Socials";
$page_title_fr    = "Social";
$page_description = "Follow thebad.website on socials!";

// Enforce the url
page_enforce_url($page_url);

// Prepare links in the correct language
$bluesky_link   = ($lang == 'EN') ? 'thebad.website'              : 'lemauvais.site';
$instagram_link = ($lang == 'EN') ? 'thebad.website'              : 'lemauvais.site';
$youtube_link   = ($lang == 'EN') ? 'TheRealBadChannel'           : 'LeVraiBad';
$tiktok_link    = ($lang == 'EN') ? 'thebad.website'              : 'lemauvais.site';
$reddit_link    = ($lang == 'EN') ? 'thebadwebsite'               : 'lemauvaissite';
$lemmy_link     = ($lang == 'EN') ? 'lemmy.world/c/thebadwebsite' : 'jlai.lu/c/lemauvaissite';




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     FRONT END                                                     */
/*                                                                                                                   */
/*******************************************************************************/ include './../inc/header.inc.php'; ?>

<div class="width_50">

  <div>
    <img src="<?=$path?>img/website/socials_<?=$lang_lower?>.png" alt="thebad.website" title="thebad.website">
  </div>

  <div>
    <a href="https://discord.gg/XTd3qQKZqV" target="_blank">
      <img src="<?=$path?>img/banners/social/discord_<?=$lang_lower?>.png" alt="Discord" title="Discord">
    </a>
  </div>

  <div>
    <a href="https://www.instagram.com/<?=$instagram_link?>/" target="_blank">
      <img src="<?=$path?>img/banners/social/instagram_<?=$lang_lower?>.png" alt="Instagram" title="Instagram">
    </a>
  </div>

  <div>
    <a href="https://bsky.app/profile/<?=$bluesky_link?>" target="_blank">
      <img src="<?=$path?>img/banners/social/bluesky_<?=$lang_lower?>.png" alt="Bluesky" title="Bluesky">
    </a>
  </div>

  <div>
    <a href="https://www.reddit.com/r/<?=$reddit_link?>" target="_blank">
      <img src="<?=$path?>img/banners/social/reddit_<?=$lang_lower?>.png" alt="Reddit" title="Reddit">
    </a>
  </div>

  <div>
    <a href="https://<?=$lemmy_link?>" target="_blank">
      <img src="<?=$path?>img/banners/social/lemmy_<?=$lang_lower?>.png" alt="Lemmy" title="Lemmy">
    </a>
  </div>

  <div>
    <a href="https://www.youtube.com/@<?=$youtube_link?>" target="_blank">
      <img src="<?=$path?>img/banners/social/youtube_<?=$lang_lower?>.png" alt="YouTube" title="YouTube">
    </a>
  </div>

  <div>
    <a href="https://www.tiktok.com/@<?=$tiktok_link?>" target="_blank">
      <img src="<?=$path?>img/banners/social/tiktok_<?=$lang_lower?>.png" alt="TikTok" title="TikTok">
    </a>
  </div>

  <div>
    <a href="<?=$GLOBALS['website_url']?>rss" target="_blank">
      <img src="<?=$path?>img/banners/social/rss_<?=$lang_lower?>.png" alt="RSS" title="RSS">
    </a>
  </div>

  <div>
    <a href="https://nobleme.com/pages/social/irc" target="_blank">
      <img src="<?=$path?>img/banners/social/irc_<?=$lang_lower?>.png" alt="IRC" title="IRC">
    </a>
  </div>

  <div>
    <a href="https://hsnl.social/@Bad" target="_blank">
      <img src="<?=$path?>img/banners/social/mastodon_<?=$lang_lower?>.png" alt="Mastodon" title="Mastodon">
    </a>
  </div>

  <div>
    <a href="https://www.instagram.com/thebad.cats/" target="_blank">
      <img src="<?=$path?>img/banners/social/instagram2_<?=$lang_lower?>.png" alt="Instagram" title="Instagram">
    </a>
  </div>

  <div>
    <img src="<?=$path?>img/website/socials_nox_<?=$lang_lower?>.png" alt="thebad.website" title="thebad.website">
  </div>

  <div>
    <img src="<?=$path?>img/website/socials_language_<?=$lang_lower?>.png" alt="thebad.website" title="thebad.website">
  </div>

</div>

<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                    END OF PAGE                                                    */
/*                                                                                                                   */
/**********************************************************************************/ include './../inc/footer.inc.php';