<?php

namespace Oleh\AmDev\core;
use Oleh\AmDev\core\Router;

/**
 * 
 */
class App
{	
	public function __construct()
	{
		$router = new Router();
		$router->run();
	}
}

