<?php

namespace Ise\Admin\Service;

use Ise\Bread\Service\AbstractService;

class AbstractRbacService extends AbstractService
{

    /**
     * {@inheritDoc}
     */
    public function getForm($action)
    {
        $form = parent::getForm($action);
        if ($action !== 'edit') {
            return $form;
        }
        $nameParts = explode('\\', $this->entityClass);
        switch (end($nameParts)) {
            case 'Role':
                $form->getInputFilter()->remove('parent');
                $form->getInputFilter()->remove('permissions');
                // no break
            case 'Permission':
                $form->getInputFilter()->remove('name');
                break;
        }
        return $form;
    }
}
