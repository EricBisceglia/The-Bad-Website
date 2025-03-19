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
___('admin_menu_ideas',       'EN', "Ideas");
___('admin_menu_ideas',       'FR', "Idées");
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
___('admin_ideas_new_title',    'EN', "New idea");
___('admin_ideas_new_title',    'FR', "Nouvelle idée");
___('admin_ideas_title',        'EN', "Idea name");
___('admin_ideas_title',        'FR', "Nom de l'idée");
___('admin_ideas_new_body',     'EN', "Idea description");
___('admin_ideas_new_body',     'FR', "Description de l'idée");
___('admin_ideas_add',          'EN', "Add idea");
___('admin_ideas_add',          'FR', "Ajouter l'idée");
___('admin_ideas_list',         'EN', "{{1}} smug ideas");
___('admin_ideas_list',         'FR', "{{1}} idées arrogantes");
___('admin_ideas_sort_random',  'EN', "Random");
___('admin_ideas_sort_random',  'FR', "Aléatoire");
___('admin_ideas_sort_title',   'EN', "Title");
___('admin_ideas_sort_title',   'FR', "Titre");
___('admin_ideas_sort_newest',  'EN', "Newest");
___('admin_ideas_sort_newest',  'FR', "Récent");
___('admin_ideas_sort_oldest',  'EN', "Oldest");
___('admin_ideas_sort_oldest',  'FR', "Ancien");
___('admin_ideas_edit',         'EN', "Edit idea");
___('admin_ideas_edit',         'FR', "Modifier l'idée");
___('admin_ideas_delete',       'EN', "Confirm the deletion of this idea");
___('admin_ideas_delete',       'FR', "Confirmez la suppression de cette idée");




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                      IMAGES                                                       */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Images list
___('admin_images_title',         'EN', "Images");
___('admin_images_title',         'FR', "Images");
___('admin_images_list_type',     'EN', "Type");
___('admin_images_list_type',     'FR', "Type");
___('admin_images_list_language', 'EN', "Lang.");
___('admin_images_list_language', 'FR', "Lang.");
___('admin_images_list_name',     'EN', "Name");
___('admin_images_list_name',     'FR', "Nom");
___('admin_images_list_nsfw',     'EN', "NSFW");
___('admin_images_list_nsfw',     'FR', "NSFW");
___('admin_images_list_date',     'EN', "Uploaded");
___('admin_images_list_date',     'FR', "Mis en ligne");
___('admin_images_list_count',    'EN', "{{1}} image");
___('admin_images_list_count',    'FR', "{{1}} image");
___('admin_images_list_count+',   'EN', "{{1}} images");
___('admin_images_list_count+',   'FR', "{{1}} images");


// Add an image
___('admin_images_add_title',           'EN', "Add an image");
___('admin_images_add_title',           'FR', "Ajouter une image");
___('admin_images_add_file',            'EN', "Upload image");
___('admin_images_add_file',            'FR', "Téléverser l'image");
___('admin_images_add_nsfw',            'EN', "Blur image (NSFW)");
___('admin_images_add_nsfw',            'FR', "Flouter l'image (NSFW)");
___('admin_images_add_name',            'EN', "Image name (lowercase, no spaces)");
___('admin_images_add_name',            'FR', "Nom de l'image (minuscules, sans espaces)");
___('admin_images_add_type',            'EN', "Image type");
___('admin_images_add_type',            'FR', "Type d'image");
___('admin_images_add_lang',            'EN', "Language");
___('admin_images_add_lang',            'FR', "Langue");
___('admin_images_add_date',            'EN', "Upload date (YYYY-MM-DD)");
___('admin_images_add_date',            'FR', "Date de création (YYYY-MM-DD)");
___('admin_images_add_caption',         'EN', "Image caption / transcript");
___('admin_images_add_caption',         'FR', "Légende / transcription de l'image");
___('admin_images_add_submit',          'EN', "Add image");
___('admin_images_add_submit',          'FR', "Ajouter l'image");
___('admin_images_add_error_file',      'EN', "File missing");
___('admin_images_add_error_file',      'FR', "Fichier manquant");
___('admin_images_add_error_name',      'EN', "Image name missing");
___('admin_images_add_error_name',      'FR', "Nom de l'image manquant");
___('admin_images_add_error_misnamed',  'EN', "Incorrect file name");
___('admin_images_add_error_misnamed',  'FR', "Nom du fichier incorrect");
___('admin_images_add_error_failed',    'EN', "Image upload failed");
___('admin_images_add_error_failed',    'FR', "Le téléversement de l'image a échoué");




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
___('admin_comic_types_name',   'EN', "Name");
___('admin_comic_types_name',   'FR', "Nom");
___('admin_comic_types_banner', 'EN', "Banner");
___('admin_comic_types_banner', 'FR', "Bannière");
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


