<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

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
     * @ORM\Column(type="bool", nullable=false)
     * @ZF\Exclude()
     * @var bool
     */
    protected $permanent = false;

    /**
     * Is permanent
     *
     * @return bool
     */
    public function isPermanent()
    {
        return $this->permanent;
    }

    /**
     * Set permanent
     *
     * @param bool $permanent
     *
     * @return self
     */
    public function setPermanent($permanent)
    {
        $this->permanent = (bool)$permanent;
        return $this;
    }
}
