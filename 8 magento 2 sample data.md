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





