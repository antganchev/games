<?php

namespace Controllers;

use DI\DependencyInjection;

/**
 * Base APP controller
 */

class BaseController 
{

    protected DependencyInjection $di;

    public function __construct(DependencyInjection $di)
    {
        $this->di = $di;
    }

    /**
     * Handle the request and display selected controller/view
     * 
     * @param DependencyInjection $di
     * @param array $selectedRoute
     * 
     * @return BaseController
     */
    public static function dispatch(DependencyInjection $di, array $selectedRoute)
    {
        $className = __NAMESPACE__ . '\\' . $selectedRoute['controller'];
        $controller = new $className($di);

        $controller->{$selectedRoute['action']}();
    }

    /**
     * Display a view
     * 
     * @param string $view
     * @param array $data
     * 
     * @return string
     */
    protected function showView(string $view, array $data = []): void
    {
        $viewFile = $this->di->getService('config')['view_dir'] . $view . ".php";
        if (file_exists($viewFile)) {
            foreach ($data as $variableName => $variableValue) {
                $$variableName = $variableValue;
            }
            ob_start();
            require_once $viewFile;
            $viewContent = ob_get_clean();
        }
        
        require_once $this->di->getService('config')['view_dir'] . "layout.php";
    }

}
