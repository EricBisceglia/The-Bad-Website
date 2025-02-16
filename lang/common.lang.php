<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                          INTERNATIONALIZATION FUNCTIONS                                           */
/*                                                                                                                   */
/*********************************************************************************************************************/

 /**
 * Returns a localized translation.
 *
 * The translations are stored in the global variable called $GLOBALS['translations'].
 * Translations can optionally have a plural version, in this case append a '+' to the end of 'phrase_name'.
 * If you request a plural and no plural is found by the function, it will return the singular version of the phrase.
 * Inside those translations, links can be built using the {{link|href|text|style|internal|path}} format.
 * The last 3 parameters of this format are optional - see the doc of the __link() function for details.
 *
 * @param   string                $string         The string identifying the phrase to be translated.
 * @param   int|null  (OPTIONAL)  $amount         Amount of elements: 1 or null is singular, anything else is plural.
 * @param   int       (OPTIONAL)  $spaces_before  Number of spaces to insert before the translation.
 * @param   int       (OPTIONAL)  $spaces_after   Number of spaces to append to the end of the translation.
 * @param   array     (OPTIONAL)  $preset_values  An array of values to be included in the phrase.
 *
 * @return  string                              The translated string, or an empty string if no translation was found.
 */

function __(  string  $string                   ,
              ?int    $amount         = NULL    ,
              int     $spaces_before  = 0       ,
              int     $spaces_after   = 0       ,
              array   $preset_values  = array() ) : string
{
  // If there are no global translations, return nothing
  if(!isset($GLOBALS['translations']))
    return '';

  // If required, use the plural version of the string if it exists (plural translation names ends in a '+')
  if(!is_null($amount) && $amount !== 1 && isset($GLOBALS['translations'][$string.'+']))
    $returned_string = $GLOBALS['translations'][$string.'+'];

  // Otherwise, use the requested string
  else if(isset($GLOBALS['translations'][$string]))
    $returned_string = $GLOBALS['translations'][$string];

  // If we have no string to return, return an empty string
  if(!isset($returned_string))
    return "";

  // Look for content to replace if required
  if(is_array($preset_values) && !empty($preset_values))
  {
    // Walk through all elements in the provided array and replace them using a regex
    foreach($preset_values as $key => $value)
      $returned_string = str_replace("{{".($key + 1)."}}", $value, $returned_string);
  }

  /*
  / Replace URLs if needed, using a regex that can work in either of the following ways:
  / {{link_popup|href|text}}        # Will open in a popup (target blank)
  / {{link++|href|text|style|path}} # Will always be an internal link
  / {{link+|href|text|style}}
  / {{link|href|text}}
  / {{external|href|text}}
  / {{external_popup|href|text}}    # Will open in a popup (target blank)
  */
  $returned_string = preg_replace('/\{\{link_popup\|(.*?)\|(.*?)\}\}/is',__link("$1", "$2", popup: true), $returned_string);
  $returned_string = preg_replace('/\{\{link\+\+\|(.*?)\|(.*?)\|(.*?)\|(.*?)\}\}/is',__link("$1", "$2", "$3", path: "$5"), $returned_string);
  $returned_string = preg_replace('/\{\{link\+\+\|(.*?)\|(.*?)\|(.*?)\|(.*?)\}\}/is',__link("$1", "$2", "$3", 0), $returned_string);
  $returned_string = preg_replace('/\{\{link\+\|(.*?)\|(.*?)\|(.*?)\}\}/is',__link("$1", "$2", "$3"), $returned_string);
  $returned_string = preg_replace('/\{\{link\|(.*?)\|(.*?)\}\}/is',__link("$1", "$2"), $returned_string);
  $returned_string = preg_replace('/\{\{external\|(.*?)\|(.*?)\}\}/is',__link("$1", "$2", is_internal: false), $returned_string);
  $returned_string = preg_replace('/\{\{external_popup\|(.*?)\|(.*?)\}\}/is',__link("$1", "$2", is_internal: false, popup: true), $returned_string);

  /*
  / Replace tooltips if needed, using a regex that can work in either of the following ways:
  / {{tooltip+|title|tooltip|title_style|tooltip_style}}
  / {{tooltip|title|tooltip}}
  */
  $returned_string = preg_replace('/\{\{tooltip\+\|(.*?)\|(.*?)\|(.*?)\|(.*?)\}\}/is',__tooltip("$1", "$2", "$3", "$4"), $returned_string);
  $returned_string = preg_replace('/\{\{tooltip\|(.*?)\|(.*?)\}\}/is',__tooltip("$1", "$2"), $returned_string);

  // Prepare the spaces to prepend to the string
  if(is_int($spaces_before) && $spaces_before > 0)
    $spaces_before = ($spaces_before === 1) ? " " : str_repeat(" ", $spaces_before);
  else
    $spaces_before = '';

  // Prepare the spaces to append to the string
  if(is_int($spaces_after) && $spaces_after > 0)
    $spaces_after = ($spaces_after === 1) ? " " : str_repeat(" ", $spaces_after);
  else
    $spaces_after = '';

  // Return the string, with the requested spaces around it
  return $spaces_before.$returned_string.$spaces_after;
}




 /**
 * Adds a new translation to the global translations array.
 *
 * @param   string  $name         The identifier of the translation, used to fetch it with the __() function.
 * @param   string  $lang         The language in which the translation is being made.
 * @param   string  $translation  The translated string, which will be returned when calling the __() function.
 *
 * @return  void
 */

