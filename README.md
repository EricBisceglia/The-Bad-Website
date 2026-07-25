# The Bad Website

This repository contains the source code of [The Bad Website's website](https://thebad.website).

The codebase is vanilla PHP, MySQL, JS, CSS.

No frameworks nor build steps, it's all vanilla.


## Project structure

Code logic is split in folders.

The structure is hopefully self explanatory.

| Path | Purpose |
| --- | --- |
| `actions/` | Application logic |
| `admin/` | Admin panel |
| `conf/` | Configuration files |
| `css/` | Stylesheets |
| `img/` | Images |
| `inc/` | Core functions |
| `js/` | Javascript files |
| `lang/` | Translation strings |
| `pages/` | Website content |


## Contributing

Contributions to the repository are welcome, ideally discussed on [socials](https://thebad.website/about/socials) first.

1. Create your own branch, don't wory directly on `trunk`
2. Make a pull request on GitHub from your branch, I'll take it from there
3. One PR per change please, if you are to contribute multiple changes, make multiple PRs

If you can't do the french or english translation strings, no worries, leave them empty, I'll add them myself.


## Development

There is no test suite, nor is there a linter.

Keep coding style consistent with the rest of the codebase.

Some good practices to follow:
- Sanitize all external inputs before using them
- Sanitize all database content before displaying it
- Use translation strings, don't write text directly in pages
- Modify the database schema through `admin/queries_sql.inc.php`
- After any db schema changes, update accordingly `conf/schema.sql`
- Check any CSS/layout changes on both desktop and mobile


## Security

If you discover a security issue, please report it privately.

You can contact me using [The Bad Website's socials](https://thebad.website/about/socials).


## License

The source code is distributed under the [MIT License](LICENSE.md).

This license only covers this project's source code, not the website itself.

Unless otherwise stated, comics, illustrations, and other media in this repository are © Éric Bisceglia and are not covered by the MIT License.

You are free to reuse parts or all the code for any purpose, commercial or not.

You must include this project's licence and copyright notice in any codebase that reuses its code.

Copyright © 2025-2026 Éric Bisceglia / The Bad Website / thebad.website


## Third party licenses

The Bad Website includes third-party fonts, which are not covered by the project's MIT License.

Their respective licenses are included in the project.

- [`css/fonts/LICENSE-roboto.md`](css/fonts/LICENSE-roboto.md)
- [`css/fonts/LICENSE-opensans.md`](css/fonts/LICENSE-opensans.md)


## Local installation

### Requirements

- Apache with `mod_rewrite`
- PHP >= 8.3 with `mysqli`
- MySQL or MariaDB

### 1. Grab the code

Clone the repository.

```bash
git clone https://github.com/EricBisceglia/The-Bad-Website.git
cd The-Bad-Website
```

### 2. Prepare the database

Create a MySQL or MariaDB database with the `utf8mb4` charset / `utf8mb4_unicode_ci` collation.

Create a dedicated user.

```sql
CREATE DATABASE thebadwebsite
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

CREATE USER 'thebadwebsite'@'localhost'
  IDENTIFIED BY 'your-password-goes-here';

GRANT ALL PRIVILEGES
  ON thebadwebsite.*
  TO 'thebadwebsite'@'localhost';
```

Import the database schema located at `conf/schema.sql`.

```bash
mysql -u thebadwebsite -p thebadwebsite < conf/schema.sql
```

### 3. Configure the project

Duplicate the configuration file located at `conf/main.conf.php.DEFAULT` and rename it to `conf/main.conf.php`.

```bash
cp conf/main.conf.php.DEFAULT conf/main.conf.php
```

Then edit your configuration file, which should be self explanatory.

Your local configuration file is in .gitignore thus will never be committed, no worries.

### 4. Prepare Apache

You should not need any Apache configuration other than enabling `mod_rewrite`.

Apache will need full permissions on the project directory, several pages create, move, delete files.

### 5. Protect the admin panel

If you intend to open your copy of the website to the public, you should password protect the admin area.

Setting up .htaccess and .htpasswd (or another system) in your `admin` directory is up to you.

### 6. Run database migrations

Once you have the project working, visit `admin/queries` with your browser.

```text
https://your-localhost/The-Bad-Website/admin/queries
```

This will run any missing migrations to the database schema, to make sure it is up to date.

### 6. Congratulations

Your copy of The Bad Website should now be operational.