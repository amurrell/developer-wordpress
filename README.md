# DEVELOPER Wordpress

A boilerplate wordpress setup - for developers 🤯, and specifically for self-hosting wordpress.

There's strong opinion and effort to keep [wordpress installation separate](#wordpress-installation) from [custom code](#custom-code), to also version-control the [server/code-maintenance related tooling](#server-configurations), and to [organize theme files](#theme) with intention and structure. Also ships with [Local Development](#local-development) gitsubmodule, if you choose to use it.


💡 Quick Notes:

- This repository is using the [MIT License](/LICENSE-MIT).
- Neither Wordpress nor any plugins are included in this repo.
    - You download them and drop them in yourself!
- You can git clone this project at first, but then [setup your own tracking](#add-your-own-git-repository) and can [start with a fresh history](#reset-the-git-history)
    - Yay for version controlling your wordpress project!
- If you are using WP Engine, and want a boilerplate and local dev setup for that, well that's coming soon in another repo!

---

## Contents

[Installation](#installation)
- [Git Clone](#installation)
- [Add wordpress](#add-latest-wordpress)
- [Run Locally](#run-locally-with-dockerlocal)
- [Add your Repo](#add-your-own-git-repository)
- [Reset commit history](#reset-the-git-history)

[Wordpress Goods](#wordpress-goods)
- [Login](#login)
- [Download/Upgrade](#download--upgrade)
- [Automated wp-config](#wp-config)
- [php env vars](#php-env-vars)
- [Code Structure](#code-structure)
- [Detailed Wordpress Installation](#wordpress-installation)

[Plugins & Mu-Plugins](#custom-code)
- [plugins](#plugins)
- [mu-plugins](#mu-plugins)

[Theme](#theme)
- [Local Development](#local-development)
    - [DockerLocal Requirements](#dockerlocal-requirements)
    - [Setup Git Submodule](#setup-gitsubmodule)
    - [Setup Wordpress Database](#setup-database)
    - [npm install & watch](#npm-install-and-watch)
- [Server Configurations](#server-configurations)

---

## Installation

Git clone and install DockerLocal submodule for local development

```
cd <your-code-folder>

git clone git@github.com:amurrell/developer-wordpress.git <your-project-name>
cd commands
./install-gitmodules
```

---

### Add Latest Wordpress

For more detailed information about adding specific versions of wordpress or upgrading/downgrading - [read here](#wordpress-installation), but the quick setup is this:

```
cd <your-code-folder>

cd html
curl -O -L https://wordpress.org/latest.zip
unzip latest.zip
mv wordpress wp
rm latest.zip
```

---

### Run Locally with DockerLocal

✋ wait! Have you [met requirements](#dockerlocal-requirements) for DockerLocal?

```
cd <your-project-name>/DockerLocal/commands
echo "3010" > ../port
./site-up -c=my_db

# Optionally, for php-version changes
# echo "7.4" > DockerLocal/versions/override-php-version
# and run ./site-up -c=my_db again
```

- Visit your site: [http://localhost:3010](http://localhost:3010)
    - Login to wp-admin @ http://localhost:3010/wp/wp-admin
- Read for more information about [local development](#local-development)

### Start & Stop

```
# Turn off DockerLocal
cd DockerLocal/commands
./site-down

# Turn on DockerLocal
./site-up

# ssh into web container for some reason
./site-ssh -h=web

# edit DockerLocal config eg env.yml files? Restart
./site-up
```
---

### Add your own git repository

```
# Add your repo
git remote rename origin devwp
git remote add origin git@github.com:<you>/<project-name>.git
```

### Reset the git history

```
# Clear history with orphan branch
git checkout --orphan temp_branch

# add all the files
git add -A

# your initial commit message
git commit -am "The initial setup of my project, based on developer-wordpress"

# delete original branches
git branch -D master
git branch -D main

# rename your temp_branch
git branch -m main

# if you have an origin main, this will force push, with cleared history
git push -f origin main
```

[↑](#contents)

---

# Wordpress Goods

---

## Code Structure

The repo consists of some abstraction above the codebase itself, so that one could store server configurations, local development tooling, or other necessities related to maintaining the codebase itself.

### Overview

| Folder(s)            | Concept                                                                         |
|----------------------|---------------------------------------------------------------------------------|
| .vscode, .gitmodules | [Local Development](#local-development)                                         |
| html                 | [wordpress installation](#wordpress-installation) + [custom code](#custom-code) |
| conf                 | [server configurations](#server-configurations)                                 |


Here's the file structure:

```
- .vscode
    - settings.json
- conf
    - nginx
        - redirects
            - initial.conf
- html
    - wp
    - wp-content
        - themes
            - devwp
        - plugins
        - mu-plugins
        - uploads
    - index.php
    - wp-config.php
- .gitignore
- .gitmodules
```

[↑](#contents)

---

## Wordpress Installation

Pure wordpress is downloaded (whatever version you want to use) and placed into the project as folder `wp`.  Never edit any of the files in this folder.

```
- html/wp
```

The `html/index.php` and `html/wp-config.php` have already adjusted the few references needed to run wordpress at `wp` while also using `html/wp-content`.

---

### Download / Upgrade

To install your wordpress you just need to:

1. download the [zip from wordpress](https://wordpress.org/latest.zip)
2. unzip it
3. rename it to `wp` and place into `html` (replacing the existing folder)

Or, in the terminal:

```
cd html
curl -O -L https://wordpress.org/latest.zip
unzip latest.zip
mv wordpress wp
rm latest.zip
```

[↑](#contents)

---

### Login

Since we installed wordpress platform at `wp` you will login at:

```
yoursite.com/wp/wp-admin
```

### WP-config

The wordpress configuration file - often times (in other projects) is not commited to version control because it has environmental variables. This project is different.

The `html/wp-config.php` file references PHP env vars so that the file can be committed. If you still want to use a wp-config that has custom variables in it, you can put it at `conf/wp-config.php`.

### PHP env vars

- APP_WP_DB_NAME
- APP_WP_DB_USER
- APP_WP_DB_PASSWORD
- APP_WP_DB_HOST

This snippet is from `html/wp-config`

```
define('DB_NAME', getenv('APP_WP_DB_NAME'));
define('DB_USER', getenv('APP_WP_DB_USER'));
define('DB_PASSWORD', getenv('APP_WP_DB_PASSWORD'));
define('DB_HOST', getenv('APP_WP_DB_HOST'));
```

### DockerLocal Env Vars

If you need to add more variables to use - do:

First, copy `env-example.yml` which is used to generate `env-custom.yml`
```
cd <your-project>
cp DockerLocal/env-example.yml env.yml
```

We want to maintain all the stuff there, but just append your new vars:
```
env[MY_VAR]: something
env[ANOTHER_VAR]: 39fh4hjddhfj-made-up
```

Always restart DockerLocal - this will regenerate `env-custom.yml`
```
cd DockerLocal/commands
./site-up
```

[↑](#contents)

---

## Custom Code

All the custom code, files, etc that your wordpress project requires should go in `html/wp-content`.

```
- wp-content
    - themes
        - devwp
    - plugins
    - mu-plugins
    - uploads
```

Add plugins, add must-use (mu-plugins) plugins, themes, etc you want to use. Also, you may need to adjust permissions on the uploads folder.

[↑](#contents)

---

### Plugins

Copy what plugins you want to use into the `html/wp-content/plugins` folder. It's recommended to use version control and not install via wordpress admin, but do as you wish. You may need to update permissions on your folders if you plan to use wordpress admin to manage your plugin downloads.

Once you have wordpress downloaded, you can copy all the plugins, or just some:

```
cd html

# copy specific plugin
cp -R wp/wp-content/plugins/akismet wp-content/plugins/

# copy all of them?
cp -R wp/wp-content/plugins/* wp-content/plugins/
```

---

### Mu-Plugins

The `load.php` file will loop through all directories in this folder and look for load files that either match the directory name or end in `-loader.php`

Eg.

```
- mu-plugins
    - social-meta-tags
        - social-meta-tags.php
    - bylines
        - bylines-loader.php
```

[↑](#contents)

---

# Theme

Use `devwp` or you can drop in an existing theme and use your own.

The following documentation is about using the `devwp` theme, which you may want to use if you are building a site from scratch and really want a different kind of experience than is typical in wordpress development.

### Renaming

This project includes a theme, `devwp` by default.

If you want to rename this folder - and other instances of this phrasing, then:

1. Rename the folder - in your edit or terminal:

    ```
    cd html
    mv wp-content/themes/devwp wp-content/themes/yourtheme
    ```

1. Edit the comments in `style.css` to your own project.

    ```
    /*
        Theme Name: [Rename] Developer Wordpress
        Theme URI:
        Description: [Re-describe] DevWP Custom Theme
        Version: 1
        Author: You??
    */

    ```

1. Please do a search in your editor (eg. vscode) on theme files for `devwp/build` an replace references with your theme name. There should be 2 files.

1. Change in `wp-config.php` this:

    ```
    define('WP_DEFAULT_THEME', 'devwp');
    ```

1. And in `package.json` you may want to change the name:

    ```
    "name": "devwp",
    ```

### index.php

> 💡 Did you know that **the only files you need to make a wordpress theme are index.php and style.css**?

The `index.php` is used as a fallback or default to other theme files, so therefore it has to exist. The `style.css` uses comments to populate the wp-admin with theme information.

The philosophy of the devwp theme is that **if you did not code it, then the page should not render**. This means we make the index.php return a 404.

```
<?php

// force 404 for things falling back to index.
// create actual templates for everything.
// ie. front-page.php, single.php, page.php, archive.php etc

global $wp_query;

$wp_query->set_404();
status_header( 404 );
nocache_headers();
include( get_query_template( '404' ) );
die();
```

[↑](#contents)

---

### Other Folders

| Folder          | What it is for                                                            |
|-----------------|---------------------------------------------------------------------------|
| src             | All your logic & html templates                                           |
| src/controllers | We build all the $data needed for pages in here                           |
| src/templates   | html templates; PHP is only used for templating                           |
| assets/*        | We keep all img, js, css in here                                          |
| build/*         | We build for dev or for production optimized versions of what's in assets |
| lib             | We keep a library of helpful includes to put into functions.php           |
| lib/utils       | Specific helpful includes in the library are stored here.                 |

[↑](#contents)

---

## Local Development

This project ships with [DockerLocal](https://github.com/amurrell/DockerLocal) for local development in the form of a `gitmodule`.

### DockerLocal Requirements

- Linux or Mac`*`
- Bash 4+ (MacOS default 3.2.57, needs [brew install](https://github.com/amurrell/DockerLocal#update-bash-for-macos))
- Docker-engine`**`
- Docker-compose`**`
    - must downgrade to v1 (in your terminal do, `docker-compose disable-v2`)

If you are using **Docker for Mac** aka **Docker Desktop**, you just need to install that (it includes the above and downgrade docker-compose). Move docker to applications folder, and run the program. **You can skip the tutorial**.

- `*`  *(not tested w/ windows WSL; tested with ubuntu)*
- `**` *(Tested Docker Desktop - version 20.10.0, build 7287ab3)*

### Setup GitSubmodule

If you have initialized this project with git (either from git cloning or from your own tracking), then you can install the `.gitmodules`.

```
git submodule update --init --recursive
```

If you forget this code, you will see you can go to `developer-wordpress/commands` and `./install-gitmodules`

### Setup Database

To use [DockerLocal](https://github.com/amurrell/DockerLocal), you'll want to read the docs over there, but to keep things simple, all you need to do is:

```
cd DockerLocal/commands
./site-up -c=your_wp_db_name
```

Run ^ it again if you get:
```
ERROR 1045 (28000): Access denied for user 'root'@'localhost' (using password: YES)
```

For more options, like importing an existing database, or switching the PHP / Database versions [read the DockerLocal Documentation](https://github.com/amurrell/DockerLocal).


[↑](#contents)

---

### NPM install and Watch

We use `nvm` to manage the version of `nodejs` and `npm` so that we are running on the same setup. You will see `.nvmrc` files in frontend files as a result.

#### Install NVM

You will need to install nvm on your computer first.

See if you have it: `command -v nvm` - nothing? you don't.

If you are on mac or linux, run the following:

```
wget -qO- https://raw.githubusercontent.com/creationix/nvm/v0.34.0/install.sh | bash

. ~/.nvm/nvm.sh
. ~/.profile
. ~/.bashrc

export NVM_DIR="$HOME/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"  # This loads nvm
[ -s "$NVM_DIR/bash_completion" ] && \. "$NVM_DIR/bash_completion"  # This loads nvm bash_completion

command -v nvm
```

Then in your terminal, navigate to `<your-code>/developer-wordpress/html/wp-content/themes/devwp` where the `.nvmrc` file is - and run `nvm install`


### Run npm commands

#### Go to your theme folder:

```
cd <your-code>/<your-project>
cd html/wp-content/themes/devwp/
```

#### Add your desired packages: here are some suggested

```
# npm
npm install ajv animate.sass bootstrap-sass browser-sync browser-sync-webpack-plugin compass compass-sass-mixins jquery laravel-mix laravel-mix-svg sass sass-loader vue-template-compiler waypoints

# npm save dev
npm install -D tailwindcss
npx tailwindcss init
```

#### Run / Build

```
# Run dev (not watching)
npm run dev

# Run watch (will re-build, we don't have hot reload)
npm run watch

# Build Production (for commiting and pushing to origin)
npm run production
```

[↑](#contents)

---

## Server Configurations

This folder is for storing custom application or server configuations, like possible nginx redirects, or place a custom wp-config.php that you may wish not to version control.

- `conf/` - You can store a custom `conf/wp-config.php` - which is currently gitignored
- `conf/nginx` or `conf/nginx/redirects` - you could use this folder to version control necessary nginx configurations or redirects and include them in your web server setup.

Eg. Redirects

```
server {
    listen 443 ssl;
    server_name yoursite.com;
    index index.php index.html;

    ...

    include /var/www/yoursite.com/wp/current/conf/nginx/redirects/migrations/*.conf;
    include /var/www/yoursite.com/wp/current/conf/nginx/redirects/company-partners/*.conf;
    include /var/www/yoursite.com/wp/current/conf/nginx/redirects/misc/*.conf;

    ...
}
```

[↑](#contents)
