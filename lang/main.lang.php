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
[a character waves and smiles]
Hi there!
Seems like you took a wrong turn while browsing the Internet.
This place is the Bad Website!
EOT
);
___('home_comics_intro', 'FR', <<<EOT
[un personnage nous salue en souriant]
Salut !
Tu as du te perdre bien fort sur Internet pour arriver ici…
…c'est le Mauvais Site !
EOT
);
___('home_comics_satire', 'EN', <<<EOT
[a crowd of characters seem uneasy]
Hey you... yes you there...
Be warned, we were browsing this website and we are APPALLED!
It seems to be full of political satire, some of which is quite offensive!
EOT
);
___('home_comics_satire', 'FR', <<<EOT
[une foule de personnages ont l'air gênés]
Hé toi… oui toi là !
Je te préviens, après avoir visité ce site nous sommes OUTRÉS !
Il semble être rempli de satire politique, parfois très offensant !
EOT
);
___('home_comics_questions', 'EN', <<<EOT
[a character frowns]
This place looks silly.
I have questions.
Click me, let's go find some answers.
EOT
);
___('home_comics_questions', 'FR', <<<EOT
[un personnage mécontent croise les bras]
Ce site a l'air bizarre.
J'ai plein de questions.
Clique-moi, allons trouver des réponses.
EOT
);
___('home_comics_comics', 'EN', <<<EOT
[a character seems quite happy]
Satire you say?
Awesome!
Click me, let's go read some comics!
EOT
);
___('home_comics_comics', 'FR', <<<EOT
[un personnage radie de joie]
Tu as dit satire ?
Trop bien !
Clique-moi, allons lire des comics.
EOT
);
___('home_comics_language', 'EN', <<<EOT
[a nerdy character goes on a rant]
Erm... did you notice you can change the language between English and French by clicking the flag on the top right of the page?
That's Neat.
EOT
);
___('home_comics_language', 'FR', <<<EOT
[un personnage à lunettes parle]
Hmm... as-tu remarqué que tu peux changer la langue entre français et anglais en cliquant sur le drapeau en haut de la page ? C'est cool.
EOT
);
___('home_comics_socials', 'EN', <<<EOT
[a character seems lost]
Damn I wish I could follow this cool website…
[another character answers]
Good news! The Bad Website posts updates to a bunch of a different social platforms.
Click me to see the list of places you can follow to stay updated.
EOT
);
___('home_comics_socials', 'FR', <<<EOT
[un personnage a l'air perdu]
Si seulement je pouvais suivre ce site…
[un autre personnage lui répond]
Bonne nouvelle ! Le Mauvais Site partage ses contenus sur plusieurs plateformes sociales !
Clique-moi pour voir la liste des plateformes où tu peux le suivre.
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
___('about_quality_title',  'EN', "Why do you draw stickmen?");
___('about_quality_title',  'FR', "Pourquoi dessiner des personnages en bâtons ?");
___('about_quality_body_1', 'EN', <<<EOT
I can draw more "seriously", but sticking to simple drawings forces me to focus on letting the satire, paneling, colors, and humor grab people's attention.
EOT
);
___('about_quality_body_1', 'FR', <<<EOT
Je pourrais dessiner plus "sérieusement", mais faire des dessins simples me force à travailler sur la satire, la mise en page, les couleurs et l'humour pour attirer l'attention des gens.
EOT
);
___('about_quality_body_2', 'EN', <<<EOT
The simplistic style is part of the joke. There's humor in silly stick figures.
EOT
);
___('about_quality_body_2', 'FR', <<<EOT
Le style fait partie de la blague : il y a une forme d'humour particulière inhérente aux personnages en bâton.
EOT
);


// Pastels
___('about_pastels_title',  'EN', "What's with the pastel colors?");
___('about_pastels_title',  'FR', "Pourquoi ces couleurs pastel ?");
___('about_pastels_body_1', 'EN', <<<EOT
I like them.
EOT
);
___('about_pastels_body_1', 'FR', <<<EOT
Je les aime bien.
EOT
);
___('about_pastels_body_2', 'EN', <<<EOT
It's that simple.
EOT
);
___('about_pastels_body_2', 'FR', <<<EOT
C'est aussi simple que ça.
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
I'm not here to laugh <span class="italics">at</span> people, but <span class="italics">with</span> them. If one of my comics stings, take a step back and consider what's really being satirized. Most of the time, it's not about you personally, but rather about some problematic ideas. If you happen to agree with those problematic ideas... well, you're meant to be offended.
EOT
);
___('about_offended_body_2', 'FR', <<<EOT
Mon but n'est pas de rire <span class="italics">des</span> gens, mais de rire <span class="italics">avec</span> eux. Si un de mes comics vous pique, prenez du recul et demandez-vous ce qui est réellement satirisé. En général, ce sont des idées problématiques. Si vous partagez ces idées... en effet, c'est normal que ça vous offense.
EOT
);
___('about_offended_body_3', 'EN', <<<EOT
Keep in mind I also mock my own traits and opinions. If you're going to dish it out, you should be able to take it too. It's important to know how to laugh at yourself.
EOT
);
___('about_offended_body_3', 'FR', <<<EOT
Certains de mes comics se moquent aussi de mes propres travers et opinions. Si on veut frapper, il faut savoir encaisser. Mieux vaut en rire qu'en faire une affaire personnelle.
EOT
);
___('about_offended_body_4', 'EN', <<<EOT
If my comics really do offend you, remember that nobody's forcing you to keep reading them.
EOT
);
___('about_offended_body_4', 'FR', <<<EOT
Si mes comics vous offensent fort, n'oubliez pas que personne ne vous oblige à continuer à les lire.
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
Oui, c'est pour ça que ça s'appelle The Bad Website, soit en français Le Mauvais Site.
EOT
);
___('about_credits_body_3', 'EN', <<<EOT
I'm just a french guy who likes to draw silly things.
EOT
);
___('about_credits_body_3', 'FR', <<<EOT
Je suis juste un gars qui aime bien dessiner des conneries.
EOT
);
___('about_credits_body_4', 'EN', <<<EOT
You don't need to know more than that about me.
EOT
);
___('about_credits_body_4', 'FR', <<<EOT
Vous n'avez pas besoin d'en savoir plus à mon sujet.
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
You can share my comics, use my characters, steal my jokes, and best of all, you don't even need to ask for permission. Please keep the signature / website name on any images you modify whenever possible.
EOT
);
___('about_reuse_body_2', 'FR', <<<EOT
Vous pouvez partager mes comics, utiliser mes personnages, voler mes blagues, sans demander la permission. Merci de garder la signature / le nom du site sur les images que vous modifiez lorsque c'est possible.
EOT
);
___('about_reuse_body_3', 'EN', <<<EOT
The only restriction is that you can't use them in commercial projects or in advertisements without my explicit permission. Revenue generated using The Bad Website's content without discussing it with me first may result in legal action.
EOT
);
___('about_reuse_body_3', 'FR', <<<EOT
La seule restriction est que vous ne pouvez pas les utiliser dans un projet commercial ou dans une publicité sans mon accord explicite. Tout revenu généré en exploitant les contenus du Mauvais Site sans m'avoir consulté préalablement pourrait entraîner des poursuites judiciaires.
EOT
);


// Follow
___('about_follow_title',  'EN', "How can I stay updated?");
___('about_follow_title',  'FR', "Comment rester à jour ?");
___('about_follow_body_1', 'EN', <<<EOT
You can follow thebad.website on several social media platforms: <a href="./socials" target="_blank">click here for a list of platforms</a>.
EOT
);
___('about_follow_body_1', 'FR', <<<EOT
Vous pouvez suivre lemauvais.site sur plusieurs médias sociaux : <a href="./socials" target="_blank">cliquez ici pour une liste de plateformes</a>.
EOT
);
___('about_follow_body_2', 'EN', <<<EOT
I don't do any promotion or marketing, so following, liking, sharing my content does a lot to help me.
EOT
);
___('about_follow_body_2', 'FR', <<<EOT
Je ne fais pas de promotion ni de marketing, donc suivre, liker, partager mes contenus m'aide énormément.
EOT
);


// Talk
___('about_talk_title',  'EN', "Can I talk with you?");
___('about_talk_title',  'FR', "Est-ce qu'on peut discuter ?");
___('about_talk_body_1', 'EN', <<<EOT
Sure, you can chat with me <a href="https://discord.gg/XTd3qQKZqV" target="_blank">on Discord</a>.
EOT
);
___('about_talk_body_1', 'FR', <<<EOT
Oui, on peut discuter <a href="https://discord.gg/XTd3qQKZqV" target="_blank">sur Discord</a>
EOT
);
___('about_talk_body_2', 'EN', <<<EOT
Talk to you soon!
EOT
);
___('about_talk_body_2', 'FR', <<<EOT
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


// Commissions
___('about_commissions_title',  'EN', "Do you do drawings on request?");
___('about_commissions_title',  'FR', "Fais-tu des dessins sur demande ?");
___('about_commissions_body_1', 'EN', <<<EOT
Got ideas for a fun comic, a new meme template, or any other cool thing you'd like me to draw? Suggest it <a href="https://discord.gg/XTd3qQKZqV" target="_blank">on Discord</a> or <a href="https://thebad.website/about/socials">other socials</a>, and I might do it (and credit you!).
EOT
);
___('about_commissions_body_1', 'FR', <<<EOT
Tu as des idées pour un comic rigolo, un nouveau modèle de meme, ou d'autres trucs cool que tu voudrais que je dessine ? Tu peux me les suggérer <a href="https://discord.gg/XTd3qQKZqV" target="_blank">sur Discord</a> ou <a href="https://thebad.website/about/socials">un réseau social</a>, et peut-être que je le ferai (et te créditerai !).
EOT
);
___('about_commissions_body_2', 'EN', <<<EOT
If you're looking for a more serious (paid) commission, contact me and we'll discuss it privately.
EOT
);
___('about_commissions_body_2', 'FR', <<<EOT
Si tu veux me passer commande d'un dessin plus sérieux (payant), contacte-moi, discutons-en en privé.
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
The website's source code is publicly available, as I believe everything should be open sourced.
EOT
);
___('about_source_body_2', 'FR', <<<EOT
Le code source du site est visible publiquement, car j'ai la conviction que tout doit être open sourcé.
EOT
);
___('about_source_body_3', 'EN', <<<EOT
<a href="https://github.com/EricBisceglia/The-Bad-Website" target="_blank">Click here to check out the bad website's source code on GitHub</a>.
EOT
);
___('about_source_body_3', 'FR', <<<EOT
<a href="https://github.com/EricBisceglia/The-Bad-Website" target="_blank">Cliquez ici pour voir le code source du mauvais site sur GitHub</a>.
EOT
);


// Cookies
___('about_cookies_title',  'EN', "Why wasn't I asked to accept cookies?");
___('about_cookies_title',  'FR', "Pourquoi le site ne m'a pas demandé d'accepter des cookies ?");
___('about_cookies_body_1', 'EN', <<<EOT
Because this is a simple website full of silly pastel drawings, and nothing more.
EOT
);
___('about_cookies_body_1', 'FR', <<<EOT
Parce que ce n'est qu'un simple site rempli de dessins pastel idiots.
EOT
);
___('about_cookies_body_2', 'EN', <<<EOT
There's no need to track you or sell your data to third parties.
EOT
);
___('about_cookies_body_2', 'FR', <<<EOT
Il n'y a aucune raison de traquer vos données ou de les vendre à des tiers.
EOT
);
___('about_cookies_body_3', 'EN', <<<EOT
Since none of your personal data is being collected or shared, there's nothing you need to consent to.
EOT
);
___('about_cookies_body_3', 'FR', <<<EOT
Comme vos données personnelles ne sont ni collectées ni partagées, vous n'avez pas de cookies à accepter.
EOT
);
___('about_cookies_body_4', 'EN', <<<EOT
Maybe you should start wondering why every other website asks for your personal data.
EOT
);
___('about_cookies_body_4', 'FR', <<<EOT
Vous devriez vous demander pourquoi tous les autres sites réclament vos données personnelles.
EOT
);



/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                      SOCIALS                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Socials: Comics
___('socials_comic_header', 'EN', <<<EOT
[a character ponders]
Damn I wish I could follow this website
[another character answers]
Good news! The Bad Website posts updates to a bunch of different social platforms.
Following and sharing is much appreciated, thanks a lot.
EOT
);
___('socials_comic_header', 'FR', <<<EOT
[un personnage a l'air pensif]
Si seulement je pouvais suivre ce site…
[un autre personnage lui répond]
Bonne nouvelle ! Le Mauvais Site partage ses contenus sur plusieurs plateformes sociales !
Suivre et partager est très apprécié, merci beaucoup.
EOT
);
___('socials_comic_x',      'EN', <<<EOT
[a character ponders]
Wait a second… all those socials but thebad.website isn't on X?
[another character shrugs]
Well who cares, being on a platform ran by and for fascists makes you a fascism enabler.
EOT
);
___('socials_comic_x',      'FR', <<<EOT
[un personnage réfléchit]
Attendez… toutes ces plateformes mais lemauvais.site n'est pas sur X ?
[un autre personnage hausse les épaules]
Si ça se trouve c'est lié au fait que contribuer à une plateforme gérée par des fascistes légitime le fascisme.
EOT
);
___('socials_comic_footer', 'EN', <<<EOT
[a character points above them]
Some of the links above are available in two different languages (English / French).
If you're looking for the link to the french socials, change te website's language by clicking on the flag on top of the page.
EOT
);
___('socials_comic_footer', 'FR', <<<EOT
[un personnage pointe au dessus de lui]
Certains des liens ci-dessus sont disponibles dans deux langues (français / anglais).
Si vous cherchez les liens vers les versions anglophones de ces médias sociaux, changez la langue du site en cliquant sur le drapeau en haut de la page.
EOT
);


// Socials: Platforms
___('socials_links_discord',    'EN', "Discord server (comics, memes, chat with me)");
___('socials_links_discord',    'FR', "Serveur Discord (comics, memes, discutez avec moi)");
___('socials_links_instagram',  'EN', "Instagram (comics, memes, drawings)");
___('socials_links_instagram',  'FR', "Instagram (comics, memes, dessins)");
___('socials_links_bluesky',    'EN', "Bluesky (comics, memes, drawings)");
___('socials_links_bluesky',    'FR', "Bluesky (comics, memes, dessins)");
___('socials_links_reddit',     'EN', "Reddit (comics, memes, drawings)");
___('socials_links_reddit',     'FR', "Reddit (comics, memes, dessins)");
___('socials_links_lemmy',      'EN', "Lemmy (comics, memes, drawings)");
___('socials_links_lemmy',      'FR', "Lemmy (comics, memes, dessins)");
___('socials_links_youtube',    'EN', "YouTube (animated comics and shorts, video essays)");
___('socials_links_youtube',    'FR', "YouTube (comics animés, vidéos courtes, essais vidéo)");
___('socials_links_tiktok',     'EN', "TikTok (animated comics and shorts)");
___('socials_links_tiktok',     'FR', "TikTok (comics animés, vidéos courtes)");
___('socials_links_rss',        'EN', "RSS feed (follow oldschool style, no social media required)");
___('socials_links_rss',        'FR', "Flux RSS (suivez le site à l'ancienne, sans médias sociaux)");
___('socials_links_mastodon',   'EN', "Mastodon (personal stuff, pictures, drawings)");
___('socials_links_mastodon',   'FR', "Mastodon (vie privée, photos, dessins)");
___('socials_links_instagram2', 'EN', "Another instagram?! (cat pictures)");
___('socials_links_instagram2', 'FR', "Un autre instagram ?! (photos de chats)");




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