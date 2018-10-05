Magento 2 Architecture
======================

1. Magento 2 Modular System
2. Areas
3. Themes
4. Layout files
5. Merged config files
6. Object Instantiation "magic"
7. Events and plugins

---

Magento 2 is a Modular System
-----------------------------
- Magento 2 is a **modular** system. It means that in magento 2, every functionality or business logic is designed and developed in form of **modules**. It provides more independency. Every module can work as an stand alone unit and it has minimum dependencies of other modules.
- A module is basically a package that encapsulate a business feature or a set of features.
    - Magento 2 modules are smaller and the functionality is grouped in a more logical manner (for example, if you are looking for a checkout code, you only have to look in checkout folder and nowhere else)
    - **Modules** are located under `app/code` or `vendor` directory of your magento 2 installation
        - `app/code/<module_name>`
        - `vendor/vendor-composer-namespace/<module_name>`
    - With modules developers can define new business features, or customizations to existing ones, they can also define a default user interface for those features, which are customizable by theme

---

Areas in Magento2
-----------------
An area is a scope in the configuration that allows:
- To load only the configuration files and options that are required for a specific request
- Only the config options for that are loaded
- Typically have both behavior and view components
- Magento 2 technically have 6 areas
    - Frontend
    - Adminhtml
    - Crontab
    - REST web api
    - SOUP web api
- Developers will primarily interact with only two areas **Adminhtml** and frontend
- E.g. Let us take an example of catalog folder 
    - There is a user who wants to know details about the prodocts. 
    - The etc inside the `catalog` folder contains all configuration related fields. 
    - This contains subfolders like `adminhtml`, `frontend`, `webapi_rest`, `webapi_soap` etc. 
    - All the files related to frontend is located inside `frontend` folder. 
    - These config files are loaded when the user requests to see products from frontend. 
    - Other files are not loaded. So this will make input file 
- A module can contain files for one or more of the areas

---

Theme in Magento 2
------------------
- Themes are a set of files that define how a website will look.
- Themes include all types of static assets, and are deeply connected to the magento 2 rendering system.
- Some **Static files** like CSS and JavaScript files are located in the module folder, while others are in a theme location
    - `app/design/<area>/<theme_name>` or
    - `vendor/magento/theme-frontend|adminhtml-*`
- It is important to understand that while `PHP` code is mostly located in modules, `generic` static assets are organized in themes
- The components that are related to all modules are located in theme folder, which can be accessed by all modules. The components that are module specific, they are stored in view folder inside the modules directory.

---

Layout files in Magento 2
-------------------------
- Layout is an essential concept in Magento 2 rendering system. It is a set of **XML Files** that define which elements should be on a page (topology).
- Layout configuration defines which blocks should be present on a page and the block hierarchy.
- **Block** is a special PHP class in Magento 2. It is usually connected (but not always) to a template. Each block's generated HTML together comprises with the whole page. So a block class generates a piece of HTML (using its template), and layout defines which blocks should be included on the page.
- Layouts are highly configurable and extendable. You can create layout updates in your module to modify any existing page or create a new layout for a new page.
- There are three folders in `app/code/<Namespace>/<themename>/view` - `adminhtml`, `base`, `frontend`. The `adminhtml` contains all files related to `adminhtml` and so on. `base` contains all files that are used in all areas.
    - Inside these folders, you can find `layout folder`
    - It contains all xml layout files. IT defines layout of a template or html files
    - It defines which block should be present on a page and the block heirarchy
    - Each block generates the piece of html that are part of the whole page using its template, and layout defines which block is included and where it is included in a page. 
    - Layout location is `app/code/<Namespace>/<themename>/view/<area>/layout/`
    - Blocks file location is `app/code/<Namespace>/<themename>/block`

    <page xmlns:xsl="http://www.w3.org/2001/XMLSchema-instance" layout="2columns-left" xsi:noNamespaceSchemaLocation="....." ...>
      <body>
        <attribute name="class" value="account" />
        <referenceContainer name='sidebar.main'>
           <block class="Magento\Framework\View\Element\Template" template="Magento_theme::html/collapsible.phtml" bef...>
              <arguments>
                <argument name="block_css" xsi:type="string">account-nav</argument
              </arguments>
              <block ...>...</block>
              <block ...>...</block>
              ...
           </block>
        </referenceContainer>
      </body>
    </page>

---

Merged config files in Magento 2
--------------------------------
- In Magento 2, there are several types of configuration files - for example `events.xml`, `routes.xml`,`acl.xml` and more in etc folder of individual modules
- Those files are distibruted across different modules. Each module can have its own set of standard config files
- When a certain type of information is requested by an application (like a list of available routes), Magento merges all config files of a certain type (example: `routes.xml`) and derives information from there.

---

Object Initiation **Magic** in magento 2
----------------------------
- Object initiation `magic` or dependency injection (DI), is a Magento 2 feature. When you need a new object, you declare it (or its interface) in the constructor, and magento will deliver an instance

---

Events and plugins
------------------
- Events and plugins are two major **customization** techniques in Magento 2. Events are fired in the core code, and developers can add observers to that event.
- Each event has parameters, so a developer can use or even modify them.
- Plugin technology allows developers to add specific behavior to every public method of each class. This is very powerful tool.
- For an example if you want to add behaviour in function, you can change its parameter or change its return type with plugins

---

High level elements of magento
------------------------------
These are high-level elements of Magento with which every developer will interact.
- Configuration
	- Location: `app/etc/`
	- Description: Configuration refers to the general configuration for an instance. It is not the same as module configuration. General configuration defines which modules are available, The database credentials, and more. Module-specific configuration defines the behavior of a module
	- There is local configuration located in each module folder, and global configuration at `app/etc/`
	- e.g. `app/etc/config.php` which contains configurations about which modules are available, activated, deactivated
	- `app/etc/env.php` contains all information about database connection, 
	- `app/etc/di.xml` contains information about dependency injection.
- Framework
    - Location: `lib/internal/Magento/Framework` or
    - `vendor/magento/framework`
    Description: Framework is low-level code, not related to features and business logic. Framework defines how the whole system works - for example, interaction with databases, URL processing, logging, and remote request tools.
- Dev
    - Location: `dev/`
    - Description: Dev tools include scripts and tools that assist a magento developer (for an example, a testing framework would be located here)
