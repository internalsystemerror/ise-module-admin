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
     * Get name
     *
     * @return string
     */
    protected function getName(): string
    {
        return 'user_menu';
    }
}