function ___( string  $name         ,
              string  $lang         ,
              string  $translation  ) : void
{
  // Only treat this if we are in the current language
  $current_lang = (!isset($_SESSION['lang'])) ? 'EN' : $_SESSION['lang'];
  if($current_lang !== $lang)
    return;

  // Check if a translation by this name already exists - if yes publicly humiliate the coder for their poor work :(
  if(isset($GLOBALS['translations'][$name]))
    exit(__('error_duplicate_translation').$name);

  // Create or overwrite an entry in the global translations array
  $GLOBALS['translations'][$name] = $translation;
}




 /**
 * Builds a link.
 *
 * @param   string  $href                     The destination of the link.
 * @param   string  $text                     The text to be displayed on the link.
 * @param   string  $style        (OPTIONAL)  The CSS style(s) to apply to the link.
 * @param   bool    $is_internal  (OPTIONAL)  Whether the link is internal (on the website) or external.
 * @param   string  $path         (OPTIONAL)  The path to the website's root (defaults to 2 folders from root).
 * @param   string  $onclick      (OPTIONAL)  A javascript option to trigger upon clicking the link.
 * @param   string  $onmouseover  (OPTIONAL)  A javascript option to trigger upon hovering over the link.
 * @param   string  $id           (OPTIONAL)  An ID to give the <a> element containing the link.
 * @param   bool    $popup        (OPTIONAL)  Opens the link in a new window.
 * @param   string  $confirm      (OPTIONAL)  A confirmation dialog that must be accepted before the link is followed.
 *
 * @return  string                            The link, ready for use.
 */

function __link(  string  $href                       ,
                  string  $text                       ,
                  string  $style        = "bold"      ,
                  bool    $is_internal  = true        ,
                  string  $path         = "./../../"  ,
                  string  $onclick      = ''          ,
                  string  $onmouseover  = ''          ,
                  string  $id           = ''          ,
                  bool    $popup        = false       ,
                  string  $confirm      = ''          ) : string
{
  // Prepare the style
  $class = ($style) ? " class=\"$style\"" : "";

  // Prepare the URL
  $url = ($is_internal) ? $path.$href : $href;
  $url = ($url)         ? "href=\"".$url."\"" : "";

  // Make it pop-up if needed
  $popup = ($popup) ? 'rel="noopener noreferrer" target="_blank"' : '';

  // Prepare the confirmation dialog
  $onclick = ($confirm) ? "return confirm('".$confirm."'); ".$onclick : $onclick;

  // Prepare the onclick
  $onclick = ($onclick) ? 'onclick="'.$onclick.'"' : '';

  // Prepare the onmouseover
  $onmouseover = ($onmouseover) ? 'onmouseover="'.$onmouseover.'"' : '';

  // Prepare the ID
  $id = ($id) ? 'id="'.$id.'"' : '';

  // Return the built link
  return "<a $class $url $popup $onclick $onmouseover $id>$text</a>";
}



 /**
 * Builds an icon.
 *
 * @param   string  $icon                     The icon's name.
 * @param   bool    $is_small     (OPTIONAL)  Use the small version of an icon instead of the full version.
 * @param   string  $href         (OPTIONAL)  The URL the icon links to.
 * @param   bool    $is_internal  (OPTIONAL)  Whether the link is internal (on the website) or external.
 * @param   string  $class        (OPTIONAL)  Extra css classes to apply to the icon.
 * @param   string  $alt          (OPTIONAL)  The alt text which will be displayed if the image can't be found.
 * @param   string  $title        (OPTIONAL)  The hover text which shows up when the pointer rests over the image.
 * @param   string  $title_case   (OPTIONAL)  Change the case of the icon's hover title.
 * @param   bool    $use_dark     (OPTIONAL)  Whether to use the dark version of the icon instead of user settings.
 * @param   bool    $use_light    (OPTIONAL)  Whether to use the light version of the icon instead of user settings.
 * @param   string  $identifier   (OPTIONAL)  Gives a html id to the element.
 * @param   string  $path         (OPTIONAL)  The path to the website's root (defaults to 2 folders from root).
 * @param   string  $onclick      (OPTIONAL)  A javascript option to trigger upon clicking the link.
 * @param   bool    $popup        (OPTIONAL)  Opens the link in a new window.
 * @param   string  $confirm      (OPTIONAL)  A confirmation dialog that must be accepted before a link is followed.
 *
 * @return  string                            The icon, ready for use.
 */

