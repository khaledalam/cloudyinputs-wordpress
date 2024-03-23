(function( $ ) {
	'use strict';


	// Save settings
	$(document).on('click', '#btn-save-settings', function(e) {
		e.preventDefault();

		const $cloudyinputs_apikey = $('#cloudyinputs_apikey').val();
		const $enable = $('#cloudyinputs_enable').is(':checked');

		document.body.style.cursor = "wait";
		$(this).prop('disabled', true);

		const $adminAjaxUrl = $(this).data('admin-ajax');
		const $nonce = $(this).data('nonce');

		let $data = {
			nonce: $nonce,
			action: 'ajax_handle_save_settings',
			apikey: $cloudyinputs_apikey,
			enable: $enable ? 1 : 0,
		};

		$.ajaxSetup({
			type: 'POST',
			timeout: 15000,
		});

		$.post($adminAjaxUrl, $data)
			.done(res => {
				let success = res?.message;
				document.body.style.cursor = "default";
				alert(success);
			})
			.fail(err => {
				document.body.style.cursor = "default";
				let error = err?.responseJSON?.data?.message;
				alert(error || err?.statusText);
			})
			.always(() => {
				document.body.style.cursor = "default";
				$(this).prop('disabled', false);
			});
	});

})( jQuery );
