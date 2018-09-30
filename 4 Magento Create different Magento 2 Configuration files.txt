Create different Magento 2 Configuration files
==============================================

app/code/Magento/Namespace/ExtensionName

- Namespace 
	- Extension name
		- Block
		- Controller
		- etc
		    - frontend
		    - module.xml
		- view
		- registration.php


## ExtensionName/registration.php

	<?php
	*/ Copyright Author name */

	\Magento\Framework\Component\ComponentRegistrar::register(\Magento\Framework\Component\ComponentRegistrar::MODULE,'Namespace_ExtensionName', __DIR__);



## ExtensionName/etc/module.xml

	<?xml version="1.0" ?>
	<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="../../../../../lib/internal/Magento/Framework/Module/etc/module.xsd">
	    <module name="Namespace_ExtensionName" setup_version="0.0.1">
	</config>


## Create a New Module named test
- Create the new directory structure
    - Prabin/Test/etc
        - Prabin: Namespace
        - Test: Module name
        - etc: settings directory inside module
        
- Create `Test/registration.php` file inside `Prabin/`

	<?php
	*/ Copyright Author name */

	\Magento\Framework\Component\ComponentRegistrar::register(\Magento\Framework\Component\ComponentRegistrar::MODULE,'Prabin_Test', __DIR__);

- Create `Test/etc/module.xml` file inside namespace `Prabin/`

	<?xml version="1.0" ?>
	<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="../../../../../lib/internal/Magento/Framework/Module/etc/module.xsd">
	    <module name="Prabin_Test" setup_version="1.4.1">
	</config>




