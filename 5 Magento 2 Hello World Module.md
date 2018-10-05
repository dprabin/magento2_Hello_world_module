Hello World Module
==================
A module is basically a package that encapsulates a business feature or a set of features.
- Magento 2 is built of modules. Its core is technically a set of modules. When a developer creates a customization, first thing to do is to create a module.
- In Magento 1, files belonging to one module were not kept within a single directory. In Magento 2, a module is now contained within a single folder.
- In Magento 2, modules have been made more granular, are better organized and their dependencies are more explicit. This facilitates building scalable and maintainable stores. Magento 2 modules ar also smaller and the functionality is grouped in a more logical manner (for example, if you are looking for a **checkout** code, you only have to look in checkout and nowhere else).


Possible file structure of a Module folder
- Api/
- Block/
- Console/
- Controller/
- etc/ *
- Helper/
- I18n/
- Model/
- Observer/
- Plugin/
- Setup/
- Test/
- Ui/
- View/
- registration.php *
- composer.json

Among these, only `etc` folder and `registration.php` files are required. All other files or folders are optional and depend upon the functionality or business logic of a module. It is not very strict in structure; a developer can create any other folder as per need.

---

## Step 1

- In Magento 2, modules are grouped by vendors. So first of all 
    - create a **vendor or namespace** folder inside `app/code` and then 
    - inside it create a **module** folder. Regardless of your installation type.
- In our case, we will create Hello module inside the vendor Prabhu
    - Prabhu
        - Hello


## Step 2

- In magento 2, modules are named <Vendor>_<Module>. Module names are case sensitive
    - For an example **Magento_Catalog**.
	    - Magento = vendor name or namespace
	    - Catalog = module name
	- `Prabhu_Hello`
	    - Prabhu = vendor name or namespace
	    - Hello = module name
- Create `etc` folder in your module and create `module.xml` file inside it. Note that these are case sensitive
- The `module.xml` is very important and required file, actually you can say that it defines a module. The `module.xml contains` three pieces of information.
    - The module name
    - Version
    - Dependencies 
- Create following directory structure
    - app
        - code
            - Prabhu
                - Hello
                    - etc
                        - module.xml
                    - 
- Example of `module.xml` file inside checkout module

    <config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Module/etc/module.xsd">
        <module name="Magento_Checkout" setup_version="2.3.4">
            <sequence>
                <module name="Magento_Eav" />
                <module name="Magento_Cms" />
                <module name="Magento_Indexer" />
                <module name="Magento_Customer" />
            </sequence>
        </module>
    </config>

- The entries inside sequence are the dependencies for this module.
- Our `module.xml` file

    <?xml version="1.0" ?>
    <config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="../../../../../lib/internal/Magento/Module/etc/module.xsd">
        <module name="Prabhu_Hello" setup_version="0.0.1">
        </module>
    </config>

- We don't have any dependencies for our module, so there is no sequence node.


## Step 3

- Create `registration.php` file inside module's folder. It contains instructions on how to find a module.
- Following is the pattern of `registration.php` file

    \Magento\Framework\Component\ComponentRegistrar::register(\Magento\Framework\Component\ComponentRegistrar::MODULE, 'Prabhu_Hello', __DIR__);

- The only thing you have to change here is the module name.


## Step 4

- Now we have to write `controller` or  `action` class. Controller is the part of "MVC" design pattern. But here, its functionality is different because Magento do not follow or implement standard MVC.
- Controllers live inside `Controller` directory of a module e.g.
    - `<Module>/Controller/<ActionPath>/ControllerClass`
- Every controller extends `Magento\Framework\App\Action\Action` class
- Every controller has to have an `execute()` method. `execute()` method actually process a URL. Every time a user hits a link, the `execute` method will take over.
- For an example, lets create a folder named `Controller` inside `Prabhu` module directory. Let use create another directory named `Path` for ActionPath
- The Controller directory and ActionPath directory start with uppercase while etc start with lowercase
- Lets create a new file inside this. The name of our controller will be `HelloWorld.php`.

    <?php

    namespace Prabhu\Hello\Controller\Path;

    use Magento\Framework\App\Action\Action;
    use Magento\Framework\App\ResponseInterface;

    class HelloWorld extends Action{

    	/**
    	 * Dispatch request
    	 *
    	 * @return \Magento\Framework\Controller\ResultInterface\ResponseInterface
    	 * @throws \Magento\Framework\Exception\NotFoundException
    	 */

    	public function execute(){
    		//TODO: Implement execute() method
    		echo "Hello World";

    	}
    } 


## Step 5

- Now you have to set up a `url route` for your module. So to define a route for your module, you have to create `route.xml` (Which is a configuration file so it will live inside etc folder) here we are going to define route for frontend `area` so `routes.xml` will be located in frontend subfolder. E.g. `Prabhu/etc/frontend/routes.xml`
- routes.xml file demonstrate three things
    - id of the router
    - frontname
    - Module name
- For an example

	<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:App/etc/routes.xsd">
		<router id="standard">
			<route id="prabhu" frontName="prabhu">
				<module name="Prabhu_Hello" />
			</route>
		</router>
	</config>

- Here, the id attribute of **router** is **standard** because we are going to define route for frontend. It will be **id = admin** if we are setting up URL for admin panel.
- Here, the id attribute of the **route** node uniquely identifies this node across all magento 2 modules installed in the system. In most time the value of **id** and **frontName** is same
- **frontName** is most important part here which tells magento that the module is registered to process the URLs that starts with **prabhu**
- Every URL that starts with prabhu, this module will handle that link


## Step 8

- Enable the module via command prompt
    - use `php bin.magento module:status` to check the status of all module which are installed in the system
    - use `php bin/magento module:enable:Prabhu_Hello` to enable your module
- You can also use admin panel to enable modules


## Step 9

- Run command `php bin/magento setup:upgrade`
- You have to run this to upgrade your module version in magento's database schema.
- Database table `setup_module` contains all information about all modules and their status


## Step 10

- Run/test your module
- In Magento 2 an url composed of `<magento dir>/frontName/actionPath/Action`
- So in our case, to test the module, type following in addressbar
    - `http://localhost/ecommerce.com/prabhu/path/HelloWorld`
- Here
    - ecomerce.com: magento installation directory
    - prabhu: frontName of the module
    - path: ActionPath connected to the Controller folder
    - helloWorld: php class of action or controller
- We have to write view component for displaying proper output 
