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
___('comics_title_tag',     'EN', "Comic image - transcription in alt text");
___('comics_title_tag',     'FR', "Image du comic - transcription en alt text");
___('comics_description',   'EN', "About this comic");
___('comics_description',   'FR', "Au sujet de ce comic");
___('comics_youtube',       'EN', "Video version");
___('comics_youtube',       'FR', "Version vidéo");
___('comics_trans_button',  'EN', "Show image transcriptions");
___('comics_trans_button',  'FR', "Transcription des images");
___('comics_full_button',   'EN', "Fully assembled comic");
___('comics_full_button',   'FR', "Version assemblée du comic");
___('comics_old_button',    'EN', "Older version");
___('comics_old_button',    'FR', "Ancienne version");
___('comics_transcript',    'EN', "Image transcriptions");
___('comics_transcript',    'FR', "Transcription des images");


// Navigation
___('comics_nav_previous', 'EN', "Previous comic");
___('comics_nav_previous', 'FR', "Comic précédent");
___('comics_nav_next',     'EN', "Next comic");
___('comics_nav_next',     'FR', "Comic suivant");
___('comics_nav_random',   'EN', "Random comic");
___('comics_nav_random',   'FR', "Comic aléatoire");


// Socials
___('comics_socials_follow',    'EN', "Follow on socials");
___('comics_socials_follow',    'FR', "Suivre sur les réseaux");
___('comics_socials_bluesky',   'EN', "Bluesky");
___('comics_socials_bluesky',   'FR', "Bluesky");
___('comics_socials_instagram', 'EN', "Instagram");
___('comics_socials_instagram', 'FR', "Instagram");


// Comics list
___('comics_list_all',        'EN', "All comics");
___('comics_list_all',        'FR', "Tous les comics");
___('comics_list_search',     'EN', "Search comics");
___('comics_list_search',     'FR', "Rechercher des comics");
___('comics_list_new',        'EN', "Latest comic");
___('comics_list_new',        'FR', "Comic le plus récent");
___('comics_list_tags',       'EN', "Tags");
___('comics_list_tags',       'FR', "Tags");
___('comics_list_latest',     'EN', "Latest comics");
___('comics_list_latest',     'FR', "Comics récents");
___('comics_list_templates',  'EN', "Templates");
___('comics_list_templates',  'FR', "Modèles");


// Full comics list
___('comics_list_input',  'EN', "Type your search query here");
___('comics_list_input',  'FR', "Écrivez votre recherche ici");
___('comics_list_submit', 'EN', "Search the comics");
___('comics_list_submit', 'FR', "Rechercher");
___('comics_list_title',  'EN', "Title");
___('comics_list_title',  'FR', "Titre");
___('comics_list_type',   'EN', "Category");
___('comics_list_type',   'FR', "Catégorie");
___('comics_list_date',   'EN', "Published");
___('comics_list_date',   'FR', "Publié");
___('comics_list_count',  'EN', "{{1}} comic");
___('comics_list_count',  'FR', "{{1}} comic");
___('comics_list_count+', 'EN', "{{1}} comics");
___('comics_list_count+', 'FR', "{{1}} comics");


// Templates
___('comics_templates_desc', 'EN', <<<EOT
Below are a bunch of images that you can use to make your own memes.<br>
<br>
Feel free to use them however you like, without asking for permission, as long as you leave the website's credits/signature.<br>
<br>
Click on an image to see it in its full size.<br>
<br>
Confused by some of these images? It's part of the fun, you'll have to figure out how to use them properly!
EOT
);
___('comics_templates_desc', 'FR', <<<EOT
Ci-dessous, des images que vous pouvez utiliser pour faire vos propres memes.<br>
<br>
Utilisez-les comme vous le désirez, pas besoin de demander la permission, tant que vous laissez la signature du site.<br>
<br>
Cliquez sur une image pour la voir dans sa taille réelle.<br>
<br>
Certaines des images vous laissent perplexe ? Ça fait partie du fun, à vous de deviner comment les utiliser correctement !
EOT
);