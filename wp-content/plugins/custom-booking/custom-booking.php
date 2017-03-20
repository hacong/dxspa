<?php

/**
 * Plugin Name: Custom Tickets booking for Techfest
 * Description:
 * Version: 0.0.1
 * Author: Hung Nguyen
 * Author URI: http://facebook.com/hungkyo.998
 */

add_action('gdlr_print_item_selector', 'custom_check_ticket_item', 11, 2);
function custom_check_ticket_item( $type, $settings = array() ){
	if($type == 'ticket'){
		custom_booking_ticket_( $settings );
	}
}

function custom_booking_ticket_($settings) {
	?>
	<div id="ticketer" style="display: none">
		<h3 style="text-align: center">Book with:</h3>
		<a class="gdlr-button-paypal gdlr-button img-button" href="https://ticketbox.vn/ticket-booking/27519/widget" data-rel="fancybox" data-fancybox-type="iframe">
			<img src="<?php echo plugins_url( 'ticketbox.png', __FILE__ ) ?>" alt="book tickets for techfest with ticketbox" style="width: 140px"/>
		</a>
		<b>OR</b>
		<a class="gdlr-button-paypal gdlr-button img-button bigtime" href="http://bigtime.vn/sapi?event_id=1607" data-rel="fancybox" data-fancybox-type="iframe">
			<img src="<?php echo plugins_url( '04-01.png', __FILE__ ) ?>" alt="book tickets for techfest with bigtime.vn" style="height: 140px"/>
		</a>
	</div>
	<div id="bigtime" style="display: none; width: 550px">
		<h3 style="text-align: center">Select ticket type:</h3>
		<a class="gdlr-button with-border bigtime iframe" href="http://bigtime.vn/sapi?event_id=1487">Innovator pass</a>
		<a class="gdlr-button with-border bigtime" href="http://bigtime.vn/sapi?event_id=1486">SHOWCASE pass</a>
		<a class="gdlr-button with-border bigtime" href="http://bigtime.vn/sapi?event_id=1488">INVESTOR pass</a>
		<div class="clear"></div>
		<h4 style="text-align: center">Free tickets:</h4>
		<center>
			<a class="gdlr-button with-border bigtime" href="http://bigtime.vn/sapi?event_id=1491">GENERAL AUDIENCE pass</a>
			<a class="gdlr-button with-border bigtime" href="http://bigtime.vn/sapi?event_id=1490">MEDIA PASS</a>
		</center>
	</div>
	<script>
		var ticketContentHeight = 0;
		(function ($) {
			$(window).load(function() {
				$(".gdlr-ticket-button").fancybox();
				$(".gdlr-ticket-content").each(function (i, e){
					if ($(e).height() > ticketContentHeight) {
						ticketContentHeight = $(e).height();
					}
				});
				$(".gdlr-ticket-content").css('height', ticketContentHeight + 'px');
				$(".bigtime").fancybox({
					type: 'iframe',
					width: '900px',
					height: '635px',
					padding: 0,
					margin:0,
					scrolling: 'no',
				});
			});
		} (jQuery));
	</script>
	<style>
		.img-button {
			background: none;
			padding: 0;
			border: 0;
		}
	</style>
<?php
}