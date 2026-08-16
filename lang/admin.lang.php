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
___('admin_menu_videos',    'EN', "Videos");
___('admin_menu_videos',    'FR', "Vidéos");
___('admin_menu_tags',      'EN', "Tags");
___('admin_menu_tags',      'FR', "Tags");
___('admin_menu_quotes',    'EN', "Quotes");
___('admin_menu_quotes',    'FR', "Citations");
___('admin_menu_merch',     'EN', "Merch");
___('admin_menu_merch',     'FR', "Merch");
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
___('admin_notes_tasks',    'EN', "Tasks");
___('admin_notes_tasks',    'FR', "Tâches");
___('admin_notes_update',   'EN', "Update tasks");
___('admin_notes_update',   'FR', "Mettre à jour les tâches");
___('admin_notes_devmode',  'EN', "You are currently in local dev mode");
___('admin_notes_devmode',  'FR', "Vous êtes actuellement en mode dev local");


// Ideas: List
___('admin_ideas_new_title',    'EN', "New idea");
___('admin_ideas_new_title',    'FR', "Nouvelle idée");
___('admin_ideas_title',        'EN', "Idea name");
___('admin_ideas_title',        'FR', "Nom de l'idée");
___('admin_ideas_added',        'EN', "Idea recorded ");
___('admin_ideas_added',        'FR', "Idée enregistrée ");
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
___('admin_ideas_edit_types',   'EN', "Edit idea types");
___('admin_ideas_edit_types',   'FR', "Modifier les types d'idées");


// Ideas: Add
___('admin_ideas_add_title',  'EN', "Add an idea");
___('admin_ideas_add_title',  'FR', "Ajouter une idée");


// Ideas: Edit
___('admin_ideas_edit',       'EN', "Edit idea");
___('admin_ideas_edit',       'FR', "Modifier l'idée");
___('admin_ideas_edit_added', 'EN', "Added ");
___('admin_ideas_edit_added', 'FR', "Ajoutée le ");


// Ideas: Delete
___('admin_ideas_delete',   'EN', "Confirm the deletion of this idea");
___('admin_ideas_delete',   'FR', "Confirmez la suppression de cette idée");
___('admin_ideas_deleted',  'EN', "The idea has been deleted");
___('admin_ideas_deleted',  'FR', "L'idée a été supprimée");


// Idea types: List
___('admin_idea_types_title',   'EN', "Idea types");
___('admin_idea_types_title',   'FR', "Types d'idées");
___('admin_idea_types_order',   'EN', "Order");
___('admin_idea_types_order',   'FR', "Ordre");
___('admin_idea_types_name',    'EN', "Name");
___('admin_idea_types_name',    'FR', "Nom");
___('admin_idea_types_number',  'EN', "Ideas");
___('admin_idea_types_number',  'FR', "Idées");
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
___('admin_idea_types_delete_confirm', 'FR', "Confirmer la suppression définitive de ce type d\'idée");
___('admin_idea_type_delete_used',     'EN', "You cannot delete an idea type as long as it has ideas attached to it");
___('admin_idea_type_delete_used',     'FR', "Vous ne pouvez pas supprimer un type d\'idée tant qu\'il est lié à des idées");




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                      IMAGES                                                       */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Images list
___('admin_images_title',             'EN', "Images");
___('admin_images_title',             'FR', "Images");
___('admin_images_list_templates',    'EN', "Templates");
___('admin_images_list_templates',    'FR', "Modèles");
___('admin_images_list_gallery',      'EN', "Gallery");
___('admin_images_list_gallery',      'FR', "Galerie");
___('admin_images_list_type',         'EN', "Type");
___('admin_images_list_type',         'FR', "Type");
___('admin_images_list_type_comic',   'EN', "Comic");
___('admin_images_list_type_comic',   'FR', "Comic");
___('admin_images_list_type_prev',    'EN', "Cover");
___('admin_images_list_type_prev',    'FR', "Couverture");
___('admin_images_list_type_full',    'EN', "Assembled image");
___('admin_images_list_type_full',    'FR', "Image asemblée");
___('admin_images_list_type_remake',  'EN', "Remake of an old comic");
___('admin_images_list_type_remake',  'FR', "Remake d'un vieux comic");
___('admin_images_list_type_bonus',   'EN', "Extra panel");
___('admin_images_list_type_bonus',   'FR', "Contenu additionnel");
___('admin_images_list_type_templ',   'EN', "Template");
___('admin_images_list_type_templ',   'FR', "Modèle");
___('admin_images_list_type_emoji',   'EN', "Emoji");
___('admin_images_list_type_emoji',   'FR', "Emoji");
___('admin_images_list_type_bubble',  'EN', "Speech bubble");
___('admin_images_list_type_bubble',  'FR', "Bulle de texte");
___('admin_images_list_language',     'EN', "Lang.");
___('admin_images_list_language',     'FR', "Lang.");
___('admin_images_list_name',         'EN', "Name");
___('admin_images_list_name',         'FR', "Nom");
___('admin_images_list_nsfw',         'EN', "NSFW");
___('admin_images_list_nsfw',         'FR', "NSFW");
___('admin_images_list_comic',        'EN', "Comic");
___('admin_images_list_comic',        'FR', "Comic");
___('admin_images_list_comic_y',      'EN', "Linked to a comic");
___('admin_images_list_comic_y',      'FR', "Lié à un comic");
___('admin_images_list_comic_n',      'EN', "Not linked to a comic");
___('admin_images_list_comic_n',      'FR', "Non lié à un comic");
___('admin_images_list_date',         'EN', "Uploaded");
___('admin_images_list_date',         'FR', "Mis en ligne");
___('admin_images_list_count',        'EN', "{{1}} image");
___('admin_images_list_count',        'FR', "{{1}} image");
___('admin_images_list_count+',       'EN', "{{1}} images");
___('admin_images_list_count+',       'FR', "{{1}} images");


