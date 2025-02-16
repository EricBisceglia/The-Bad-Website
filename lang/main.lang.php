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