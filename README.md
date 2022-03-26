# DEVELOPER Wordpress

A boilerplate wordpress setup - for developers, and specifically for self-hosting wordpress.

There's strong opinion and effort to keep [wordpress installation seperate](#wordpress-installation) from [custom code](#custom-code), to also version-control the [server/code-maintenance related tooling](#server-configurations), and to [organize theme files](#theme) with intention and structure. Also ships with [Local Development](#local-development) gitsubmodule, if you choose to use it.


Quick Notes:

- This repository is using the [MIT License](/LICENSE-MIT).
- Neither Wordpress nor any plugins are included in this repo.
    - You download them and drop them in yourself!
- You don't git clone this project
    - You download the zip and use git init with your own repository. Yay for version controlling your wordpress project!
- If you are using WP-ENGINE, and want a boilerplate and local dev setup for that, well that's coming soon in another repo!

---

## Contents

- [Installation](#installation)
    - [Login](#login)
    - [Download/Upgrade](#download--upgrade)
    - [wp-config](#wp-config)
    - [php env vars](#php-env-vars)
- [Code Structure](#code-structure)
- [Wordpress Installation](#wordpress-installation)
- [Custom Code](#custom-code)
    - [plugins](#plugins)
    - [mu-plugins](#mu-plugins)
    - [theme](#theme)
- [Local Developement](#local-development)
- [Server Configurations](#server-configurations)

---

## Installation

Since this is a boilerplate to your own project, I recommend getting these files **as a zip** *instead of via git clone*.

To save you time, here's a terminal command using curl to download the github zip file. Be in the directory you want your project to be in.

```
curl -L -O https://github.com/amurrell/developer-wordpress/archive/refs/heads/main.zip && tar -xzf main.zip && mv developer-wordpress-main devwp && rm main.zip
```

Then you can `git init` with **your own repository and version control**.

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

---

## Wordpress Installation

Pure wordpress is downloaded (whatever version you want to use) and placed into the project as folder `wp`.  Never edit any of the files in this folder.

```
- html/wp
```

The `html/index.php` and `html/wp-config.php` have already adjusted the few references needed to run wordpress at `wp` while also using `html/wp-content`.

### Download / Upgrade

To install your wordpress you just need to:

1. download the [zip from wordpress](https://wordpress.org/latest.zip)
2. unzip it
3. rename it to `wp` and place into `html` (replacing the existing folder)

Or, in the terminal:

```
cd html
curl -O -L https://wordpress.org/latest.zip
&& unzip latest.zip
&& mv wordpress wp
&& rm latest.zip
```

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


### Plugins

Copy what plugins you want to use into the `html/wp-content/plugins` folder. It's recommended to use version control and not install via wordpress admin, but do as you wish. You may need to update permissions on your folders if you plan to use wordpress admin to manage your plugin downloads.

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

---

## Theme

Use `devwp` or you can drop in an existing theme and use your own.

The following documentation is about using the `devwp` theme, which you may want to use if you are building a site from scratch and really want a different kind of experience than is typical in wordpress development.

### Renaming

This project includes a theme, `devwp` which you can rename and edit the comments in `style.css` to your own project. If you do this, please do a search on theme files for `devwp/build` an replace references with your theme name.

### index.php

> 💡 Did you know that **the only files you need to make a wordpress theme are index.php and style.css**?

The `index.php` is used as a fallback or default to other theme files, so therefore it has to exist. The `style.css` uses comments to populate the wp-admin with theme information.

The philosophy of the devwp theme is that **if you did not code it, then the page should not render**. This means we make the index.php return a 404.

---

## Local Development

This project ships with [DockerLocal](https://github.com/amurrell/DockerLocal) for local development in the form of a `gitmodule`.

### Requirements

If you have initialized this project with git (either from git cloning or from your own tracking), then you can install the `.gitmodules`.

```
git submodule update --init --recursive
```

If you forget this code, you will see you can go to `developer-wordpress/commands` and `./install-gitmodules`

To use [DockerLocal](https://github.com/amurrell/DockerLocal), you'll want to read the docs over there, but to keep things simple, all you need to do is:

```
cd DockerLocal/commands
./site-up -c=your_wp_db_name
```

For more options, like importing an existing database, or switching the PHP / Database versions [read the DockerLocal Documentation](https://github.com/amurrell/DockerLocal).

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
