<?php

namespace Ise\Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ise\Bread\Entity\AbstractBasicEntity;
use Zend\Form\Annotation as ZF;

/**
 * @ORM\MappedSuperclass
 */
class AbstractRbacEntity extends AbstractBasicEntity
{
    /**
     * @ORM\Column(type="string", unique=true, length=128, nullable=false)
     * @ZF\Flags({"priority": 100})
     * @ZF\Options({"label": "Name"})
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     * @ZF\Exclude()
     * @var boolean
     */
    protected $permanent = false;

    /**
     * Set permanent
     *
     * @param boolean $permanent
     * @return self
     */
    public function setPermanent($permanent)
    {
        $this->permanent = (boolean) $permanent;
        return $this;
    }

    /**
     * Is permanent
     *
     * @return boolean
     */
    public function isPermanent()
    {
        return $this->permanent;
    }
}
