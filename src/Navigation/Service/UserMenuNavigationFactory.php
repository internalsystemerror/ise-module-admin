<?php

namespace Ise\Admin\Navigation\Service;

use Zend\Navigation\Service\AbstractNavigationFactory;

class UserMenuNavigationFactory extends AbstractNavigationFactory
{

    /**
     * @return string
     */
    protected function getName()
    {
        return 'user_menu';
    }
}
