<?php


// To be moved to project config
// CMSBatchActionHandler::register('moveto', 'CMSBatchAction_MoveTo');
// CMSBatchActionHandler::register('hidefrommenus', 'CMSBatchAction_HideFromMenus');
// CMSBatchActionHandler::register('hidefromsearch', 'CMSBatchAction_HideFromSearch');


LeftAndMain::require_javascript(basename(__DIR__) . '/javascript/LeftAndMain.BatchActionsPlus.js');
LeftAndMain::require_css(basename(__DIR__) . '/css/batchactionsplus.css');
