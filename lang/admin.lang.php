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
___('admin_menu_index',     'EN', "Notes");
___('admin_menu_index',     'FR', "Notes");
___('admin_menu_ideas',     'EN', "Ideas");
___('admin_menu_ideas',     'FR', "Idées");
___('admin_menu_images',    'EN', "Images");
___('admin_menu_images',    'FR', "Images");
___('admin_menu_comics',    'EN', "Comics");
___('admin_menu_comics',    'FR', "Comics");
___('admin_menu_tags',      'EN', "Tags");
___('admin_menu_tags',      'FR', "Tags");
___('admin_menu_searches',  'EN', "Searches");
___('admin_menu_searches',  'FR', "Recherches");
___('admin_menu_queries',   'EN', "SQL Queries");
___('admin_menu_queries',   'FR', "Requêtes SQL");




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


// Ideas: List
___('admin_ideas_new_title',    'EN', "New idea");
___('admin_ideas_new_title',    'FR', "Nouvelle idée");
___('admin_ideas_title',        'EN', "Idea name");
___('admin_ideas_title',        'FR', "Nom de l'idée");
___('admin_ideas_type',         'EN', "Idea type");
___('admin_ideas_type',         'FR', "Type d'idée");
___('admin_ideas_new_body',     'EN', "Idea description");
___('admin_ideas_new_body',     'FR', "Description de l'idée");
___('admin_ideas_add',          'EN', "Add idea");
___('admin_ideas_add',          'FR', "Ajouter l'idée");
___('admin_ideas_filters',      'EN', "Filters");
___('admin_ideas_filters',      'FR', "Filtres");
___('admin_ideas_list',         'EN', "{{1}} idea");
___('admin_ideas_list',         'FR', "{{1}} idée");
___('admin_ideas_list+',        'EN', "{{1}} ideas");
___('admin_ideas_list+',        'FR', "{{1}} idées");
___('admin_ideas_sort_random',  'EN', "Random");
___('admin_ideas_sort_random',  'FR', "Aléatoire");
___('admin_ideas_sort_title',   'EN', "Title");
___('admin_ideas_sort_title',   'FR', "Titre");
___('admin_ideas_sort_newest',  'EN', "Newest");
___('admin_ideas_sort_newest',  'FR', "Récent");
___('admin_ideas_sort_oldest',  'EN', "Oldest");
___('admin_ideas_sort_oldest',  'FR', "Ancien");


// Ideas: Add
___('admin_ideas_add_title',  'EN', "Add an idea");
___('admin_ideas_add_title',  'FR', "Ajouter une idée");


// Ideas: Edit
___('admin_ideas_edit',         'EN', "Edit idea");
___('admin_ideas_edit',         'FR', "Modifier l'idée");


// Ideas: Delete
___('admin_ideas_delete',       'EN', "Confirm the deletion of this idea");
___('admin_ideas_delete',       'FR', "Confirmez la suppression de cette idée");


// Idea types: List
___('admin_idea_types_title',   'EN', "Idea types");
___('admin_idea_types_title',   'FR', "Types d'idées");
___('admin_idea_types_order',   'EN', "Order");
___('admin_idea_types_order',   'FR', "Ordre");
___('admin_idea_types_name',    'EN', "Name");
___('admin_idea_types_name',    'FR', "Nom");
___('admin_idea_types_count',   'EN', "{{1}} idea type");
___('admin_idea_types_count',   'FR', "{{1}} type d'idée");
___('admin_idea_types_count+',  'EN', "{{1}} idea types");
___('admin_idea_types_count+',  'FR', "{{1}} types d'idées");


// Idea types: Add
___('admin_idea_types_add_title',   'EN', "Add an idea type");
___('admin_idea_types_add_title',   'FR', "Ajouter un type d'idée");
___('admin_idea_types_add_order',   'EN', "Sorting order");
___('admin_idea_types_add_order',   'FR', "Ordre de tri");
___('admin_idea_types_add_name_en', 'EN', "Name (english)");
___('admin_idea_types_add_name_en', 'FR', "Nom (anglais)");
___('admin_idea_types_add_name_fr', 'EN', "Name (french)");
___('admin_idea_types_add_name_fr', 'FR', "Nom (français)");
___('admin_idea_types_add_submit',  'EN', "Add idea type");
___('admin_idea_types_add_submit',  'FR', "Ajouter le type d'idée");