function __icon(  string  $icon                                   ,
                  bool    $is_small     = false                   ,
                  string  $href         = ''                      ,
                  bool    $is_internal  = true                    ,
                  string  $class        = 'valign_middle pointer' ,
                  string  $alt          = 'X'                     ,
                  string  $title        = ' '                     ,
                  string  $title_case   = ''                      ,
                  bool    $use_dark     = false                   ,
                  bool    $use_light    = false                   ,
                  string  $identifier   = ''                      ,
                  string  $path         = "./../../"              ,
                  string  $onclick      = ''                      ,
                  bool    $popup        = false                   ,
                  string  $confirm      = ''                      ) : string
{
  // Prepare the URL
  $url = ($is_internal) ? $path.$href : $href;
  $url = ($url)         ? "href=\"".$url."\"" : "";

  // Make the link pop-up if needed
  $popup = ($popup) ? 'rel="noopener noreferrer" target="_blank"' : '';

  // Prepare the identifier if needed
  $id = ($identifier) ? ' id="'.$identifier.'"' : '';

  // Prepare the style
  $style  = ($is_small) ? 'smallicon' : 'icon';
  $style .= ($class)    ? ' '.$class : '';
  $class  = 'class="'.$style.'"';

  // Prepare the confirmation dialog
  $onclick = ($confirm) ? "return confirm('".$confirm."'); ".$onclick : $onclick;

  // Prepare the onclick
  $onclick = ($onclick) ? 'onclick="'.$onclick.'"' : '';

  // Prepare the image path
  $icon = ($is_small) ? $icon.'_small' : $icon;
  $src  = 'src="'.$path.'img/icons/'.$icon.'.svg"';

  // Prepare the alt text and title
  $alt = 'alt="'.$alt.'"';

  // Prepare the title
  $title  = ($title_case) ? string_change_case($title, $title_case) : $title;
  $title  = 'title="'.$title.'"';

  // Return the assembled icon
  if($href)
    return "<a class=\"noglow\" $url $popup><img $id $class $src $alt $title $onclick></a>";
  else
    return "<img $id $class $src $alt $title $onclick>";
}




 /**
 * Builds an inline tooltip.
 *
 * @param   string  $title                      The element that triggers the tooltip.
 * @param   string  $tooltip_body               The tooltip's body.
 * @param   string  $title_style    (OPTIONAL)  The CSS style(s) to apply to the tooltip's triggering element.
 * @param   string  $tooltip_style  (OPTIONAL)  CSS style(s) to apply to the tooltip's body.
 *
 * @return  string                              The tooltip, ready for use.
 */

function __tooltip( string  $title                      ,
                    string  $tooltip_body               ,
                    string  $title_style    = "bold"    ,
                    string  $tooltip_style  = "notbold" ) : string
{
  // Return the assembled tooltip
  return "<span class=\"tooltip_container ".$title_style."\">".$title."<span class=\"tooltip ".$tooltip_style."\">".$tooltip_body."</span></span>";
}




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                SHARED TRANSLATIONS                                                */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Website name
___('thebadwebsite',     'EN', "The Bad Website");
___('thebadwebsite',     'FR', "Le mauvais site");
___('thebadwebsite.com', 'EN', "thebad.website");
___('thebadwebsite.com', 'FR', "mauvais.site");


// Punctuation
___(':', 'EN', ":");
___(':', 'FR', " :");


// Buttons and labels
___('add',        'EN', "add");
___('add',        'FR', "créer");
___('calendar',   'EN', "calendar");
___('calendar',   'FR', "calendrier");
___('clock',      'EN', "clock");
___('clock',      'FR', "horloge");
___('confirm',    'EN', "confirm");
___('confirm',    'FR', "confirmer");
___('copy',       'EN', "copy");
___('copy',       'FR', "copier");
___('delete',     'EN', "delete");
___('delete',     'FR', "supprimer");
___('done',       'EN', "done");
___('done',       'FR', "fini");
___('duplicate',  'EN', "duplicate");
___('duplicate',  'FR', "dupliquer");
___('details',    'EN', "details");
___('details',    'FR', "détails");
___('edit',       'EN', "edit");
___('edit',       'FR', "modifier");
___('graph',      'EN', "graph");
___('graph',      'FR', "graphe");
___('help',       'EN', "help");
___('help',       'FR', "aide");
___('info',       'EN', "info");
___('info',       'FR', "info");
___('maximize',   'EN', "maximize");
___('maximize',   'FR', "agrandir");
___('minimize',   'EN', "minimize");
___('minimize',   'FR', "réduire");
___('mode_dark',  'EN', "dark mode");
___('mode_dark',  'FR', "mode sombre");
___('mode_light', 'EN', "light mode");
___('mode_light', 'FR', "mode clair");
___('modify',     'EN', "modify");
___('modify',     'FR', "modifier");
___('more',       'EN', "more");
___('more',       'FR', "plus");
___('preview',    'EN', "preview");
___('preview',    'FR', "prévisualiser");
___('preview_2',  'EN', "preview");
___('preview_2',  'FR', "prévisualisation");
___('refresh',    'EN', "refresh");
___('refresh',    'FR', "recharger");
___('rss',        'EN', "RSS feed");
___('rss',        'FR', "flux RSS");
___('reset',      'EN', "reset");
___('reset',      'FR', "ràz");
___('reason',     'EN', "reason");
___('reason',     'FR', "raison");
___('settings',   'EN', "settings");
___('settings',   'FR', "réglages");
___('star',       'EN', "star");
___('star',       'FR', "étoile");
___('stats',      'EN', "stats");
___('stats',      'FR', "stats");
___('statistics', 'EN', "statistics");
___('statistics', 'FR', "statistiques");
___('submit',     'EN', "submit");
___('submit',     'FR', "envoyer");
___('undelete',   'EN', "undelete");
___('undelete',   'FR', "restaurer");
___('upload',     'EN', "upload");
___('upload',     'FR', "téléverser");
___('warning',    'EN', "warning");
___('warning',    'FR', "avertissement");


