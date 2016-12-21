<?php

namespace IseAdmin\Listener;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventInterface;
use Zend\Mvc\Controller\AbstractController;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\Http\RouteMatch;
use Zend\View\Renderer\PhpRenderer;

class AdminRouteListener implements ListenerAggregateInterface
{

    /**
     * @var array
     */
    protected $listeners = [];

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $eventManager)
    {
        $this->listeners[] = $eventManager->attach(MvcEvent::EVENT_DISPATCH, [$this, 'selectLayoutBasedOnRoute']);
    }

    /**
     * {@inheritDoc}
     */
    public function detach(EventManagerInterface $eventManager)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($eventManager->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * Select the admin layout based on route name
     *
     * @param EventInterface $event
     */
    public function selectLayoutBasedOnRoute(EventInterface $event)
    {
        $match          = $event->getRouteMatch();
        $controller     = $event->getTarget();
        $serviceManager = $event->getApplication()->getServiceManager();
        if (!$match instanceof RouteMatch || $controller->getEvent()->getResult()->terminate() ||
            !$serviceManager->has('ViewRenderer')) {
            return;
        }

        // Configure renderer
        $renderer = $serviceManager->get('ViewRenderer');
        if (!$renderer instanceof PhpRenderer) {
            return;
        }
        $this->setupLayoutBasedOnRoute($controller, $match->getMatchedRouteName(), $renderer);
    }

    /**
     * Setup layout based on route
     *
     * @param AbstractController $controller
     * @param string $matchedRouteName
     * @param PhpRenderer $renderer
     */
    protected function setupLayoutBasedOnRoute(AbstractController $controller, $matchedRouteName, PhpRenderer $renderer)
    {
        switch (true) {
            case $matchedRouteName === 'zfcuser/login':
            case $matchedRouteName === 'zfcuser/register':
            case $matchedRouteName === 'zfcuser/authenticate':
                $controller->layout('layout/login');
                $this->configureViewForLoginLayout($renderer);
                break;
            case 0 === strpos($matchedRouteName, 'admin'):
            case 0 === strpos($matchedRouteName, 'zfcuser'):
                $controller->layout('layout/admin');
                $this->configureViewForAdminLayout($renderer);
                break;
            default:
                break;
        }
    }

    /**
     * Configure view for admin layout
     *
     * @param PhpRenderer $renderer
     */
    protected function configureViewForAdminLayout(PhpRenderer $renderer)
    {
        $basePath = $renderer->basePath();
        $renderer->headTitle('Admin');
        $renderer->headLink()->appendStylesheet($basePath . '/css/admin.css');
        $renderer->headScript()->appendScript('(function(){document.getElementById("html").className="js";})();');
        $renderer->inlineScript()->appendFile($basePath . '/js/admin.js');
    }

    /**
     * Configure view for login layout
     *
     * @param PhpRenderer $renderer
     */
    protected function configureViewForLoginLayout(PhpRenderer $renderer)
    {
        $basePath = $renderer->basePath();
        $renderer->headTitle('Login');
        $renderer->headLink()->appendStylesheet($basePath . '/css/login.css');
        $renderer->inlineScript()->appendFile($basePath . '/js/login.js');
    }
}