<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                    ADMIN PANEL                                                    */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Admin menu
___('admin_menu_index',       'EN', "Notes");
___('admin_menu_index',       'FR', "Notes");
___('admin_menu_images',      'EN', "Images");
___('admin_menu_images',      'FR', "Images");
___('admin_menu_comics',      'EN', "Comics");
___('admin_menu_comics',      'FR', "Comics");
___('admin_menu_tags',        'EN', "Tags");
___('admin_menu_tags',        'FR', "Tags");
___('admin_menu_queries',     'EN', "SQL Queries");
___('admin_menu_queries',     'FR', "Requêtes SQL");




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                   QUERIES                                                         */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Query results
___('admin_query_ok', 'EN', "Queries ran successfully");
___('admin_query_ok', 'FR', "Requêtes exécutées avec succès");