// Add an image
___('admin_images_add_title',           'EN', "Add an image");
___('admin_images_add_title',           'FR', "Ajouter une image");
___('admin_images_add_file',            'EN', "Upload image");
___('admin_images_add_file',            'FR', "Téléverser l'image");
___('admin_images_add_nsfw',            'EN', "Blur image (NSFW)");
___('admin_images_add_nsfw',            'FR', "Flouter l'image (NSFW)");
___('admin_images_add_preview',         'EN', "Is a cover image for a comic");
___('admin_images_add_preview',         'FR', "Est l'image de couverture d'un comic");
___('admin_images_add_bonus',           'EN', "Is an extra panel");
___('admin_images_add_bonus',           'FR', "Est un contenu additionnel");
___('admin_images_add_full',            'EN', "Is a fully assembled image");
___('admin_images_add_full',            'FR', "Est une image complète assemblée");
___('admin_images_add_remake',          'EN', "Is a remake of an old comic");
___('admin_images_add_remake',          'FR', "Est un remake d'un vieux comic");
___('admin_images_add_template',        'EN', "Is a template");
___('admin_images_add_template',        'FR', "Est un modèle d'image");
___('admin_images_add_emoji',           'EN', "Is an emoji");
___('admin_images_add_emoji',           'FR', "Est un emoji");
___('admin_images_add_bubble',          'EN', "Is a speech bubble");
___('admin_images_add_bubble',          'FR', "Est une bulle de texte");
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
___('admin_images_info_title',    'EN', "Templates");
___('admin_images_info_title',    'FR', "Modèles");
___('admin_images_info_font',     'EN', "Font used for text: Segoe UI");
___('admin_images_info_font',     'FR', "Police de caractères : Segoe UI");
___('admin_images_info_color_1',  'EN', "Color 1: Beige #EFE4B0");
___('admin_images_info_color_1',  'FR', "Couleur 1 : Beige #EFE4B0");
___('admin_images_info_color_2',  'EN', "Color 2: Purple #C8BFE7");
___('admin_images_info_color_2',  'FR', "Couleur 2 : Violet #C8BFE7");
___('admin_images_info_color_3',  'EN', "Color 3: Green #C2E7BF");
___('admin_images_info_color_3',  'FR', "Couleur 3 : Vert #C2E7BF");
___('admin_images_info_color_4',  'EN', "Color 4: Blue #99D9EA");
___('admin_images_info_color_4',  'FR', "Couleur 4 : Bleu #99D9EA");
___('admin_images_info_color_5',  'EN', "Color 5: Grey #C3C3C3");
___('admin_images_info_color_5',  'FR', "Couleur 5 : Gris #C3C3C3");
___('admin_images_info_banner',   'EN', "Category banner: 1000x200<br>img/website/categories/");
___('admin_images_info_banner',   'FR', "Bannière de catégorie : 1000x200<br>img/website/categories/");
___('admin_images_info_tag',      'EN', "Tag banner: 1000x130<br>img/website/tags/");
___('admin_images_info_tag',      'FR', "Bannière de tag : 1000x130<br>img/website/tags/");
___('admin_images_info_preview',  'EN', "Comic preview: 1000x400");
___('admin_images_info_preview',  'FR', "Prévisualisation de comic : 1000x400");


