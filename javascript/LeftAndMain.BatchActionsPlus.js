/**
 * 
 */
(function($) {
	$.entwine('ss.tree', function($){
	
		/**
		 * 
		 */
		$('#Form_BatchActionsForm').entwine({

			/**
			 * Function: onsubmit
			 * 
			 * Parameters:
			 *  (Event) e
			 */
			onsubmit: function(e) {
				e.preventDefault();

				var self = this, 
					ids = this.getIDs(), 
					tree = this.getTree(),
					id = 'ss-ui-dialog-' + new Date().getTime(),
					selectValue = $('#Form_BatchActionsForm_Action').val();
				
				if(selectValue == 'admin/pages/batchactions/moveto'){

					// if no nodes are selected, return with an error
					if(!ids || !ids.length) {
						alert(ss.i18n._t('CMSMAIN.SELECTONEPAGE'));
						return false;
					}

					// apply callback, which might modify the IDs
					var type = this.find(':input[name=Action]').val();
					if(this.getActions()[type]) ids = this.getActions()[type].apply(this, [ids]);
				
					// write (possibly modified) IDs back into to the hidden field
					this.setIDs(ids);

					// Reset failure states
					tree.find('li').removeClass('failed');

					var button = this.find(':submit:first');
					button.addClass('loading');
				

				

					var dialog = $('#ss-ui-dialog-' + id);

					if(!dialog.length) {
						dialog = $('<div class="ss-ui-dialog" id="' + id + '" />');
						$('body').append(dialog);
					}

					dialog.ssdialog({
						iframeUrl: $('base').attr('href')+'admin/movepagesform?PageIDs='+this.getIDs(), 
						autoOpen: true, 
						dialogExtraClass: 'batch-actions',
						width: 600,
						height: 320,
						modal:true,
						position: { 
							my: "center", 
							at: "center", 
							of: window 
						}
					});

					console.log(this.getIDs());

		

				} else {
					this._super();
				}

				
			}
		
		});
	});
	
}(jQuery));