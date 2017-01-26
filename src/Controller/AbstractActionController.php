<?php

namespace Ise\Admin\Controller;

use Ise\Bread\Controller\AbstractActionController as BreadAbstractActionController;
use ZfcRbac\Exception\UnauthorizedException;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
abstract class AbstractActionController extends BreadAbstractActionController
{
    
    /**
     * {@inheritDoc}
     * @throws UnauthorizedException
     */
    protected function checkPermission($actionType = null, $context = null)
    {
        $permission = static::$basePermission;
        if ($actionType) {
            $permission .= '.' . $actionType;
        }
        if (!$this->isGranted($permission, $context)) {
            throw new UnauthorizedException;
        }
    }
}