// Image gallery
___('admin_images_gallery_title',  'EN', "Image gallery");
___('admin_images_gallery_title',  'FR', "Galerie d'images");
___('admin_images_gallery_search', 'EN', "Search");
___('admin_images_gallery_search', 'FR', "Chercher");
___('admin_images_gallery_count',  'EN', "{{1}} image");
___('admin_images_gallery_count',  'FR', "{{1}} image");
___('admin_images_gallery_count+', 'EN', "{{1}} images");
___('admin_images_gallery_count+', 'FR', "{{1}} images");




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
___('admin_comics_list_video',    'EN', "Video");
___('admin_comics_list_video',    'FR', "Video");
___('admin_comics_list_video_y',  'EN', "Has a video");
___('admin_comics_list_video_y',  'FR', "A une vidéo");
___('admin_comics_list_video_n',  'EN', "Does not have a video");
___('admin_comics_list_video_n',  'FR', "N'a pas de vidéo");
___('admin_comics_list_tags',     'EN', "Tags");
___('admin_comics_list_tags',     'FR', "Tags");
___('admin_comics_list_views',    'EN', "Views");
___('admin_comics_list_views',    'FR', "Vues");
___('admin_comics_list_search',   'EN', "Search");
___('admin_comics_list_search',   'FR', "Chercher");
___('admin_comics_list_count',    'EN', "{{1}} comic");
___('admin_comics_list_count',    'FR', "{{1}} comic");
___('admin_comics_list_count+',   'EN', "{{1}} comics");
___('admin_comics_list_count+',   'FR', "{{1}} comics");
___('admin_comics_list_link_img', 'EN', "Linked images");
___('admin_comics_list_link_img', 'FR', "Images liées");
___('admin_comics_list_share',    'EN', "Sharing tools");
___('admin_comics_list_share',    'FR', "Outils de partage");


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
___('admin_comics_edit_title',      'EN', "Edit comic");
___('admin_comics_edit_title',      'FR', "Modifier le comic");
___('admin_comics_edit_date',       'EN', "Upload date (YYYY-MM-DD)");
___('admin_comics_edit_date',       'FR', "Date de mise en ligne (YYYY-MM-DD)");
___('admin_comics_edit_desc_en',    'EN', "English description");
___('admin_comics_edit_desc_en',    'FR', "Description anglaise");
___('admin_comics_edit_desc_fr',    'EN', "French description");
___('admin_comics_edit_desc_fr',    'FR', "Description française");
___('admin_comics_edit_youtube_fr', 'EN', "French YouTube ID");
___('admin_comics_edit_youtube_fr', 'FR', "ID YouTube français");
___('admin_comics_edit_youtube_en', 'EN', "English YouTube ID");
___('admin_comics_edit_youtube_en', 'FR', "ID YouTube anglais");
___('admin_comics_edit_tags',       'EN', "Comic tags");
___('admin_comics_edit_tags',       'FR', "Tags du comic");
___('admin_comics_edit_private',    'EN', "Private (hidden from public view)");
___('admin_comics_edit_private',    'FR', "Privé (caché du public)");
___('admin_comics_edit_submit',     'EN', "Edit comic");
___('admin_comics_edit_submit',     'FR', "Modifier le comic");
___('admin_comics_edit_preview',    'EN', "Cover");
___('admin_comics_edit_preview',    'FR', "Couverture");
___('admin_comics_edit_comic',      'EN', "Comic");
___('admin_comics_edit_comic',      'FR', "Comic");


// Delete a comic
___('admin_comics_delete_confirm', 'EN', "Confirm the permanent deletion of this comic");
___('admin_comics_delete_confirm', 'FR', "Confirmer la suppression définitive de ce comic");


// Sharing tools
___('admin_comics_share_link',        'EN', "Link to the comic");
___('admin_comics_share_link',        'FR', "Lien du comic");
___('admin_comics_share_private',     'EN', "This comic is private and shouldn't be shared!");
___('admin_comics_share_private',     'FR', "Ce comic est privé et ne devrait pas être partagé!");
___('admin_comics_share_title',       'EN', "Comic title");
___('admin_comics_share_title',       'FR', "Title du comic");
___('admin_comics_share_desc',        'EN', "Comic description");
___('admin_comics_share_desc',        'FR', "Description du comic");
___('admin_comics_share_youtube',     'EN', "YouTube link");
___('admin_comics_share_youtube',     'FR', "Lien YouTube");
___('admin_comics_share_transcript',  'EN', "Comic transcript");
___('admin_comics_share_transcript',  'FR', "Transcription du comic");
___('admin_comics_share_markdown',    'EN', "Markdown transcript");
___('admin_comics_share_markdown',    'FR', "Transcription Markdown");


