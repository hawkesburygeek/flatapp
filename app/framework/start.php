<?php

/**
 * Start.php
 *
 * Responsible for loading different files that the framework
 * requires for use.
 *
 */

include __FRAMEWORK_LOCATION.'FrameworkLoader.php';

spl_autoload_register('FrameworkLoader::classLoader');
spl_autoload_register('FrameworkLoader::pluginSpaceLoader');
spl_autoload_register('FrameworkLoader::userSpaceLoader');

/**
 * Start Plugin System
 */
\Jade\Plugins::createInstance();

function errorHandler() {
	\Jade\Plugins::$pluginInstance->runHooks('serverErrorEncountered');
}

register_shutdown_function('errorHandler');

// frameworkLoaded hook.
\Jade\Plugins::$pluginInstance->runHooks('frameworkLoaded');

/**
 * Start Routing
 *
 * Include the file that controlls the applications routing.
 *
 */
$routeContext = (include __SITE_LOCATION.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'Routes.php');

// frameworkUnloaded hook.
\Jade\Plugins::$pluginInstance->runHooks('frameworkUnLoaded');