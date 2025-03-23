<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../404")); die(); }

// Include pages that are required to make MySQL queries
include_once './../inc/settings.inc.php';     # General settings
include_once './../inc/sql.inc.php';          # MySQL connection
include_once './../inc/sanitization.inc.php'; # Data sanitization

// If there is no table for settings, then create it
$settings_exists = 0;
$qtablelist = query(" SHOW TABLES ");

// Check if the settings table exists
while($dtablelist = query_row($qtablelist, return_format: 'both'))
  $settings_exists = ($dtablelist[0] === 'settings') ? 1 : $settings_exists;

// Create the settings table if it doesn't exist
if(!$settings_exists)
{
  sql_create_table('settings');
  sql_create_field('settings', 'latest_query_id', 'INT UNSIGNED NOT NULL DEFAULT 0', 'id');
  query(" INSERT INTO settings SET latest_query_id = 0 ");
}




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                       FUNCTIONS USED FOR STRUCTURAL QUERIES                                       */
/*                                                                                                                   */
/*********************************************************************************************************************/
/*     These functions allow for "safe" manipulation of the database, and should only be used within this file.      */
/*********************************************************************************************************************/
/*                                                                                                                   */
/*  sql_check_query_id        Checks whether a query should be ran or not.                                           */
/*  sql_update_query_id       Updates the ID of the last query that was ran.                                         */
/*                                                                                                                   */
/*  sql_create_table          Creates a new table.                                                                   */
/*  sql_rename_table          Renames an existing table.                                                             */
/*  sql_empty_table           Gets rid of all the data in an existing table.                                         */
/*  sql_delete_table          Deletes an existing table.                                                             */
/*                                                                                                                   */
/*  sql_create_field          Creates a new field in an existing table.                                              */
/*  sql_rename_field          Renames an existing field in an existing table.                                        */
/*  sql_change_field_type     Changes the type of an existing field in an existing table.                            */
/*  sql_move_field            Moves an existing field in an existing table.                                          */
/*  sql_delete_field          Deletes an existing field in an existing table.                                        */
/*                                                                                                                   */
/*  sql_create_index          Creates an index in an existing table.                                                 */
/*  sql_delete_index          Deletes an existing index in an existing table.                                        */
/*                                                                                                                   */
/*  sql_insert_value          Inserts a value in an existing table.                                                  */
/*                                                                                                                   */
/*  sql_sanitize_data         Sanitizes data for MySQL queries.                                                      */
/*                                                                                                                   */
/*********************************************************************************************************************/

/**
 * Checks whether a query should be ran or not.
 *
 * @return  int|null  Returns null if the query should be ran, otherwise return the id of the latest query that ran.
 */

function sql_check_query_id() : mixed
{
  // Fetch the id of the last query that was ran
  $last_query = query(" SELECT    settings.latest_query_id AS 'latest_query_id'
                        FROM      settings
                        ORDER BY  settings.latest_query_id DESC
                        LIMIT     1 ",
                        fetch_row: true);

  // Return that id
  return $last_query['latest_query_id'];
}




/**
 * Updates the ID of the last query that was ran.
 *
 * @param   int   $id   ID of the query.
 *
 * @return  void
 */

