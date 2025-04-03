<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic management

// Get the optional parameter
$exclude = form_fetch_element('exclude', request_type: 'GET', default_value: '');

// Get a random comic
$comic_slug = comics_get_random_slug( exclude_slug: $exclude );

// Stop here if there is no comic
if(!$comic_slug)
  exit(header("Location: ".$path."404"));

// Redirect to the random comic
exit(header("Location: ".$path."comic/".$comic_slug));