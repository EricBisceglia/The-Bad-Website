<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                                       SETUP                                                       */
/*                                                                                                                   */
// File inclusions /**************************************************************************************************/
include_once './../inc/includes.inc.php';   # Core
include_once './../actions/comics.act.php'; # Comic management

// Get a random comic
$comic_slug = comics_get_random_slug();

// Stop here if there is no comic
if(!$comic_slug)
  exit(header("Location: ".$path."404"));

// Redirect to the random comic
exit(header("Location: ".$path."comic/".$comic_slug));