<?php


// Default batch action: move to 
CMSBatchActionHandler::register('moveto', 'CMSBatchAction_MoveTo');
CMSMenu::remove_menu_item('CMSBatchAction_MoveToController'); 


// Extras, to be moved to project config as required
// CMSBatchActionHandler::register('hidefrommenus', 'CMSBatchAction_HideFromMenus');
// CMSBatchActionHandler::register('hidefromsearch', 'CMSBatchAction_HideFromSearch');


LeftAndMain::require_javascript(basename(__DIR__) . '/javascript/LeftAndMain.BatchActionsPlus.js');
LeftAndMain::require_css(basename(__DIR__) . '/css/batchactionsplus.css');
