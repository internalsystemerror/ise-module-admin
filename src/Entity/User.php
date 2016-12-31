<?php

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
     * @ZF\Exclude()
     * @var string
     */
    protected $id;

    /**
     * @ORM\Column(type="string", unique=true, length=128, nullable=false)
     * @ZF\Options({"label": "Username"})
     * @ZF\Filter({"name": "StripNewlines"})
     * @ZF\Filter({"name": "StripTags"})
     * @ZF\Validator({"name": "StringLength", "options": {"min": 3, "max": 128}})
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
     * @ZF\Validator({"name": "StringLength", "options": {"min": 7, "max": 128}})
     * @var string
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="display_name")
     * @ZF\Options({"label": "Display Name"})
     * @ZF\Filter({"name": "StripNewlines"})
     * @ZF\Validator({"name": "StringLength", "options": {"min": 3, "max": 128}})
     * @var string
     */
    protected $displayName;

    /**
     * @ORM\Column(type="smallint", nullable=true, options={"unsigned":true})
     * @ZF\Exclude()
     * @var integer
     */
    protected $state;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     * @ZF\Exclude()
     * @var boolean
     */
    protected $banned = false;

    /**
     * @ORM\ManyToMany(targetEntity="Ise\Admin\Entity\Role", mappedBy="")
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
    public function __toString()
    {
        return $this->getDisplayName();
    }

    /**
     * Set id
     *
     * @param string $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = (string) $id;
        return $this;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = (string) $username;
        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = (string) $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = (string) $password;
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set displayName
     *
     * @param string $displayName
     * @return self
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = (string) $displayName;
        return $this;
    }

    /**
     * Get displayName
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set state
     *
     * @param integer $state
     * @return self
     */
    public function setState($state)
    {
        $this->state = (integer) $state;
        return $this;
    }

    /**
     * Get state
     *
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set banned
     *
     * @param boolean $banned
     * @return self
     */
    public function setBanned($banned)
    {
        $this->banned = (boolean) $banned;
        return $this;
    }

    /**
     * Is banned
     *
     * @return boolean
     */
    public function isBanned()
    {
        return $this->banned;
    }

    /**
     * Add role
     *
     * @param Role $role
     * @return self
     */
    public function addRole(Role $role)
    {
        $this->roles[] = $role;
        return $this;
    }

    /**
     * Remove role
     *
     * @param Role $role
     * @return self
     */
    public function removeRole(Role $role)
    {
        $this->roles->removeElement($role);
        return $this;
    }

    /**
     * Get roles
     *
     * @return Collection
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
