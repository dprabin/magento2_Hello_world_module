Static files in Magento 2
=========================

Static files are more commonly known as assets in other software. These files can be any of the following:  HTML files, Javascript files, CSS, Images etc

- In magento 2, all view (user interface) related files/content (css, js, xml layout handle files, template.phtml) exist in `view` directory of a module in a well organized manner.
- In magento 2 (developer mode), static view files are generated every time (on demand when they are requested) and written to the pub/static directory.
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
- As we know static files are cacheable so off course you can find some cached view files in var/view_preprocessed directory
    - frontend: contain content/files which are related to front side (store)
    - adminhtml: contain files which are required in admin panel side of a Magento 2's project.
    - base: contain common files which can be use in both sides i.e. admin console and front side.
    - layouts:contain layout handle (xml) files
    - templates: contain template files (phtml) files
    - web: all static assets files (js, css) exist in web folder, which can be serve in a Magento's instance via http or https request.


- Location of static files 
