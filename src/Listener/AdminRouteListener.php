<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Admin\Listener;

use Ise\Admin\Entity\User;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\Mvc\Controller\AbstractController;
use Zend\Mvc\MvcEvent;
use Zend\Router\Http\RouteMatch;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;

class AdminRouteListener implements ListenerAggregateInterface
{

    use ListenerAggregateTrait;

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $eventManager, $priority = 1): void
    {
        $this->listeners[] = $eventManager->attach(
            MvcEvent::EVENT_DISPATCH,
            [$this, 'selectLayoutBasedOnRoute'],
            $priority
        );
    }

    /**
     * Select the admin layout based on route name
     *
     * @param MvcEvent $event
     *
     * @return void
     */
    public function selectLayoutBasedOnRoute(MvcEvent $event): void
    {
        $match = $event->getRouteMatch();
        if (!$match instanceof RouteMatch) {
            return;
        }

        $serviceManager = $event->getApplication()->getServiceManager();
        if (!$serviceManager->has('ViewRenderer')) {
            return;
        }

        $viewModel = $event->getResult();
        if (!$viewModel instanceof ViewModel || $viewModel->terminate()) {
            return;
        }

        // Configure renderer
        $renderer = $serviceManager->get('ViewRenderer');
        if (!$renderer instanceof PhpRenderer) {
            return;
        }

        $controller = $event->getTarget();
        if (!$controller instanceof AbstractController) {
            return;
        }

        $this->setupLayoutBasedOnRoute($controller, $match->getMatchedRouteName(), $renderer);
    }

    /**
     * Setup layout based on route
     *
     * @param AbstractController $controller
     * @param string             $matchedRouteName
     * @param PhpRenderer        $renderer
     *
     * @return void
     */
    protected function setupLayoutBasedOnRoute(
        AbstractController $controller,
        string $matchedRouteName,
        PhpRenderer $renderer
    ): void {
        $user = $controller->plugin('identity')();
        if ($user instanceof User) {
            $controller->layout('layout/admin');
            $this->configureViewForAdminLayout($renderer);
            return;
        }

        if ($matchedRouteName === 'zfcuser/login'
            || $matchedRouteName === 'zfcuser/register'
            || $matchedRouteName === 'zfcuser/authenticate'
        ) {
            $controller->layout('layout/login');
            $this->configureViewForLoginLayout($renderer);
            return;
        }
    }

    /**
     * Configure view for admin layout
     *
     * @param PhpRenderer $renderer
     *
     * @return void
     */
    protected function configureViewForAdminLayout(PhpRenderer $renderer): void
    {
        $basePath = $renderer->basePath();
        $renderer->headTitle('Admin');
        $renderer->headLink()->__call('appendStylesheet', [$basePath . '/css/admin.css']);
        $renderer->headScript()->appendScript('(function(){document.getElementById("html").className="js";})();');
        $renderer->inlineScript()->appendFile($basePath . '/js/admin.js');
    }

    /**
     * Configure view for login layout
     *
     * @param PhpRenderer $renderer
     *
     * @return void
     */
    protected function configureViewForLoginLayout(PhpRenderer $renderer): void
    {
        $basePath = $renderer->basePath();
        $renderer->headTitle('Login');
        $renderer->headLink()->__call('appendStylesheet', [$basePath . '/css/login.css']);
        $renderer->inlineScript()->appendFile($basePath . '/js/login.js');
    }
}