// Comic types: Edit
___('admin_comic_types_edit_title',   'EN', "Edit a comic type");
___('admin_comic_types_edit_title',   'FR', "Modifier un type de comic");
___('admin_comic_types_edit_submit',  'EN', "Edit comic type");
___('admin_comic_types_edit_submit',  'FR', "Modifier le type de comic");


// Comic types: Delete
___('admin_comic_types_delete_confirm', 'EN', "Confirm the permanent deletion of this comic type");
___('admin_comic_types_delete_confirm', 'FR', "Confirmer la suppression définitive de ce type de comic");




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                    TAGS                                                        */
/*                                                                                                                   */
/*********************************************************************************************************************/

// List tags
___('admin_tags_title',     'EN', "Tags");
___('admin_tags_title',     'FR', "Tags");
___('admin_tags_count',     'EN', "{{1}} tag");
___('admin_tags_count',     'FR', "{{1}} tag");
___('admin_tags_count+',    'EN', "{{1}} tags");
___('admin_tags_count+',    'FR', "{{1}} tags");
___('admin_tags_name',      'EN', "Name");
___('admin_tags_name',      'FR', "Nom");
___('admin_tags_banner',    'EN', "Banner");
___('admin_tags_banner',    'FR', "Bannière");
___('admin_tags_tagtitle',  'EN', "Title");
___('admin_tags_tagtitle',  'FR', "Titre");
___('admin_tags_order',     'EN', "Order");
___('admin_tags_order',     'FR', "Ordre");


// Add a tag
___('admin_tags_add_title',      'EN', "Add a tag");
___('admin_tags_add_title',      'FR', "Ajouter un tag");
___('admin_tags_add_order',      'EN', "Sorting order");
___('admin_tags_add_order',      'FR', "Ordre de tri");
___('admin_tags_add_name',       'EN', "Tag name (lowercase letters only, no spaces)");
___('admin_tags_add_name',       'FR', "Nom du tag (lettres minuscules uniquement, sans espaces)");
___('admin_tags_add_title_en',   'EN', "Tag title (EN)");
___('admin_tags_add_title_en',   'FR', "Titre du tag (EN)");
___('admin_tags_add_title_fr',   'EN', "Tag title (FR)");
___('admin_tags_add_title_fr',   'FR', "Titre du tag (FR)");
___('admin_tags_add_banner_en',  'EN', "Banner image name (EN)");
___('admin_tags_add_banner_en',  'FR', "Nom de l'image de bannière (EN)");
___('admin_tags_add_banner_fr',  'EN', "Banner image name (FR)");
___('admin_tags_add_banner_fr',  'FR', "Nom de l'image de bannière (FR)");
___('admin_tags_add_desc_en',    'EN', "Tag description (EN)");
___('admin_tags_add_desc_en',    'FR', "Description du tag (EN)");
___('admin_tags_add_desc_fr',    'EN', "Tag description (FR)");
___('admin_tags_add_desc_fr',    'FR', "Description du tag (FR)");
___('admin_tags_add_submit',     'EN', "Add tag");
___('admin_tags_add_submit',     'FR', "Ajouter un tag");


// Edit a tag
___('admin_tags_edit_title',   'EN', "Edit a tag");
___('admin_tags_edit_title',   'FR', "Modifier un tag");
___('admin_tags_edit_submit',  'EN', "Edit tag");
___('admin_tags_edit_submit',  'FR', "Modifier le tag");


// Delete a tag
___('admin_tags_delete_confirm', 'EN', "Confirm the permanent deletion of this tag");
___('admin_tags_delete_confirm', 'FR', "Confirmer la suppression définitive de ce tag");