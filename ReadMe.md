#############################################################
Framework: ezAppFramework_v1.3
Architecture: MVC
Language: PHP 5.6
Version: v1.3
Released Date: 20 - 01 - 2018 
Developer: Sarpong Abdul-Rahman D. for Rasarp Multimedia Inc.
Country: Ghana.
Contact: +233271957502/+233269063879
Email  : rasarpmultimedia@gmail.com
License :GPL v3.0 Open Source License
#############################################################

ezAppFramework is a Rapid Application Development (RAD) framework developed in PHP implementing MVC architecture and has many build-in libraries to make web development easier and faster.

Directory Structure 

+ modules - main framework diretory were core components are found  
	- _config – contains database configuration ini file change setting to configure databases and other settings.

    - _core – contains main framework core class library scripts

    - _lib – contains all auxiliary class library scripts for web application development

    - _components – contains auxiliary scripts such as helper classes for web development, keep all your additional helper classes here.
	
+ _templates – contains main and site wide css, html and scripts -boiler templates for web development, create all site wide boiler templates here, sample templates provided for guidance.

+  vendor  - contains scripts from third parties vendors libraries  and plugins
    
+ app – applications main directory for website, web applications etc.

	+	_multimedia – contains media uploaded like pictures, videos, audio files for website
	
 	-	_webroot – contains main website files and assets or public website scripts 
    	-   _jsondata – contains JSON data for websites
    	-	controller – controller directory  keep all frontend controller files here
    	-	model – model directory keep all frontend model files here
    	-	view – view directory keep all frontend view files here.
		
	+   _log – contains error log text files.

+	includes – contains directory path setting, initiations files and other sever side includes

+	schema – contains sample database dump files and SQL scripts for database creation.

Change Logs
PHP Namespace Added


