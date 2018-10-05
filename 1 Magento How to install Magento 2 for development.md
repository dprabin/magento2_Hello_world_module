How to install Magento 2
========================

Magento 2 is a Robust, lengthy and complex product, and it requires many hours of dedicated practie to become proficient in its development.

## Prerequisites:
- Working Knowledge of PHP
- Concepts of Object Oriented Programming
- Knowledge of MVC design pattern
- Zend Framework (Optional)

### Requirements
- PHP 5.6 or higher
- Apache 2.2 or higher
- MySQL 5.6 or higher
- A text Editor
- Composer
    - https://getcomposer.org/download
    - https://en.wikipedia.org/wiki/Composer_(Software)

### Example
- Windows 10
- Xampp (with PHP 5.6 or PHP 7.0)
    - https://www.apachefriends.org/download.html
- PhpStorm


## Process
### Download magento 2 Community Edition
1. composer create-project --repository-url=https://repo.magento.com/ magento/project-community-edition [Project-name]
2. https://github.com/magento/magento2
    - Click Clone or download
    - Move  to htdocs folder
    - Extract the package and rename to magento 2 project. e.g. htdocs/estore.com
    - Install dependencies with composer
        - Open command prompt - Shift + Rt. Click and command prompt
        - Your current directory should be the project folder.
        - Composer install
        - If command prompt give any warning after this command like inlt or xsl extension is missing, dont panic. Xampp already ship with these extensions. You just need to enable them. For this purpose, just navigate to php.ini file in xampp (xampp/php/php.ini) find required extension and uncomment them.
        - Now run the magento from browser
3. Note: there is a slight folder structure change

### Installing Magento 2
- Go to the browser and point to your magento installation. e.g. localhost/estore.com
- Agree terms and conditions by clicking **Agree and Setup magento**
- Click **Start Readiness Check** and Click next.
    - If there are any errors, you can go to rectify the errors by doing what it requests
    - Enable/install entensions, Change file permisions etc.
- Now add a database information and click next
    - First create new database from phpmyadmin. It is better to create a new user and grant permission to this user for the database. rather than using root.
    - Database Server Host: Localhost
    - Database Server Username: root
    - Database Server Password: ********
    - Database Name: magento_estore_com
    - Table Prefix: 
- Web configuration and click next
    - Store Address: http://localhost/estore.com
    - Magento Admin Address: http://localhost/estore.com/admin
    - Put hard to guess admin address e.g. p3qs34dr to make it more secure 
- Create Admin Account
    - New username: ram
    - New email: ram@chandra.com
    - New Password: ***
    - Confirm Password: ***
- Click install now.
    - It will take some time to install. 
    - After success page opens, copy the information for your future reference
- Open the site. You are ready to go
- If the images don't show up
    - Open the project in phpEditor e.g. phpstorm
    - go to app/etc/di.xml
    - In line 609 change the line `<item name="view_preprocessed" xsi:type="object">Magento\Framework\App\View\Asset\MateralizationStrategy\Symlink</item>` to `<item name="view_preprocessed" xsi:type="object">Magento\Framework\App\View\Asset\MateralizationStrategy\Copy</item>`


---
---
---

Sample data in Magento 2
========================
Magento sample data includes a sample store, complete with more than 250 products of which about 200 are configurable products, categories, promotional price rules, CMS pages, banners, and so on. Sample data uses the Luma theme on the storefront.

Step 1
------
- Download latest magento 2 from github.com from following link and unzip it inside htdocs directory of xampp: `https://github.com/magento/magento2` and install.

Step 2
------
- Download latest magento 2 sample data from github.com from following link and unzip inside htdocs directory of xampp `https://github.com/magento/magento2-sample-data`
- You should download same version of sample data as that of magento 2

Step 3
------
Open terminal and navigate to `../dev/tools` directory of sample data directory

Step 4
------
- Type following command
`php -f build-sample-data.php -- --ce-source="<magento ce install dir>"`
- In our case, we have installed magento 2 in ecomsite.com so command will be
`php -f build-sample-data.php -- --ce-source="../../../ecomsite.com"`
- Note: Run xampp and terminal/command prompt as administrator in windows because above command will create symlinks between sample files and magento. And windows symlinks cannot be created without administrator mode.

Step 5
------
- Update database schema
`php bin/magento setup:upgrade`
- It will take some time to complete whole database upgrade. so be patient

Step 6
------
Clean cache and reload the site in browser. It will show sample products. Now you can finally use your module to test after regular products



---
---
---



Command Line Interface and Command line tool
============================================

- Magento has command-line interface, that performs both installatin and configuration tasks
    - Install Magento
    - Clear Cache
    - Magento Indexes
    - Generate non-existent classes
    - Deploy static view files; Clear static files (to comply with static file fallback rules)
- Location: <Magento installation dir>/bin/magento

---

## To run the command line

- Open terminal or cmd in windows
- To List all available installation nd configuration commands, use the command
    - `php bin/magento list`  
- To list all available modules  and their status, use the command
    - `php bin/magento module:status`
- To find detail/helps about a command and its options, use the command
    - `php bin/magento help:module:status`
    - `php bin/magento module:status --help`
- Enable Developer Mode
    - `bin/magento deploy:mode:show`
    - `bin/magento d:m:set developer`
    - `bin/magento cache:disable config`
    - `bin/magento cache:flush config`
