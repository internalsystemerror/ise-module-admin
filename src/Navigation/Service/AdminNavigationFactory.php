<?php

namespace IseAdmin\Navigation\Service;

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
