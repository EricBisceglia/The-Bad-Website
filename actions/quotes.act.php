<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../../404")); die(); }


/*********************************************************************************************************************/
/*                                                                                                                   */
/*  quotes_bbcodes              Formats a quote body for HTML display.                                               */
/*  quotes_get                  Fetches a quote.                                                                     */
/*  quotes_list                 Fetches quotes.                                                                      */
/*  quotes_list_origins         Lists possible origins for a quote.                                                  */
/*  quotes_add                  Adds a quote to the database.                                                        */
/*  quotes_edit                 Edits a quote.                                                                       */
/*  quotes_delete               Deletes a quote.                                                                     */
/*                                                                                                                   */
/*  quote_authors_get           Fetches a quote author.                                                              */
/*  quote_authors_list          Fetches quote authors.                                                               */
/*  quote_authors_add           Adds a quote author to the database.                                                 */
/*  quote_authors_edit          Edits a quote author.                                                                */
/*  quote_authors_delete        Deletes a quote author.                                                              */
/*                                                                                                                   */
/*  quote_media_get             Fetches a quote media.                                                               */
/*  quote_media_get_authors     Fetches authors attached to a media.                                                 */
/*  quote_media_list            Fetches quote media.                                                                 */
/*  quote_media_add             Adds a quote media to the database.                                                  */
/*  quote_media_edit            Edits a quote media.                                                                 */
/*  quote_media_edit_authors    Updates the authors attached to a quote media.                                       */
/*  quote_media_delete          Deletes a quote media.                                                               */
/*                                                                                                                   */
/*  quote_tags_get              Fetches a quote tag.                                                                 */
/*  quote_tags_list             Fetches quote tags.                                                                  */
/*  quote_tags_add              Adds a quote tag to the database.                                                    */
/*  quote_tags_edit             Edits a quote tag.                                                                   */
/*  quote_tags_delete           Deletes a quote tag.                                                                 */
/*                                                                                                                   */
/*********************************************************************************************************************/

/**
 * Formats a quote body for HTML display.
 *
 * @param   string|null   $quote_body   The quote body to format.
 *
 * @return  string                      The formatted quote body.
 */

function quotes_bbcodes( ?string $quote_body ) : string
{
  // Stop here if there is no quote body
  if(!$quote_body)
    return "";

  // Apply some basic BBCodes
  $quote_body = str_ireplace(
    array(
      '[b]' , '[/b]',
      '[i]' , '[/i]',
      '[u]' , '[/u]',
      '[s]' , '[/s]'
    ),
    array(
      '<span class="bold">',          '</span>' ,
      '<span class="italics">',       '</span>' ,
      '<span class="underlined">',    '</span>' ,
      '<span class="strikethrough">', '</span>'
    ),
    $quote_body
  );

  // Return the formatted quote body
  return $quote_body;
}



/**
 * Fetches a quote.
 *
 * @param   int         $quote_id  The ID of the quote.
 *
 * @return  array|null             An array containing data on the quote, or null if the quote does not exist.
 */