// Comic types: List
___('admin_comic_types_title',  'EN', "Comic types");
___('admin_comic_types_title',  'FR', "Types de comics");
___('admin_comic_types_order',  'EN', "Order");
___('admin_comic_types_order',  'FR', "Ordre");
___('admin_comic_types_name',   'EN', "Name");
___('admin_comic_types_name',   'FR', "Nom");
___('admin_comic_types_banner', 'EN', "Banner");
___('admin_comic_types_banner', 'FR', "Bannière");
___('admin_comic_types_number', 'EN', "Comics");
___('admin_comic_types_number', 'FR', "Comics");
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
___('admin_comic_type_delete_used',     'EN', "You cannot delete a comic type as long as it has comics attached to it");
___('admin_comic_type_delete_used',     'FR', "Vous ne pouvez pas supprimer un type de comic tant qu\'il est lié à des comics");




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                      VIDEOS                                                       */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Behind the scene videos
___('admin_videos_bts_title', 'EN', "Behind the scenes videos");
___('admin_videos_bts_title', 'FR', "Vidéos des coulisses");


// BTS videos: Add
___('admin_videos_bts_add_title',       'EN', "Add a behind the scenes video");
___('admin_videos_bts_add_title',       'FR', "Ajouter une vidéo des coulisses");
___('admin_videos_bts_add_order',       'EN', "Sorting order");
___('admin_videos_bts_add_order',       'FR', "Ordre de tri");
___('admin_videos_bts_add_youtube_id',  'EN', "YouTube ID");
___('admin_videos_bts_add_youtube_id',  'FR', "ID YouTube");
___('admin_videos_bts_add_name_en',     'EN', "Video title (EN)");
___('admin_videos_bts_add_name_en',     'FR', "Titre de la vidéo (EN)");
___('admin_videos_bts_add_name_fr',     'EN', "Video title (FR)");
___('admin_videos_bts_add_name_fr',     'FR', "Titre de la vidéo (FR)");
___('admin_videos_bts_add_desc_en',     'EN', "Video description (EN)");
___('admin_videos_bts_add_desc_en',     'FR', "Description de la vidéo (EN)");
___('admin_videos_bts_add_desc_fr',     'EN', "Video description (FR)");
___('admin_videos_bts_add_desc_fr',     'FR', "Description de la vidéo (FR)");
___('admin_videos_bts_add_submit',      'EN', "Add BTS video");
___('admin_videos_bts_add_submit',      'FR', "Ajouter la vidéo BTS");




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                        TAGS                                                       */
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
___('admin_tags_number',    'EN', "Used");
___('admin_tags_number',    'FR', "Utilisé");
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
___('admin_tags_delete_used',    'EN', "You cannot delete a tag as long as it has comics linked to it");
___('admin_tags_delete_used',    'FR', "Vous ne pouvez pas supprimer un tag tant qu\'il est lié à des comics");




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





/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                      QUOTES                                                       */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Quote
___('admin_quote_title',  'EN', "Quote");
___('admin_quote_title',  'FR', "Citation");
___('admin_quote_edit',   'EN', "Edit quote");
___('admin_quote_edit',   'FR', "Modifier la citation");
___('admin_quote_source', 'EN', "Source");
___('admin_quote_source', 'FR', "Source");
___('admin_quote_tags',   'EN', "Tags");
___('admin_quote_tags',   'FR', "Tags");


// Quote BBCode documentation
___('admin_quotes_bbcode_title',      'EN', "BBCode documentation (quotes)");
___('admin_quotes_bbcode_title',      'FR', "Doc des BBCodes (citations)");
___('admin_quotes_bbcode_bold',       'EN', "[b]Bold[/b]");
___('admin_quotes_bbcode_bold',       'FR', "[b]Gras[/b]");
___('admin_quotes_bbcode_italics',    'EN', "[i]Italics[/i]");
___('admin_quotes_bbcode_italics',    'FR', "[i]Italique[/i]");
___('admin_quotes_bbcode_underline',  'EN', "[u]Underlined[/u]");
___('admin_quotes_bbcode_underline',  'FR', "[u]Souligné[/u]");
___('admin_quotes_bbcode_strike',     'EN', "[s]Strikethrough[/s]");
___('admin_quotes_bbcode_strike',     'FR', "[s]Barré[/s]");
___('admin_quotes_bbcode_link',       'EN', "[url=https://example.com]Link[/url]");
___('admin_quotes_bbcode_link',       'FR', "[url=https://example.com]Lien[/url]");
___('admin_quotes_bbcode_link_2',     'EN', "[url]https://example.com[/url]");
___('admin_quotes_bbcode_link_2',     'FR', "[url]https://example.com[/url]");
___('admin_quotes_bbcode_help',       'EN', "BBCodes help");
___('admin_quotes_bbcode_help',       'FR', "Aide des BBCodes");