// Common words
___('bilingual',    'EN', "bilingual");
___('bilingual',    'FR', "bilingue");
___('birthday',     'EN', "birthday");
___('birthday',     'FR', "anniversaire");
___('category',     'EN', "category");
___('category',     'FR', "catégorie");
___('category+',    'EN', "categories");
___('category+',    'FR', "catégories");
___('closed',       'EN', "closed");
___('closed',       'FR', "fermé");
___('contents',     'EN', "contents");
___('contents',     'FR', "contenu");
___('created',      'EN', "created");
___('created',      'FR', "crée");
___('description',  'EN', "description");
___('description',  'FR', "description");
___('en',           'EN', "EN");
___('en',           'FR', "EN");
___('english',      'EN', "english");
___('english',      'FR', "anglais");
___('fr',           'EN', "FR");
___('fr',           'FR', "FR");
___('french',       'EN', "french");
___('french',       'FR', "français");
___('lang.',        'EN', "lang.");
___('lang.',        'FR', "lang.");
___('language',     'EN', "language");
___('language',     'FR', "langue");
___('language+',    'EN', "languages");
___('language+',    'FR', "langues");
___('link+',        'EN', "links");
___('link+',        'FR', "liens");
___('location',     'EN', "location");
___('location',     'FR', "lieu");
___('no',           'EN', "no");
___('no',           'FR', "non");
___('none',         'EN', "none");
___('none',         'FR', "aucun");
___('none_f',       'EN', "none");
___('none_f',       'FR', "aucune");
___('opened',       'EN', "opened");
___('opened',       'FR', "ouvert");
___('order',        'EN', "order");
___('order',        'FR', "ordre");
___('page',         'EN', "page");
___('page',         'FR', "page");
___('published',    'EN', "published");
___('published',    'FR', "publié");
___('sent',         'EN', "sent");
___('sent',         'FR', "envoyé");
___('sent+',        'EN', "sent");
___('sent+',        'FR', "envoyés");
___('text',         'EN', "text");
___('text',         'FR', "texte");
___('theme',        'EN', "theme");
___('theme',        'FR', "thème");
___('the',          'EN', "the");
___('the',          'FR', "le");
___('title',        'EN', "title");
___('title',        'FR', "titre");
___('view',         'EN', "view");
___('view',         'FR', "vue");
___('view+',        'EN', "views");
___('view+',        'FR', "vues");
___('with',         'EN', "with");
___('with',         'FR', "avec");
___('yes',          'EN', "yes");
___('yes',          'FR', "oui");


// Common actions
___('act',        'EN', "act.");
___('act',        'FR', "act.");
___('action',     'EN', "action");
___('action+',    'EN', "actions");
___('action',     'FR', "action");
___('action+',    'FR', "actions");
___('close_form', 'EN', "close this form");
___('close_form', 'FR', "fermer ce formulaire");
___('restore',    'EN', "restore");
___('restore',    'FR', "restaurer");
___('search',     'EN', "search");
___('search',     'FR', "chercher");
___('search2',    'EN', "search");
___('search2',    'FR', "recherche");
___('sort',       'EN', "sort");
___('sort',       'FR', "trier");
___('message',    'EN', "message");
___('message',    'FR', "message");


// Common technical terms
___('error',    'EN', "error");
___('error',    'FR', "erreur");
___('error+',   'EN', "errors");
___('error+',   'FR', "erreurs");
___('id',       'EN', "ID");
___('id',       'FR', "ID");
___('option',   'EN', "option");
___('option+',  'EN', "options");
___('option',   'FR', "option");
___('option+',  'FR', "options");
___('query',    'EN', "query");
___('query+',   'EN', "queries");
___('query',    'FR', "requête");
___('query+',   'FR', "requêtes");
___('type',     'EN', "type");
___('type',     'FR', "type");
___('version',  'EN', "version");
___('version',  'FR', "version");