function quotes_get( int $quote_id ) : ?array
{
  // Sanitize the data
  $quote_id = sanitize($quote_id, 'int');

  // Stop here if the quote does not exist
  if(!$quote_id || !database_row_exists('quotes', $quote_id))
    return null;

  // Fetch the user's current language
  $lang = string_change_case(user_get_language(), 'lowercase');

  // Fetch the quote's data
  $quote = query(" SELECT     quotes.fk_quote_media       AS 'q_media'        ,
                              quotes.fk_quote_authors     AS 'q_author'       ,
                              quotes.slug                 AS 'q_slug'         ,
                              quotes.sorting_order        AS 'q_sort'         ,
                              quotes.year_published       AS 'q_year'         ,
                              quotes.origin_$lang         AS 'q_origin'       ,
                              quotes.origin_en            AS 'q_origin_en'    ,
                              quotes.origin_fr            AS 'q_origin_fr'    ,
                              quotes.source_$lang         AS 'q_source'       ,
                              quotes.source_en            AS 'q_source_en'    ,
                              quotes.source_fr            AS 'q_source_fr'    ,
                              quotes.title_$lang          AS 'q_title'        ,
                              quotes.title_en             AS 'q_title_en'     ,
                              quotes.title_fr             AS 'q_title_fr'     ,
                              quotes.description_$lang    AS 'q_desc'         ,
                              quotes.description_en       AS 'q_desc_en'      ,
                              quotes.description_fr       AS 'q_desc_fr'      ,
                              quotes.quote_$lang          AS 'q_body'         ,
                              quotes.quote_en             AS 'q_body_en'      ,
                              quotes.quote_fr             AS 'q_body_fr'      ,
                              quote_media.name_$lang      AS 'qm_name'        ,
                              quote_media.year_published  AS 'qm_year'
                    FROM      quotes
                    LEFT JOIN quote_media
                    ON        quote_media.id = quotes.fk_quote_media
                    WHERE     quotes.id = '$quote_id' ",
                    fetch_row: true);

  // Prepare the data for display
  $data['id']             = sanitize_output($quote_id);
  $data['slug']           = sanitize_output($quote['q_slug']);
  $data['media_id']       = sanitize_output($quote['q_media']);
  $data['author_id']      = sanitize_output($quote['q_author']);
  $data['sort']           = sanitize_output($quote['q_sort']);
  $data['year']           = $quote['q_year'] ? sanitize_output($quote['q_year']) : "";
  $data['origin_en']      = sanitize_output($quote['q_origin_en']);
  $data['origin_fr']      = sanitize_output($quote['q_origin_fr']);
  $data['source_en_raw']  = $quote['q_source_en'];
  $data['source_fr_raw']  = $quote['q_source_fr'];
  $data['source_en']      = quotes_bbcodes(sanitize_output($quote['q_source_en'], preserve_line_breaks: true));
  $data['source_fr']      = quotes_bbcodes(sanitize_output($quote['q_source_fr'], preserve_line_breaks: true));
  $data['source']         = quotes_bbcodes(sanitize_output($quote['q_source'], preserve_line_breaks: true));
  $data['title']          = sanitize_output($quote['q_title']);
  $data['title_en']       = sanitize_output($quote['q_title_en']);
  $data['title_fr']       = sanitize_output($quote['q_title_fr']);
  $data['desc_en_raw']    = $quote['q_desc_en'];
  $data['desc_fr_raw']    = $quote['q_desc_fr'];
  $data['desc_en']        = quotes_bbcodes(sanitize_output($quote['q_desc_en'], preserve_line_breaks: true));
  $data['desc_fr']        = quotes_bbcodes(sanitize_output($quote['q_desc_fr'], preserve_line_breaks: true));
  $data['desc']           = quotes_bbcodes(sanitize_output($quote['q_desc'], preserve_line_breaks: true));
  $data['body_en_raw']    = $quote['q_body_en'];
  $data['body_fr_raw']    = $quote['q_body_fr'];
  $data['body_en']        = quotes_bbcodes(sanitize_output($quote['q_body_en'], preserve_line_breaks: true));
  $data['body_fr']        = quotes_bbcodes(sanitize_output($quote['q_body_fr'], preserve_line_breaks: true));
  $data['body']           = ($quote['q_body'])
                          ? quotes_bbcodes(sanitize_output($quote['q_body'], preserve_line_breaks: true))
                          : (($data['body_en'])
                          ? quotes_bbcodes(sanitize_output($quote['q_body_en'], preserve_line_breaks: true))
                          : quotes_bbcodes(sanitize_output($quote['q_body_fr'], preserve_line_breaks: true)));
  $data['media_name']     = sanitize_output($quote['qm_name']);
  $data['published']      = ($quote['qm_year']) ? sanitize_output($quote['qm_year']) :
                            (($quote['q_year']) ? sanitize_output($quote['q_year']) : "");

  // Fetch the quote's origin
  $quote_origins_list = quote_list_origins();
  $quote_origin       = ($quote['q_body']) ? $quote['q_origin']
                      : (($data['body_en']) ? $quote['q_origin_en'] : $quote['q_origin_fr']);
  $data['origin']     = sanitize_output($quote_origins_list['names'][$quote_origin]);


  // Fetch the quote's authors
  $authors = query("  SELECT    quote_authors.id          AS 'qa_id'   ,
                                quote_authors.slug        AS 'qa_slug' ,
                                quote_authors.name_$lang  AS 'qa_name'
                      FROM      quote_authors
                      WHERE     quote_authors.id =
                      (
                        SELECT  quotes.fk_quote_authors
                        FROM    quotes
                        WHERE   quotes.id = '$quote_id'
                      )
                      OR quote_authors.id IN
                      (
                        SELECT  quote_media_authors.fk_quote_authors
                        FROM    quote_media_authors
                        JOIN    quotes
                        ON      quotes.fk_quote_media  = quote_media_authors.fk_quote_media
                        WHERE   quotes.id              = '$quote_id'
                      )
                      ORDER BY  quote_authors.name_$lang ASC ");

  // Initialize author names and portraits
  $author_names     = array();
  $author_portraits = false;

  // Prepare the authors for display
  for($i = 0; $row = query_row($authors); $i++)
  {
    // Author data
    $data['authors']['id'][$i]    = sanitize_output($row['qa_id']);
    $data['authors']['name'][$i]  = sanitize_output($row['qa_name']);
    $author_names[]               = $row['qa_name'];

    // Portraits
    if(file_exists(root_path().'img/portraits/'.$row['qa_slug'].'.png'))
    {
      $author_portraits = true;
      $data['authors']['portrait'][$i] = '/img/portraits/'.$row['qa_slug'].'.png';
    }
    else
      $data['authors']['portrait'][$i] = '/img/portraits/no_portrait.png';
  }

  // Prepare author names and portraits for display
  $data['authors']['portraits'] = $author_portraits;
  $data['authors_full']       = sanitize_output(implode(' & ', $author_names));

  // Add the number of authors to the returned data
  $data['authors_count'] = $i;

  // Fetch the quote's tags
  $tags = query(" SELECT      quote_tag_links.fk_quote_tags   AS 'qt_id'   ,
                              quote_tags.name_$lang           AS 'qt_name'
                  FROM        quote_tag_links
                  JOIN        quote_tags
                  ON          quote_tags.id = quote_tag_links.fk_quote_tags
                  WHERE       quote_tag_links.fk_quotes = '$quote_id'
                  ORDER BY    quote_tags.sorting_order  ASC ,
                              quote_tags.name_$lang     ASC ");

  // Prepare the tags for display
  for($i = 0; $row = query_row($tags); $i++)
  {
    $data['tags']['id'][$i]   = sanitize_output($row['qt_id']);
    $data['tags']['name'][$i] = sanitize_output($row['qt_name']);
  }
  $data['tags_list'] = ($i > 0) ? implode(', ', $data['tags']['name']) : '';

  // Add the number of tags to the returned data
  $data['tags']['rows'] = $i;

  // Return the prepared data
  return $data;
}




/**
 * Fetches quotes.
 *
 * @param   string  $sort_by  How the quotes should be sorted.
 * @param   array   $search   The search query.
 *
 * @return  array             An array containing the quotes.
 */

function quotes_list( string  $sort_by  = 'date'  ,
                      array   $search   = array() ) : array
{
  // Sanitize the search parameters
  $search_year    = sanitize_array_element($search, 'year', 'int');
  $search_author  = sanitize_array_element($search, 'author', 'int');
  $search_media   = sanitize_array_element($search, 'media', 'int');
  $search_title   = sanitize_array_element($search, 'title', 'string');
  $search_body    = sanitize_array_element($search, 'body', 'string');
  $search_tag     = sanitize_array_element($search, 'tag', 'int');

  // Get the user's current language
  $lang = string_change_case(user_get_language(), 'lowercase');

  // Search through the data
  $query_search   = ($search_year === 1)  ? " AND ( quote_media.year_published  > 0
                                              OR    quotes.year_published       > 0 ) "                 : "";
  $query_search  .= ($search_year === -1) ? " AND ( quote_media.year_published  = 0
                                              OR    quote_media.year_published  IS NULL )
                                              AND   quotes.year_published       = 0 "                   : "";
  $query_search  .= ($search_media)       ? " AND   quotes.fk_quote_media       = '$search_media' "     : "";
  $query_search  .= ($search_title)       ? " AND ( quotes.title_en          LIKE '%$search_title%'
                                              OR    quotes.title_fr          LIKE '%$search_title%' ) " : "";
  $query_search  .= ($search_body)        ? " AND ( quotes.title_en          LIKE '%$search_body%'
                                              OR    quotes.title_fr          LIKE '%$search_body%'
                                              OR    quotes.description_en    LIKE '%$search_body%'
                                              OR    quotes.description_fr    LIKE '%$search_body%'
                                              OR    quotes.quote_en          LIKE '%$search_body%'
                                              OR    quotes.quote_fr          LIKE '%$search_body%' ) "  : "";

  // Search by author
  if($search_author)
    $query_search .= "  AND (
                        quotes.fk_quote_authors = '$search_author'
                        OR EXISTS (
                          SELECT 1
                          FROM   quote_media_authors AS searched_media_authors
                          WHERE  searched_media_authors.fk_quote_media    = quotes.fk_quote_media
                          AND    searched_media_authors.fk_quote_authors  = '$search_author' )
                        ) ";

  // Search by tag
  if($search_tag && $search_tag > 0)
    $query_search .= "  AND EXISTS (
                        SELECT 1
                        FROM   quote_tag_links AS searched_tags
                        WHERE  searched_tags.fk_quotes      = quotes.id
                        AND    searched_tags.fk_quote_tags  = '$search_tag' ) ";
  if($search_tag && $search_tag === -1)
    $query_search .= "  AND NOT EXISTS (
                        SELECT 1
                        FROM   quote_tag_links AS searched_tags
                        WHERE  searched_tags.fk_quotes = quotes.id ) ";

  // Sort the data
  $query_sort = match($sort_by)
  {
    'author'   => " ORDER BY  NULLIF(author_data.author_names, '') IS NULL  DESC  ,
                              author_data.author_names                      ASC   ,
                              q_eyear                                       ASC   ,
                              COALESCE(quote_media.name_$lang, '')          ASC   ,
                              quotes.sorting_order                          ASC   ,
                              quotes.id                                     ASC   ",
    'source'  => "  ORDER BY  NULLIF(quote_media.name_$lang, '') IS NULL    ASC   ,
                              quote_media.name_$lang                        ASC   ,
                              quotes.sorting_order                          ASC   ,
                              quotes.id                                     ASC   ",
    'title'   => "  ORDER BY  NULLIF(quotes.title_$lang, '') IS NULL        DESC  ,
                              quotes.title_$lang                            ASC   ,
                              quotes.sorting_order                          ASC   ,
                              quotes.id                                     ASC   ",
    'tags'    => "  ORDER BY  COALESCE(tag_data.tag_count, 0)               DESC  ,
                              COALESCE(author_data.author_names, '')        ASC   ,
                              q_eyear                                       ASC   ,
                              COALESCE(quote_media.name_$lang, '')          ASC   ,
                              quotes.sorting_order                          ASC   ,
                              quotes.id                                     ASC   ",
    'year'    => "  ORDER BY  NULLIF(q_eyear, 0) IS NULL                    ASC   ,
                              q_eyear                                       ASC   ,
                              COALESCE(author_data.author_names, '')        ASC   ,
                              COALESCE(quote_media.name_$lang, '')          ASC   ,
                              quotes.sorting_order                          ASC   ,
                              quotes.id                                     ASC   ",
    default   => "  ORDER BY  COALESCE(author_data.author_names, '')        ASC   ,
                              q_eyear                                       ASC   ,
                              COALESCE(quote_media.name_$lang, '')          ASC   ,
                              quotes.sorting_order                          ASC   ,
                              quotes.id                                     ASC   "
  };

  // Fetch the quotes
  $quotes = query(" SELECT  quotes.id                                 AS 'q_id'       ,
                            quotes.sorting_order                      AS 'q_sort'     ,
                            quotes.year_published                     AS 'q_year'     ,
                            quotes.title_$lang                        AS 'q_title'    ,
                            quotes.title_en                           AS 'q_title_en' ,
                            quotes.title_fr                           AS 'q_title_fr' ,
                            quotes.quote_$lang                        AS 'q_body'     ,
                            quotes.quote_en                           AS 'q_body_en'  ,
                            quotes.quote_fr                           AS 'q_body_fr'  ,
                            COALESCE(author_data.author_names, '')    AS 'qa_names'   ,
                            COALESCE(quote_media.year_published, '')  AS 'qm_year'    ,
                            COALESCE(quote_media.name_$lang, '')      AS 'qm_name'    ,
                            COALESCE(quote_media.name_en, '')         AS 'qm_name_en' ,
                            COALESCE(quote_media.name_fr, '')         AS 'qm_name_fr' ,
                            COALESCE(tag_data.tag_count, 0)           AS 'qt_count'   ,
                            COALESCE(tag_data.tag_names, '')          AS 'qt_names'   ,
                            COALESCE(
                              NULLIF(quote_media.year_published, 0),
                              NULLIF(quotes.year_published, 0) )      AS 'q_eyear'

                    FROM   quotes

                    LEFT JOIN
                    (
                      SELECT    quote_authors_resolved.quote_id                                       ,
                                COUNT(DISTINCT quote_authors_resolved.author_id)  AS 'author_count'   ,
                                GROUP_CONCAT(
                                  DISTINCT quote_authors_resolved.author_name
                                  ORDER BY quote_authors_resolved.author_name ASC
                                  SEPARATOR '|||' )                               AS 'author_names'
                      FROM
                      (
                        SELECT  quotes.id                 AS 'quote_id'   ,
                                quote_authors.id          AS 'author_id'  ,
                                quote_authors.name_$lang  AS 'author_name'
                        FROM    quotes
                        JOIN    quote_authors
                        ON      quote_authors.id = quotes.fk_quote_authors
                        WHERE   quotes.fk_quote_authors IS NOT NULL
                      UNION
                        SELECT  quotes.id                 AS 'quote_id'   ,
                                quote_authors.id          AS 'author_id'  ,
                                quote_authors.name_$lang  AS 'author_name'
                        FROM    quotes
                        JOIN    quote_media_authors
                        ON      quote_media_authors.fk_quote_media = quotes.fk_quote_media
                        JOIN    quote_authors
                        ON      quote_authors.id = quote_media_authors.fk_quote_authors
                        WHERE   quotes.fk_quote_media IS NOT NULL
                      )
                      AS quote_authors_resolved
                      GROUP BY quote_authors_resolved.quote_id
                    )
                    AS author_data
                    ON author_data.quote_id = quotes.id

                    LEFT JOIN quote_media
                    ON        quote_media.id = quotes.fk_quote_media

                    LEFT JOIN
                    (
                      SELECT    quote_tag_links.fk_quotes     AS 'quote_id'   ,
                                COUNT(DISTINCT quote_tags.id) AS 'tag_count'  ,
                                GROUP_CONCAT(
                                  DISTINCT  quote_tags.name_$lang
                                  ORDER BY  quote_tags.sorting_order  ASC ,
                                            quote_tags.name_$lang     ASC
                                SEPARATOR '|||' )            AS 'tag_names'
                      FROM      quote_tag_links
                      JOIN      quote_tags
                      ON        quote_tags.id = quote_tag_links.fk_quote_tags
                      GROUP BY  quote_tag_links.fk_quotes
                  )
                  AS tag_data
                  ON tag_data.quote_id = quotes.id

                  WHERE 1 = 1
                  $query_search
                  $query_sort ");

  // Prepare the data for display
  for($i = 0; $row = query_row($quotes); $i++)
  {
    // Quote data
    $data[$i]['id']       = sanitize_output($row['q_id']);
    $data[$i]['sort']     = sanitize_output($row['q_sort']);
    $data[$i]['year']     = ($row['qm_year']) ? sanitize_output($row['qm_year']) : sanitize_output($row['q_year']);
    $data[$i]['year']     = ($data[$i]['year'] === '0') ? '' : $data[$i]['year'];
    $data[$i]['title']    = sanitize_output($row['q_title']);
    $data[$i]['stitle']   = sanitize_output(string_truncate($row['q_title'], 25, '...'));
    $data[$i]['mtitle']   = sanitize_output(string_truncate($row['q_title'], 16, '...'));
    $data[$i]['title_en'] = sanitize_output($row['q_title_en']);
    $data[$i]['title_fr'] = sanitize_output($row['q_title_fr']);
    $data[$i]['body_en']  = quotes_bbcodes(sanitize_output($row['q_body_en'], preserve_line_breaks: true));
    $data[$i]['body_fr']  = quotes_bbcodes(sanitize_output($row['q_body_fr'], preserve_line_breaks: true));
    $data[$i]['body']     = ($row['q_body'])
                          ? quotes_bbcodes(sanitize_output($row['q_body'], preserve_line_breaks: true))
                          : (($data[$i]['body_en'])
                          ? quotes_bbcodes(sanitize_output($row['q_body_en'], preserve_line_breaks: true))
                          : quotes_bbcodes(sanitize_output($row['q_body_fr'], preserve_line_breaks: true)));
    $data[$i]['media']    = sanitize_output($row['qm_name']);
    $data[$i]['smedia']   = sanitize_output(string_truncate($row['qm_name'], 20, '...'));
    $data[$i]['mmedia']   = sanitize_output(string_truncate($row['qm_name'], 11, '...'));
    $data[$i]['media_en'] = sanitize_output($row['qm_name_en']);
    $data[$i]['media_fr'] = sanitize_output($row['qm_name_fr']);
    $data[$i]['tags']     = sanitize_output($row['qt_count']);

    // Quote authors
    $data[$i]['authors_full']   = sanitize_output(str_replace('|||', ' & ', $row['qa_names']));
    $data[$i]['sauthors_full']  = sanitize_output(
                                    str_replace('|||', ' & ', string_truncate($row['qa_names'], 20, '...')));

    // Quote tags
    $tag_names             = sanitize_output($row['qt_names']);
    $data[$i]['tags_list'] = str_replace('|||', '<br>', $tag_names);
  }

  // Add the number of rows to the returned data
  $data['rows'] = $i;

  // Return the prepared data
  return ($data ?? []);
}




