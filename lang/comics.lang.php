<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                      COMICS                                                       */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Description
___('comics_description', 'EN', "About this comic");
___('comics_description', 'FR', "Au sujet de ce comic");
___('comics_transcript',  'EN', "Image transcriptions");
___('comics_transcript',  'FR', "Transcription des images");


// Navigation
___('comics_nav_previous', 'EN', "Previous comic");
___('comics_nav_previous', 'FR', "Comic précédent");
___('comics_nav_next',     'EN', "Next comic");
___('comics_nav_next',     'FR', "Comic suivant");
___('comics_nav_random',   'EN', "Random comic");
___('comics_nav_random',   'FR', "Comic aléatoire");


// Comics list
___('comics_list_all',        'EN', "All comics");
___('comics_list_all',        'FR', "Tous les comics");
___('comics_list_search',     'EN', "Search comics");
___('comics_list_search',     'FR', "Rechercher des comics");
___('comics_list_categories', 'EN', "Categories");
___('comics_list_categories', 'FR', "Catégories");
___('comics_list_tags',       'EN', "Tags");
___('comics_list_tags',       'FR', "Tags");