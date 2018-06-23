<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

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
