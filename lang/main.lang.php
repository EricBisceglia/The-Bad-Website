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
___('home_comics_socials', 'EN', <<<EOT
Damn I wish I could follow this cool website… Good news! The Bad Website posts updates to a bunch of a different socials, including some exclusive content! Click me to see the list fo places where you can stay updated.
EOT
);
___('home_comics_socials', 'FR', <<<EOT
J'aimerais trop pouvoir suivre le contenu de ce site… Bonne nouvelle ! Le mauvais site poste ses contenus sur plusieurs médias sociaux, en plus de contenus exclusifs ! Clique moi pour voir la liste des plateformes où tu peux le suivre.
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
___('about_quality_title',  'EN', "Why don't you draw better?");
___('about_quality_title',  'FR', "Pourquoi ne pas dessiner mieux ?");
___('about_quality_body_1', 'EN', <<<EOT
As you might have seen from my other projects, I can drew decently well.
EOT
);
___('about_quality_body_1', 'FR', <<<EOT
Comme vous avez pu le voir via mes autres projets, je sais dessiner plutôt correctement.
EOT
);
___('about_quality_body_2', 'EN', <<<EOT
Using simple drawings forces me to focus on letting the humor, paneling, colors, and characters grab people's attention.
EOT
);
___('about_quality_body_2', 'FR', <<<EOT
Utiliser des dessins simples me force à travailler sur l'humour, la mise en page, les couleurs, les personnages pour attirer l'attention des gens.
EOT
);
___('about_quality_body_3', 'EN', <<<EOT
The simplistic style is part of the joke. There's humor in poorly drawn stick figures. It might not be to everyone's taste, and that's fine. You're allowed to dislike my art.
EOT
);
___('about_quality_body_3', 'FR', <<<EOT
Le style fait partie de la blague. Il y a quelque chose de drôle dans des personnages en bâtons dessinés à l'arrache. Ce n'est pas au goût de tout le monde, mais ce n'est pas grave. Vous avez le droit de ne pas aimer.
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
I'm not here to laugh <span class="italics">at</span> people but <span class="italics">with</span> them. If one of my comics stings, take a step back and consider what's really being mocked. Most of the time, it's not you personally, but rather some problematic ideas. If you agree with those problematic ideas... well, that's on you.
EOT
);
___('about_offended_body_2', 'FR', <<<EOT
Mon but n'est pas de rire <span class="italics">des</span> gens, mais de rire <span class="italics">avec</span> eux. Si un de mes comics vous pique, prenez du recul et demandez-vous ce qui est réellement parodié. En général, ce sont des idées très problématiques. Si vous partagez ces idées... en effet, vous êtes la cible.
EOT
);
___('about_offended_body_3', 'EN', <<<EOT
I also mock my own traits and opinions. If you're going to dish it out, you should be able to take it too. It's important to know how to laugh at yourself, and can turn into opportunities to reflect and grow.
EOT
);
___('about_offended_body_3', 'FR', <<<EOT
Beaucoup de mes comics se moquent aussi de mes propres travers et opinions. Si on veut frapper, il faut savoir encaisser. Mieux vaut en rire qu'en faire une affaire personnelle, ça peut même être des opportunités de réfléchir et de grandir.
EOT
);
___('about_offended_body_4', 'EN', <<<EOT
If my comics really offend you, that's fine. Keep in mind, nobody's forcing you to read them.
EOT
);
___('about_offended_body_4', 'FR', <<<EOT
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
I'm just a guy, from France, who likes to draw stuff.
EOT
);
___('about_credits_body_3', 'FR', <<<EOT
Je suis juste un mec, de France, qui aime bien dessiner des trucs.
EOT
);
___('about_credits_body_4', 'EN', <<<EOT
You don't really need to know more than that.
EOT
);
___('about_credits_body_4', 'FR', <<<EOT
Pas besoin d'en savoir plus à mon sujet.
EOT
);


// Reuse
___('about_reuse_title',  'EN', "Can I share / reuse your art?");
___('about_reuse_title',  'FR', "Puis-je partager / réutiliser ton art ?");
___('about_reuse_body_1', 'EN', <<<EOT
Of course! Art is meant to be shared, screw people and corporations who think otherwise.
EOT
);
___('about_reuse_body_1', 'FR', <<<EOT
Bien sûr ! L'art est fait pour être partagé, merde aux gens et entreprises qui pensent le contraire.
EOT
);
___('about_reuse_body_2', 'EN', <<<EOT
You can share my comics, use my characters, steal my jokes, and best of all, you don't even need to ask for permission. Have fun.
EOT
);
___('about_reuse_body_2', 'FR', <<<EOT
Vous pouvez partager mes comics, utiliser mes personnages, voler mes blagues... et le meilleur dans tout ça, c'est que vous n'avez même pas besoin de demander la permission. Faites-vous plaisir.
EOT
);
___('about_reuse_body_3', 'EN', <<<EOT
The only restriction is that you can't use them in commercial projects without my explicit permission. Any revenue generated from The Bad Website's intellectual property would violate intellectual property laws and may result in legal action.
EOT
);
___('about_reuse_body_3', 'FR', <<<EOT
La seule restriction est que vous ne pouvez pas les utiliser dans un projet commercial sans mon accord explicite. Tout revenu généré en exploitant la propriété intellectuelle du Mauvais Site constituerait une violation des lois sur la propriété intellectuelle et pourrait entraîner des poursuites judiciaires.
EOT
);


// Follow
___('about_follow_title',  'EN', "How can I stay updated?");
___('about_follow_title',  'FR', "Comment rester à jour ?");
___('about_follow_body_1', 'EN', <<<EOT
You can follow thebad.website <a href="./socials" target="_blank">on various social media platforms</a>.
EOT
);
___('about_follow_body_1', 'FR', <<<EOT
Vous pouvez suivre lemauvais.site <a href="./socials" target="_blank">via plusieurs médias sociaux</a>.
EOT
);
___('about_follow_body_2Bienvenue aux USA nous avons des mouvements de gauchistes variés:', 'EN', <<<EOT
I don't do any promotion or marketing, so following, liking, sharing my content does a lot to help me.
EOT
);
___('about_follow_body_2Bienvenue aux USA nous avons des mouvements de gauchistes variés:', 'FR', <<<EOT
Je ne fais pas de promotion ni de marketing, donc suivre, liker, partager mes contenus m'aide énormément.
EOT
);


// Talk
___('about_talk_title',  'EN', "Can I talk with you?");
___('about_talk_title',  'FR', "Est-ce qu'on peut discuter ?");
___('about_talk_body_1', 'EN', <<<EOT
Sure.
EOT
);
___('about_talk_body_1', 'FR', <<<EOT
Bien sûr.
EOT
);
___('about_talk_body_2', 'EN', <<<EOT
You can chat with me on <a href="https://nobleme.com/pages/social/discord" target="_blank">NoBleme's Discord server</a> and <a href="https://nobleme.com/pages/social/irc" target="_blank">NoBleme's IRC chat</a>.
EOT
);
___('about_talk_body_2', 'FR', <<<EOT
On peut discuter sur <a href="https://nobleme.com/pages/social/discord" target="_blank">le serveur Discord de NoBleme</a> et <a href="https://nobleme.com/pages/social/irc" target="_blank">le chat IRC de NoBleme</a>.
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
For now, the answer is no. There's no merch available for purchase.
EOT
);
___('about_merch_body_1', 'FR', <<<EOT
Pour l'instant, la réponse est non. Il n'y a rien en vente.
EOT
);
___('about_merch_body_2', 'EN', <<<EOT
But who knows what might happen in the future...
EOT
);
___('about_merch_body_2', 'FR', <<<EOT
Mais qui sait ce que l'avenir nous réserve...
EOT
);


// Source
___('about_source_title',  'EN', "Cool website, did you make it yourself?");
___('about_source_title',  'FR', "Ce site est cool, tu l'as fait toi-même ?");
___('about_source_body_1', 'EN', <<<EOT
Yep, it's all hand crafted.
EOT
);
___('about_source_body_1', 'FR', <<<EOT
Oui, tout est fait à la main.
EOT
);
___('about_source_body_2', 'EN', <<<EOT
If you're curious, the source code is open sourced and <a href="https://github.com/EricBisceglia/The-Bad-Website" target="_blank">publicly available on GitHub</a>.
EOT
);
___('about_source_body_2', 'FR', <<<EOT
Si ça vous dit de voir le code source, il est open source et <a href="https://github.com/EricBisceglia/The-Bad-Website" target="_blank">disponible publiquement sur GitHub</a>.
EOT
);


// Cookies
___('about_cookies_title',  'EN', "Why wasn't I asked to accept cookies?");
___('about_cookies_title',  'FR', "Pourquoi le site ne m'a-t-il pas demandé d'accepter des cookies ?");
___('about_cookies_body_1', 'EN', <<<EOT
Because this is just a simple website full of silly pastel drawings. There's no need to track you, serve you ads, or sell your data to third parties. Since no personal data is being collected, there's nothing you need to consent to.
EOT
);
___('about_cookies_body_1', 'FR', <<<EOT
Parce que ce n'est qu'un simple site rempli de dessins pastels idiots. Il n'y a aucune raison de traquer vos données, de vous afficher des publicités ou de les vendre à des tiers. Puisque vos données personnelles ne sont pas collectées, vous n'avez rien à accepter.
EOT
);
___('about_cookies_body_2', 'EN', <<<EOT
Maybe you should start asking why other websites need your personal data. Just saying.
EOT
);
___('about_cookies_body_2', 'FR', <<<EOT
Vous devriez vous demander pourquoi les autres sites réclament vos données personnelles.
EOT
);




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                   LEGAL NOTICE                                                    */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Legal notice
___('legal_notice_title',   'EN', "Legal notice / Privacy policy");
___('legal_notice_title',   'FR', "Mentions légales / Politique de confidentialité");
___('legal_notice_body_1',  'EN', <<<EOT
This website does not collect any personal data.
EOT
);
___('legal_notice_body_1',  'FR', <<<EOT
Ce site ne collecte aucune donnée personnelle.
EOT
);
___('legal_notice_body_2',  'EN', <<<EOT
Everything here is custom-made and handcrafted. No third-party scripts or services are used, and your personal data is not shared with anyone. You can verify this by checking the website's <a href="https://github.com/EricBisceglia/The-Bad-Website" target="_blank">source code</a>, which is open-source and publicly available.
EOT
);
___('legal_notice_body_2',  'FR', <<<EOT
Tout son contenu est entièrement fait main et sur mesure. Aucun script ni service tiers n'est utilisé. Aucune donnée personnelle n'est collectée ni partagée. Vous pouvez le vérifier en consultant le <a href="https://github.com/EricBisceglia/The-Bad-Website" target="_blank">code source</a> du site, qui est public.
EOT
);
___('legal_notice_body_3',  'EN', <<<EOT
That's why you weren't asked to accept cookies or a user agreement like on most other websites. Just enjoy the colors!
EOT
);
___('legal_notice_body_3',  'FR', <<<EOT
C'est pourquoi vous n'avez pas eu à accepter de cookies ou de contrat utilisateur, contrairement à la plupart des autres sites Internet. Profitez-en !
EOT
);




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                               INTELLECTUAL PROPERTY                                               */
/*                                                                                                                   */
/*********************************************************************************************************************/

// IP
___('intellectual_property_title',   'EN', "Intellectual property");
___('intellectual_property_title',   'FR', "Propriété intellectuelle");
___('intellectual_property_body_1',  'EN', <<<EOT
The Bad Website, its characters, comics, and smug humor are all original creations and the intellectual property of Éric Bisceglia, aka Bad.
EOT
);
___('intellectual_property_body_1',  'FR', <<<EOT
The Bad Website, alias Le Mauvais Site, ainsi que ses personnages, ses comics et son humour arrogant sont des créations originales et la propriété intellectuelle d'Éric Bisceglia, alias Bad.
EOT
);
___('intellectual_property_body_2',  'EN', <<<EOT
You are free to reuse The Bad Website's characters, comics, and smug humor however you like, without asking for permission and without crediting the source or author (though I'd appreciate it). The only restriction is that you cannot use them in commercial projects without explicit permission. Any revenue generated from The Bad Website's intellectual property would violate intellectual property laws and may result in legal action.
EOT
);
___('intellectual_property_body_2',  'FR', <<<EOT
Vous êtes libre de réutiliser les personnages, l'art, et l'humour arrogant du Mauvais Site à volonté, sans demander la permission, sans créditer l'auteur ou la source (même si cela serait apprécié). La seule restriction est que vous ne pouvez pas les utiliser dans un projet commercial sans permission explicite. Tout revenu généré en exploitant la propriété intellectuelle du Mauvais Site constituerait une violation des lois sur la propriété intellectuelle et pourrait entraîner des poursuites judiciaires.
EOT
);
___('intellectual_property_body_3',  'EN', <<<EOT
Most of The Bad Website's comics use the <a href="https://en.wikipedia.org/wiki/Segoe" target="_blank">Segoe UI font family</a>, a registered trademark of Microsoft.
EOT
);
___('intellectual_property_body_3',  'FR', <<<EOT
La plupart des comics du Mauvais Site utilisent la police <a href="https://en.wikipedia.org/wiki/Segoe" target="_blank">Segoe UI</a>, une marque détenue par Microsoft.
EOT
);
___('intellectual_property_body_4',  'EN', <<<EOT
The (hidden) admin panel of the website uses <a href="https://feathericons.com/" target="_blank">Feather icons</a>, created by Cole Bemis. Thanks Cole, you're awesome.
EOT
);
___('intellectual_property_body_4',  'FR', <<<EOT
Le panneau d'administration (caché) utilise <a href="https://feathericons.com/" target="_blank">Feather icons</a>, crée par Cole Bemis. Merci Cole, tu déchires.
EOT
);
___('intellectual_property_body_5',  'EN', <<<EOT
© The Bad Website / Éric Bisceglia 2025 - {{1}}
EOT
);
___('intellectual_property_body_5',  'FR', <<<EOT
© The Bad Website / Éric Bisceglia 2025 - {{1}}
EOT
);