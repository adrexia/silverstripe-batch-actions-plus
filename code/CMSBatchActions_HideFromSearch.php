<?php
/**
* Extra Batch Actions
*
* @package BatchActionsPlus
*/

class CMSBatchAction_HideFromSearch extends CMSBatchAction {
	public function getActionTitle() {
		return _t('CMSBatchActions.HIDESEARCH', 'Hide from Search');
	}


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

	public function applicablePages($ids) {
		return $this->applicablePagesHelper($ids, 'canEdit', false, true);
	}
}
