#How to make your own batch actions
##Single stage actions
You can add single stage batch actions by adding a class that extends CMSBatchAction (eg class CMSBatchAction_HideFromMenus extends CMSBatchAction {}). This class needs :
	
	// Returns the name of the action for the menu
	public function getActionTitle()

	//
	public function run(SS_List $pages)

	// Returns a list of pages to be ....
	public function applicablePages($ids) 



##Multi stage action
Adding multi stage actions requires an interface for the user to select the action and then choose another option. For this we use modale dialogs. Files needed:
	* The CMSBatchAction file
	* A javascript file to produle the modale and link the batch action to a new form
	* A file to display and process the form.