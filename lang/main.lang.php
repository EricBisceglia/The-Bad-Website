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
/*                                                      VIDEOS                                                       */
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





/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                       ABOUT                                                       */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Intro image
___('about_comics_intro', 'EN', "The Bad Website FAQ");
___('about_comics_intro', 'FR', "FAQ du Mauvais Site");


// Art quality
___('about_quality_title',  'EN', "Why don't you get better at drawing?");
___('about_quality_title',  'FR', "Pourquoi ne pas apprendre à mieux dessiner ?");
___('about_quality_body_1', 'EN', <<<EOT
Believe it or not, I can actually draw pretty well.
EOT
);
___('about_quality_body_1', 'FR', <<<EOT
Croyez-le ou non, je sais dessiner.
EOT
);
___('about_quality_body_2', 'EN', <<<EOT
Using simple drawings forces me to focus on letting the humor, paneling, colors, and characters grab people's attention. It's a different way of storytelling.
EOT
);
___('about_quality_body_2', 'FR', <<<EOT
Utiliser des dessins simples me pousse à travailler sur l'humour, la mise en page, les couleurs, les personnages pour attirer l'attention des gens. C'est une façon différente de raconter des histoires.
EOT
);
___('about_quality_body_3', 'EN', <<<EOT
I call my comics "smuggies": their smug, simplistic style is part of the joke. There's humor in poorly drawn stick figures. It might not be to everyone's taste, and that's fine. You're allowed to dislike my art.
EOT
);
___('about_quality_body_3', 'FR', <<<EOT
J'appelle mes comics des « arroganteries », et leur style volontairement arrogant fait partie de la blague. Il y a quelque chose de drôle dans des personnages en bâtons dessinés à l'arrache. Ce n'est pas au goût de tout le monde, mais ce n'est pas grave. Vous avez le droit de ne pas aimer.
EOT
);


// Pastels
___('about_pastels_title',  'EN', "What's with the pastel colors?");
___('about_pastels_title',  'FR', "Pourquoi ces couleurs pastel ?");
___('about_pastels_body_1', 'EN', <<<EOT
I like them. They make me feel relaxed. It's that simple.
EOT
);
___('about_pastels_body_1', 'FR', <<<EOT
Je les aime bien. Elles me détendent. C'est aussi simple que ça.
EOT
);
___('about_pastels_body_2', 'EN', <<<EOT
Don't vibe with my pastels? That's okay. You're allowed to.
EOT
);
___('about_pastels_body_2', 'FR', <<<EOT
Vous n'accrochez pas ? Pas de souci, c'est la vie.
EOT
);


// Offended
___('about_offended_title',  'EN', "Why have you offended me?");
___('about_offended_title',  'FR', "Pourquoi m'avoir offensé ?");
___('about_offended_body_1', 'EN', <<<EOT
Whoops. This can happen.
EOT
);
___('about_offended_body_1', 'FR', <<<EOT
Oups. Ça arrive.
EOT
);
___('about_offended_body_2', 'EN', <<<EOT
Political satire means mocking opinions, and nobody likes being mocked. But if you look closely, you'll see I'm not mocking real people, just strawmen: exaggerated, over-the-top caricatures, so ridiculous that they don't represent real people anymore.
EOT
);
___('about_offended_body_2', 'FR', <<<EOT
La satire politique implique de se moquer des opinions, et personne n'aime ça. Mais essayez de vous détacher un peu de ce qui vous pose problème. Je ne me moque pas de vraies personnes, juste d'hommes de paille : des caricatures exagérées, tellement absurdes qu'elles en deviennent irréelles.
EOT
);
___('about_offended_body_3', 'EN', <<<EOT
I'm not here to laugh <span class="italics">at</span> people but <span class="italics">with</span> them. If one of my comics stings, take a step back and consider what's really being mocked. Most of the time, it's not you personnally, but rather some problematic ideas. If you agree with those problematic ideas... well, that's on you.
EOT
);
___('about_offended_body_3', 'FR', <<<EOT
Mon but n'est pas de rire <span class="italics">des</span> gens, mais de rire <span class="italics">avec</span> eux. Si un de mes comics vous pique, prenez du recul et demandez-vous ce qui est réellement parodié. En général, ce sont des idées très problématiques. Si vous partagez ces idées... en effet, vous êtes la cible. Tant pis.
EOT
);
___('about_offended_body_4', 'EN', <<<EOT
I also mock my own traits and opinions. If you're going to dish it out, you should be able to take it too. It's important to know how to laugh at yourself, and can turn into opportunities to reflect and grow.
EOT
);
___('about_offended_body_4', 'FR', <<<EOT
Beaucoup de mes comics se moquent aussi de mes propres travers et opinions. Si on veut frapper, il faut savoir encaisser. Mieux vaut en rire qu'en faire une affaire personnelle, ça peut même être des opportunités de réfléchir et de grandir.
EOT
);
___('about_offended_body_5', 'EN', <<<EOT
If my comics really offend you, that's fine. Keep in mind, nobody's forcing you to read them.
EOT
);
___('about_offended_body_5', 'FR', <<<EOT
Si mes comics vous semblent trop offensants pour être drôles, peut-être vaut-il mieux arrêter de les lire.
EOT
);