// Idea types: Edit
___('admin_idea_types_edit_title',   'EN', "Edit an idea type");
___('admin_idea_types_edit_title',   'FR', "Modifier un type d'idée");
___('admin_idea_types_edit_submit',  'EN', "Edit idea type");
___('admin_idea_types_edit_submit',  'FR', "Modifier le type d'idée");


// Idea types: Delete
___('admin_idea_types_delete_confirm', 'EN', "Confirm the permanent deletion of this idea type");
___('admin_idea_types_delete_confirm', 'FR', "Confirmer la suppression définitive de ce type d'idée");




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                      IMAGES                                                       */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Images list
___('admin_images_title',           'EN', "Images");
___('admin_images_title',           'FR', "Images");
___('admin_images_list_templates',  'EN', "Templates");
___('admin_images_list_templates',  'FR', "Modèles");
___('admin_images_list_type',       'EN', "Type");
___('admin_images_list_type',       'FR', "Type");
___('admin_images_list_type_comic', 'EN', "Comic");
___('admin_images_list_type_comic', 'FR', "Comic");
___('admin_images_list_type_prev',  'EN', "Cover");
___('admin_images_list_type_prev',  'FR', "Couverture");
___('admin_images_list_type_full',  'EN', "Assembled image");
___('admin_images_list_type_full',  'FR', "Image asemblée");
___('admin_images_list_type_old',   'EN', "Old version");
___('admin_images_list_type_old',   'FR', "Vieille version");
___('admin_images_list_type_templ', 'EN', "Template");
___('admin_images_list_type_templ', 'FR', "Modèle");
___('admin_images_list_type_reus',  'EN', "Reusable image");
___('admin_images_list_type_reus',  'FR', "Image réutilisable");
___('admin_images_list_language',   'EN', "Lang.");
___('admin_images_list_language',   'FR', "Lang.");
___('admin_images_list_name',       'EN', "Name");
___('admin_images_list_name',       'FR', "Nom");
___('admin_images_list_nsfw',       'EN', "NSFW");
___('admin_images_list_nsfw',       'FR', "NSFW");
___('admin_images_list_comic',      'EN', "Comic");
___('admin_images_list_comic',      'FR', "Comic");
___('admin_images_list_comic_y',    'EN', "Linked to a comic");
___('admin_images_list_comic_y',    'FR', "Lié à un comic");
___('admin_images_list_comic_n',    'EN', "Not linked to a comic");
___('admin_images_list_comic_n',    'FR', "Non lié à un comic");
___('admin_images_list_date',       'EN', "Uploaded");
___('admin_images_list_date',       'FR', "Mis en ligne");
___('admin_images_list_count',      'EN', "{{1}} image");
___('admin_images_list_count',      'FR', "{{1}} image");
___('admin_images_list_count+',     'EN', "{{1}} images");
___('admin_images_list_count+',     'FR', "{{1}} images");


// Add an image
___('admin_images_add_title',           'EN', "Add an image");
___('admin_images_add_title',           'FR', "Ajouter une image");
___('admin_images_add_file',            'EN', "Upload image");
___('admin_images_add_file',            'FR', "Téléverser l'image");
___('admin_images_add_nsfw',            'EN', "Blur image (NSFW)");
___('admin_images_add_nsfw',            'FR', "Flouter l'image (NSFW)");
___('admin_images_add_preview',         'EN', "Is a cover image for a comic");
___('admin_images_add_preview',         'FR', "Est l'image de couverture d'un comic");
___('admin_images_add_reusable',        'EN', "Is a reusable image");
___('admin_images_add_reusable',        'FR', "Est une image réutilisable");
___('admin_images_add_full',            'EN', "Is a fully assembled image");
___('admin_images_add_full',            'FR', "Est une image complète assemblée");
___('admin_images_add_old',             'EN', "Is an old version");
___('admin_images_add_old',             'FR', "Est une version ancienne");
___('admin_images_add_template',        'EN', "Is a template");
___('admin_images_add_template',        'FR', "Est un modèle d'image");
___('admin_images_add_name',            'EN', "Image name (lowercase, no spaces)");
___('admin_images_add_name',            'FR', "Nom de l'image (minuscules, sans espaces)");
___('admin_images_add_comic',           'EN', "Linked comic");
___('admin_images_add_comic',           'FR', "Comic lié");
___('admin_images_add_order',           'EN', "Image display order (optional)");
___('admin_images_add_order',           'FR', "Ordre d'affichage de l'image (optionnel)");
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


