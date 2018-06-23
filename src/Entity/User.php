<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Admin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ise\Bread\Entity\AbstractEntity;
use Zend\Form\Annotation as ZF;
use ZfcRbac\Identity\IdentityInterface;
use ZfcUser\Entity\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="admin_user")
 */
class User extends AbstractEntity implements UserInterface, IdentityInterface
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
     * @ZF\Options({"label": "Username"})
     * @ZF\Filter({"name": "StripNewlines"})
     * @ZF\Filter({"name": "StripTags"})
     * @ZF\Validator({"name": "StringLength", "options": {"min": 3}})
     * @var string
     */
    protected $username;

    /**
     * @ORM\Column(type="string", unique=true, length=255, nullable=false)
     * @ZF\Options({"label": "Email"})
     * @ZF\Type("email")
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=128, nullable=false)
     * @ZF\Options({"label": "Password"})
     * @ZF\Type("password")
     * @ZF\Validator({"name": "StringLength", "options": {"min": 7}})
     * @var string
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="display_name")
     * @ZF\Options({"label": "Display Name"})
     * @ZF\Filter({"name": "StripNewlines"})
     * @ZF\Validator({"name": "StringLength", "options": {"min": 3}})
     * @var string
     */
    protected $displayName;

    /**
     * @ORM\Column(type="smallint", nullable=true, options={"unsigned":true})
     * @ZF\Exclude()
     * @var int
     */
    protected $state;

    /**
     * @ORM\Column(type="bool", nullable=false)
     * @ZF\Exclude()
     * @var bool
     */
    protected $banned = false;

    /**
     * @ORM\ManyToMany(targetEntity="Ise\Admin\Entity\Role", mappedBy="users", indexBy="name", cascade={"persist","remove"})
     * @ZF\Exclude()
     * @var Role[]|Collection
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
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return $this->getUsername();
    }

    /**
     * Set id
     *
     * @param string $id
     *
     * @return void
     */
    public function setId($id): void
    {
        $this->id = (string)$id;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return void
     */
    public function setUsername($username): void
    {
        $this->username = (string)$username;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return void
     */
    public function setEmail($email): void
    {
        $this->email = (string)$email;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return void
     */
    public function setPassword($password): void
    {
        $this->password = (string)$password;
    }

    /**
     * Get displayName
     *
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * Set displayName
     *
     * @param string $displayName
     *
     * @return void
     */
    public function setDisplayName($displayName): void
    {
        $this->displayName = (string)$displayName;
    }

    /**
     * Get state
     *
     * @return int
     */
    public function getState(): int
    {
        return $this->state;
    }

    /**
     * Set state
     *
     * @param int $state
     *
     * @return void
     */
    public function setState($state): void
    {
        $this->state = (int)$state;
    }

    /**
     * Is banned
     *
     * @return bool
     */
    public function isBanned(): bool
    {
        return $this->banned;
    }

    /**
     * Set banned
     *
     * @param bool $banned
     *
     * @return void
     */
    public function setBanned(bool $banned): void
    {
        $this->banned = $banned;
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
        $role->addUser($this);
    }

    /**
     * Remove role
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
        $role->removeUser($this);
    }

    /**
     * Get roles
     *
     * @return Role[]|Collection
     */
    public function getRoles(): iterable
    {
        return $this->roles;
    }
}