// Common time and quantity related terms
___('all',          'EN', "All");
___('all',          'FR', "Tous");
___('date',         'EN', "date");
___('date',         'FR', "date");
___('at_date',      'EN', "at");
___('at_date',      'FR', "à");
___('day',          'EN', "day");
___('day+',         'EN', "days");
___('day',          'FR', "jour");
___('day+',         'FR', "jours");
___('day_short',    'EN', "d");
___('day_short',    'FR', "j");
___('ddmmyy',       'EN', "DD/MM/YY");
___('ddmmyy',       'FR', "JJ/MM/AA");
___('hhiiss',       'EN', "hours:minutes:seconds");
___('hhiiss',       'FR', "heures:minutes:secondes");
___('month',        'EN', "month");
___('month+',       'EN', "months");
___('month',        'FR', "mois");
___('month+',       'FR', "mois");
___('month_short',  'EN', "m");
___('month_short',  'FR', "m");
___('time',         'EN', "time");
___('time',         'FR', "heure");
___('times',        'EN', "time");
___('times+',       'EN', "times");
___('times',        'FR', "fois");
___('yyyyddmm',     'EN', "YYYY-DD-MM");
___('yyyyddmm',     'FR', "AAAA-MM-JJ");
___('year',         'EN', "year");
___('year+',        'EN', "years");
___('year',         'FR', "année");
___('year+',        'FR', "années");
___('year_age',     'EN', "year");
___('year_age+',    'EN', "years");
___('year_age',     'FR', "an");
___('year_age+',    'FR', "ans");
___('year_short',   'EN', "y");
___('year_short',   'FR', "a");


// Generic user related terms
___('account',        'EN', "account");
___('account',        'FR', "compte");
___('activity',       'EN', "activity");
___('activity',       'FR', "activité");
___('admin',          'EN', "admin");
___('admin',          'FR', "admin");
___('administration', 'EN', "administration");
___('administration', 'FR', "administration");
___('administrator',  'EN', "administrator");
___('administrator',  'FR', "administration");
___('deleted',        'EN', "deleted");
___('deleted',        'FR', "supprimé");
___('login',          'EN', "login");
___('login',          'FR', "connexion");
___('moderator',      'EN', "moderator");
___('moderator',      'FR', "modération");
___('password',       'EN', "password");
___('password',       'FR', "mot de passe");
___('register',       'EN', "register");
___('register',       'FR', "inscription");
___('rights',         'EN', "rights");
___('rights',         'FR', "droits");
___('user',           'EN', "user");
___('user',           'FR', "membre");
___('user+',          'EN', "users");
___('user+',          'FR', "membres");
___('user_acc+',      'EN', "users");
___('user_acc+',      'FR', "comptes");
___('username',       'EN', "username");
___('username',       'FR', "pseudonyme");


// Stats pages
___('stats_overall',  'EN', "Overall stats");
___('stats_overall',  'FR', "Stats globales");
___('stats_timeline', 'EN', "Timeline");
___('stats_timeline', 'FR', "Ligne temporelle");


// Table of contents
___('toc',            'EN', "Table of contents");
___('toc',            'FR', "Sommaire");




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                       DATES                                                       */
/*                                                                                                                   */
/*********************************************************************************************************************/

// Bilingual ordinals
___('ordinal_0_en', 'EN', "th");
___('ordinal_0_en', 'FR', "th");
___('ordinal_1_en', 'EN', "st");
___('ordinal_1_en', 'FR', "st");
___('ordinal_2_en', 'EN', "nd");
___('ordinal_2_en', 'FR', "nd");
___('ordinal_3_en', 'EN', "rd");
___('ordinal_3_en', 'FR', "rd");
___('ordinal_0_fr', 'EN', "ème");
___('ordinal_0_fr', 'FR', "ème");
___('ordinal_1_fr', 'EN', "er");
___('ordinal_1_fr', 'FR', "er");
___('ordinal_2_fr', 'EN', "nd");
___('ordinal_2_fr', 'FR', "nd");


// Bilingual time indicator
___('time_indicator_en',  'EN', "at");
___('time_indicator_en',  'FR', "at");
___('time_indicator_fr',  'EN', "à");
___('time_indicator_fr',  'FR', "à");