// Quote farm
___('admin_quotes_farm_title',  'EN', "Quote farm");
___('admin_quotes_farm_title',  'FR', "Ferme à citations");
___('admin_quotes_farm_search', 'EN', "Search");
___('admin_quotes_farm_search', 'FR', "Chercher");


// Quote list
___('admin_quotes_title',           'EN', "Quotes");
___('admin_quotes_title',           'FR', "Citations");
___('admin_quotes_year',            'EN', "Year");
___('admin_quotes_year',            'FR', "Année");
___('admin_quotes_author',          'EN', "Author");
___('admin_quotes_author',          'FR', "Auteur");
___('admin_quotes_source',          'EN', "Source");
___('admin_quotes_source',          'FR', "Source");
___('admin_quotes_quote_full',      'EN', "Quote");
___('admin_quotes_quote_full',      'FR', "Citation");
___('admin_quotes_name',            'EN', "Title");
___('admin_quotes_name',            'FR', "Titre");
___('admin_quotes_quote',           'EN', "Quote");
___('admin_quotes_quote',           'FR', "Citation");
___('admin_quotes_sort',            'EN', "Sorting order");
___('admin_quotes_sort',            'FR', "Ordre de tri");
___('admin_quotes_tags',            'EN', "Tags");
___('admin_quotes_tags',            'FR', "Tags");
___('admin_quotes_added',           'EN', "Added");
___('admin_quotes_added',           'FR', "Ajoutée");
___('admin_quotes_search_notrans',  'EN', "No translation");
___('admin_quotes_search_notrans',  'FR', "Pas de traduction");
___('admin_quotes_search_notitle',  'EN', "No title");
___('admin_quotes_search_notitle',  'FR', "Pas de titre");
___('admin_quotes_search_year',     'EN', "Has a year");
___('admin_quotes_search_year',     'FR', "A une année");
___('admin_quotes_search_noyear',   'EN', "Does not have a year");
___('admin_quotes_search_noyear',   'FR', "N'a pas d'année");
___('admin_quotes_search_notags',   'EN', "Does not have tags");
___('admin_quotes_search_notags',   'FR', "N'a pas de tags");
___('admin_quotes_count',           'EN', "{{1}} quote");
___('admin_quotes_count',           'FR', "{{1}} citation");
___('admin_quotes_count+',          'EN', "{{1}} quotes");
___('admin_quotes_count+',          'FR', "{{1}} citations");


// Quotes: Add
___('admin_quotes_add_title',     'EN', "Add a quote");
___('admin_quotes_add_title',     'FR', "Ajouter une citation");
___('admin_quotes_add_media',     'EN', "Source media");
___('admin_quotes_add_media',     'FR', "Média source");
___('admin_quotes_add_author',    'EN', "Author");
___('admin_quotes_add_author',    'FR', "Auteur");
___('admin_quotes_add_nomedia',   'EN', " (if no media)");
___('admin_quotes_add_nomedia',   'FR', " (si pas de média)");
___('admin_quotes_add_year',      'EN', "Year published");
___('admin_quotes_add_year',      'FR', "Année de publication");
___('admin_quotes_add_sort',      'EN', "Sorting order (within the media/author)");
___('admin_quotes_add_sort',      'FR', "Ordre de tri (au sein du média/auteur)");
___('admin_quotes_add_title_en',  'EN', "English title");
___('admin_quotes_add_title_en',  'FR', "Titre anglais");
___('admin_quotes_add_title_fr',  'EN', "French title");
___('admin_quotes_add_title_fr',  'FR', "Titre français");
___('admin_quotes_add_origin_en', 'EN', "English origin");
___('admin_quotes_add_origin_en', 'FR', "Origine anglaise");
___('admin_quotes_add_origin_fr', 'EN', "French origin");
___('admin_quotes_add_origin_fr', 'FR', "Origine française");
___('admin_quotes_add_source_en', 'EN', "English source (or link)");
___('admin_quotes_add_source_en', 'FR', "Source (ou lien) anglais");
___('admin_quotes_add_source_fr', 'EN', "French source (or link)");
___('admin_quotes_add_source_fr', 'FR', "Source (ou lien) français");
___('admin_quotes_add_desc_en',   'EN', "English description / addendums");
___('admin_quotes_add_desc_en',   'FR', "Description / addendums en anglais");
___('admin_quotes_add_desc_fr',   'EN', "French description / addendums");
___('admin_quotes_add_desc_fr',   'FR', "Description / addendums en français");
___('admin_quotes_add_body_en',   'EN', "English quote");
___('admin_quotes_add_body_en',   'FR', "Citation en anglais");
___('admin_quotes_add_body_fr',   'EN', "French quote");
___('admin_quotes_add_body_fr',   'FR', "Citation en français");
___('admin_quotes_add_tags',      'EN', "Tagged categories");
___('admin_quotes_add_tags',      'FR', "Catégories liées");
___('admin_quotes_add_submit',    'EN', "Add quote");
___('admin_quotes_add_submit',    'FR', "Ajouter la citation");
___('admin_quotes_add_untitled',  'EN', "Untitled quote");
___('admin_quotes_add_untitled',  'FR', "Citation sans titre");


