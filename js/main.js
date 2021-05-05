/* Меню для мобильных устройств */
$(document).ready(function() {
	$('.mobile-menu__btn').on('click', function(event) {
		event.preventDefault();
		$(this).toggleClass('mobile-menu__btn_active');
		$('.mobile-menu').toggleClass('mobile-menu_shown');
	});
});