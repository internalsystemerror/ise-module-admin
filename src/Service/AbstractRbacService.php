<?php

namespace Ise\Admin\Service;

use Ise\Bread\Service\AbstractService;

class AbstractRbacService extends AbstractService
{

    /**
     * {@inheritDoc}
     */
    public function browse($criteria = [], $orderBy = ['name' => 'ASC'], $limit = null, $offset = null);
}