// Quotes: Edit
___('admin_quotes_edit_title',     'EN', "Edit a quote");
___('admin_quotes_edit_title',     'FR', "Modifier une citation");
___('admin_quotes_edit_submit',    'EN', "Edit quote");
___('admin_quotes_edit_submit',    'FR', "Modifier la citation");


// Quotes: Delete
___('admin_quotes_delete_confirm', 'EN', "Confirm the permanent deletion of this quote");
___('admin_quotes_delete_confirm', 'FR', "Confirmer la suppression définitive de cette citation");


// Quote authors
___('admin_quotes_authors_title',     'EN', "Quote authors");
___('admin_quotes_authors_title',     'FR', "Auteurs de citations");
___('admin_quotes_authors_name',      'EN', "Name");
___('admin_quotes_authors_name',      'FR', "Nom");
___('admin_quotes_authors_portrait',  'EN', "Img");
___('admin_quotes_authors_portrait',  'FR', "Img");
___('admin_quotes_authors_slug',      'EN', "Slug");
___('admin_quotes_authors_slug',      'FR', "Slug");
___('admin_quotes_authors_image',     'EN', "Portrait");
___('admin_quotes_authors_image',     'FR', "Portrait");
___('admin_quotes_authors_years',     'EN', "Years");
___('admin_quotes_authors_years',     'FR', "Années");
___('admin_quotes_authors_media',     'EN', "Media");
___('admin_quotes_authors_media',     'FR', "Médias");
___('admin_quotes_authors_quotes',    'EN', "Quotes");
___('admin_quotes_authors_quotes',    'FR', "Citations");
___('admin_quotes_authors_count',     'EN', "{{1}} author");
___('admin_quotes_authors_count',     'FR', "{{1}} auteur");
___('admin_quotes_authors_count+',    'EN', "{{1}} authors");
___('admin_quotes_authors_count+',    'FR', "{{1}} auteurs");


// Quote authors: Add
___('admin_quotes_authors_add_title',   'EN', "Add an author");
___('admin_quotes_authors_add_title',   'FR', "Ajouter un auteur");
___('admin_quotes_authors_add_name_en', 'EN', "English name");
___('admin_quotes_authors_add_name_en', 'FR', "Nom anglais");
___('admin_quotes_authors_add_name_fr', 'EN', "French name");
___('admin_quotes_authors_add_name_fr', 'FR', "Nom français");
___('admin_quotes_authors_add_birth',   'EN', "Birth year");
___('admin_quotes_authors_add_birth',   'FR', "Année de naissance");
___('admin_quotes_authors_add_death',   'EN', "Death year");
___('admin_quotes_authors_add_death',   'FR', "Année de décès");
___('admin_quotes_authors_add_desc_en', 'EN', "English description");
___('admin_quotes_authors_add_desc_en', 'FR', "Description anglaise");
___('admin_quotes_authors_add_desc_fr', 'EN', "French description");
___('admin_quotes_authors_add_desc_fr', 'FR', "Description française");
___('admin_quotes_authors_add_submit',  'EN', "Add author");
___('admin_quotes_authors_add_submit',  'FR', "Ajouter l'auteur");


// Quote authors: Edit
___('admin_quotes_authors_edit_title',   'EN', "Edit an author");
___('admin_quotes_authors_edit_title',   'FR', "Modifier un auteur");
___('admin_quotes_authors_edit_submit',  'EN', "Edit author");
___('admin_quotes_authors_edit_submit',  'FR', "Modifier l'auteur");