// Edit an image
___('admin_images_edit_title',      'EN', "Edit image");
___('admin_images_edit_title',      'FR', "Modifier l'image");
___('admin_images_edit_date',       'EN', "Upload date (YYYY-MM-DD)");
___('admin_images_edit_date',       'FR', "Date de mise en ligne (YYYY-MM-DD)");
___('admin_images_add_transcript',  'EN', "Image transcript");
___('admin_images_add_transcript',  'FR', "Transcription de l'image");
___('admin_images_edit_submit',     'EN', "Edit image");
___('admin_images_edit_submit',     'FR', "Modifier l'image");


// Delete an image
___('admin_images_delete_confirm', 'EN', "Confirm the permanent deletion of this image");
___('admin_images_delete_confirm', 'FR', "Confirmer la suppression définitive de cette image");


// Image templates
___('admin_images_templates_title',   'EN', "Templates");
___('admin_images_templates_title',   'FR', "Modèles");
___('admin_images_templates_font',    'EN', "Font used for text: Segoe UI");
___('admin_images_templates_font',    'FR', "Police de caractères : Segoe UI");
___('admin_images_templates_color_1', 'EN', "Color 1: Beige #EFE4B0");
___('admin_images_templates_color_1', 'FR', "Couleur 1 : Beige #EFE4B0");
___('admin_images_templates_color_2', 'EN', "Color 2: Purple #C8BFE7");
___('admin_images_templates_color_2', 'FR', "Couleur 2 : Violet #C8BFE7");
___('admin_images_templates_color_3', 'EN', "Color 3: Green #C2E7BF");
___('admin_images_templates_color_3', 'FR', "Couleur 3 : Vert #C2E7BF");
___('admin_images_templates_color_4', 'EN', "Color 4: Blue #99D9EA");
___('admin_images_templates_color_4', 'FR', "Couleur 4 : Bleu #99D9EA");
___('admin_images_templates_color_5', 'EN', "Color 5: Grey #C3C3C3");
___('admin_images_templates_color_5', 'FR', "Couleur 5 : Gris #C3C3C3");
___('admin_images_templates_banner',  'EN', "Category banner: 1000x200<br>img/banners/comics/types/");
___('admin_images_templates_banner',  'FR', "Bannière de catégorie : 1000x200<br>img/banners/comics/types/");
___('admin_images_templates_tag',     'EN', "Tag banner: 1000x130<br>img/banners/comics/tags/");
___('admin_images_templates_tag',     'FR', "Bannière de tag : 1000x130<br>img/banners/comics/tags/");
___('admin_images_templates_preview', 'EN', "Comic preview: 1000x400");
___('admin_images_templates_preview', 'FR', "Prévisualisation de comic : 1000x400");
___('admin_images_reusables_gallery', 'EN', "Reusable images gallery");
___('admin_images_reusables_gallery', 'FR', "Galerie d'images réutilisables");
___('admin_images_templates_gallery', 'EN', "Template gallery");
___('admin_images_templates_gallery', 'FR', "Galerie de modèles");




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                      COMICS                                                       */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Comics list
___('admin_comics_title',         'EN', "Comics");
___('admin_comics_title',         'FR', "Comics");
___('admin_comics_search_body',   'EN', "Search in descriptions and transcripts");
___('admin_comics_search_body',   'FR', "Rechercher dans les descriptions et transcriptions");
___('admin_comics_list_title',    'EN', "Title");
___('admin_comics_list_title',    'FR', "Titre");
___('admin_comics_list_type',     'EN', "Type");
___('admin_comics_list_type',     'FR', "Type");
___('admin_comics_list_date',     'EN', "Uploaded");
___('admin_comics_list_date',     'FR', "Mis en ligne");
___('admin_comics_list_private',  'EN', "Priv.");
___('admin_comics_list_private',  'FR', "Priv.");
___('admin_comics_list_images',   'EN', "Images");
___('admin_comics_list_images',   'FR', "Images");
___('admin_comics_list_images_y', 'EN', "Has images");
___('admin_comics_list_images_y', 'FR', "A des images");
___('admin_comics_list_images_n', 'EN', "Has no images");
___('admin_comics_list_images_n', 'FR', "N'a pas d'images");
___('admin_comics_list_tags',     'EN', "Tags");
___('admin_comics_list_tags',     'FR', "Tags");
___('admin_comics_list_views',    'EN', "Views");
___('admin_comics_list_views',    'FR', "Vues");
___('admin_comics_list_count',    'EN', "{{1}} comic");
___('admin_comics_list_count',    'FR', "{{1}} comic");
___('admin_comics_list_count+',   'EN', "{{1}} comics");
___('admin_comics_list_count+',   'FR', "{{1}} comics");
___('admin_comics_list_link_img', 'EN', "Linked images");
___('admin_comics_list_link_img', 'FR', "Images liées");