// Credits
___('about_credits_title',  'EN', "Who's behind this website?");
___('about_credits_title',  'FR', "Qui est derrière ce site ?");
___('about_credits_body_1', 'EN', <<<EOT
Hi, I'm Bad.
EOT
);
___('about_credits_body_1', 'FR', <<<EOT
Bonjour, je suis Bad.
EOT
);
___('about_credits_body_2', 'EN', <<<EOT
Yeah, that's why it's called the Bad Website.
EOT
);
___('about_credits_body_2', 'FR', <<<EOT
Oui, c'est pour ça que ça s'appelle le Mauvais Site.
EOT
);
___('about_credits_body_3', 'EN', <<<EOT
I'm just a guy, from France, who likes to draw stuff. You don't really need to know more than that. The comics will do the talking.
EOT
);
___('about_credits_body_3', 'FR', <<<EOT
Je suis juste un mec, de France, qui aime bien dessiner des trucs. Pas besoin d'en savoir plus à mon sujet. Les comics parleront à ma place.
EOT
);


// Follow
___('about_follow_title',  'EN', "How can I stay updated?");
___('about_follow_title',  'FR', "Comment rester à jour ?");
___('about_follow_body_1', 'EN', <<<EOT
Want to know when new comics drop? Hell yeah, that's awesome!
EOT
);
___('about_follow_body_1', 'FR', <<<EOT
Tu veux savoir quand de nouveaux comics sortent ? Super, j'adore !
EOT
);
___('about_follow_body_2', 'EN', <<<EOT
The only social media account dedicated to this website is <a href="https://bsky.app/profile/thebad.website" target="_blank">@thebad.website on Bluesky</a>. Follow it to stay updated. Reposting, sharing, and commenting on my comics makes me happy.
EOT
);
___('about_follow_body_2', 'FR', <<<EOT
Le seul réseau social où je poste pour ce site est <a href="https://bsky.app/profile/thebad.website" target="_blank">@thebad.website sur Bluesky</a>. Suis ce compte pour rester à jour. Reposter, partager et commenter mes comics me rend heureux.
EOT
);
___('about_follow_body_3', 'EN', <<<EOT
If you're oldschool enough to know how to use RSS, this website has <a href="./../rss" target="_blank">an feed for you</a>.
EOT
);
___('about_follow_body_3', 'FR', <<<EOT
Si tu es assez oldschool pour savoir utiliser un flux RSS, ce site <a href="./../rss_fr" target="_blank">en propose un</a>.
EOT
);
___('about_follow_body_4', 'EN', <<<EOT
I also share some comics on <a href="https://www.reddit.com/r/FranceDigeste/" target="_blank">r/francedigeste on Reddit</a> and the <a href="https://jlai.lu/" target="_blank">jlai.lu Lemmy community</a>.
EOT
);
___('about_follow_body_4', 'FR', <<<EOT
Je partage aussi certains comics sur <a href="https://www.reddit.com/r/FranceDigeste/" target="_blank">r/francedigeste sur Reddit</a> et sur la <a href="https://jlai.lu/" target="_blank">communauté Lemmy jlai.lu</a>.
EOT
);


// Talk
___('about_talk_title',  'EN', "Can I talk with you?");
___('about_talk_title',  'FR', "Est-ce qu'on peut discuter ?");
___('about_talk_body_1', 'EN', <<<EOT
Actually yeah, I love meeting new people!
EOT
);
___('about_talk_body_1', 'FR', <<<EOT
Carrément, j'adore rencontrer de nouvelles personnes !
EOT
);
___('about_talk_body_2', 'EN', <<<EOT
I don’t reply to most DMs on social media, but you can chat with me on <a href="https://nobleme.com/pages/social/discord" target="_blank">NoBleme's Discord server</a> and <a href="https://nobleme.com/pages/social/irc" target="_blank">NoBleme's IRC chat</a>.
EOT
);
___('about_talk_body_2', 'FR', <<<EOT
Je ne réponds pas à la plupart des messages privés sur les réseaux sociaux, mais on peut discuter sur <a href="https://nobleme.com/pages/social/discord" target="_blank">le serveur Discord de NoBleme</a> et <a href="https://nobleme.com/pages/social/irc" target="_blank">le chat IRC de NoBleme</a>.
EOT
);
___('about_talk_body_3', 'EN', <<<EOT
Talk to you soon!
EOT
);
___('about_talk_body_3', 'FR', <<<EOT
À bientôt !
EOT
);


// Merch
___('about_merch_title',  'EN', "Is there merch available?");
___('about_merch_title',  'FR', "Il y a des goodies disponibles ?");
___('about_merch_body_1', 'EN', <<<EOT
I've made myself some custom smug shirts, mugs, stickers, etc., and people keep asking if they can get their own.
EOT
);
___('about_merch_body_1', 'FR', <<<EOT
Je me suis fait des t-shirts, mugs, stickers, etc., avec mes designs arrogants, et les gens qui les ont vus en veulent pour eux aussi.
EOT
);
___('about_merch_body_2', 'EN', <<<EOT
For now, the answer is no. There's no merch available for purchase.
EOT
);
___('about_merch_body_2', 'FR', <<<EOT
Pour l'instant, la réponse est non. Il n'y a rien en vente.
EOT
);
___('about_merch_body_3', 'EN', <<<EOT
But who knows what might happen in the future...
EOT
);
___('about_merch_body_3', 'FR', <<<EOT
Mais qui sait ce que l'avenir nous réserve...
EOT
);