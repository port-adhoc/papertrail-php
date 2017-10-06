<?php
	require( __DIR__ . '/../vendor/autoload.php' );

	use PortAdhoc\Papertrail;

	Papertrail::host('example.papertrailapp.com')
		->port(123456)
		->facility(99)
		->program('cron')
		->component('spam-cleaning')
		->message('hello world')
		->severity( Papertrail::SEVERITY_DEBUG )
		->send();
?>