// Add a comic
___('admin_comics_add_title',     'EN', "Add a comic");
___('admin_comics_add_title',     'FR', "Ajouter un comic");
___('admin_comics_add_title_en',  'EN', "English title");
___('admin_comics_add_title_en',  'FR', "Titre anglais");
___('admin_comics_add_title_fr',  'EN', "French title");
___('admin_comics_add_title_fr',  'FR', "Titre français");
___('admin_comics_add_type',      'EN', "Comic type");
___('admin_comics_add_type',      'FR', "Type de comic");
___('admin_comics_add_submit',    'EN', "Add comic");
___('admin_comics_add_submit',    'FR', "Ajouter le comic");


// Edit a comic
___('admin_comics_edit_title',    'EN', "Edit comic");
___('admin_comics_edit_title',    'FR', "Modifier le comic");
___('admin_comics_edit_date',     'EN', "Upload date (YYYY-MM-DD)");
___('admin_comics_edit_date',     'FR', "Date de mise en ligne (YYYY-MM-DD)");
___('admin_comics_edit_desc_en',  'EN', "English description");
___('admin_comics_edit_desc_en',  'FR', "Description anglaise");
___('admin_comics_edit_desc_fr',  'EN', "French description");
___('admin_comics_edit_desc_fr',  'FR', "Description française");
___('admin_comics_edit_tags',     'EN', "Comic tags");
___('admin_comics_edit_tags',     'FR', "Tags du comic");
___('admin_comics_edit_private',  'EN', "Private (hidden from public view)");
___('admin_comics_edit_private',  'FR', "Privé (caché du public)");
___('admin_comics_edit_submit',   'EN', "Edit comic");
___('admin_comics_edit_submit',   'FR', "Modifier le comic");
___('admin_comics_edit_preview',  'EN', "Cover");
___('admin_comics_edit_preview',  'FR', "Couverture");
___('admin_comics_edit_comic',    'EN', "Comic");
___('admin_comics_edit_comic',    'FR', "Comic");


// Delete a comic
___('admin_comics_delete_confirm', 'EN', "Confirm the permanent deletion of this comic");
___('admin_comics_delete_confirm', 'FR', "Confirmer la suppression définitive de ce comic");


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
___('admin_comic_types_add_major',      'EN', "Is a main category (shows up in random comics)");
___('admin_comic_types_add_major',      'FR', "Est une catégorie principale (apparaît dans les comics aléatoires)");
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




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                      SEARCHES                                                     */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Searches list
___('admin_user_searches_list',       'EN', "Latest user searches");
___('admin_user_searches_list',       'FR', "Dernières recherches utilisateur");
___('admin_user_searches_list_empty', 'EN', "The user search file is empty");
___('admin_user_searches_list_empty', 'FR', "Le fichier des recherches est vide");
___('admin_user_searches_clear',      'EN', "Confirm the deletion of the entire user search history");
___('admin_user_searches_clear',      'FR', "Confirmer la suppression de tout l\'historique des recherches");