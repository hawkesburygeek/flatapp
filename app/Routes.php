<?php

/**
 * Routes
 *
 * Contains the logic for the applications routes.
 *
 */

function error_not_found()
{

}

\Jade\Route::get('/', function () {
    $path = \Jade\Input::get('page');

    // echo "M " . $path . " M";
    if ($path === NULL || $path === '') {
        if (PageFinder::indexPageExists('')) {
            $page = new Page('index');
            $template = $page->header["Template"];
            if ($template == '' || $template == NULL) {
                $template = 'default';
            }
            \Jade\Plugins::$pluginInstance->runHooks('pageBeforeLoad');
            \Jade\View::make($template)->with('pageURL', '')->
            with('page', $page)->render();
            // Run hook after page loaded.
            \Jade\Plugins::$pluginInstance->runHooks('pageLoaded');
        } else {
            echo "NOPE!";
            header('HTTP/1.0 404 Not Found');
            \Jade\Plugins::$pluginInstance->runHooks('404BeforeLoad');
            \Jade\View::make('404')->with('resource', \Jade\Input::get('page'))->render();
            \Jade\Plugins::$pluginInstance->runHooks('404Loaded');
        }
        exit;
    }

    // Check for file or folder
    echo "ABD();";
    echo $path;

    if (PageFinder::isFile($path)) {
        $page = new Page(\Jade\Input::get('page'));

        // TODO: Fix bug
        if (isset($page->header["Template"]))
            $template = $page->header["Template"];
        else $template = NULL;

        if ($template == '' || $template === NULL) {
            $template = 'default';
        }
        // Run hook before page loaded.
        \Jade\Plugins::$pluginInstance->runHooks('pageBeforeLoad');
        \Jade\View::make($template)->with('pageURL', \Jade\Input::get('page'))->
        with('page', $page)->render();
        // Run hook after page loaded.
        \Jade\Plugins::$pluginInstance->runHooks('pageLoaded');
    } else {
        // $page = new Page("pages/".\Jade\Input::get('page'));
        echo "CAPO";
        // echo \Jade\Input::get('page');
        // $a = '/pages/'.$path;
        // echo $a;
        // print_r($page);
        // Check if path points to a directory within the documentation content folder.
        if (PageFinder::isDirectory($path)) {
            // Check if directory contains an index.md file
            if (PageFinder::indexPageExists($path)) {
                $page = new Page(\Jade\Input::get('page') . 'index');
                $template = $page->header["Template"];
                if ($template == '' || $template == NULL) {
                    $template = 'default';
                }
                \Jade\Plugins::$pluginInstance->runHooks('pageBeforeLoad');
                \Jade\View::make($template)->with('pageURL', \Jade\Input::get('page'))->
                with('page', $page)->render();

                \Jade\Plugins::$pluginInstance->runHooks('pageLoaded');
            } else {
                \Jade\Plugins::$pluginInstance->runHooks('directoryBeforeLoad');
                // No index.md file exists, fall back to a default template view.
                \Jade\View::make('directory')->with('path', $path)
                    ->with('pageURL', \Jade\Input::get('page'))
                    ->with('structure', PageFinder::getDirectoryTree($path))->render();
                \Jade\Plugins::$pluginInstance->runHooks('directoryLoaded');
            }
        } else { // Page not found
            header('HTTP/1.0 404 Not Found');
            \Jade\Plugins::$pluginInstance->runHooks('404BeforeLoad');
            \Jade\View::make('404')->with('resource', \Jade\Input::get('page'))->render();
            \Jade\Plugins::$pluginInstance->runHooks('404Loaded');
        }
    }

});

\Jade\Route::post('/', function () {
    \Jade\Plugins::$pluginInstance->runHooks('postRequested');
});
