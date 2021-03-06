<?php

/**
 * Controller to process move pages batch action.
 * 
 * @package batchactionsplus
 */
class CMSBatchAction_MoveToController extends LeftAndMain {

	private static $url_segment = 'batchmoveto';

	private static $menu_title = 'Move to';

	private static $required_permission_codes = false;

	private static $allowed_actions = array (
		'MovePagesForm',
		'index'
	);

	/** 
	 * Function called by AJAX from LeftAndMain.BatchActionsPlus.js 
	 * and from $this->doMovePages(). 
	 *
	 * @param Request $request, String $pageIDs
	 * @return Form rendered within CMSDialog
	 */
	public function index($request, $pageIDs = null) {
		$form = $this->MovePagesForm($pageIDs);
		return $this->customise(array(
			'Content' => ' ',
			'Form' => $form
		))->renderWith('CMSDialog');
	}
	

	/**
	 * Presents a form to select a new parent for pages selected with batch actions.
	 *
	 * @param string $pageIDs | null
	 * @return Form $form
	 */
	public function MovePagesForm($pageIDs = null){
		Versioned::reading_stage('Stage'); // Needs this for changes to effect draft tree
		
		$action = FormAction::create('doMovePages', 'Move')
			->setUseButtonTag('true')
			->addExtraClass('ss-ui-button ss-ui-action-constructive batch-form-actions')
			->setUseButtonTag(true);

		$actions = FieldList::create($action);

		$allFields = new CompositeField();
		$allFields->addExtraClass('batch-form-body');

		if($pageIDs == null){
			$pageIDs = $this->getRequest()->getVar('PageIDs');
		} else{
			$allFields->push(new LiteralField("ErrorParent",'<p class="message bad">Invalid parent selected, please choose another</p>'));
		}

		$allFields->push(new HiddenField("PageIDs","PageIDs", $pageIDs));
		$allFields->push(new TreeDropdownField("ParentID", "Choose Parent Page", "SiteTree"));

		$headings = new CompositeField(
			new LiteralField(
				'Heading',
				sprintf('<h3 class="">%s</h3>', _t('HtmlEditorField.MOVE', 'Move To...')))
		);

		$headings->addExtraClass('cms-content-header batch-pages');

		$fields = new FieldList(
			$headings,
			$allFields
		);

		$form = Form::create(
			$this, 
			'MovePagesForm', 
			$fields, 
			$actions
		);

		return $form;
	}


	/**
	* Handles the movement of pages within the sitetree
	* Note: if a page is selected as it's own parent, it should be moved to root
	*
	* @param array $data, Form $form
	* @return boolean | index function
	**/
	public function doMovePages($data, $form){
		if($data['ParentID']){
			$parentID = (int)$data['ParentID'];
		}else{
			$parentID = 0;
		}
		$pagesArray = explode(',', $data['PageIDs']);

		// for each $pageID (needs to be an array)
		foreach($pagesArray as $pageID){
			$page = SiteTree::get()->byID($pageID);

			$page->ParentID = $parentID;

			// Make page root if own id selected
			if($parentID == $pageID){
				$page->ParentID = 0;
			}

			// validate / write move, and redraw form if move fails
			try {
				$page->write();
			} catch (ValidationException $e) {
				return $this->index($this->getRequest(), $data['PageIDs']);
			}
		}
		
		return '<input type="hidden" class="close-dialog" />';
	}
}
