<?php

namespace Ise\Admin\Service;

use Ise\Bread\Service\AbstractService;

abstract class AbstractRbacService extends AbstractService
{

    /**
     * {@inheritDoc}
     */
    public function browse(array $criteria = [], array $orderBy = ['name' => 'ASC'], $limit = null, $offset = null)
    {
        return parent::browse($criteria, $orderBy, $limit, $offset);
    }
}
