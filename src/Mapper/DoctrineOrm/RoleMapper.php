<?php

namespace Ise\Admin\Mapper\DoctrineOrm;

use Ise\Bread\Mapper\DoctrineOrm\AbstractMapper;

class RoleMapper extends AbstractMapper
{

    /**
     * @var string
     */
    protected $entityClass = 'Ise\Admin\Entity\Role';

    /**
     * {@inheritDoc}
     */
    public function browse($criteria = [], $orderBy = ['name' => 'ASC'], $limit = null, $offset = null)
    {
        return parent::browse($criteria, $orderBy, $limit, $offset);
    }
}
