<?php

namespace Ise\Admin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Rbac\Role\HierarchicalRoleInterface;
use Zend\Form\Annotation as ZF;

/**
 * @ORM\Entity
 * @ORM\Table(name="admin_role")
 */
class Role extends AbstractRbacEntity implements HierarchicalRoleInterface
{

    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     * @var string
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Ise\Admin\Entity\Role", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * @ZF\Options({"label": "Parent Role"})
     * @var Role
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="Ise\Admin\Entity\Role", mappedBy="parent")
     * @var Role[]|Collection
     */
    protected $children;

    /**
     * @ORM\ManyToMany(targetEntity="Ise\Admin\Entity\Permission", mappedBy="")
     * @ZF\Options({"label": "Permissions"})
     * @ZF\Type("DoctrineORMModule\Form\Element\EntityMultiCheckbox")
     * @var Permission[]|Collection
     */
    protected $permissions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children    = new ArrayCollection;
        $this->permissions = new ArrayCollection;
        parent::__construct();
    }

    /**
     * Set parent
     *
     * @param Role|null $parent
     * @return self
     */
    public function setParent(Role $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return Role
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add child
     *
     * @param Role $child
     * @return self
     */
    public function addChild(Role $child)
    {
        $this->children[] = $child;
        return $this;
    }

    /**
     * Remove child
     *
     * @param Role $child
     * @return self
     */
    public function removeChild(Role $child)
    {
        $this->children->removeElement($child);
        return $this;
    }

    /**
     * Get children
     *
     * @return Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Does role have children?
     *
     * @return boolean
     */
    public function hasChildren()
    {
        return !$this->children->isEmpty();
    }
    
    /**
     * Add permissions
     *
     * @param Collection $permissions
     * @return self
     */
    public function addPermissions(Collection $permissions)
    {
        foreach ($permissions as $permission) {
            $this->addPermission($permission);
        }
        return $this;
    }

    /**
     * Add permission
     *
     * @param Permission $permission
     * @return self
     */
    public function addPermission(Permission $permission)
    {
        $this->permissions[] = $permission;
        return $this;
    }

    /**
     * Remove permissions
     *
     * @param Collection $permissions
     * @return self
     */
    public function removePermissions(Collection $permissions)
    {
        foreach ($permissions as $permission) {
            $this->removePermission($permission);
        }
        return $this;
    }
    
    /**
     * Remove permission
     *
     * @param Permission $permission
     * @return self
     */
    public function removePermission(Permission $permission)
    {
        $this->permissions->removeElement($permission);
        return $this;
    }

    /**
     * Get permissions
     *
     * @return Collection
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * Does role have this permission?
     *
     * @param  string|Permission $permission
     * @return boolean
     */
    public function hasPermission($permission)
    {
        $criteria = Criteria::create()->where(Criteria::expr()->eq('name', (string) $permission));
        $result   = $this->permissions->matching($criteria);

        return count($result) > 0;
    }
}
