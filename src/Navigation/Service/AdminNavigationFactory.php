<?php

namespace Ise\Admin\Navigation\Service;

use Zend\Navigation\Service\AbstractNavigationFactory;

class AdminNavigationFactory extends AbstractNavigationFactory
{

    /**
     * @return string
     */
    protected function getName()
    {
        return 'admin';
    }
}
