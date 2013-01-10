<?php

// Set hashids configuration
$config = array(
	'salt' => 'Place your salt here',
	'length' => 6
);

// Autoload libraries folder
Autoloader::directories(array(
	Bundle::path('hashids').'libraries',
));

Autoloader::namespaces(array(
	'Hashids\Libraries' => Bundle::path('hashids').'libraries',
));

// Register Hashids in the IoC container for DRY code
// and Dependency Injection
IoC::register('hashids', function() use ($config)
{
	$version = floatval(phpversion());

	if ($version >= '5.4')
	{
		$hashids = new Hashids\Libraries\hashids($config['salt'], $config['length']);
	}
	else
	{
		$hashids = new Hashids\Libraries\hashids53($config['salt'], $config['length']);
	}

	return $hashids;
});