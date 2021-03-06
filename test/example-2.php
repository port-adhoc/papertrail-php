<?php
	require( __DIR__ . '/../vendor/autoload.php' );

	use PortAdhoc\Papertrail;

	Papertrail::host('example.papertrailapp.com')
		->port(123456)
		->facility(99)
		->program('cron')
		->component('spam-cleaning');

	// a few moments later

	Papertrail::message('fetching table done')
		->severity( Papertrail::SEVERITY_DEBUG )
		->send();

	// an eternity later

	Papertrail::message('cleaning table done')
		->severity( Papertrail::SEVERITY_DEBUG )
		->send();
?>