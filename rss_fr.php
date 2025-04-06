<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './inc/includes.inc.php';   # Core
include_once './actions/comics.act.php'; # Comic management
include_once './lang/comics.lang.php';   # Admin translations

// Page summary
$page_url       = "rss_fr";
$page_title_en  = "RSS feed";
$page_title_fr  = "Flux RSS";




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get the list of comics

$comics_list = comics_list( sort_by:    'date'  ,
                            is_public:  true    ,
                            is_major:   true    );




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Generate the RSS feed

header('Content-Type: application/rss+xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<rss version="2.0">
  <channel>
    <title>Le Mauvais Site</title>
    <link>https://lemauvais.site</link>
    <description>Comics satiriques issus du Mauvais Site</description>
    <language>fr-fr</language>

    <?php for($i = 0; $i < $comics_list['rows']; $i++): ?>
    <?php if($i < 25): ?>
    <item>
      <title><?=htmlspecialchars($comics_list[$i]['title_fr'])?></title>
      <link><?=htmlspecialchars($comics_list[$i]['url'])?></link>
      <description><?=htmlspecialchars($comics_list[$i]['desc_fr'])?></description>
      <pubDate><?=htmlspecialchars($comics_list[$i]['date'])?></pubDate>
    </item>
    <?php endif; ?>
    <?php endfor; ?>

  </channel>
</rss>