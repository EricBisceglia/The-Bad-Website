<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     HOMEPAGE                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Header
___('home_intro_title', 'EN', "The Bad Website");
___('home_intro_title', 'FR', "Le mauvais site");
___('home_intro_text',  'EN', "Come back in a few weeks :)");
___('home_intro_text',  'FR', "Revenez dans quelques semaines :)");
___('home_intro_bsky',  'EN', "In the meantime, you can find my smuggies <span class=\"text_blue\">on Bluesky</span>");
___('home_intro_bsky',  'FR', "En attendant, vous pouvez trouver mes arroganteries <span class=\"text_blue\">sur Bluesky</span>");


// Mini comics
___('home_comics_intro', 'EN', <<<EOT
Hi there!
Seems like you took a wrong turn why browsing the Internet
This place is the Bad Website
EOT
);
___('home_comics_intro', 'FR', <<<EOT
Salut !
On dirait que tu as pris un mauvais virage en naviguant sur Internet
Tu es tombé sur le Mauvais Site
EOT
);
___('home_comics_satire', 'EN', <<<EOT
Hey you... yes you there...
Just as a warning, we were browsing this website and we are APPALLED
It seems to be full of crudely drawn societal and political satire
EOT
);
___('home_comics_satire', 'FR', <<<EOT
Hey toi... oui toi là...
Je te préviens, nous avons visité ce site et nous sommes OUTRÉS
Il semble être rempli de satire sociétal et politique mal dessiné
EOT
);
___('home_comics_questions', 'EN', <<<EOT
I have so many questions...
This website looks so silly
Click me an let's go find some answers
EOT
);
___('home_comics_questions', 'FR', <<<EOT
J'ai beaucoup de questions
Ce site a l'air complètement con
Clique-moi et allons trouver des réponses
EOT
);
___('home_comics_comics', 'EN', <<<EOT
What a joy!
This website is full of comics!
Click me to see the comics
EOT
);
___('home_comics_comics', 'FR', <<<EOT
Quelle joie !
Ce site est rempli de comics !
Clique-moi et allons voir les comics
EOT
);
___('home_comics_language', 'EN', <<<EOT
Erm... did you notice you can change the language between English and French by clicking the flag on the top right of the page? Neat.
EOT
);
___('home_comics_language', 'FR', <<<EOT
Euh... as-tu remarqué que tu peux changer la langue entre le français et l'anglais en cliquant sur le drapeau en haut à droite de la page ? Cool.
EOT
);
___('home_comics_bluesky', 'EN', <<<EOT
Click me and follow me to stay updated, I'm @thebad.website on Bluesky
EOT
);
___('home_comics_bluesky', 'FR', <<<EOT
Clique-moi et suis-moi pour rester à jour, je suis @thebad.website sur Bluesky
EOT
);
___('home_comics_rss', 'EN', <<<EOT
Or maybe you're more oldschool? Cilck me if you'd like an RSS feed
EOT
);
___('home_comics_rss', 'FR', <<<EOT
Es-tu une personne à l'ancienne ? Clique-moi pour avoir un flux RSS !
EOT
);




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                     VIDEOS                                                        */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Mini comics
___('videos_comics_intro', 'EN', <<<EOT
Videos?
What do you mean videos?
There's clearly no such thing on this website, you've been misled
EOT
);
___('videos_comics_intro', 'FR', <<<EOT
Des vidéos ?
Comment ça des vidéos ?
Il n'y en a pas sur ce site, on vous a donné des fausses informations
EOT
);
___('videos_comics_future', 'EN', <<<EOT
This page is probably there for a reason though... how ominous!
EOT
);
___('videos_comics_future', 'FR', <<<EOT
Mais cette page doit bien avoir une raison d'exister... c'est suspect !
EOT
);