/**
 * Lists possible origins for a quote.
 *
 * @return  array  An array containing the possible origins for a quote.
 */

function quote_list_origins() : array
{
  // Prepare the origins
  $origins[0] = 'source';
  $origins[1] = 'paraphrased';
  $origins[2] = 'translated';
  $origins[3] = 'third';
  $origins[4] = 'unknown';

  // Count the number of origins
  $origins_count = count($origins);

  // Prepare an array of origins
  for($i = 0; $i < $origins_count; $i++)
    $data['names'][$i] = __('quote_origin_'.$origins[$i]);

  // Prepare an array of short hand origins
  for($i = 0; $i < $origins_count; $i++)
    $data['short'][$i] = __('quote_origin_'.$origins[$i].'_short');

  // Add the number of origins to the returned data
  $data['count'] = $origins_count;

  // Return the array of possible quote origins
  return $data;
}




/**
 * Adds a quote to the database.
 *
 * @param   array  $data  An array containing data on the quote.
 *
 * @return  int           The ID of the added quote.
 */

function quotes_add( array $data ) : int
{
  // Sanitize the data
  $media_id   = sanitize_array_element($data, 'quote_media', 'int');
  $author_id  = sanitize_array_element($data, 'quote_author', 'int');
  $sort       = sanitize_array_element($data, 'quote_sort', 'int');
  $year       = sanitize_array_element($data, 'quote_year', 'int');
  $origin_en  = sanitize_array_element($data, 'quote_origin_en', 'int');
  $origin_fr  = sanitize_array_element($data, 'quote_origin_fr', 'int');
  $source_en  = sanitize_array_element($data, 'quote_source_en', 'string');
  $source_fr  = sanitize_array_element($data, 'quote_source_fr', 'string');
  $title_en   = sanitize_array_element($data, 'quote_title_en', 'string');
  $title_fr   = sanitize_array_element($data, 'quote_title_fr', 'string');
  $desc_en    = sanitize_array_element($data, 'quote_desc_en', 'string');
  $desc_fr    = sanitize_array_element($data, 'quote_desc_fr', 'string');
  $body_en    = sanitize_array_element($data, 'quote_body_en', 'string');
  $body_fr    = sanitize_array_element($data, 'quote_body_fr', 'string');

  // Disallow linking to an author if there is a media
  if($media_id)
    $author_id = 0;

  // If there is no title, generate one for the slug
  if(!$title_en)
  {
    $authors_en = "";
    $media_en   = "";

    // If there is an author, grab its name
    if($author_id)
    {
      $author     = quote_authors_get($author_id);
      $authors_en = $author['name_en_raw'];
    }

    // If there is a media, grab its name and authors
    else if($media_id)
    {
      $media            = quote_media_get($media_id);
      $media_author_ids = quote_media_get_authors($media_id);
      $media_en         = $media['name_en_raw'];
      foreach($media_author_ids as $media_author_id)
      {
        $author       = quote_authors_get((int)$media_author_id);
        if(!$author)
          continue;
        $authors_en  .= ($authors_en ? ' & ' : '').$author['name_en_raw'];
      }
    }

    // Prepare the default title
    $default_title_en = implode(' - ', array_filter(array($authors_en, $media_en)));

    // Give the quote a title
    $slug_title_en = $title_en ?: ($default_title_en ?: __('admin_quotes_add_untitled'));
  }

  // Generate a slug for the quote
  $slug = (isset($slug_title_en) ? $slug_title_en : $title_en);
  $slug = str_replace(' ', '_', string_truncate($slug, 40));
  $slug = sanitize(string_change_case(preg_replace('/[^a-z0-9_]/i', '', $slug), 'lowercase'), 'string');
  $slug = ($slug) ?: 'quote';

  // Make sure the slug is unique
  $underscores = '';
  while(database_entry_exists('quotes', 'slug', $slug.$underscores))
    $underscores .= '_';
  $slug .= $underscores;

  // Add the quote to the database
  query(" INSERT INTO quotes
          SET         quotes.fk_quote_media   = '$media_id'   ,
                      quotes.fk_quote_authors = '$author_id'  ,
                      quotes.slug             = '$slug'       ,
                      quotes.sorting_order    = '$sort'       ,
                      quotes.year_published   = '$year'       ,
                      quotes.origin_en        = '$origin_en'  ,
                      quotes.origin_fr        = '$origin_fr'  ,
                      quotes.source_en        = '$source_en'  ,
                      quotes.source_fr        = '$source_fr'  ,
                      quotes.title_en         = '$title_en'   ,
                      quotes.title_fr         = '$title_fr'   ,
                      quotes.description_en   = '$desc_en'    ,
                      quotes.description_fr   = '$desc_fr'    ,
                      quotes.quote_en         = '$body_en'    ,
                      quotes.quote_fr         = '$body_fr'    ");

  // Fetch the newly created quote's ID
  $quote_id = query_id();

  // Sanitize the quote ID
  $quote_id = sanitize($quote_id, 'int');

  // Loop through the tags
  if($quote_id && isset($data['quote_tags']) && is_array($data['quote_tags']))
  {
    foreach($data['quote_tags'] as $tag_id => $tag_value)
    {
      // Sanitize the tag's data
      $tag_id    = sanitize($tag_id, 'int');
      $tag_value = sanitize($tag_value, 'int');

      // Link the tags to the quote
      if($tag_value)
        query(" INSERT INTO quote_tag_links
                SET         quote_tag_links.fk_quotes = '$quote_id' ,
                            quote_tag_links.fk_quote_tags = '$tag_id' ");
    }
  }

  // Return the newly created quote's ID
  return $quote_id;
}




/**
 * Edits a quote.
 *
 * @param   int    $quote_id  The ID of the quote to edit.
 * @param   array  $data      An array containing the quote data to update.
 *
 * @return  bool              Whether the quote was edited successfully.
 */

function quotes_edit( int   $quote_id ,
                      array $data     ) : bool
{
  // Sanitize the quote's ID
  $quote_id = sanitize($quote_id, 'int');

  // Stop here if the quote does not exist
  if(!$quote_id || !database_row_exists('quotes', $quote_id))
    return false;

  // Sanitize the data
  $media_id   = sanitize_array_element($data, 'quote_media', 'int');
  $author_id  = sanitize_array_element($data, 'quote_author', 'int');
  $sort       = sanitize_array_element($data, 'quote_sort', 'int');
  $year       = sanitize_array_element($data, 'quote_year', 'int');
  $origin_en  = sanitize_array_element($data, 'quote_origin_en', 'int');
  $origin_fr  = sanitize_array_element($data, 'quote_origin_fr', 'int');
  $source_en  = sanitize_array_element($data, 'quote_source_en', 'string');
  $source_fr  = sanitize_array_element($data, 'quote_source_fr', 'string');
  $title_en   = sanitize_array_element($data, 'quote_title_en', 'string');
  $title_fr   = sanitize_array_element($data, 'quote_title_fr', 'string');
  $desc_en    = sanitize_array_element($data, 'quote_desc_en', 'string');
  $desc_fr    = sanitize_array_element($data, 'quote_desc_fr', 'string');
  $body_en    = sanitize_array_element($data, 'quote_body_en', 'string');
  $body_fr    = sanitize_array_element($data, 'quote_body_fr', 'string');

  // Disallow linking to an authors if there is a media
  if($media_id)
    $author_id = 0;

  // If there is no title, generate one for the slug
  if(!$title_en)
  {
    $authors_en = "";
    $media_en   = "";

    // If there is an author, grab its name
    if($author_id)
    {
      $author     = quote_authors_get($author_id);
      $authors_en = $author['name_en_raw'];
    }

    // If there is a media, grab its name and authors
    else if($media_id)
    {
      $media            = quote_media_get($media_id);
      $media_author_ids = quote_media_get_authors($media_id);
      $media_en         = $media['name_en_raw'];
      foreach($media_author_ids as $media_author_id)
      {
        $author       = quote_authors_get((int)$media_author_id);
        if(!$author)
          continue;
        $authors_en  .= ($authors_en ? ' & ' : '').$author['name_en_raw'];
      }
    }

    // Prepare the default title
    $default_title_en = implode(' - ', array_filter(array($authors_en, $media_en)));

    // Give the quote a title
    $slug_title_en = $title_en ?: ($default_title_en ?: __('admin_quotes_add_untitled'));
  }

  // Generate a slug for the quote
  $slug = isset($slug_title_en) ? $slug_title_en : $title_en;
  $slug = str_replace(' ', '_', string_truncate($slug, 40));
  $slug = sanitize(string_change_case(preg_replace('/[^a-z0-9_]/i', '', $slug), 'lowercase'), 'string');
  $slug = ($slug) ?: 'quote';

  // Clear the current slug
  query(" UPDATE  quotes
          SET     quotes.slug = ''
          WHERE   quotes.id   = '$quote_id' ");

  // Make sure the slug is unique
  $underscores = '';
  while(database_entry_exists('quotes', 'slug', $slug.$underscores))
    $underscores .= '_';
  $slug .= $underscores;

  // Update the quote in the database
  query(" UPDATE  quotes
          SET     quotes.fk_quote_media   = '$media_id'   ,
                  quotes.fk_quote_authors = '$author_id'  ,
                  quotes.slug             = '$slug'       ,
                  quotes.sorting_order    = '$sort'       ,
                  quotes.year_published   = '$year'       ,
                  quotes.origin_en        = '$origin_en'  ,
                  quotes.origin_fr        = '$origin_fr'  ,
                  quotes.source_en        = '$source_en'  ,
                  quotes.source_fr        = '$source_fr'  ,
                  quotes.title_en         = '$title_en'   ,
                  quotes.title_fr         = '$title_fr'   ,
                  quotes.description_en   = '$desc_en'    ,
                  quotes.description_fr   = '$desc_fr'    ,
                  quotes.quote_en         = '$body_en'    ,
                  quotes.quote_fr         = '$body_fr'
          WHERE   quotes.id               = '$quote_id' ");

  // Get a list of all tags
  $tags_list = quote_tags_list();

  // Go through the tag list
  for($i = 0; $i < $tags_list['rows']; $i++)
  {
    // Sanitize the tag's id
    $tag_id = sanitize($tags_list[$i]['id'], 'int');

    // Check whether tags have been applied
    if(isset($data['quote_tags'][$tag_id]) && $data['quote_tags'][$tag_id] === 1)
    {
      // Look for the tag
      $check_tag = query("  SELECT  quote_tag_links.fk_quote_tags AS 'ct_id'
                            FROM    quote_tag_links
                            WHERE   quote_tag_links.fk_quotes     = '$quote_id'
                            AND     quote_tag_links.fk_quote_tags = '$tag_id' ",
                            fetch_row: true);

      // Create the tag if it is missing
      if(!isset($check_tag['ct_id']))
        query(" INSERT INTO quote_tag_links
                SET         quote_tag_links.fk_quotes     = '$quote_id' ,
                            quote_tag_links.fk_quote_tags = '$tag_id' ");
    }

    // Check whether the tag has been deleted
    else
    {
      // Look for the tag
      $check_tag = query("  SELECT  quote_tag_links.fk_quote_tags AS 'ct_id'
                            FROM    quote_tag_links
                            WHERE   quote_tag_links.fk_quotes     = '$quote_id'
                            AND     quote_tag_links.fk_quote_tags = '$tag_id' ",
                            fetch_row: true);

      // Delete the tag if it exists
      if(isset($check_tag['ct_id']))
        query(" DELETE FROM quote_tag_links
                WHERE       quote_tag_links.fk_quotes     = '$quote_id'
                AND         quote_tag_links.fk_quote_tags = '$tag_id' ");
    }
  }

  // The quote has been edited
  return true;
}




/**
 * Deletes a quote.
 *
 * @param   int    $quote_id  The ID of the quote to delete.
 *
 * @return  bool              Whether the quote was deleted successfully.
 */

function quotes_delete( int $quote_id ) : bool
{
  // Sanitize the data
  $quote_id = sanitize($quote_id, 'int');

  // Stop here if the quote does not exist
  if(!$quote_id || !database_row_exists('quotes', $quote_id))
    return false;

  // Delete the quote
  query(" DELETE FROM quotes
          WHERE       quotes.id = '$quote_id' ");

  // Delete any linked tags
  query(" DELETE FROM quote_tag_links
          WHERE       quote_tag_links.fk_quotes = '$quote_id' ");

  // The quote has been deleted
  return true;
}




/**
 * Fetches a quote author.
 *
 * @param   int    $author_id  The ID of the quote author.
 *
 * @return  array              An array containing data on the quote author.
 */

function quote_authors_get( int $author_id ) : ?array
{
  // Sanitize the data
  $author_id = sanitize($author_id, 'int');

  // Stop here if the author does not exist
  if(!$author_id || !database_row_exists('quote_authors', $author_id))
    return null;

  // Fetch the author's data
  $author = query(" SELECT  quote_authors.slug            AS 'qa_slug'      ,
                            quote_authors.name_en         AS 'qa_name_en'   ,
                            quote_authors.name_fr         AS 'qa_name_fr'   ,
                            quote_authors.year_birth      AS 'qa_birth'     ,
                            quote_authors.year_death      AS 'qa_death'     ,
                            quote_authors.description_en  AS 'qa_desc_en'   ,
                            quote_authors.description_fr  AS 'qa_desc_fr'
                      FROM  quote_authors
                      WHERE quote_authors.id = '$author_id' ",
                      fetch_row: true);

  // Prepare the data for display
  $data['id']           = sanitize_output($author_id);
  $data['slug']         = sanitize_output($author['qa_slug']);
  $data['name_en']      = sanitize_output($author['qa_name_en']);
  $data['name_fr']      = sanitize_output($author['qa_name_fr']);
  $data['name_en_raw']  = $author['qa_name_en'];
  $data['birth']        = sanitize_output($author['qa_birth']);
  $data['death']        = sanitize_output($author['qa_death']);
  $data['desc_en_raw']  = $author['qa_desc_en'];
  $data['desc_fr_raw']  = $author['qa_desc_fr'];
  $data['desc_en']      = sanitize_output($author['qa_desc_en'], preserve_line_breaks: true);
  $data['desc_fr']      = sanitize_output($author['qa_desc_fr'], preserve_line_breaks: true);

  // Portrait
  if(file_exists(root_path().'img/portraits/'.$author['qa_slug'].'.png'))
  {
    $data['portrait']     = '/img/portraits/'.$author['qa_slug'].'.png';
    $data['has_portrait'] = true;
  }
  else
  {
    $data['portrait']     = '/img/portraits/no_portrait.png';
    $data['has_portrait'] = false;
  }

  // Return the prepared data
  return $data;
}




/**
 * Fetches quote authors.
 *
 * @return  array  An array containing the quote authors.
 */

function quote_authors_list() : array
{
  // Get the user's current language
  $lang = string_change_case(user_get_language(), 'lowercase');

  // Fetch the authors
  $authors = query("  SELECT      quote_authors.id                      AS 'qa_id'      ,
                                  quote_authors.slug                    AS 'qa_slug'    ,
                                  quote_authors.name_$lang              AS 'qa_name'    ,
                                  quote_authors.name_en                 AS 'qa_name_en' ,
                                  quote_authors.name_fr                 AS 'qa_name_fr' ,
                                  quote_authors.year_birth              AS 'qa_birth'   ,
                                  quote_authors.year_death              AS 'qa_death'   ,
                                  COALESCE(quote_data.quote_count, 0)   AS 'q_count'    ,
                                  COALESCE(media_data.media_count, 0)   AS 'qma_count'  ,
                                  COALESCE(media_data.media_names, '')  AS 'qma_names'

                      FROM        quote_authors

                      LEFT JOIN
                      (
                        SELECT    author_quotes.author_id,
                                  COUNT(author_quotes.quote_id) AS 'quote_count'
                        FROM
                        (
                          SELECT  quotes.fk_quote_authors AS 'author_id',
                                  quotes.id               AS 'quote_id'
                          FROM    quotes
                          WHERE   quotes.fk_quote_authors > 0

                          UNION

                          SELECT  quote_media_authors.fk_quote_authors  AS 'author_id',
                                  quotes.id                             AS 'quote_id'
                          FROM    quote_media_authors
                          JOIN    quotes
                          ON      quotes.fk_quote_media = quote_media_authors.fk_quote_media
                          WHERE   quotes.fk_quote_media > 0
                     )
                     AS author_quotes
                     GROUP BY author_quotes.author_id
                   )
                   AS quote_data
                   ON quote_data.author_id = quote_authors.id

                   LEFT JOIN
                   (
                     SELECT       quote_media_authors.fk_quote_authors                AS 'author_id'    ,
                                  COUNT(DISTINCT quote_media_authors.fk_quote_media)  AS 'media_count'  ,
                                  GROUP_CONCAT(
                                  quote_media.name_$lang
                                  ORDER BY quote_media.name_$lang ASC
                                  SEPARATOR '|||')                                    AS 'media_names'
                     FROM         quote_media_authors
                     JOIN         quote_media
                     ON           quote_media.id = quote_media_authors.fk_quote_media
                     GROUP BY     quote_media_authors.fk_quote_authors
                   )
                   AS media_data
                   ON media_data.author_id = quote_authors.id

                   ORDER BY quote_authors.name_$lang ASC ");

  // Prepare the data for display
  for($i = 0; $row = query_row($authors); $i++)
  {
    // Quote author data
    $data[$i]['id']           = sanitize_output($row['qa_id']);
    $data[$i]['slug']         = sanitize_output($row['qa_slug']);
    $data[$i]['name']         = sanitize_output($row['qa_name']);
    $data[$i]['sname']        = sanitize_output(string_truncate($row['qa_name'], 25, '...'));
    $data[$i]['name_en']      = sanitize_output($row['qa_name_en']);
    $data[$i]['name_fr']      = sanitize_output($row['qa_name_fr']);
    $data[$i]['name_en_raw']  = $row['qa_name_en'];
    $data[$i]['birth']        = sanitize_output($row['qa_birth']);
    $data[$i]['death']        = sanitize_output($row['qa_death']);
    $data[$i]['quotes']       = sanitize_output($row['q_count']);
    $data[$i]['media']        = sanitize_output($row['qma_count']);
    $data[$i]['used']         = sanitize_output($row['q_count'] + $row['qma_count']);

    // Quote media
    $media_names = sanitize_output($row['qma_names']);
    $data[$i]['media_list'] = str_replace('|||', '<br>', $media_names);

    // Portrait
    if(file_exists(root_path().'img/portraits/'.$row['qa_slug'].'.png'))
    {
      $data[$i]['portrait']     = '/img/portraits/'.$row['qa_slug'].'.png';
      $data[$i]['has_portrait'] = true;
    }
    else
    {
      $data[$i]['portrait']     = '/img/portraits/no_portrait.png';
      $data[$i]['has_portrait'] = false;
    }
  }

  // Add the number of rows to the returned data
  $data['rows'] = $i;

  // Return the prepared data
  return ($data ?? []);
}




/**
 * Adds a quote author to the database.
 *
 * @param   array  $data  An array containing data on the quote author.
 *
 * @return  int           The ID of the added quote author.
 */

function quote_authors_add( array $data ) : int
{
  // Sanitize the data
  $name_en    = sanitize_array_element($data, 'name_en', 'string');
  $name_fr    = sanitize_array_element($data, 'name_fr', 'string');
  $year_birth = sanitize_array_element($data, 'year_birth', 'int');
  $year_death = sanitize_array_element($data, 'year_death', 'int');
  $desc_en    = sanitize_array_element($data, 'desc_en', 'string');
  $desc_fr    = sanitize_array_element($data, 'desc_fr', 'string');

  // Generate a slug for the quote author
  $slug = str_replace(' ', '_', string_truncate($name_en, 100));
  $slug = sanitize(string_change_case(preg_replace('/[^a-z0-9_]/i', '', $slug), 'lowercase'), 'string');

  // Make sure the slug is unique
  $underscores = '';
  while(database_entry_exists('quote_authors', 'slug', $slug.$underscores))
    $underscores .= '_';
  $slug .= $underscores;

  // Add the quote author to the database
  query(" INSERT INTO quote_authors
          SET         quote_authors.slug            = '$slug',
                      quote_authors.name_en         = '$name_en',
                      quote_authors.name_fr         = '$name_fr',
                      quote_authors.year_birth      = '$year_birth',
                      quote_authors.year_death      = '$year_death',
                      quote_authors.description_en  = '$desc_en',
                      quote_authors.description_fr  = '$desc_fr' ");

  // Fetch the newly created quote author's ID
  $quote_author_id = query_id();

  // Return the quote author's ID
  return $quote_author_id;
}




/**
 * Edits a quote author.
 *
 * @param   int    $author_id  The ID of the quote author to edit.
 * @param   array  $data       An array containing data on the quote author.
 *
 * @return  void
 */

function quote_authors_edit(  int   $author_id  ,
                              array $data       ) : void
{
  // Sanitize the data
  $author_id   = sanitize($author_id, 'int');
  $name_en     = sanitize_array_element($data, 'name_en', 'string');
  $name_fr     = sanitize_array_element($data, 'name_fr', 'string');
  $year_birth  = sanitize_array_element($data, 'year_birth', 'int');
  $year_death  = sanitize_array_element($data, 'year_death', 'int');
  $desc_en     = sanitize_array_element($data, 'desc_en', 'string');
  $desc_fr     = sanitize_array_element($data, 'desc_fr', 'string');

  // Stop here if the author does not exist
  if(!$author_id || !database_row_exists('quote_authors', $author_id))
    return;

  // Get rid of the old slug
  query ("  UPDATE  quote_authors
            SET     quote_authors.slug = ''
            WHERE   quote_authors.id   = '$author_id' ");

  // Generate a new slug for the quote author
  $slug = str_replace(' ', '_', string_truncate($name_en, 100));
  $slug = sanitize(string_change_case(preg_replace('/[^a-z0-9_]/i', '', $slug), 'lowercase'), 'string');

  // Make sure the slug is unique
  $underscores = '';
  while(database_entry_exists('quote_authors', 'slug', $slug.$underscores))
    $underscores .= '_';
  $slug .= $underscores;

  // Edit the quote author
  query(" UPDATE  quote_authors
          SET     quote_authors.slug            = '$slug'       ,
                  quote_authors.name_en         = '$name_en'    ,
                  quote_authors.name_fr         = '$name_fr'    ,
                  quote_authors.year_birth      = '$year_birth' ,
                  quote_authors.year_death      = '$year_death' ,
                  quote_authors.description_en  = '$desc_en'    ,
                  quote_authors.description_fr  = '$desc_fr'
          WHERE   quote_authors.id              = '$author_id' ");
}




/**
 * Deletes a quote author.
 *
 * @param   int    $author_id  The ID of the quote author to delete.
 *
 * @return  bool               Whether the quote author was deleted successfully.
 */

function quote_authors_delete( int $author_id ) : bool
{
  // Sanitize the data
  $author_id = sanitize($author_id, 'int');

  // Check whether the author is linked to any media
  $media = query(" SELECT COUNT(DISTINCT quote_media_authors.id) AS 'qma_id'
                   FROM   quote_media_authors
                   WHERE  quote_media_authors.fk_quote_authors = '$author_id' ",
                   fetch_row: true);

  // Return false if there are still media linked to the author
  if($media['qma_id'] > 0)
    return false;

  // Check whether the author is linked to any quotes
  $quotes = query(" SELECT COUNT(DISTINCT quotes.id) AS 'q_id'
                    FROM   quotes
                    WHERE  quotes.fk_quote_authors = '$author_id' ",
                    fetch_row: true);

  // Return false if there are still quotes linked to the author
  if($quotes['q_id'] > 0)
    return false;

  // Delete the quote author
  query(" DELETE FROM quote_authors
          WHERE       quote_authors.id = '$author_id' ");

  // The author has been deleted
  return true;
}




/**
 * Fetches a quote media.
 *
 * @param   int    $media_id  The ID of the quote media.
 *
 * @return  array             An array containing data on the quote media.
 */

function quote_media_get( int $media_id ) : ?array
{
  // Sanitize the data
  $media_id = sanitize($media_id, 'int');

  // Stop here if the media does not exist
  if(!$media_id || !database_row_exists('quote_media', $media_id))
    return null;

  // Fetch the media's data
  $media = query("  SELECT  quote_media.slug            AS 'qm_slug'      ,
                            quote_media.name_en         AS 'qm_name_en'   ,
                            quote_media.name_fr         AS 'qm_name_fr'   ,
                            quote_media.year_published  AS 'qm_year'      ,
                            quote_media.description_en  AS 'qm_desc_en'   ,
                            quote_media.description_fr  AS 'qm_desc_fr'   ,
                            quote_media.source_en       AS 'qm_source_en' ,
                            quote_media.source_fr       AS 'qm_source_fr'
                      FROM  quote_media
                      WHERE quote_media.id = '$media_id' ",
                      fetch_row: true);

  // Prepare the data for display
  $data['id']             = sanitize_output($media_id);
  $data['slug']           = sanitize_output($media['qm_slug']);
  $data['name_en']        = sanitize_output($media['qm_name_en']);
  $data['name_fr']        = sanitize_output($media['qm_name_fr']);
  $data['name_en_raw']    = $media['qm_name_en'];
  $data['year']           = $media['qm_year'] ? sanitize_output($media['qm_year']) : '';
  $data['description_en'] = sanitize_output($media['qm_desc_en']);
  $data['description_fr'] = sanitize_output($media['qm_desc_fr']);
  $data['source_en']      = sanitize_output($media['qm_source_en']);
  $data['source_fr']      = sanitize_output($media['qm_source_fr']);

  // Return the prepared data
  return $data;
}




/**
 * Fetches authors attached to a quote media.
 *
 * @param   int    $media_id  The ID of the media.
 *
 * @return  array             An array containing the authors attached to the media.
 */

function quote_media_get_authors( int $media_id ) : array
{
  // Sanitize the media ID
  $media_id = sanitize($media_id, 'int');

  // Fetch the attached authors
  $authors = query("  SELECT    quote_media_authors.fk_quote_authors AS 'qma_id'
                      FROM      quote_media_authors
                      WHERE     quote_media_authors.fk_quote_media = '$media_id'
                      ORDER BY  quote_media_authors.fk_quote_authors ASC ");

  // Prepare the data for display
  for($i = 0; $row = query_row($authors); $i++)
    $data[$i] = sanitize_output($row['qma_id']);

  // Return the prepared data
  return ($data ?? []);
}




/**
 * Fetches quote media.
 *
 * @param   bool   $sort_by_author   (OPTIONAL) Sorts the media list by author instead of media name.
 *
 * @return  array                               An array containing the quote media.
 */

function quote_media_list( bool $sort_by_author = false ) : array
{
  // Get the user's current language
  $lang = string_change_case(user_get_language(), 'lowercase');

  // Sort the media
  $query_sort = ($sort_by_author)
                ? " ORDER BY author_data.author_names IS NULL ASC,
                         author_data.author_names         ASC,
                         quote_media.name_$lang           ASC  "
                : " ORDER BY quote_media.name_$lang           ASC  ";

  // Fetch the media
  $media = query("  SELECT        quote_media.id                          AS 'qm_id'      ,
                                  quote_media.name_$lang                  AS 'qm_name'    ,
                                  quote_media.name_en                     AS 'qm_name_en' ,
                                  quote_media.name_fr                     AS 'qm_name_fr' ,
                                  quote_media.year_published              AS 'qm_year'    ,
                                  COALESCE(quote_data.quote_count, 0)     AS 'q_count'    ,
                                  COALESCE(author_data.author_count, 0)   AS 'qa_count'   ,
                                  COALESCE(author_data.author_names, '')  AS 'qa_names'

                      FROM   quote_media

                      LEFT JOIN
                      (
                        SELECT    quotes.fk_quote_media AS 'media_id',
                                  COUNT(quotes.id)       AS 'quote_count'
                        FROM      quotes
                        GROUP BY  quotes.fk_quote_media
                      )
                      AS quote_data
                      ON quote_data.media_id = quote_media.id

                      LEFT JOIN
                      (
                        SELECT    quote_media_authors.fk_quote_media  AS 'media_id',
                                  COUNT(quote_media_authors.id)       AS 'author_count',
                                  GROUP_CONCAT(
                                    quote_authors.name_$lang
                                    ORDER BY quote_authors.name_$lang ASC
                                    SEPARATOR '|||'
                                  )                                   AS 'author_names'
                        FROM      quote_media_authors
                        JOIN      quote_authors
                        ON        quote_authors.id = quote_media_authors.fk_quote_authors
                        GROUP BY  quote_media_authors.fk_quote_media
                      )
                      AS author_data
                      ON author_data.media_id = quote_media.id

                      $query_sort  ");

  // Prepare the data for display
  for($i = 0; $row = query_row($media); $i++)
  {
    // Quote media data
    $data[$i]['id']       = sanitize_output($row['qm_id']);
    $data[$i]['name']     = sanitize_output($row['qm_name']);
    $data[$i]['sname']    = sanitize_output(string_truncate($row['qm_name'], 25, '...'));
    $data[$i]['name_en']  = sanitize_output($row['qm_name_en']);
    $data[$i]['name_fr']  = sanitize_output($row['qm_name_fr']);
    $data[$i]['year']     = sanitize_output($row['qm_year']);
    $data[$i]['authors']  = sanitize_output($row['qa_count']);
    $data[$i]['quotes']   = sanitize_output($row['q_count']);

    // Quote authors
    $author_names = sanitize_output($row['qa_names']);
    $data[$i]['authors_list'] = str_replace('|||', '<br>', $author_names);
    $data[$i]['authors_text'] = str_replace('|||', ' & ', $author_names);

    // Full name with authors
    $data[$i]['full_name']  = ($data[$i]['authors_text'])
                            ? $data[$i]['authors_text'].' - '.$data[$i]['name']
                            : $data[$i]['name'];
  }

  // Add the number of rows to the returned data
  $data['rows'] = $i;

  // Return the prepared data
  return ($data ?? []);
}




/**
 * Adds a quote media to the database.
 *
 * @param   array  $data  An array containing data on the quote media.
 *
 * @return  int           The ID of the added quote media.
 */

function quote_media_add( array $data ) : int
{
  // Sanitize the data
  $name_en    = sanitize_array_element($data, 'name_en', 'string');
  $name_fr    = sanitize_array_element($data, 'name_fr', 'string');
  $desc_en    = sanitize_array_element($data, 'desc_en', 'string');
  $desc_fr    = sanitize_array_element($data, 'desc_fr', 'string');
  $source_en  = sanitize_array_element($data, 'source_en', 'string');
  $source_fr  = sanitize_array_element($data, 'source_fr', 'string');
  $year       = sanitize_array_element($data, 'year', 'int');

  // Generate a slug for the quote media
  $slug = str_replace(' ', '_', string_truncate($name_en, 100));
  $slug = sanitize(string_change_case(preg_replace('/[^a-z0-9_]/i', '', $slug), 'lowercase'), 'string');

  // Make sure the slug is unique
  $underscores = '';
  while(database_entry_exists('quote_media', 'slug', $slug.$underscores))
    $underscores .= '_';
  $slug .= $underscores;

  // Add the quote media to the database
  query(" INSERT INTO quote_media
          SET         quote_media.slug            = '$slug'       ,
                      quote_media.name_en         = '$name_en'    ,
                      quote_media.name_fr         = '$name_fr'    ,
                      quote_media.description_en  = '$desc_en'    ,
                      quote_media.description_fr  = '$desc_fr'    ,
                      quote_media.source_en       = '$source_en'  ,
                      quote_media.source_fr       = '$source_fr'  ,
                      quote_media.year_published  = '$year'       ");

  // Fetch the newly created quote media's ID
  $quote_media_id = query_id();

  // Return the quote media's ID
  return $quote_media_id;
}




/**
 * Edits a quote media.
 *
 * @param   int    $media_id  The ID of the quote media to edit.
 * @param   array  $data      An array containing data on the quote media.
 *
 * @return  void
*/

function quote_media_edit(  int   $media_id  ,
                              array $data      ) : void
{
  // Sanitize the data
  $media_id    = sanitize($media_id, 'int');
  $name_en     = sanitize_array_element($data, 'name_en', 'string');
  $name_fr     = sanitize_array_element($data, 'name_fr', 'string');
  $desc_en     = sanitize_array_element($data, 'desc_en', 'string');
  $desc_fr     = sanitize_array_element($data, 'desc_fr', 'string');
  $source_en   = sanitize_array_element($data, 'source_en', 'string');
  $source_fr   = sanitize_array_element($data, 'source_fr', 'string');
  $year        = sanitize_array_element($data, 'year', 'int');

  // Stop here if the media does not exist
  if(!$media_id || !database_row_exists('quote_media', $media_id))
    return;

  // Get rid of the old slug
  query ("  UPDATE  quote_media
            SET     quote_media.slug = ''
            WHERE   quote_media.id   = '$media_id' ");

  // Generate a new slug for the quote media
  $slug = str_replace(' ', '_', string_truncate($name_en, 100));
  $slug = sanitize(string_change_case(preg_replace('/[^a-z0-9_]/i', '', $slug), 'lowercase'), 'string');

  // Make sure the slug is unique
  $underscores = '';
  while(database_entry_exists('quote_media', 'slug', $slug.$underscores))
    $underscores .= '_';
  $slug .= $underscores;

  // Edit the quote media
  query(" UPDATE  quote_media
          SET     quote_media.slug            = '$slug'       ,
                  quote_media.name_en         = '$name_en'    ,
                  quote_media.name_fr         = '$name_fr'    ,
                  quote_media.description_en  = '$desc_en'    ,
                  quote_media.description_fr  = '$desc_fr'    ,
                  quote_media.source_en       = '$source_en'  ,
                  quote_media.source_fr       = '$source_fr'  ,
                  quote_media.year_published  = '$year'
          WHERE   quote_media.id              = '$media_id' ");
}




/**
 * Updates the authors attached to a quote media.
 *
 * @param   int    $media_id  The ID of the quote media.
 * @param   array  $authors   An array of author IDs to attach to the quote media.
 *
 * @return  void
 */

function quote_media_edit_authors(  int   $media_id ,
                                    array $authors  ) : void
{
  // Sanitize the media ID
  $media_id = sanitize($media_id, 'int');

  // Stop here if the media does not exist
  if(!$media_id || !database_row_exists('quote_media', $media_id))
    return;

  // Sanitize, validate, and deduplicate the author IDs
  $valid_author_ids = array();
  foreach($authors as $author_id)
  {
    $author_id = sanitize($author_id, 'int');
    if($author_id && database_row_exists('quote_authors', $author_id) && !in_array($author_id, $valid_author_ids))
      $valid_author_ids[] = $author_id;
  }

  // Remove author-media links that should no longer exist
  if(count($valid_author_ids) > 0)
  {
    $valid_author_ids_sql = implode(',', $valid_author_ids);
    query(" DELETE FROM quote_media_authors
            WHERE       quote_media_authors.fk_quote_media        = '$media_id'
            AND         quote_media_authors.fk_quote_authors NOT IN ($valid_author_ids_sql) ");
  }

  // Or remove all author-media links if none are provided
  else
  {
    query(" DELETE FROM quote_media_authors
            WHERE       quote_media_authors.fk_quote_media = '$media_id' ");
  }

  // Add any missing author-media links
  foreach($valid_author_ids as $author_id)
  {
    // Look for missing link
    $check_link = query(" SELECT  COUNT(*) AS 'link_count'
                          FROM    quote_media_authors
                          WHERE   quote_media_authors.fk_quote_media   = '$media_id'
                          AND     quote_media_authors.fk_quote_authors = '$author_id' ",
                          fetch_row: true);

    // Create missing link
    if($check_link['link_count'] == 0)
    {
      query(" INSERT INTO quote_media_authors
              SET         quote_media_authors.fk_quote_media   = '$media_id'  ,
                          quote_media_authors.fk_quote_authors = '$author_id' ");
    }
  }
}




/**
 * Deletes a quote media.
 *
 * @param   int    $media_id  The ID of the quote media to delete.
 *
 * @return  bool              Whether the quote media was deleted successfully.
 */

function quote_media_delete( int $media_id ) : bool
{
  // Sanitize the data
  $media_id = sanitize($media_id, 'int');

  // Check whether the media is linked to any quotes
  $quotes = query(" SELECT COUNT(DISTINCT quotes.id) AS 'q_id'
                    FROM   quotes
                    WHERE  quotes.fk_quote_media = '$media_id' ",
                    fetch_row: true);

  // Return false if there are still quotes linked to the media
  if($quotes['q_id'] > 0)
    return false;

  // Delete any links between the media and authors
  query(" DELETE FROM quote_media_authors
          WHERE       quote_media_authors.fk_quote_media = '$media_id' ");

  // Delete the quote media
  query(" DELETE FROM quote_media
          WHERE       quote_media.id = '$media_id' ");

  // The media has been deleted
  return true;
}




/**
 * Fetches a quote tag.
 *
 * @param   int    $tag_id  The ID of the quote tag.
 *
 * @return  array           An array containing data on the quote tag.
 */

function quote_tags_get( int $tag_id ) : ?array
{
  // Sanitize the data
  $tag_id = sanitize($tag_id, 'int');

  // Stop here if the tag does not exist
  if(!$tag_id || !database_row_exists('quote_tags', $tag_id))
    return null;

  // Fetch the tag's data
  $tag = query("  SELECT  quote_tags.slug           AS 'qt_slug'      ,
                          quote_tags.sorting_order  AS 'qt_sort'      ,
                          quote_tags.name_en        AS 'qt_name_en'   ,
                          quote_tags.name_fr        AS 'qt_name_fr'
                  FROM    quote_tags
                  WHERE   quote_tags.id = '$tag_id' ",
                  fetch_row: true);

  // Prepare the data for display
  $data['id']       = sanitize_output($tag_id);
  $data['slug']     = sanitize_output($tag['qt_slug']);
  $data['sort']     = sanitize_output($tag['qt_sort']);
  $data['name_en']  = sanitize_output($tag['qt_name_en']);
  $data['name_fr']  = sanitize_output($tag['qt_name_fr']);

  // Return the prepared data
  return $data;
}




/**
 * Fetches quote tags.
 *
 * @return  array  An array of quote tags.
 */

function quote_tags_list() : array
{
  // Get the user's current language
  $lang = string_change_case(user_get_language(), 'lowercase');

  // Fetch the tags
  $tags = query(" SELECT      quote_tags.id             AS 'qt_id'      ,
                              quote_tags.slug           AS 'qt_slug'    ,
                              quote_tags.sorting_order  AS 'qt_sort'    ,
                              quote_tags.name_$lang     AS 'qt_name'    ,
                              quote_tags.name_en        AS 'qt_name_en' ,
                              quote_tags.name_fr        AS 'qt_name_fr' ,
                              COUNT(quote_tag_links.id) AS 'ql_count'
                    FROM      quote_tags
                    LEFT JOIN quote_tag_links ON quote_tag_links.fk_quote_tags = quote_tags.id
                    GROUP BY  quote_tags.id
                    ORDER BY  quote_tags.sorting_order ASC ");

  // Prepare the data for display
  for($i = 0; $row = query_row($tags); $i++)
  {
    $data[$i]['id']       = sanitize_output($row['qt_id']);
    $data[$i]['slug']     = sanitize_output($row['qt_slug']);
    $data[$i]['sort']     = sanitize_output($row['qt_sort']);
    $data[$i]['name']     = sanitize_output($row['qt_name']);
    $data[$i]['sname']    = sanitize_output(string_truncate($row['qt_name'], 25, '...'));
    $data[$i]['quotes']   = sanitize_output($row['ql_count']);
    $data[$i]['name_en']  = sanitize_output($row['qt_name_en']);
    $data[$i]['name_fr']  = sanitize_output($row['qt_name_fr']);
  }

  // Add the number of rows to the returned data
  $data['rows'] = $i;

  // Return the prepared data
  return ($data ?? []);
}




/**
 * Adds a quote tag to the database.
 *
 * @param   array  $data  An array containing data on the quote tag.
 *
 * @return  int           The ID of the added quote tag.
 */

function quote_tags_add( array $data ) : int
{
  // Sanitize the data
  $sort     = sanitize_array_element($data, 'sort', 'int');
  $name_en  = sanitize_array_element($data, 'name_en', 'string');
  $name_fr  = sanitize_array_element($data, 'name_fr', 'string');

  // Generate a slug for the quote tag
  $slug = str_replace(' ', '_', string_truncate($name_en, 100));
  $slug = sanitize(string_change_case(preg_replace('/[^a-z0-9_]/i', '', $slug), 'lowercase'), 'string');

  // Make sure the slug is unique
  $underscores = '';
  while(database_entry_exists('quote_tags', 'slug', $slug.$underscores))
    $underscores .= '_';
  $slug .= $underscores;

  // Add the quote tag to the database
  query(" INSERT INTO quote_tags
          SET         quote_tags.slug           = '$slug'       ,
                      quote_tags.sorting_order  = '$sort'       ,
                      quote_tags.name_en        = '$name_en'    ,
                      quote_tags.name_fr        = '$name_fr'    ");

  // Fetch the newly created quote tag's ID
  $quote_tag_id = query_id();

  // Return the quote tag's ID
  return $quote_tag_id;
}




/**
 * Edits a quote tag.
 *
 * @param   int    $tag_id  The ID of the quote tag to edit.
 * @param   array  $data    An array containing data on the quote tag.
 *
 * @return  void
 */

function quote_tags_edit( int   $tag_id ,
                          array $data   ) : void
{
  // Sanitize the data
  $tag_id    = sanitize($tag_id, 'int');
  $sort      = sanitize_array_element($data, 'sort', 'int');
  $name_en   = sanitize_array_element($data, 'name_en', 'string');
  $name_fr   = sanitize_array_element($data, 'name_fr', 'string');

  // Stop here if the tag does not exist
  if(!$tag_id || !database_row_exists('quote_tags', $tag_id))
    return;

  // Get rid of the old slug
  query ("  UPDATE  quote_tags
            SET     quote_tags.slug = ''
            WHERE   quote_tags.id   = '$tag_id' ");

  // Generate a new slug for the quote tag
  $slug = str_replace(' ', '_', string_truncate($name_en, 100));
  $slug = sanitize(string_change_case(preg_replace('/[^a-z0-9_]/i', '', $slug), 'lowercase'), 'string');

  // Make sure the slug is unique
  $underscores = '';
  while(database_entry_exists('quote_tags', 'slug', $slug.$underscores))
    $underscores .= '_';
  $slug .= $underscores;

  // Edit the quote tag
  query(" UPDATE  quote_tags
          SET     quote_tags.slug           = '$slug'       ,
                  quote_tags.sorting_order  = '$sort'       ,
                  quote_tags.name_en        = '$name_en'    ,
                  quote_tags.name_fr        = '$name_fr'
          WHERE   quote_tags.id             = '$tag_id' ");
}




/**
 * Deletes a quote tag.
 *
 * @param   int    $tag_id  The ID of the quote tag to delete.
 *
 * @return  bool            Whether the quote tag was deleted successfully.
 */

function quote_tags_delete( int $tag_id ) : bool
{
  // Sanitize the data
  $tag_id = sanitize($tag_id, 'int');

  // Check whether the tag is linked to any quotes
  $quotes = query(" SELECT COUNT(DISTINCT quote_tag_links.id) AS 'ql_id'
                    FROM   quote_tag_links
                    WHERE  quote_tag_links.fk_quote_tags = '$tag_id' ",
                    fetch_row: true);

  // Return false if there are still quotes linked to the tag
  if($quotes['ql_id'] > 0)
    return false;

  // Delete the quote tag
  query(" DELETE FROM quote_tags
          WHERE       quote_tags.id = '$tag_id' ");

  // The tag has been deleted
  return true;
}