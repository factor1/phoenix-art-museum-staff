(function($) {
	$(document).ready(function() {
		// Hide Divi content
		$('h3:contains("About Yourself")').hide();
		$('.tml-user-description-wrap').parent('.tml-form-table').hide();

		// Fix ACF conditional
		var $checkbox = $('.acf-field[data-name="past_president"] input[type="checkbox"]');
		var $target = $('.acf-field[data-name="past_president"] .acf-true-false .acf-switch');
		var $group = $('.acf-field-group[data-name="years_of_office"]');
		$checkbox.on('change pageload', function(e) {
			if($checkbox.data('toggled')) {
				$group.hide();
				$checkbox.data('toggled', false);
			} else {
				$group.show();
				$checkbox.data('toggled', true);
			}
		});
		if($target.hasClass('-on')) {
			$checkbox.data('toggled', true);
			$group.show();
		} else {
			$checkbox.data('toggled', false);
			$group.hide();
		}

		// "Jump To" functionality
		$('select[name="docent-letter"]').on('change', function(e) {
			var $target = $(e.target);
			window.location = $target.data('uri') + $target.val();
		});
	});
})(jQuery);