<?php
/**
* Extra Batch Actions
*
* @package BatchActionsPlus
*/

class CMSBatchAction_MoveTo extends CMSBatchAction {
	public function getActionTitle() {
		return _t('CMSBatchActions.MOVETO', 'Move to...');
	}


	public function run(SS_List $pages) {
		return $this->response(_t('CMSBatchActions.Moved', 'Moved'), $status);
	}

	public function applicablePages($ids) {
		return $this->applicablePagesHelper($ids, 'canEdit', false, true);
	}

}
