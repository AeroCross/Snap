<?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
 * Autoloader and dependency injection initialization for Swift Mailer.
 */

if (defined('SWIFT_REQUIRED_LOADED'))
	return;

define('SWIFT_REQUIRED_LOADED', true);

// load Swift utility class
require dirname(__FILE__) . '/library/classes/Swift.php';

// start the autoloader
Swift::registerAutoload();

// load the init script to set up dependency injection
require dirname(__FILE__) . '/library/swift_init.php';

// get smtp settings
$settings	= Setting::all();
$data			= array();

foreach ($settings as $setting) {
	$data[$setting->name] = $setting->value;
}

// into an object
$settings = json_decode(json_encode($data));

// Register a mailer in the IoC container
Laravel\IoC::singleton('mailer', function()
{
	$transport = Laravel\IoC::resolve('mailer.transport');

	return Swift_Mailer::newInstance($transport);
});

// Register a transporter in the IoC container
Laravel\IoC::register('mailer.transport', function()
{
	return Swift_SmtpTransport::newInstance($settings->smtp_host, $settings->smtp_port)
		->setUsername($settings->smtp_user)
		->setPassword($settings->smtp_password);
});