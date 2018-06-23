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
     * @var Role|null
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
     * @return Role|null
     */
    public function getParent(): ?Role
    {
        return $this->parent;
    }

    /**
     * Set parent
     *
     * @param Role|null $parent
     *
     * @return void
     */
    public function setParent(Role $parent = null): void
    {
        $this->parent = $parent;
    }

    /**
     * Add child
     *
     * @param Role $child
     *
     * @return void
     */
    public function addChild(Role $child): void
    {
        if ($this->children->contains($child)) {
            return;
        }

        $this->children[$child->getName()] = $child;
        $child->setParent($this);
    }

    /**
     * Remove child
     *
     * @param Role $child
     *
     * @return void
     */
    public function removeChild(Role $child): void
    {
        if (!$this->children->contains($child)) {
            return;
        }

        $this->children->removeElement($child);
        $child->setParent(null);
    }

    /**
     * Does role have children?
     *
     * @return bool
     */
    public function hasChildren(): bool
    {
        return !$this->children->isEmpty();
    }

    /**
     * Get children
     *
     * @return Role[]|Collection
     */
    public function getChildren(): iterable
    {
        return $this->children;
    }

    /**
     * Add users
     *
     * @param iterable $users
     *
     * @return void
     */
    public function addUsers(iterable $users): void
    {
        foreach ($users as $user) {
            $this->addUser($user);
        }
    }

    /**
     * Add user
     *
     * @param User $user
     *
     * @return void
     */
    public function addUser(User $user): void
    {
        if ($this->users->contains($user)) {
            return;
        }

        $this->users[$user->getId()] = $user;
        $user->addRole($this);
    }

    /**
     * Remove users
     *
     * @param iterable $users
     *
     * @return void
     */
    public function removeUsers(iterable $users): void
    {
        foreach ($users as $user) {
            $this->removeUser($user);
        }
    }

    /**
     * Remove user
     *
     * @param User $user
     *
     * @return void
     */
    public function removeUser(User $user): void
    {
        if (!$this->users->contains($user)) {
            return;
        }

        $this->users->removeElement($user);
        $user->removeRole($this);
    }


    /**
     * Get users
     *
     * @return User[]|Collection
     */
    public function getUsers(): iterable
    {
        return $this->users;
    }

    /**
     * Add permissions
     *
     * @param iterable $permissions
     *
     * @return void
     */
    public function addPermissions(iterable $permissions): void
    {
        foreach ($permissions as $permission) {
            $this->addPermission($permission);
        }
    }

    /**
     * Add permission
     *
     * @param Permission $permission
     *
     * @return void
     */
    public function addPermission(Permission $permission): void
    {
        if ($this->permissions->contains($permission)) {
            return;
        }

        $this->permissions[$permission->getName()] = $permission;
        $permission->addRole($this);
    }

    /**
     * Remove permissions
     *
     * @param iterable $permissions
     *
     * @return void
     */
    public function removePermissions(iterable $permissions): void
    {
        foreach ($permissions as $permission) {
            $this->removePermission($permission);
        }
    }

    /**
     * Remove permission
     *
     * @param Permission $permission
     *
     * @return void
     */
    public function removePermission(Permission $permission): void
    {
        if (!$this->permissions->contains($permission)) {
            return;
        }

        $this->permissions->removeElement($permission);
        $permission->removeRole($this);
    }

    /**
     * Get permissions
     *
     * @return Permission[]|Collection
     */
    public function getPermissions(): iterable
    {
        return $this->permissions;
    }

    /**
     * Does role have this permission?
     *
     * @param  string|Permission $permission
     *
     * @return bool
     */
    public function hasPermission($permission): bool
    {
        if ($permission instanceof Permission) {
            return $this->permissions->contains($permission);
        }
        return $this->permissions->containsKey($permission);
    }
}
