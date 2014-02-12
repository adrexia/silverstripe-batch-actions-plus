<?php
/**
* Extra Batch Action: Move to. 
* Enables multiple pages to be selected and moved to a new parent
* Has a javascript requirement (/javascript/LeftAndMain.BatchActionsPlus.js)
* Processed by CMSBatchActions_MoveToController.php
*
* @package BatchActionsPlus
*/

class CMSBatchAction_MoveTo extends CMSBatchAction {
	public function getActionTitle() {
		return _t('CMSBatchActions.MOVETO', 'Move to...');
	}


	public function run(SS_List $pages) {
		$status = array(
			'modified'=>array()
		);

		foreach($pages as $page) {
			$id = $page->ID;

			$status['modified'][$id] = array(
				'TreeTitle' => $page->TreeTitle
			);
		}
		return $this->response(_t('CMSBatchActions.Moved', 'Moved'), $status);
	}

	public function applicablePages($ids) {
		return $this->applicablePagesHelper($ids, 'canEdit', false, true);
	}

}
