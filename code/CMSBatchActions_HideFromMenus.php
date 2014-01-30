<?php
/**
* Extra Batch Actions
*
* @package BatchActionsPlus
*/

class CMSBatchAction_HideFromMenus extends CMSBatchAction {
	public function getActionTitle() {
		return _t('CMSBatchActions.HIDEFROMMENUS', 'Hide from menus');
	}

	public function run(SS_List $pages) {

		$status = array(
			'modified'=>array()
		);

		foreach($pages as $page) {
			$id = $page->ID;

			// Perform the action
			$page->ShowInMenus = 0;
			$page->write();

			$status['modified'][$id] = array(
				'TreeTitle' => $page->TreeTitle
			);
		}

		return $this->response(_t('CMSBatchActions.HIDDENMENUS', 'Hidden from menus'), $status);
	}


	public function applicablePages($ids) {
		return $this->applicablePagesHelper($ids, 'canEdit', false, true);
	}
}