// Bilingual days
___('day_1_en', 'EN', "Monday");
___('day_1_en', 'FR', "Monday");
___('day_2_en', 'EN', "Tuesday");
___('day_2_en', 'FR', "Tuesday");
___('day_3_en', 'EN', "Wednesday");
___('day_3_en', 'FR', "Wednesday");
___('day_4_en', 'EN', "Thursday");
___('day_4_en', 'FR', "Thursday");
___('day_5_en', 'EN', "Friday");
___('day_5_en', 'FR', "Friday");
___('day_6_en', 'EN', "Saturday");
___('day_6_en', 'FR', "Saturday");
___('day_7_en', 'EN', "Sunday");
___('day_7_en', 'FR', "Sunday");
___('day_1_fr', 'EN', "Lundi");
___('day_1_fr', 'FR', "Lundi");
___('day_2_fr', 'EN', "Mardi");
___('day_2_fr', 'FR', "Mardi");
___('day_3_fr', 'EN', "Mercredi");
___('day_3_fr', 'FR', "Mercredi");
___('day_4_fr', 'EN', "Jeudi");
___('day_4_fr', 'FR', "Jeudi");
___('day_5_fr', 'EN', "Vendredi");
___('day_5_fr', 'FR', "Vendredi");
___('day_6_fr', 'EN', "Samedi");
___('day_6_fr', 'FR', "Samedi");
___('day_7_fr', 'EN', "Dimanche");
___('day_7_fr', 'FR', "Dimanche");


// Month names
___('month_1',        'EN', "January");
___('month_1',        'FR', "Janvier");
___('month_2',        'EN', "February");
___('month_2',        'FR', "Février");
___('month_3',        'EN', "March");
___('month_3',        'FR', "Mars");
___('month_4',        'EN', "April");
___('month_4',        'FR', "Avril");
___('month_5',        'EN', "May");
___('month_5',        'FR', "Mai");
___('month_6',        'EN', "June");
___('month_6',        'FR', "Juin");
___('month_7',        'EN', "July");
___('month_7',        'FR', "Juillet");
___('month_8',        'EN', "August");
___('month_8',        'FR', "Août");
___('month_9',        'EN', "September");
___('month_9',        'FR', "Septembre");
___('month_10',       'EN', "October");
___('month_10',       'FR', "Octobre");
___('month_11',       'EN', "November");
___('month_11',       'FR', "Novembre");
___('month_12',       'EN', "December");
___('month_12',       'FR', "Décembre");
___('month_short_1',  'EN', "Jan.");
___('month_short_1',  'FR', "Jan.");
___('month_short_2',  'EN', "Feb.");
___('month_short_2',  'FR', "Fév.");
___('month_short_3',  'EN', "Mar.");
___('month_short_3',  'FR', "Mar.");
___('month_short_4',  'EN', "Apr.");
___('month_short_4',  'FR', "Avr.");
___('month_short_5',  'EN', "May");
___('month_short_5',  'FR', "Mai");
___('month_short_6',  'EN', "June");
___('month_short_6',  'FR', "Juin");
___('month_short_7',  'EN', "July");
___('month_short_7',  'FR', "Juil.");
___('month_short_8',  'EN', "Aug.");
___('month_short_8',  'FR', "Août");
___('month_short_9',  'EN', "Sept.");
___('month_short_9',  'FR', "Sept.");
___('month_short_10', 'EN', "Oct.");
___('month_short_10', 'FR', "Oct.");
___('month_short_11', 'EN', "Nov.");
___('month_short_11', 'FR', "Nov.");
___('month_short_12', 'EN', "Dec.");
___('month_short_12', 'FR', "Déc.");


// Bilingual months
___('month_1_en',   'EN', "January");
___('month_1_en',   'FR', "January");
___('month_2_en',   'EN', "February");
___('month_2_en',   'FR', "February");
___('month_3_en',   'EN', "March");
___('month_3_en',   'FR', "March");
___('month_4_en',   'EN', "April");
___('month_4_en',   'FR', "April");
___('month_5_en',   'EN', "May");
___('month_5_en',   'FR', "May");
___('month_6_en',   'EN', "June");
___('month_6_en',   'FR', "June");
___('month_7_en',   'EN', "July");
___('month_7_en',   'FR', "July");
___('month_8_en',   'EN', "August");
___('month_8_en',   'FR', "August");
___('month_9_en',   'EN', "September");
___('month_9_en',   'FR', "September");
___('month_10_en',  'EN', "October");
___('month_10_en',  'FR', "October");
___('month_11_en',  'EN', "November");
___('month_11_en',  'FR', "November");
___('month_12_en',  'EN', "December");
___('month_12_en',  'FR', "December");
___('month_1_fr',   'EN', "Janvier");
___('month_1_fr',   'FR', "Janvier");
___('month_2_fr',   'EN', "Février");
___('month_2_fr',   'FR', "Février");
___('month_3_fr',   'EN', "Mars");
___('month_3_fr',   'FR', "Mars");
___('month_4_fr',   'EN', "Avril");
___('month_4_fr',   'FR', "Avril");
___('month_5_fr',   'EN', "Mai");
___('month_5_fr',   'FR', "Mai");
___('month_6_fr',   'EN', "Juin");
___('month_6_fr',   'FR', "Juin");
___('month_7_fr',   'EN', "Juillet");
___('month_7_fr',   'FR', "Juillet");
___('month_8_fr',   'EN', "Août");
___('month_8_fr',   'FR', "Août");
___('month_9_fr',   'EN', "Septembre");
___('month_9_fr',   'FR', "Septembre");
___('month_10_fr',  'EN', "Octobre");
___('month_10_fr',  'FR', "Octobre");
___('month_11_fr',  'EN', "Novembre");
___('month_11_fr',  'FR', "Novembre");
___('month_12_fr',  'EN', "Décembre");
___('month_12_fr',  'FR', "Décembre");




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                 BBCODES / NBCODES                                                 */
/*                                                                                                                   */
/*********************************************************************************************************************/

