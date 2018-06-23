<?php

namespace Ise\Admin\Listener;

use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\Mvc\Controller\AbstractController;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\Http\RouteMatch;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;

class AdminRouteListener implements ListenerAggregateInterface
{

    use ListenerAggregateTrait;

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $eventManager)
    {
        $this->listeners[] = $eventManager->attach(MvcEvent::EVENT_DISPATCH, [$this, 'selectLayoutBasedOnRoute']);
    }

    /**
     * Select the admin layout based on route name
     *
     * @param EventInterface $event
     */
    public function selectLayoutBasedOnRoute(EventInterface $event)
    {
        $match          = $event->getRouteMatch();
        $serviceManager = $event->getApplication()->getServiceManager();
        $viewModel      = $event->getResult();
        if (!$match instanceof RouteMatch
            || !$viewModel instanceof ViewModel
            || $viewModel->terminate()
            || !$serviceManager->has('ViewRenderer')
        ) {
            return;
        }

        // Configure renderer
        $renderer = $serviceManager->get('ViewRenderer');
        if (!$renderer instanceof PhpRenderer) {
            return;
        }
        $this->setupLayoutBasedOnRoute($event->getTarget(), $match->getMatchedRouteName(), $renderer);
    }

    /**
     * Setup layout based on route
     *
     * @param AbstractController $controller
     * @param string             $matchedRouteName
     * @param PhpRenderer        $renderer
     */
    protected function setupLayoutBasedOnRoute(AbstractController $controller, $matchedRouteName, PhpRenderer $renderer)
    {
        if ($controller->identity()) {
            $controller->layout('layout/admin');
            return $this->configureViewForAdminLayout($renderer);
        }

        if ($matchedRouteName === 'zfcuser/login'
            || $matchedRouteName === 'zfcuser/register'
            || $matchedRouteName === 'zfcuser/authenticate'
        ) {
            $controller->layout('layout/login');
            return $this->configureViewForLoginLayout($renderer);
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
