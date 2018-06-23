<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Admin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation as ZF;
use ZfcRbac\Permission\PermissionInterface;

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

    /**
     * @ORM\Column(type="string", unique=true, length=128, nullable=false)
     * @ZF\Flags({"priority": 100})
     * @ZF\Options({"label": "Name"})
     * @var string
     */
    protected $name;

    /**
     * @ORM\ManyToMany(targetEntity="Ise\Admin\Entity\Role", inversedBy="permissions", indexBy="name")
     * @ORM\JoinTable(
     *     name="admin_role_permissions",
     *     joinColumns={@ORM\JoinColumn(name="permission_id", referencedColumnName="id", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=false)}
     * )
     * @ZF\Options({"label": "Roles"})
     * @ZF\Type("DoctrineORMModule\Form\Element\EntityMultiCheckbox")
     * @var Permission[]|Collection
     */
    protected $roles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roles = new ArrayCollection;
        parent::__construct();
    }

    /**
     * Add roles
     *
     * @param iterable $roles
     *
     * @return void
     */
    public function addRoles(iterable $roles): void
    {
        foreach ($roles as $role) {
            $this->addRole($role);
        }
    }

    /**
     * Add role
     *
     * @param Role $role
     *
     * @return void
     */
    public function addRole(Role $role): void
    {
        if ($this->roles->contains($role)) {
            return;
        }

        $this->roles[$role->getName()] = $role;
    }

    /**
     * Remove roles
     *
     * @param iterable $roles
     *
     * @return void
     */
    public function removeRoles(iterable $roles): void
    {
        foreach ($roles as $role) {
            $this->removeRole($role);
        }
    }

    /**
     * Remove permission
     *
     * @param Role $role
     *
     * @return void
     */
    public function removeRole(Role $role): void
    {
        if (!$this->roles->contains($role)) {
            return;
        }

        $this->roles->removeElement($role);
    }

    /**
     * Get permissions
     *
     * @return Permission[]|Collection
     */
    public function getRoles(): iterable
    {
        return $this->roles;
    }
}