// Quote authors: Delete
___('admin_quotes_authors_delete_confirm',  'EN', "Confirm the permanent deletion of this author");
___('admin_quotes_authors_delete_confirm',  'FR', "Confirmer la suppression définitive de cet auteur");
___('admin_quotes_authors_delete_quotes',   'EN', "You cannot delete an author as long as they have quotes attached to them");
___('admin_quotes_authors_delete_quotes',   'FR', "Vous ne pouvez pas supprimer un auteur tant qu\'il est lié à des citations");
___('admin_quotes_authors_delete_media',    'EN', "You cannot delete an author as long as they have media attached to them");
___('admin_quotes_authors_delete_media',    'FR', "Vous ne pouvez pas supprimer un auteur tant qu\'il est lié à des médias");


// Quote authors: Gallery
___('admin_quotes_authors_gallery_title',   'EN', "Quote authors gallery");
___('admin_quotes_authors_gallery_title',   'FR', "Galerie d'auteurs de citations");
___('admin_quotes_authors_gallery_missing', 'EN', "Authors without portraits");
___('admin_quotes_authors_gallery_missing', 'FR', "Auteurs sans portrait");
___('admin_quotes_authors_gallery_quotes',  'EN', "{{1}} quote");
___('admin_quotes_authors_gallery_quotes',  'FR', "{{1}} citation");
___('admin_quotes_authors_gallery_quotes+', 'EN', "{{1}} quotes");
___('admin_quotes_authors_gallery_quotes+', 'FR', "{{1}} citations");


// Quote media
___('admin_quotes_media_title',   'EN', "Quote media");
___('admin_quotes_media_title',   'FR', "Médias de citations");
___('admin_quotes_media_name',    'EN', "Name");
___('admin_quotes_media_name',    'FR', "Nom");
___('admin_quotes_media_year',    'EN', "Published");
___('admin_quotes_media_year',    'FR', "Publié");
___('admin_quotes_media_authors', 'EN', "Authors");
___('admin_quotes_media_authors', 'FR', "Auteurs");
___('admin_quotes_media_quotes',  'EN', "Quotes");
___('admin_quotes_media_quotes',  'FR', "Citations");
___('admin_quotes_media_count',   'EN', "{{1}} media");
___('admin_quotes_media_count',   'FR', "{{1}} média");
___('admin_quotes_media_count+',  'EN', "{{1}} media");
___('admin_quotes_media_count+',  'FR', "{{1}} médias");


// Quote media: Add
___('admin_quotes_media_add_title',     'EN', "Add a media");
___('admin_quotes_media_add_title',     'FR', "Ajouter un média");
___('admin_quotes_media_add_name_en',   'EN', "English name");
___('admin_quotes_media_add_name_en',   'FR', "Nom anglais");
___('admin_quotes_media_add_name_fr',   'EN', "French name");
___('admin_quotes_media_add_name_fr',   'FR', "Nom français");
___('admin_quotes_media_add_desc_en',   'EN', "English description");
___('admin_quotes_media_add_desc_en',   'FR', "Description anglaise");
___('admin_quotes_media_add_desc_fr',   'EN', "French description");
___('admin_quotes_media_add_desc_fr',   'FR', "Description française");
___('admin_quotes_media_add_source_en', 'EN', "English link");
___('admin_quotes_media_add_source_en', 'FR', "Lien anglais");
___('admin_quotes_media_add_source_fr', 'EN', "French link");
___('admin_quotes_media_add_source_fr', 'FR', "Lien français");
___('admin_quotes_media_add_year',      'EN', "Year published");
___('admin_quotes_media_add_year',      'FR', "Année de publication");
___('admin_quotes_media_add_submit',    'EN', "Add media");
___('admin_quotes_media_add_submit',    'FR', "Ajouter le média");


// Quote media: Edit
___('admin_quotes_media_edit_title',  'EN', "Edit a media");
___('admin_quotes_media_edit_title',  'FR', "Modifier un média");
___('admin_quotes_media_add_authors', 'EN', "Authors");
___('admin_quotes_media_add_authors', 'FR', "Auteurs");
___('admin_quotes_media_edit_submit', 'EN', "Edit media");
___('admin_quotes_media_edit_submit', 'FR', "Modifier le média");


// Quote media: Delete
___('admin_quotes_media_delete_confirm',  'EN', "Confirm the permanent deletion of this media");
___('admin_quotes_media_delete_confirm',  'FR', "Confirmer la suppression définitive de ce média");
___('admin_quotes_media_delete_quotes',   'EN', "You cannot delete a media as long as it has quotes attached to it");
___('admin_quotes_media_delete_quotes',   'FR', "Vous ne pouvez pas supprimer un média tant qu\'il est lié à des citations");


