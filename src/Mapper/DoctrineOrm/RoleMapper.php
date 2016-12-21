<?php

namespace IseAdmin\Mapper\DoctrineOrm;

use IseBread\Mapper\DoctrineOrm\AbstractMapper;

class RoleMapper extends AbstractMapper
{

    /**
     * @var string
     */
    protected $entityClass = 'IseAdmin\Entity\Role';

    /**
     * {@inheritDoc}
     */
    public function browse($criteria = [], $orderBy = ['name' => 'ASC'], $limit = null, $offset = null)
    {
        return parent::browse($criteria, $orderBy, $limit, $offset);
    }
}
