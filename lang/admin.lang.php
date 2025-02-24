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




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                      COMICS                                                       */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Comics management
___('admin_comics_management',        'EN', "Comics management");
___('admin_comics_management',        'FR', "Gestion des comics");
___('admin_comics_management_types',  'EN', "Comic types");
___('admin_comics_management_types',  'FR', "Types de comics");


// Comic types: List
___('admin_comic_types_title',  'EN', "Comic types");
___('admin_comic_types_title',  'FR', "Types de comics");
___('admin_comic_types_order',  'EN', "Order");
___('admin_comic_types_order',  'FR', "Ordre");
___('admin_comic_types_count',  'EN', "{{1}} comic type");
___('admin_comic_types_count',  'FR', "{{1}} type de comics");
___('admin_comic_types_count+', 'EN', "{{1}} comic types");
___('admin_comic_types_count+', 'FR', "{{1}} types de comics");


// Comic types: Add
___('admin_comic_types_add_title',      'EN', "Add a comic type");
___('admin_comic_types_add_title',      'FR', "Ajouter un type de comic");
___('admin_comic_types_add_order',      'EN', "Sorting order");
___('admin_comic_types_add_order',      'FR', "Ordre de tri");
___('admin_comic_types_add_banner_en',  'EN', "Banner image name (EN)");
___('admin_comic_types_add_banner_en',  'FR', "Nom de l'image de bannière (EN)");
___('admin_comic_types_add_banner_fr',  'EN', "Banner image name (FR)");
___('admin_comic_types_add_banner_fr',  'FR', "Nom de l'image de bannière (FR)");
___('admin_comic_types_add_name_en',    'EN', "Name (EN)");
___('admin_comic_types_add_name_en',    'FR', "Nom (EN)");
___('admin_comic_types_add_name_fr',    'EN', "Name (FR)");
___('admin_comic_types_add_name_fr',    'FR', "Nom (FR)");
___('admin_comic_types_add_desc_en',    'EN', "Description (EN)");
___('admin_comic_types_add_desc_en',    'FR', "Description (EN)");
___('admin_comic_types_add_desc_fr',    'EN', "Description (FR)");
___('admin_comic_types_add_desc_fr',    'FR', "Description (FR)");
___('admin_comic_types_add_submit',     'EN', "Add comic type");
___('admin_comic_types_add_submit',     'FR', "Ajouter un type de comic");