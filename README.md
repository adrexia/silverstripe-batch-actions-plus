#Silverstripe Batch Actions Plus
Extra batch actions for SilverStripe CMS's sitetree

##Available Actions
* Move to...
* Remove from Search 
* Remove from Menus 


##Setup
1. Composer install (https://packagist.org/packages/adrexia/batchactionsplus), or clone into your repo.
2. Include the extensions you would like in _config.php and run dev/build (Move to is included by default)

*mysite/_config.php*
	
	CMSBatchActionHandler::register('hidefrommenus', 'CMSBatchAction_HideFromMenus'); 
	CMSBatchActionHandler::register('hidefromsearch', 'CMSBatchAction_HideFromSearch'); 
	
