<?php

namespace IseAdmin\Navigation\Service;

use Zend\Navigation\Service\AbstractNavigationFactory;

class MenuNavigationFactory extends AbstractNavigationFactory
{

    /**
     * @return string
     */
    protected function getName()
    {
        return 'admin_menu';
    }
}
