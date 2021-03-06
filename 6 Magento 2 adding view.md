Magento 2 adding view in magento 2
==================================
- Dependency injection is a way to retrieve objects. In this process, classes reeive objects they **depend** on as **constructor arguments**. In Magento 2, the **object manager** is responsible for creating all objects a class requires.

    protected $resultPageFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ){
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

- **Dependency injection** (di) and **object manager** are complex topic.
- Note: Please do not confuse **dependency injection** with **module decency** (which usually means a module is loaded after another module)



Add view in a Module
====================
- Now our goal  is to render a string "Hello world" on a view page. So actually we are going to render **HTTP response**. In magento 2 its controller functionality tells system that "render HTTP response".

Step 1
------
- As we know in controllers there is only one **entry point** which in `execute()` method. So in execute() method we need an instance of  `Magento\Framework\View\Result\PageFactory` class, because in magento 2 `PageFactory` is class which is responsible to create page. So here we will use **Dependency Injection**. Means we have to add `__construct()` method here, how will override the `__construct()` method of controller's base class.

	<?php

	namespace Prabhu\Hello\Controller\Path;

	use Magento\Framework\App\Action\Action;
	use Magento\Framework\App\ResponseInterface;
	use Magento\Framework\App\Action\Context;
	use Magento\Framework\View\Result\PageFactory;

	class HelloWorld extends Action{

	    /**
	     * Override the parent constructor 
	     * but call parent constructor from this constructor
	     */
	    protected $pagefactory;
	    public function __construct(Context $context, PageFactory $pageFactory){
	        $this->$pagefactory=$pageFactory;
            parent::__construct($context);

	    }

		/**
		 * Dispatch request
		 * @return \Magento\Framework\Controller\ResultInterface\ResponseInterface
		 * @throws \Magento\Framework\Exception\NotFoundException.
		 */
		public function execute(){
			return $this->pagefactory->create();

		}
	}


Step 2
------
- Due to the **overriding** of `__construct()` function. Now we need call to patient's __construct() function inside current controller's **construct()** to make sure proper working of **base** class.
- So know we also have to inject `Magento\Framework\View\Result\PageFactory` class instance in our constructor due to the fact that base class's  __construct() takes this class's instance in its constructor.


Step3: Create layout xml file
-----------------------------
- Now it is time to add **layout XML** file in module. Layout XML is a tool to build pages of magento 2. Simply we can say that **Layout XML files** tells **Magento rendering system** which elements should be on a page (topology).
-There are two main stages in working with the layout XML:
    - Create the page content structure (create a logical page content structure)
    - Render the structure (generate the HTML output)
- The whole idea of the layout XML is to define the **logical** page **structure**. Once all the layout XML instructions from all the **modules** have been **processed**, the result is rendered and sent to the browser for display.
- We can find the layout XML file in this location: `app/code/[NameSpace]/[Module]/[area]/layout/*.xml`
- Structure of Layout XML file

    <?xml version="1.0" ?>
    <page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" layout="1column" xsi:noNamespaceSchemaLocation="../../../../../../../lib/internal/Magento/Framework/View/Layout/etc/page_configuration.xsd">
        <body>
            <referenceBlock name="content">
                <block 
                    template="blockContent.phtml"
                    class="Prabhu\Hello\Block\Main"
                    name="prabhu_path_HelloWorld" />
            </referenceBlock>
        </body>
    </page>

- Here,
    - Class: Class of the block object
    - Template: Template of the block
    - Name: Unique name which globally identify the name of block

- Layout Handles
    - With layout handles or update handles **Magento** view **knows** which layout XML instructions to process for a given **request**.
    - A **layout handle** is sort of like an event or notify for the **Page Layout System** certain handles **fire** on each page.
    - In our case, we created controller `HelloWorld`. We have to tell magento to take this XML file as layout. Layout handle tells Magento which layout XML instructions to process for the given request
- Page-specific action handles
    - Page-specific content is associated with a page, using the action handle specific to the request.
    - Action handles is the combination of **route**, **ActionPath** and **action name** in lower case, separated by underscore (_) e.g. `route_actionpath_action.xml`
    - In our case it will be `prabhu_path_helloworld.xml`
- Create directory structure `view\frontend\layout\` and create layout `prabhu_path_helloworld.xml` file inside that directory

    <?xml version="1.0" ?>
    <page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" layout="1column" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
        <body>
            <referenceBlock name="content">
                <block 
                    template="blockContent.phtml"
                    class="Prabhu\Hello\Block\Main"
                    name="prabhu_hello_HelloWorld" />
            </referenceBlock>
        </body>
    </page>

Step 4
------
- Now its time to create **block** class, A block is a class that calls a **template** and provides data to htat template. Blocks often instantiate **models**, which then can query **databases**, and so on. But block is a complex topic.
- Every block class extends a base class `Magento\Framework\View\Element\Template`. A block will render its **HTML** with its template properly. It is template property to **blockcontent.phtml**
- Every block class must implement `_prepareLayout()` method. Specific method `_prepareLayout()` is executed when a block is created. It is often re-declared in a specific block and contains certain init operations.
- Blocks are located inside `Block` folder of a module. In our case it will be `Prabhu/Hello/Block/BlockFile.php`
- For our case, create file `Prabhu/Hello/Block/Main.php` and put following content inside that file

    <?php

	namespace Prabhu\Hello\Block;

	use Magento\Framework\View\Element\Template

	Class Main extends Template{
		public function _prepareLayout() {
			/* */
		}
	}

- Now we need to create the template for that block. For this, we need to create a new `.phtml` file. 
- For our case create a file `Prabhu/Hello/view/frontend/templates/blockContent.phtml` and put `<b>Hello World!</b>` in the file.


- Now try to run url from browser. If there is any error, that might be because of old boilerplate files. So delete the directeor `var/generation/Hello` folder and reload. It will work.

- if the change does not reflect, you need to clear the cache.

    php bin/magento cache:clean

- It will take some time to regenrerate cache the next time your site is loaded
- If you want to disable only the full page cache, you can do

    php bin/magento cache:disable full_page

- If you are working with layout files, it is good to disable layout cache  also for some time.



Step 5
------
- Now in this step, we have to create a **template** (.phtml) file. Templates are snippets of phtml code that contain PHP elements, such as instructions, variables, and calls for class methods.
- Location: template files are located inside view folder of a module. e.g. 

    <Namespae dir>/<Module dir>/view/<area>/file.phtml

- In our case, it will be `Prabhu/Hello/view/view/blockContent.phtml`
   




