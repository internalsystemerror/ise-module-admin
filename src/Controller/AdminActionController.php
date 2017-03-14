<?php

namespace Ise\Admin\Controller;

use Ise\Bread\Controller\BreadActionController;
use Ise\Bread\EventManager\BreadEvent;
use Ise\Bread\EventManager\BreadEventManager;
use Ise\Bread\Options\ControllerOptions;
use Ise\Bread\Service\ServiceInterface;
use ZfcRbac\Exception\UnauthorizedException;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class AdminActionController extends BreadActionController
{

    /**
     * @var string
     */
    protected $basePermission;
    
    /**
     * {@inheritDoc}
     */
    public function __construct(BreadEventManager $breadEventManager, ServiceInterface $service, ControllerOptions $options)
    {
        parent::__construct($breadEventManager, $service, $options);
        $this->basePermission = $options->getBasePermission();
    }
    
    /**
     * Check an index for permission
     *
     * @param BreadEvent $event
     * @throws UnauthorizedException
     */
    public function checkIndexPermission(BreadEvent $event)
    {
        if (!$this->isGranted($this->basePermission)) {
            throw new UnauthorizedException;
        }
    }
    
    /**
     * Check a read for permission
     *
     * @param BreadEvent $event
     * @throws UnauthorizedException
     */
    public function checkReadPermission(BreadEvent $event)
    {
        if (!$this->isGranted($this->basePermission, $event->getEntity())) {
            throw new UnauthorizedException;
        }
    }
    
    /**
     * Check a create for permission
     *
     * @param BreadEvent $event
     * @throws UnauthorizedException
     */
    public function checkCreatePermission(BreadEvent $event)
    {
        if (!$this->isGranted($this->basePermission . '.' . $event->getAction())) {
            throw new UnauthorizedException;
        }
    }
    
    /**
     * Check a change for permission
     *
     * @param BreadEvent $event
     * @throws UnauthorizedException
     */
    public function checkChangePermission(BreadEvent $event)
    {
        if (!$this->isGranted($this->basePermission . '.' . $event->getAction(), $event->getEntity())) {
            throw new UnauthorizedException;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    protected function attachDefaultIndexListeners()
    {
        parent::attachDefaultIndexListeners();
        $this->breadEventManager->attach(BreadEvent::EVENT_INDEX, [$this, 'checkIndexPermission'], 850);
    }
    
    /**
     * {@inheritDoc}
     */
    protected function attachDefaultReadListeners()
    {
        parent::attachDefaultReadListeners();
        $this->breadEventManager->attach(BreadEvent::EVENT_READ, [$this, 'checkReadPermission'], 850);
    }
    
    /**
     * {@inheritDoc}
     */
    protected function attachDefaultCreateListeners()
    {
        parent::attachDefaultCreateListeners();
        $this->breadEventManager->attach(BreadEvent::EVENT_CREATE, [$this, 'checkCreatePermission'], 850);
    }
    
    /**
     * {@inheritDoc}
     */
    protected function attachDefaultUpdateListeners()
    {
        parent::attachDefaultUpdateListeners();
        $this->breadEventManager->attach(BreadEvent::EVENT_UPDATE, [$this, 'checkChangePermission'], 850);
    }
    
    /**
     * {@inheritDoc}
     */
    protected function attachDefaultDialogListeners()
    {
        parent::attachDefaultDialogListeners();
        $this->breadEventManager->attach(BreadEvent::EVENT_DIALOG, [$this, 'checkChangePermission'], 850);
    }
}
