<?php

namespace IseAdmin\Mapper\DoctrineOrm;

use IseBread\Mapper\DoctrineOrm\AbstractMapper;

class PermissionMapper extends AbstractMapper
{

    /**
     * @var string
     */
    protected $entityClass = 'IseAdmin\Entity\Permission';

    /**
     * {@inheritDoc}
     */
    public function browse($criteria = [], $orderBy = ['name' => 'ASC'], $limit = null, $offset = null)
    {
        return parent::browse($criteria, $orderBy, $limit, $offset);
    }
}