function sql_update_query_id( int $id ) : void
{
  // Data sanitization
  $id = intval($id);

  // Update the id in the database
  query(" UPDATE  settings
          SET     settings.latest_query_id = $id ");
}




/**
 * Creates a new table.
 *
 * The table will only contain one field, called "id", an auto incremented primary key.
 *
 * @param   string  $table_name   The name of the table to create.
 *
 * @return  void
 */

function sql_create_table( string $table_name ) : void
{
  // Create the table
  query(" CREATE TABLE IF NOT EXISTS ".$table_name." ( id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ) ENGINE=MyISAM;");
}




/**
 * Renames an existing table.
 *
 * @param   string  $table_name   The old name of the table.
 * @param   string  $new_name     The new name of the table.
 *
 * @return  void
 */

function sql_rename_table(  string  $table_name ,
                            string  $new_name   ) : void
{
  // Proceed only if the table exists and the new table name is not taken
  $query_old_ok = 0;
  $query_new_ok = 1;
  $qtablelist   = query(" SHOW TABLES ");
  while($dtablelist = query_row($qtablelist, 'both'))
  {
    $query_old_ok = ($dtablelist[0] === $table_name) ? 1 : $query_old_ok;
    $query_new_ok = ($dtablelist[0] === $new_name)   ? 0 : $query_new_ok;
  }
  if(!$query_old_ok || !$query_new_ok)
    return;

  // Rename the table
  query(" ALTER TABLE $table_name RENAME $new_name ");
}




/**
 * Gets rid of all the data in an existing table.
 *
 * @param   string  $table_name   The table's name.
 *
 * @return  void
 */

function sql_empty_table( string $table_name ) : void
{
  // Proceed only if the table exists
  $query_ok   = 0;
  $qtablelist = query(" SHOW TABLES ");
  while($dtablelist = query_row($qtablelist, 'both'))
    $query_ok = ($dtablelist[0] === $table_name) ? 1 : $query_ok;
  if(!$query_ok)
    return;

  // Purge the table's contents
  query(" TRUNCATE TABLE ".$table_name);
}




/**
 * Deletes an existing table.
 *
 * @param   string  $table_name   The table's name.
 *
 * @return  void
 */

function sql_delete_table( string $table_name ) : void
{
  // Delete the table
  query(" DROP TABLE IF EXISTS ".$table_name);
}




/**
 * Creates a new field in an existing table.
 *
 * @param   string  $table_name         The existing table's name.
 * @param   string  $field_name         The new field's name.
 * @param   string  $field_type         The new field's MySQL type.
 * @param   string  $after_field_name   The name of the field that is located before the emplacement of the new one.
 *
 * @return  void
 */

function sql_create_field(  string  $table_name       ,
                            string  $field_name       ,
                            string  $field_type       ,
                            string  $after_field_name ) : void
{
  // Proceed only if the table exists
  $query_ok   = 0;
  $qtablelist = query(" SHOW TABLES ");
  while($dtablelist = query_row($qtablelist, 'both'))
    $query_ok = ($dtablelist[0] === $table_name) ? 1 : $query_ok;
  if(!$query_ok)
    return;

  // Fetch the table's structure
  $qdescribe = query(" DESCRIBE ".$table_name);

  // Proceed only if the preceeding field exists
  $query_ok = 0;
  while($ddescribe = query_row($qdescribe, 'both'))
    $query_ok = ($ddescribe['Field'] === $after_field_name) ? 1 : $query_ok;
  if(!$query_ok)
    return;

  // Fetch the table's structure yet again
  $qdescribe = query(" DESCRIBE ".$table_name);

  // Proceed only if the field doesn't already exist
  $query_ko = 0;
  while($ddescribe = query_row($qdescribe, 'both'))
    $query_ko = ($ddescribe['Field'] === $field_name) ? 1 : $query_ko;
  if($query_ko)
    return;

  // Run the query
  query(" ALTER TABLE ".$table_name." ADD ".$field_name." ".$field_type." AFTER ".$after_field_name);
}




/**
 * Renames an existing field in an existing table.
 *
 * @param   string  $table_name       The existing table's name.
 * @param   string  $old_field_name   The field's old name.
 * @param   string  $new_field_name   The field's new name.
 * @param   string  $field_type       The MySQL type of the field.
 *
 * @return  void
 */

function sql_rename_field(  string  $table_name     ,
                            string  $old_field_name ,
                            string  $new_field_name ,
                            string  $field_type     ) : void
{
  // Proceed only if the table exists
  $query_ok   = 0;
  $qtablelist = query(" SHOW TABLES ");
  while($dtablelist = query_row($qtablelist, 'both'))
    $query_ok = ($dtablelist[0] === $table_name) ? 1 : $query_ok;
  if(!$query_ok)
    return;

  // Fetch the table's structure
  $qdescribe = query(" DESCRIBE ".$table_name);

  // Continue only if the new field name doesn't exist
  while($ddescribe = query_row($qdescribe, 'both'))
  {
    if ($ddescribe['Field'] === $new_field_name)
      return;
  }

  // Fetch the table's structure yet again
  $qdescribe = query(" DESCRIBE ".$table_name);

  // If the field exists in the table, rename it
  while($ddescribe = query_row($qdescribe, 'both'))
  {
    if($ddescribe['Field'] === $old_field_name)
      query(" ALTER TABLE ".$table_name." CHANGE ".$old_field_name." ".$new_field_name." ".$field_type);
  }
}




/**
 * Changes the type of an existing field in an existing table.
 *
 * @param   string  $table_name   The existing table's name.
 * @param   string  $field_name   The existing field's name.
 * @param   string  $field_type   The MySQL type to give the field.
 *
 * @return  void
 */

function sql_change_field_type( string  $table_name ,
                                string  $field_name ,
                                string  $field_type ) : void
{
  // Proceed only if the table exists
  $query_ok   = 0;
  $qtablelist = query(" SHOW TABLES ");
  while($dtablelist = query_row($qtablelist, 'both'))
    $query_ok = ($dtablelist[0] === $table_name) ? 1 : $query_ok;
  if(!$query_ok)
    return;

  // Fetch the table's structure
  $qdescribe = query(" DESCRIBE ".$table_name);

  // If the field exists in the table, rename it
  while($ddescribe = query_row($qdescribe, 'both'))
  {
    if($ddescribe['Field'] === $field_name)
      query(" ALTER TABLE ".$table_name." MODIFY ".$field_name." ".$field_type);
  }
}




/**
 * Moves an existing field in an existing table.
 *
 * @param   string  $table_name         The existing table's name.
 * @param   string  $field_name         The existing field's name.
 * @param   string  $field_type         The MySQL type of the field.
 * @param   string  $after_field_name   The name of the field that is located before the emplacement of the new one.
 *
 * @return  void
 */

function sql_move_field(  string  $table_name       ,
                          string  $field_name       ,
                          string  $field_type       ,
                          string  $after_field_name ) : void
{
  // Proceed only if the table exists
  $query_ok   = 0;
  $qtablelist = query(" SHOW TABLES ");
  while($dtablelist = query_row($qtablelist, 'both'))
    $query_ok = ($dtablelist[0] === $table_name) ? 1 : $query_ok;
  if(!$query_ok)
    return;

  // Fetch the table's structure
  $qdescribe = query(" DESCRIBE ".$table_name);

  // Continue only if both of the field names actually exist
  $field_ok       = 0;
  $field_after_ok = 0;
  while($ddescribe = query_row($qdescribe, 'both'))
  {
    $field_ok       = ($ddescribe['Field'] === $field_name)        ? 1 : $field_ok;
    $field_after_ok = ($ddescribe['Field'] === $after_field_name)  ? 1 : $field_after_ok;
  }
  if(!$field_ok || !$field_after_ok)
    return;

  // Move the field
  query(" ALTER TABLE ".$table_name." MODIFY COLUMN ".$field_name." ".$field_type." AFTER ".$after_field_name);
}




/**
 * Deletes an existing field in an existing table.
 *
 * @param   string  $table_name   The existing table's name.
 * @param   string  $field_name   The existing field's name
 *
 * @return  void
 */

function sql_delete_field(  string  $table_name ,
                            string  $field_name ) : void
{
  // Proceed only if the table exists
  $query_ok   = 0;
  $qtablelist = query(" SHOW TABLES ");
  while($dtablelist = query_row($qtablelist, 'both'))
    $query_ok = ($dtablelist[0] === $table_name) ? 1 : $query_ok;
  if(!$query_ok)
    return;

  // Fetch the table's structure
  $qdescribe = query(" DESCRIBE ".$table_name);

  // If the field exists in the table, delete it
  while($ddescribe = query_row($qdescribe, 'both'))
  {
    if($ddescribe['Field'] === $field_name)
      query(" ALTER TABLE ".$table_name." DROP ".$field_name);
  }
}




/**
 * Creates an index in an existing table.
 *
 * @param   string  $table_name               The name of the existing table.
 * @param   string  $index_name               The name of the index that will be created.
 * @param   string  $field_names              One or more fields to be indexed (eg. "my_field, other_field").
 * @param   bool    $fulltext     (OPTIONAL)  If set, the index will be created as fulltext.
 *
 * @return  void
 */

function sql_create_index(  string  $table_name           ,
                            string  $index_name           ,
                            string  $field_names          ,
                            bool    $fulltext     = false )
{
  // Proceed only if the table exists
  $query_ok   = 0;
  $qtablelist = query(" SHOW TABLES ");
  while($dtablelist = query_row($qtablelist, 'both'))
    $query_ok = ($dtablelist[0] === $table_name) ? 1 : $query_ok;
  if(!$query_ok)
    return;

  // Check whether the index already exists
  $qindex = query(" SHOW INDEX FROM ".$table_name." WHERE key_name LIKE '".$index_name."' ");

  // If it does not exist yet, then can create it and run a check to populate the table's indexes
  if(!query_row_count($qindex))
  {
    $query_fulltext = ($fulltext) ? ' FULLTEXT ' : '';
    query(" ALTER TABLE ".$table_name."
            ADD ".$query_fulltext." INDEX ".$index_name." (".$field_names."); ");
    query(" CHECK TABLE ".$table_name." ");
  }
}




/**
 * Deletes an existing index in an existing table.
 *
 * @param   string  $table_name   The existing table's name.
 * @param   string  $index_name   The existing index's name.
 *
 * @return  void
 */

function sql_delete_index(  string  $table_name ,
                            string  $index_name ) : void
{
  // Proceed only if the table exists
  $query_ok   = 0;
  $qtablelist = query(" SHOW TABLES ");
  while($dtablelist = query_row($qtablelist, 'both'))
    $query_ok = ($dtablelist[0] === $table_name) ? 1 : $query_ok;
  if(!$query_ok)
    return;

  // Check whether the index already exists
  $qindex = query(" SHOW INDEX FROM ".$table_name." WHERE key_name LIKE '".$index_name."' ");

  // If it exists, delete it and run a check to depopulate the index
  if(query_row_count($qindex))
  {
    query(" ALTER TABLE ".$table_name."
            DROP INDEX ".$index_name );
    query(" CHECK TABLE ".$table_name." ");
  }
}




/**
 * Inserts a value in an existing table.
 *
 * The only way to clarify the way this function works is with a concrete example, so here you go:
 * sql_insert_value(" SELECT my_string, my_int FROM my_table WHERE my_string LIKE 'test' AND my_int = 1 ",
 * " INSERT INTO my_table SET my_string = 'test' , my_int = 1 ");
 *
 * @param   string  $condition  A condition that must be matched before the query is ran.
 * @param   string  $query      The query to be ran to insert the value.
 *
 * @return  void
 */

function sql_insert_value(  string  $condition  ,
                            string  $query      ) : void
{
  // If the condition is met, run the query
  if(!query_row_count(query($condition)))
    query($query);
}




/**
 * Sanitizes data for MySQL queries.
 *
 * @param   mixed  $data  The data to sanitize.
 *
 * @return  mixed         The sanitized data
 */

function sql_sanitize_data( mixed $data ) : mixed
{
  // Sanitize the data using the currently open MySQL connection
  return trim(mysqli_real_escape_string($GLOBALS['db'], $data));
}




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                   QUERY HISTORY                                                   */
/*                                                                                                                   */
/*********************************************************************************************************************/
/*                                                                                                                   */
/*                               Allows replaying of queries that haven't been run yet                               */
/*                    in order to ensure a version upgrade between any two versions goes smoothly                    */
/*                                                                                                                   */
/*                               Older queries are archived in /dev/queries.archive.php                              */
/*                                                                                                                   */
/*********************************************************************************************************************/
// Those queries are treated like data migrations and will only be ran once, hence the storing of the last query id

// Fetch the id of the last query that was run
$last_query = sql_check_query_id();




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Admin notes

if($last_query < 1)
{
  sql_create_table('notes');
  sql_create_field('notes', 'tasks', 'LONGTEXT NOT NULL', 'id');
  query(" INSERT INTO notes SET notes.tasks = '' ");

  sql_update_query_id(1);
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Smuggie ideas

if($last_query < 2)
{
  sql_create_table('ideas');
  sql_create_field('ideas', 'title', 'TINYTEXT NOT NULL', 'id');
  sql_create_field('ideas', 'body', 'LONGTEXT NOT NULL', 'title');

  sql_create_index('ideas', 'ideas_title', 'title(16)');

  sql_update_query_id(2);
}



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Comic types and comics

if($last_query < 3)
{
  sql_create_table('comic_types');
  sql_create_field('comic_types', 'sorting_order', 'INT UNSIGNED NOT NULL', 'id');
  sql_create_field('comic_types', 'is_major', 'TINYINT(1) NOT NULL', 'sorting_order');
  sql_create_field('comic_types', 'banner_en', 'TINYTEXT NOT NULL', 'is_major');
  sql_create_field('comic_types', 'banner_fr', 'TINYTEXT NOT NULL', 'banner_en');
  sql_create_field('comic_types', 'name_en', 'TINYTEXT NOT NULL', 'banner_fr');
  sql_create_field('comic_types', 'name_fr', 'TINYTEXT NOT NULL', 'name_en');
  sql_create_field('comic_types', 'description_en', 'TEXT NOT NULL', 'name_fr');
  sql_create_field('comic_types', 'description_fr', 'TEXT NOT NULL', 'description_en');

  sql_create_index('comic_types', 'comic_types_sorting_order', 'sorting_order');
  sql_create_index('comic_types', 'comic_types_is_major', 'is_major');

  sql_create_table('comics');
  sql_create_field('comics', 'fk_comic_types', 'INT UNSIGNED NOT NULL', 'id');
  sql_create_field('comics', 'is_public', 'TINYINT(1) NOT NULL', 'fk_comic_types');
  sql_create_field('comics', 'slug', 'VARCHAR(255) NOT NULL', 'is_public');
  sql_create_field('comics', 'upload_date', 'DATE NOT NULL', 'slug');
  sql_create_field('comics', 'title_en', 'TINYTEXT NOT NULL', 'upload_date');
  sql_create_field('comics', 'title_fr', 'TINYTEXT NOT NULL', 'title_en');
  sql_create_field('comics', 'description_en', 'TEXT NOT NULL', 'title_fr');
  sql_create_field('comics', 'description_fr', 'TEXT NOT NULL', 'description_en');

  sql_create_index('comics', 'comics_types', 'fk_comic_types');
  sql_create_index('comics', 'comics_public', 'is_public');

  sql_update_query_id(3);
}



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Image types and images

if($last_query < 4)
{
  sql_create_table('images');
  sql_create_field('images', 'name', 'TINYTEXT NOT NULL', 'id');
  sql_create_field('images', 'fk_comics', 'INT UNSIGNED NOT NULL', 'fk_image_types');
  sql_create_field('images', 'image_order', 'INT UNSIGNED NOT NULL', 'fk_comics');
  sql_create_field('images', 'upload_date', 'DATE NOT NULL', 'image_order');
  sql_create_field('images', 'is_a_preview', 'TINYINT(1) NOT NULL', 'upload_date');
  sql_create_field('images', 'is_a_template', 'TINYINT(1) NOT NULL', 'is_a_preview');
  sql_create_field('images', 'is_nsfw', 'TINYINT(1) NOT NULL', 'is_a_template');
  sql_create_field('images', 'language', 'TINYTEXT NOT NULL', 'is_nsfw');
  sql_create_field('images', 'transcript', 'TEXT NOT NULL', 'language');

  sql_create_index('images', 'images_types', 'fk_image_types');
  sql_create_index('images', 'images_comics', 'fk_comics');
  sql_create_index('images', 'images_image_order', 'image_order');
  sql_create_index('images', 'images_is_a_preview', 'is_a_preview');
  sql_create_index('images', 'images_is_a_template', 'is_a_template');
  sql_create_index('images', 'images_is_nsfw', 'is_nsfw');
  sql_create_index('images', 'images_language', 'language(10)');

  sql_update_query_id(4);
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Tags and comic tags

if($last_query < 5)
{
  sql_create_table('tags');
  sql_create_field('tags', 'sorting_order', 'INT UNSIGNED NOT NULL', 'id');
  sql_create_field('tags', 'name', 'TINYTEXT NOT NULL', 'sorting_order');
  sql_create_field('tags', 'banner_en', 'TINYTEXT NOT NULL', 'name');
  sql_create_field('tags', 'banner_fr', 'TINYTEXT NOT NULL', 'banner_en');
  sql_create_field('tags', 'title_en', 'TINYTEXT NOT NULL', 'banner_fr');
  sql_create_field('tags', 'title_fr', 'TINYTEXT NOT NULL', 'title_en');
  sql_create_field('tags', 'description_en', 'TEXT NOT NULL', 'title_fr');
  sql_create_field('tags', 'description_fr', 'TEXT NOT NULL', 'description_en');

  sql_create_table('comic_tags');
  sql_create_field('comic_tags', 'fk_tags', 'INT UNSIGNED NOT NULL', 'id');
  sql_create_field('comic_tags', 'fk_comics', 'INT UNSIGNED NOT NULL', 'fk_tags');

  sql_create_index('comic_tags', 'comic_tags_tags', 'fk_tags');
  sql_create_index('comic_tags', 'comic_tags_comics', 'fk_comics');

  sql_update_query_id(5);
}