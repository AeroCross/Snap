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

//Load Swift utility class
require dirname(__FILE__) . '/library/classes/Swift.php';

//Start the autoloader
Swift::registerAutoload();

//Load the init script to set up dependency injection
require dirname(__FILE__) . '/library/swift_init.php';

// Register a mailer in the IoC container
Laravel\IoC::singleton('mailer', function()
{
	$transport = Laravel\IoC::resolve('mailer.transport');

	return Swift_Mailer::newInstance($transport);
});

// Register a transporter in the IoC container
Laravel\IoC::register('mailer.transport', function()
{
	return Swift_SmtpTransport::newInstance('mailtrap.io', 2525)
		->setUsername('app-development-3bf45b6ff9c244c2')
		->setPassword('573a5be18d575b80');
});