// Quote tags
___('admin_quotes_tags_title',  'EN', "Quote tags");
___('admin_quotes_tags_title',  'FR', "Tags de citations");
___('admin_quotes_tags_sort',   'EN', "Order");
___('admin_quotes_tags_sort',   'FR', "Ordre");
___('admin_quotes_tags_name',   'EN', "Name");
___('admin_quotes_tags_name',   'FR', "Nom");
___('admin_quotes_tags_quotes', 'EN', "Quotes");
___('admin_quotes_tags_quotes', 'FR', "Citations");
___('admin_quotes_tags_count',  'EN', "{{1}} tag");
___('admin_quotes_tags_count',  'FR', "{{1}} tag");
___('admin_quotes_tags_count+', 'EN', "{{1}} tags");
___('admin_quotes_tags_count+', 'FR', "{{1}} tags");


// Quote tags: Add
___('admin_quotes_tags_add_title',    'EN', "Add a tag");
___('admin_quotes_tags_add_title',    'FR', "Ajouter un tag");
___('admin_quotes_tags_add_sort',     'EN', "Sorting order");
___('admin_quotes_tags_add_sort',     'FR', "Ordre de tri");
___('admin_quotes_tags_add_name_en',  'EN', "English name");
___('admin_quotes_tags_add_name_en',  'FR', "Nom anglais");
___('admin_quotes_tags_add_name_fr',  'EN', "French name");
___('admin_quotes_tags_add_name_fr',  'FR', "Nom français");
___('admin_quotes_tags_add_submit',   'EN', "Add tag");
___('admin_quotes_tags_add_submit',   'FR', "Ajouter le tag");


// Quote tags: Edit
___('admin_quotes_tags_edit_title',   'EN', "Edit a tag");
___('admin_quotes_tags_edit_title',   'FR', "Modifier un tag");
___('admin_quotes_tags_edit_submit',  'EN', "Edit tag");
___('admin_quotes_tags_edit_submit',  'FR', "Modifier le tag");


// Quote tags: Delete
___('admin_quotes_tags_delete_confirm',  'EN', "Confirm the permanent deletion of this tag");
___('admin_quotes_tags_delete_confirm',  'FR', "Confirmer la suppression définitive de ce tag");
___('admin_quotes_tags_delete_quotes',   'EN', "You cannot delete a tag as long as it has quotes attached to it");
___('admin_quotes_tags_delete_quotes',   'FR', "Vous ne pouvez pas supprimer un tag tant qu\'il est lié à des citations");


// Quotes: Origins
___('quote_origin_source_short',      'EN', "Authentic from source");
___('quote_origin_source_short',      'FR', "Authentique depuis la source");
___('quote_origin_paraphrased_short', 'EN', "Paraphrased from source");
___('quote_origin_paraphrased_short', 'FR', "Paraphrasée depuis la source");
___('quote_origin_translated_short',  'EN', "My own translation");
___('quote_origin_translated_short',  'FR', "Ma propre traduction");
___('quote_origin_third_short',       'EN', "Third-party translation");
___('quote_origin_third_short',       'FR', "Traduite par un tiers");
___('quote_origin_unknown_short',     'EN', "Unknown/unconfirmed origin");
___('quote_origin_unknown_short',     'FR', "Origine inconnue/non confirmée");
___('quote_origin_source',            'EN', "This quote is reproduced from the source media. It has not been altered.");
___('quote_origin_source',            'FR', "Cette citation est tirée du média source. Elle n'a pas été modifiée.");
___('quote_origin_paraphrased',       'EN', "This quote is paraphrased from the source media. It might have been slightly altered.");
___('quote_origin_paraphrased',       'FR', "Cette citation est paraphrasée du média source. Elle peut être légèrement modifiée.");
___('quote_origin_translated',        'EN', "This quote has been translated from the source media. It might have lost some of its substance during the translation.");
___('quote_origin_translated',        'FR', "Cette citation a été traduite depuis le média source. Il se peut qu'elle ait perdu une partie de sa substance lors de la traduction.");
___('quote_origin_third',             'EN', "This quote has been translated by a third party tool. It might have lost some of its substance during the translation.");
___('quote_origin_third',             'FR', "Cette citation a été traduite par un outil tiers. Il se peut qu'elle ait perdu une partie de sa substance lors de la traduction.");
___('quote_origin_unknown',           'EN', "This quote's origin is unknown, and thus could not be verified. It may be a misattribution or a fabrication.");
___('quote_origin_unknown',           'FR', "L'origine de cette citation est inconnue et n'a donc pas pu être vérifiée. Il peut s'agir d'une citation erronée.");