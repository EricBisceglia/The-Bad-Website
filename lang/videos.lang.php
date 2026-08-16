<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                 BEHIND THE SCENES                                                 */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Header
___('videos_bts_title', 'EN', "Behind the scenes");
___('videos_bts_title', 'FR', "Coulisses");
___('videos_bts_desc',  'EN', <<<EOT
All drawings on the website are drawn in MSPaint, with a computer mouse.<br>
<br>
I learned to draw thanks to the following books:<br>
- Creating Characters with Personality, by Tom Bancroft<br>
- Figure Drawing - Design and Invention, by Michael Hampton<br>
- Constructive Anatomy, by George B. Bridgman<br>
- How to draw Sci-Fi Fantasy Mecha, by Kenichi Somemori & Shin Yoshimura<br>
- How to Draw: Drawing and Sketching Objects and Environments From Your Imagination, by Scott Robertson & Thomas Bertling<br>
<br>
If you are looking to learn to draw, nothing beats daily practice.<br>
The books listed above are a great help to learn the basics :)<br>
<br>
Below are a few video recordings of my drawing process.<br>
I hope you find them entertaining to watch, and maybe learn something too!
EOT
);
___('videos_bts_desc',  'FR', <<<EOT
Tous les dessins sur le site sont réalisés dans MSPaint, à la souris d'ordinateur.<br>
<br>
- J'ai appris à dessiner grâce aux livres suivants :<br>
- Creating Characters with Personality, par Tom Bancroft<br>
- Figure Drawing - Design and Invention, par Michael Hampton<br>
- Constructive Anatomy, par George B. Bridgman<br>
- How to draw Sci-Fi Fantasy Mecha, par Kenichi Somemori & Shin Yoshimura<br>
- How to Draw: Drawing and Sketching Objects and Environments From Your Imagination, par Scott Robertson & Thomas Bertling<br>
<br>
Si vous voulez apprendre à dessiner, rien ne remplace la pratique quotidienne.<br>
Les livres listés ci-dessus sont très utiles pour apprendre les bases :)<br>
<br>
Ci-dessous, quelques enregistrements de mon processus de dessin.<br>
J'espère que vous les trouverez divertissants à regarder, et qui sait, peut-être même que vous apprendrez des choses en les regardant !
EOT
);