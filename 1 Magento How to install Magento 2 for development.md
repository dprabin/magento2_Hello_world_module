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





 


