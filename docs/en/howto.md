#How to make your own batch actions
##Simple (select and click Go) batch actions:
You can add single stage batch actions by adding a class that extends CMSBatchAction. 

For example, code/CMSBatchAction_HideFromMenus.php:
 
```
CMSBatchAction_HideFromMenus extends CMSBatchAction {

	// Returns the name of the action for the menu
	public function getActionTitle(){
		return _t('CMSBatchActions.HIDESEARCH', 'Hide from search');
	}

	// Gets called when the user selects a set of pages and hits Go
	public function run(SS_List $pages) {

		$status = array(
			'modified'=>array()
		);

		foreach($pages as $page) {
			$id = $page->ID;

			// Perform the action
			$page->ShowInSearch = 0;
			$page->write();

			$status['modified'][$id] = array(
				'TreeTitle' => $page->TreeTitle
			);
		}

		return $this->response(_t('CMSBatchActions.HIDDENSEARCH', 'Hidden from search'), $status);
	}

	// Not sure why this is necessary, looks like a safety check
	public function applicablePages($ids) {
		return $this->applicablePagesHelper($ids, 'canEdit', false, true);
	}

}
```

In this batch action, we iterate over each selected page and set the ShowInSearch attribute, save it, and return a success response. 

You will also need to register this class with the CMS, do this by adding a line in _config.php, for example:

```
CMSBatchActionHandler::register('hidefrommenus', 'CMSBatchAction_HideFromMenus');
```

And you’re done.

##Advanced batch actions
Adding actions which require more information from the user (e.g. a date) requires adding to the user interface. As an example, take a look at the “Move To…” batch action.


The files needed for Move To: 

1. code/CMSBatchAction_MoveTo.php - adds the Move To option to the batch action list (see above).
2. javascript/LeftAndMain.BatchActionsPlus.js - intercepts the Go button click if the selection action is Move To, and instead presents to user with a custom form.
3. code/CMSBatchAction_MoveToController.php - builds the custom form, prompting the user to select where they want the page(s) moved to, and handles the form submission. 
4. _config.php - required to register CMSBatchAction_MoveTo and the javascript include.


Take a look at the files above to see how the Move To batch action was implemented.