// BBCodes editor
___('bold',       'EN', "Bold");
___('bold',       'FR', "Gras");
___('italics',    'EN', "Italics");
___('italics',    'FR', "Italique");
___('underlined', 'EN', "Underline");
___('underlined', 'FR', "Souligner");
___('quote',      'EN', "Quote");
___('quote',      'FR', "Citation");
___('spoiler',    'EN', "Spoiler");
___('spoiler',    'FR', "Divulgâchage");
___('link',       'EN', "Link");
___('link',       'FR', "Lien");
___('image',      'EN', "Image");
___('image',      'FR', "Image");


// BBcodes editor prompts
___('quote_prompt',   'EN', "Who or what are you quoting? (you can leave this empty)");
___('quote_prompt',   'FR', "Qui ou quoi citez-vous ? (vous pouvez laisser ceci vide)");
___('spoiler_prompt', 'EN', "What is the name of the content that you are spoiling? (you can leave this empty)");
___('spoiler_prompt', 'FR', "Quel est le nom de ce que vous divulgâchez ? (vous pouvez laisser ceci vide)");
___('link_prompt',    'EN', "What is the URL you want to link to?");
___('link_prompt',    'FR', "Vers quelle adresse internet voulez-vous faire pointer votre lien ?");
___('link_prompt_2',  'EN', "What text do you want your link to show (optional)");
___('link_prompt_2',  'FR', "Quel texte voulez-vous afficher sur votre lien (optionnel)");
___('image_prompt',   'EN', "What is the URL of the image you want to insert?");
___('image_prompt',   'FR', "Quelle est l\'adresse internet de l\'image que vous désirez insérer ?");


// BBCodes
___('bbcodes',              'EN', "BBCodes");
___('bbcodes',              'FR', "BBCodes");
___('bbcodes_quote',        'EN', "Quote:");
___('bbcodes_quote',        'FR', "Citation :");
___('bbcodes_quote_by',     'EN', "Quote by");
___('bbcodes_quote_by',     'FR', "Citation de");
___('bbcodes_spoiler',      'EN', "SPOILER");
___('bbcodes_spoiler',      'FR', "DIVULGÂCHAGE");
___('bbcodes_spoiler_hide', 'EN', "HIDE SPOILER CONTENTS");
___('bbcodes_spoiler_hide', 'FR', "MASQUER LE CONTENU CACHÉ");
___('bbcodes_spoiler_show', 'EN', "SHOW SPOILER CONTENTS");
___('bbcodes_spoiler_show', 'FR', "VOIR LE CONTENU CACHÉ");