- Sample Data
    - `bin/magento sampledata:deploy`
    - `bin/magento setup:upgrade`

---

## Cache management
A file on a local hard drive which contains temporary information that a program sets aside because it assumes you'll want to use it soon. Doing this allows the software to load the information faster than it would take to find the original data.

### Why cache
Speed is an extremely important factor for an e-commerce business, it is a ranking factor and a factor that influences bounce rates and conversions, as well as user's intentions to visit the site in the future.

### Cache in Magento 2
Magento is really fast platform. There are many methods like server upgrades, and other, but caching is the most important for sepeed. It gets information from many sources like configuration files, database queries and make the cache after processing them. So it uses cache.
- Magento use many methods to make to its store fast one of them caching
- Magento cache library for Magento-Specific caching
    - If you downloaded magento from github Location: <Magento install directory>/lib/internal/Magento/Framework/Cache
    - If you got magento from composer, Location: <Magento install directory>/vendor/magento/framework/Cache

### How cache files are managed
-  Based on the functional role Magento divide cache files into different types/groups. It is unilikely that you will want to change these settings or types, but if you do want to create a custom mechanism, the basic default list of cache types is located in: 
    - `app/etc/env.php`
- The benefits with this approach operation are like cleaning, enabling or disabling limited to the specific cache type
- Cache can be managed via admin panel's **Cache Management Page** or via command prompt
    - `php bin/magento cache:command_name [options]`

#### Cache types in Magento 2
- app/etc/env.php

    array(
        'config' => 1,
        'layout' => 1,
        'block_html' => 1,
        'collections' => 1,
        'reflection' => 1,
        'db_dd1' => 1,
        'eav' => 1,
        'customer_notification' => 1,
        'full_page' => 1
        'config_integration' => 1,
        'config_integration_api' => 1,
        'translate' => 1,
        'config_webservice' => 1,
    )

- Config: Magento collects configuration from all modules, merges it, and saves the merged result to the cache. This cache also contains store-specific settings stored in the file system and database.
- Layout: Compiled page layouts(That is, the layout components from all components)
- block_html: HTML page fragments per block
- Collections: Results of database queries
- db_ddl: Database schema
- full_page: Generated HTML pages

#### Cache files created by magento
The cache files created by magento is inside the directory `var/cache/`

### Cache cleaning in Magento 2
Cache cleaning is important as we can't see the impact of changes that we made until we do not clean cache. There are 3 options for cleaning cache. It is preferable to clean the cache via the backend or the command-line tool because these processes throughly clean the cache, even if a non-default cache storate is configured.

#### From command prompt
If we don't supply the cache type, it will clean all cache types. In following code, however, it will clear config cache.

    php bin/magento cache:clean config

#### From backend website (Admin panel)
Go to System > Cache management, then select the cache types and click refresh, enable or disable and click apply

#### By manually removing the cache directory
Delete the files inside `var/cache/` directory

---

## Development Modes in Magento 2
There are **three primary development** modes available in Magento 2. One of the biggest differences between the modes is how **static view files** get served. Static view files are CSS files, JavaScript, and images from modules that have to be processed before they can be delivered to a browser.
- Developmer
- Production
- Default
- There is also a **maintenance** mode, but that operates in a different way. Only to prevent access to the system, while updating or upgrading software


### Developer Mode
You should use the Developer mode while develipment
- The main benefit to this mode is that error messages are visible to you.
- In this mode, static view files are generated every time they are requested. They are written to the `pub/static` directory.
- In this mode **static file cache** is not used. This has a big performance impact, but any changes a developer makes to  view files are immediately visible
- Uncaught exceptions are displayed in the browser, rather than being logged. An exception is thrown whenever an event subscriber cannot be invoked.
- System logging in var/report is highly detailed in this mode.


### Production Mode
- You should run magento in Production mode once it is deployed to a production server
- Production mode provides the highest performance in Magento 2. THe most important aspect of this mode is that errors are logged to the file system **var/log ** and are never displayed to the user.
- In this mode, **Static view files** are not created on the fly when they are requested. instead, they have to be deployed to the **pub/static** directory using the command-line tool. The generated pages will contain direct links to the deployed page resources
- Any changes to view files require running the deploy tool again


### Default mode
As the name implies, default mode is how the Magento software operates if no other mode is specified
- In this mode, errors are logged to files in `var/reports` and are never shown to the user. Static view files are materialized on the fly and then cached.
- In contrast to the developer mode, view file changes are not visible until the generated static view files are cleared
- Default mode is not optimized for a production environment, primarily because of the adverse performance impact of static files being maintained on the fly rather than generating and deploying them beforehand

|   | Static file caching | Exception displayed | Exception logging | Performance (-) impact |
|------------|---|---|---|---|
| Developer  |   | * |   | * |
| Production |   |   | * |   |
| Default    | * |   | * | * |

### Switch development modes
- If you have private server environment the easiest way to switch between different development modes is via command-line
- You can view current mode via command:
    - `php bin/magento deploy: nide:show`
- You can switch between modes via command:
    - `php bin/magento deploy:mode:set {mode}` 
- Note: You cannot currently change from either Developer or production mode to default

- In other cases there are 2 ways
- Use the system environment variable MAGE_MODE in .htaccess file such as: `SetEnv MAGE_MODE=[developer|default|production]`
- If above does not work you aan use web server or `php-fpm` environment, however in case no any problem refer to the related documentation.


 


