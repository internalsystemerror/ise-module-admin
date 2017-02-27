<?php

namespace Ise\Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use ZfcRbac\Permission\PermissionInterface;
use Zend\Form\Annotation as ZF;

/**
 * @ORM\Entity
 * @ORM\Table(name="admin_permission")
 */
class Permission extends AbstractRbacEntity implements PermissionInterface
{

    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     * @var string
     */
    protected $id;
}
