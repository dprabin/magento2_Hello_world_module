Static files in Magento 2
=========================

Static files are more commonly known as assets in other software. These files can be any of the following:  HTML files, Javascript files, CSS, Images etc

- In magento 2, all view (user interface) related files/content (css, js, xml layout handle files, template.phtml) exist in `view` directory of a module in a well organized manner.
- In magento 2 (developer mode), static view files are generated every time (on demand when they are requested) and written to the pub/static directory.
- As we know static files are cacheable so off course you can find some cached view files in var/view_preprocessed directory
    - frontend: contain content/files which are related to front side (store)
    - adminhtml: contain files which are required in admin panel side of a Magento 2's project.
    - base: contain common files which can be use in both sides i.e. admin console and front side.
    - layouts:contain layout handle (xml) files
    - templates: contain template files (phtml) files
    - web: all static assets files (js, css) exist in web folder, which can be serve in a Magento's instance via http or https request.
- Most common static file directories
- view
    - frontend
        - layout
        - templates
        - Web
        - ...
    - base
        - layout
        - templates
        - Web
        - ...
    - adminhtml
        - layout
        - templates
        - Web

How to add a static file in magento 2
-----
- Navigate to the module directory 
    - `app/code/<namespace>/<moduleName>/view/<area>/web/*`
    - * are optional folder like (js, css, or any other if required). but basically all static files are in this web directory 
- In our module, we have 
    - Module
        - view
            - layout
            - template
- let's add a new directory in view directory
    - Module
        - view
            - layout
            - template
            - web
                - css
                    - hello.css
                        - `b{ font-size:60px;`
                        - `    color: #336699;}`
                - js
                    - hello.js
                        - `alert("Hello World")`

- Now it is time to add a link (http/https) of created file in four Magento module.
	- first of all, like a typical html page lets try to add head section in our page, open related layout xml file. i.e. `layout/prabhu/prabhu_path_helloworld.xml`. and add head section
	- In case of js file <link src="<namespace_module>::<folder>/<file>.js" />
	    - <namespace_module> = name of vendor and module separated by underscore " _ ". - Prabhu_HelloWorld
	    - <folder> = name of any folder if exist which contains static file - js, or css or any other
	    - <file> = Name of file
    - In case of css use css tag instead of link - <css src="<namespace_module>::<folder>/<file>.css">
- Clean cache: `php bin/magento cache:clean`
- These files go into pub directory in magento folder

Generation of file in pub directory. 
----
- In page source you can see the http or https link of our static file. The link of our file is something like that
    - http://localhost/ecomsite.com/pub/static/version34234/frontend/Magento/luma/en_US/Prabhu_Hello/js/funky.js
- Now lets try to take a deeper link on this file's URL.
- Pub is the main public directory
- ecomsite.com is the magento installation root directory
- static: is a sub directory inside pub where all static assets can be taken from themes and modules, so they can serve on browser via http
- versionxxxxxx is not actually a sub directory. It is current deployed version of generated file.
- frontend: is a directory that contain assets related to front side, adminhtml contains assets related to console.
- Magento is the name of active theme's vendor or namespace
- luma: name of the active theme
- en_US: contains english US version of assets, as magento supports internationalization
- Prabhu_Hello: is namespace_module
- js/hello.js: is subdirectory js with asset hello.js file

- With this, we can find the location of a module's static file inside pub directory. So location of static file will be
	- `<magento root>/pub/static/<area>/<theme's namespace>/<theme name>/internationalization/<module's Namespace_module>/<any direcotry containing asset>/file.*`

- Magento (all modes) take static content from different themes and odules and place them inside pub directory to make them public and accessible in browser. In magento 2 there are two assets materalization trategies
    - copy
    - symlink or symbolic link
- the first strategy is copy. It takes files from source and make a duplicate of them in pub folder
- Second strategy is Symlink, which is similar to shortcut in windows. It takes a file from source and create a soft link of that inside pub direcotyr
- Magento framework class: `Magento\Framework\App\StaticResource` is responsible to generate static files.
    - Asset materialization strategy can be defined in global configuration file `app/etc/di.xml` by setting the arguments of mentioned glass

- Let's look at materalization strategy. Go to `app/etc/di.xml`
- find `argument name=materalizationStrategyFactory` or 
- `<item name=viewpreprocessed xsi:type="object"> Magento\Framework\App\View\Asset\MaterializationStrategy\Copy </item>`
- 

    <argument name="strategiesList" xsi:type="array">
    	<item name=viewpreprocessed xsi:type="object"> Magento\Framework\App\View\Asset\MaterializationStrategy\Symlink</item>
        <item ...></item>
    </argument>

- This will create symlink instead of copying whole file in linux platform. In windows platform, it will generate error  if not run with administrator previllege. so revert that to copy
- Now clean the cache
- the directory `var/generation` contains boilerplate classes. 


















