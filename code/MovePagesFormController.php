<?php
class MovePagesFormController extends LeftAndMain {

	static $url_segment = 'movepagesform';

	static $menu_title = 'Move Pages';

	static $required_permission_codes = false;

	public function index($request) {
		$form = $this->MovePagesForm();
		return $this->customise(array(
			'Content' => ' ',
			'Form' => $form
		))->renderWith('CMSDialog');
	}
	
	public function MovePagesForm(){


		$pageIDs = Convert::raw2sql($this->getRequest()->getVar('PageIDs'));
		

		$action = FormAction::create('doMovePages', 'Move')
			->setUseButtonTag('true')
			->addExtraClass('ss-ui-button ss-ui-action-constructive')
			->setUseButtonTag(true);
		$actions = FieldList::create($action);

		$action->addExtraClass('batch-form-actions');


		$allFields = new CompositeField(
			new HiddenField("PageIDs","PageIDS", $pageIDs),
			new TreeDropdownField("ParentID", "Choose Parent Page", "SiteTree")
		);

		$allFields->addExtraClass('batch-form-body');

		$headings = new CompositeField(
			new LiteralField(
				'Heading',
				sprintf('<h3 class="">%s</h3>',
					_t('HtmlEditorField.MOVE', 'Move To...'))
			)
		);

		$headings->addExtraClass('cms-content-header batch-pages');

		$fields = new FieldList(
			$headings,
			$allFields
		);
		

		$form = Form::create(
			$this->owner, 
			'MovePagesForm', 
			$fields, 
			$actions, 
			$this->addNewRequiredFields
		);
		return $form;
	}


	/**
	* Handles the movement of pages within the sitetree
	**/
	public function doMovePages($data, $form){
		$pageIDs = $data->pageIDs;
		var_dump($form);

	}
}