// NBCodes
___('nbcodes_menu_contents',      'EN', "Page contents:");
___('nbcodes_menu_contents',      'FR', "Contenu de la page :");
___('nbcodes_video_hidden',       'EN', "This video is hidden ({{link|pages/account/settings_privacy|privacy options}})");
___('nbcodes_video_hidden',       'FR', "Cette vidéo est masquée ({{link|pages/account/settings_privacy|options de vie privée}}");
___('nbcodes_video_hidden_small', 'EN', "Video hidden ({{link|pages/account/settings_privacy|privacy options}})");
___('nbcodes_video_hidden_small', 'FR', "Vidéo masquée ({{link|pages/account/settings_privacy|options de vie privée}})");
___('nbcodes_trends_hidden',      'EN', "This Google trends graph is hidden ({{link|pages/account/settings_privacy|privacy options}})");
___('nbcodes_trends_hidden',      'FR', "Ce graphe Google trends est masqué ({{link|pages/account/settings_privacy|options de vie privée}})");




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                   COMMON FILES                                                    */
/*                                                                                                                   */
/*********************************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Error messages

// Strings thrown by the functions on this very page
___('error_duplicate_translation', 'EN', "Error: Duplicate translation name - ");
___('error_duplicate_translation', 'FR', "Erreur : Traduction déjà existante - ");


// Strings required by the function that throws the errors
___('error_ohno',         'EN', "OH NO  : (");
___('error_ohno',         'FR', "OH NON  : (");
___('error_encountered',  'EN', "YOU HAVE ENCOUNTERED AN ERROR");
___('error_encountered',  'FR', "VOUS AVEZ RENCONTRÉ UNE ERREUR");


// Forbidden page
___('error_forbidden', 'EN', "This page should not be accessed");
___('error_forbidden', 'FR', "Vous ne devriez pas accéder à cette page");




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Time differentials

// Past actions
___('time_diff_past_future',  'EN', "In the future");
___('time_diff_past_future',  'FR', "Dans le futur");
___('time_diff_past_now',     'EN', "Right now");
___('time_diff_past_now',     'FR', "En ce moment même");
___('time_diff_past_second',  'EN', "A second ago");
___('time_diff_past_second',  'FR', "Il y a 1 seconde");
___('time_diff_past_seconds', 'EN', "{{1}} seconds ago");
___('time_diff_past_seconds', 'FR', "Il y a {{1}} secondes");
___('time_diff_past_minute',  'EN', "A minute ago");
___('time_diff_past_minute',  'FR', "Il y a 1 minute");
___('time_diff_past_minutes', 'EN', "{{1}} minutes ago");
___('time_diff_past_minutes', 'FR', "Il y a {{1}} minutes");
___('time_diff_past_hour',    'EN', "An hour ago");
___('time_diff_past_hour',    'FR', "Il y a 1 heure");
___('time_diff_past_hours',   'EN', "{{1}} hours ago");
___('time_diff_past_hours',   'FR', "Il y a {{1}} heures");
___('time_diff_past_day',     'EN', "Yesterday");
___('time_diff_past_day',     'FR', "Hier");
___('time_diff_past_2days',   'EN', "2 days ago");
___('time_diff_past_2days',   'FR', "Avant-hier");
___('time_diff_past_days',    'EN', "{{1}} days ago");
___('time_diff_past_days',    'FR', "Il y a {{1}} jours");
___('time_diff_past_year',    'EN', "A year ago");
___('time_diff_past_year',    'FR', "L'année dernière");
___('time_diff_past_years',   'EN', "{{1}} years ago");
___('time_diff_past_years',   'FR', "Il y a {{1}} ans");
___('time_diff_past_century', 'EN', "A century ago");
___('time_diff_past_century', 'FR', "Le siècle dernier");
___('time_diff_past_long',    'EN', "An extremely long time ago");
___('time_diff_past_long',    'FR', "Il y a très très longtemps");


// Future actions
___('time_diff_future_past',    'EN', "In the past");
___('time_diff_future_past',    'FR', "Dans le passé");
___('time_diff_future_second',  'EN', "In 1 second");
___('time_diff_future_second',  'FR', "Dans 1 seconde");
___('time_diff_future_seconds', 'EN', "In {{1}} seconds");
___('time_diff_future_seconds', 'FR', "Dans {{1}} secondes");
___('time_diff_future_minute',  'EN', "In 1 minute");
___('time_diff_future_minute',  'FR', "Dans 1 minute");
___('time_diff_future_minutes', 'EN', "In {{1}} minutes");
___('time_diff_future_minutes', 'FR', "Dans {{1}} minutes");
___('time_diff_future_hour',    'EN', "In 1 hour");
___('time_diff_future_hour',    'FR', "Dans 1 heure");
___('time_diff_future_hours',   'EN', "In {{1}} hours");
___('time_diff_future_hours',   'FR', "Dans {{1}} heures");
___('time_diff_future_day',     'EN', "Tomorrow");
___('time_diff_future_day',     'FR', "Demain");
___('time_diff_future_2days',   'EN', "In 2 days");
___('time_diff_future_2days',   'FR', "Après-demain");
___('time_diff_future_days',    'EN', "In {{1}} days");
___('time_diff_future_days',    'FR', "Dans {{1}} jours");
___('time_diff_future_year',    'EN', "In 1 year");
___('time_diff_future_year',    'FR', "Dans 1 an");
___('time_diff_future_years',   'EN', "In {{1}} years");
___('time_diff_future_years',   'FR', "Dans {{1}} ans");
___('time_diff_future_century', 'EN', "Next century");
___('time_diff_future_century', 'FR', "Dans un siècle");
___('time_diff_future_long',    'EN', "In an extremely long time");
___('time_diff_future_long',    'FR', "Dans très très longtemps");




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Header

// Language warning
___('header_language_error', 'EN', "Sorry! This page is only available in french and does not have an english translation yet.");
___('header_language_error', 'FR', "Désolé ! Cette page n'est disponible qu'en anglais et n'a pas encore de traduction française.");




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Global menus

// Top menu
___('menu_top_home',    'EN', "HOME");
___('menu_top_home',    'FR', "INDEX");
___('menu_top_comics',  'EN', "COMICS");
___('menu_top_comics',  'FR', "COMICS");
___('menu_top_videos',  'EN', "VIDEOS");
___('menu_top_videos',  'FR', "VIDEOS");
___('menu_top_socials', 'EN', "SOCIALS");
___('menu_top_socials', 'FR', "SOCIAL");
___('menu_top_about',   'EN', "ABOUT");
___('menu_top_about',   'FR', "FAQ");




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Footer

___('footer_legal',     'EN', "Legal notice and privacy policy");
___('footer_legal',     'FR', "Mentions légales &amp; confidentialité");
___('footer_copyright', 'EN', "&copy; The Bad Website 2025 - {{1}}");
___('footer_copyright', 'FR', "&copy; Le mauvais site 2025 - {{1}}");
