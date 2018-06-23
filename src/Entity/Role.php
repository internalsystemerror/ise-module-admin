<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Admin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="string", unique=true, length=128, nullable=false)
     * @ZF\Flags({"priority": 100})
     * @ZF\Options({"label": "Name"})
     * @var string
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Ise\Admin\Entity\Role", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * @ZF\Options({"label": "Parent Role"})
     * @var Role
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="Ise\Admin\Entity\Role", mappedBy="parent")
     * @ZF\Exclude()
     * @var Role[]|Collection
     */
    protected $children;

    /**
     * @ORM\ManyToMany(targetEntity="Ise\Admin\Entity\User", inversedBy="roles", indexBy="username")
     * @ORM\JoinTable(
     *     name="admin_user_roles",
     *     joinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)}
     * )
     * @ZF\Options({"label": "Users"})
     * @ZF\Type("DoctrineORMModule\Form\Element\EntityMultiCheckbox")
     * @var User[]|Collection
     */
    protected $users;

    /**
     * @ORM\ManyToMany(
     *     targetEntity="Ise\Admin\Entity\Permission",
     *     mappedBy="roles",
     *     indexBy="name",
     *     cascade={"persist","remove"}
     * )
     * @ZF\Exclude()
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
     * Get parent
     *
     * @return Role
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set parent
     *
     * @param Role|null $parent
     *
     * @return self
     */
    public function setParent(Role $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Add child
     *
     * @param Role $child
     *
     * @return self
     */
    public function addChild(Role $child)
    {
        if ($this->children->contains($child)) {
            return;
        }

        $this->children[$child->getName()] = $child;
        $child->setParent($this);
        return $this;
    }

    /**
     * Remove child
     *
     * @param Role $child
     *
     * @return self
     */
    public function removeChild(Role $child)
    {
        if (!$this->children->contains($child)) {
            return;
        }

        $this->children->removeElement($child);
        $child->setParent(null);
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
     * Add users
     *
     * @param Collection $users
     *
     * @return self
     */
    public function addUsers(Collection $users)
    {
        foreach ($users as $user) {
            $this->addUser($user);
        }
        return $this;
    }

    /**
     * Add user
     *
     * @param ser $user
     *
     * @return self
     */
    public function addUser(User $user)
    {
        if ($this->users->contains($user)) {
            return;
        }

        $this->users[$user->getId()] = $user;
        $user->addRole($this);
        return $this;
    }

    /**
     * Remove users
     *
     * @param Collection $users
     *
     * @return self
     */
    public function removeUsers(Collection $users)
    {
        foreach ($users as $user) {
            $this->removeUser($user);
        }
        return $this;
    }

    /**
     * Remove user
     *
     * @param User $user
     *
     * @return self
     */
    public function removeUser(User $user)
    {
        if (!$this->users->contains($user)) {
            return;
        }

        $this->users->removeElement($user);
        $user->removeRole($this);
        return $this;
    }

    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add permissions
     *
     * @param Collection $permissions
     *
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
     *
     * @return self
     */
    public function addPermission(Permission $permission)
    {
        if ($this->permissions->contains($permission)) {
            return;
        }

        $this->permissions[$permission->getName()] = $permission;
        $permission->addRole($this);
        return $this;
    }

    /**
     * Remove permissions
     *
     * @param Collection $permissions
     *
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
     *
     * @return self
     */
    public function removePermission(Permission $permission)
    {
        if (!$this->permissions->contains($permission)) {
            return;
        }

        $this->permissions->removeElement($permission);
        $permission->removeRole($this);
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
     *
     * @return boolean
     */
    public function hasPermission($permission)
    {
        if ($permission instanceof Permission) {
            return $this->permissions->contains($permission);
        }
        return $this->permissions->containsKey($permission);
    }
}
