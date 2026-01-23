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
___('comics_list_generator',  'EN', "Random smuggie generator");
___('comics_list_generator',  'FR', "Générateur d'arroganterie aléatoire");
___('comics_list_templates',  'EN', "Templates");
___('comics_list_templates',  'FR', "Modèles");
___('comics_list_emojis',     'EN', "Emojis");
___('comics_list_emojis',     'FR', "Emojis");
___('comics_list_merch',      'EN', "Merch");
___('comics_list_merch',      'FR', "Goodies");


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


// Random generator
___('comics_generator_generate', 'EN', "Click here to generate a new random smuggie");
___('comics_generator_generate', 'FR', "Cliquez ici pour générer une nouvelle arroganterie");
___('comics_generator_image',    'EN', "Randomly generated smuggie");
___('comics_generator_image',    'FR', "Arroganterie générée aléatoirement");
___('comics_generator_socials',  'EN', "Follow thebad.website on socials for more smuggies and other man made horrors");
___('comics_generator_socials',  'FR', "Suivez lemauvais.site pour voir de nouvelles arroganteries et d'autres horreurs inhumaines");
___('comics_generator_desc',     'EN', "Share this randomly generated comic with others by giving them this unique link:<br>
<a href=\"{{1}}\">{{1}}</a>");
___('comics_generator_desc',     'FR', "Pour partager ce comic aléatoirement généré, utilisez ce lien unique :<br>
<a href=\"{{1}}\">{{1}}</a>");


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


// Emojis
___('comics_emojis_desc', 'EN', <<<EOT
Below are a collection emojis. You are free to use any of them wherever you want.<br>
<br>
They are all shown twice: first as large images, then in a smaller emoji size.<br>
<br>
Click on any emoji to open it, which will make downloading it easier.
EOT
);
___('comics_emojis_desc', 'FR', <<<EOT
Ci-dessous, une collection d'emojis. Vous pouvez les utiliser où vous voulez.<br>
<br>
Ils sont tous listés deux fois : d'abord en grand, puis à la taille emoji.<br>
<br>
Cliquez sur un emoji pour l'ouvrir, ce qui le rendra plus facile à télécharger.
EOT
);




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                      STUFF                                                        */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Stuff list
___('stuff_list_header', 'EN', "More stuff? I thought this website was just comics!");
___('stuff_list_header', 'FR', "D'autres trucs ? Je pensais que ce site ne contenait que des comics !");




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                      MERCH                                                        */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Merch gallery
___('comics_merch_desc', 'EN', <<<EOT
The Bad Website's merch is currently not for sale.<br>
<br>
It's exclusive products only for Bad, friends, and family :)<br>
<br>
Who knows what the future holds though…<br>
<br>
The streets whisper a rumor that people who know me personally might get access to free merch every now and then. If you know me, maybe you should ask me about it.
EOT
);
___('comics_merch_desc', 'FR', <<<EOT
Les goodies du Mauvais Site ne sont pas disponibles à la vente<br>
<br>
Ils sont des produits exclusifs uniquement pour Bad, les amis, et la famille :)<br>
<br>
Mais qui sait de quoi le futur est fait...<br>
<br>
Les rues chuchottent une rumeur selon laquelle les gens qui me connaissent personnellement auraient accès à des goodies gratuits de temps en temps. Si vous me connaissez, peut-être devriez-vous me poser des questions à ce sujet.
EOT
);