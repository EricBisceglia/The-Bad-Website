<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*  sitemap_generate          Generates or regenerates the sitemap.xml file.                                         */
/*  sitemap_add_page          Generates data to add to the sitemap.xml file.                                         */
/*                                                                                                                   */
/*********************************************************************************************************************/

function sitemap_generate()
{
  // Prepare the sitemap's header
  $sitemap  = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
  $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

  // Static pages
  $sitemap .= sitemap_add_page('', 'monthly', '1.0');
  $sitemap .= sitemap_add_page('about/copyright', 'monthly', '0.3');
  $sitemap .= sitemap_add_page('about/faq', 'monthly', '0.7');
  $sitemap .= sitemap_add_page('about/legal', 'monthly', '0.4');
  $sitemap .= sitemap_add_page('about/socials', 'monthly', '0.8');
  $sitemap .= sitemap_add_page('comics/all', 'daily', '0.5');
  $sitemap .= sitemap_add_page('comics/list', 'daily', '1.0');
  $sitemap .= sitemap_add_page('comics/tags', 'weekly', '0.6');
  $sitemap .= sitemap_add_page('memes/templates', 'weekly', '0.7');
  $sitemap .= sitemap_add_page('rss', 'daily', '0.5');

  // Categories
  $categories = comic_types_list();
  for($i = 0; $i < $categories['rows']; $i++)
    $sitemap .= sitemap_add_page('category/'.$categories[$i]['slug'], 'daily', '0.5');

  // Tags
  $tags = tags_list();
  for($i = 0; $i < $tags['rows']; $i++)
    $sitemap .= sitemap_add_page('tag/'.$tags[$i]['name'], 'daily', '0.5');

  // Comics
  $comics = comics_list(sort_by: 'date', is_public: true);
  for($i = 0; $i < $comics['rows']; $i++)
    $sitemap .= sitemap_add_page('comic/'.$comics[$i]['slug'], 'monthly', '0.5');

  // Close the sitemap
  $sitemap .= '</urlset>';

  // Delete the sitemap if it currently exists
  if(file_exists(root_path().'sitemap.xml'))
    unlink(root_path().'sitemap.xml');

  // Replace it with the updated sitemap
  file_put_contents(root_path().'sitemap.xml', $sitemap);
}



/**
 * Generates data to add to the sitemap.xml file.
 *
 * @param   string  $page_url           The page's url.
 * @param   string  $update_frequency   The page's update frequency.
 * @param   string  $priority           The page's priority.
 *
 * @return  string                      The assembled string, ready to be added to the sitemap.xml file.
 */

function sitemap_add_page( string $page_url           ,
                           string $update_frequency   ,
                           string $priority           ) : string
{
  // Assemble the data
  $page  = '  <url>'."\n";
  $page .= '    <loc>'.$GLOBALS['website_url'].$page_url.'</loc>'."\n";
  $page .= '    <lastmod>'.date('Y-m-d').'</lastmod>'."\n";
  $page .= '    <changefreq>'.$update_frequency.'</changefreq>'."\n";
  $page .= '    <priority>'.$priority.'</priority>'."\n";
  $page .= '  </url>'."\n";

  // Return the assembled data
  return $page;
}