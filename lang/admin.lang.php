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




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                  NOTES AND IDEAS                                                  */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Admin notes
___('admin_notes_tasks',  'EN', "Tasks");
___('admin_notes_tasks',  'FR', "Tâches");
___('admin_notes_update', 'EN', "Update tasks");
___('admin_notes_update', 'FR', "Mettre à jour les tâches");


// Admin ideas
___('admin_ideas_new_title',  'EN', "New idea");
___('admin_ideas_new_title',  'FR', "Nouvelle idée");
___('admin_ideas_title',      'EN', "Idea name");
___('admin_ideas_title',      'FR', "Nom de l'idée");
___('admin_ideas_new_body',   'EN', "Idea description");
___('admin_ideas_new_body',   'FR', "Description de l'idée");
___('admin_ideas_add',        'EN', "Add idea");
___('admin_ideas_add',        'FR', "Ajouter l'idée");
___('admin_ideas_list',       'EN', "{{1}} unrealized smug ideas");
___('admin_ideas_list',       'FR', "{{1}} idées arrogantes à réaliser");
___('admin_ideas_edit',       'EN', "Edit idea");
___('admin_ideas_edit',       'FR', "Modifier l'idée");
___('admin_ideas_delete',     'EN', "Confirm the deletion of this idea");
___('admin_ideas_delete',     'FR', "Confirmez la suppression de cette idée");