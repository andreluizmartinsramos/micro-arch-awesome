<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class Usuario implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dr", inversedBy="usuarios")
     * @ORM\JoinColumn(name="dr_id", referencedColumnName="id")
     */
    private $dr;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $apiKey;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Role")
     * @ORM\JoinTable(name="usuario_roles")
     */
    private $roles;

    public function __construct() {
        $this->roles = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getDr(): Dr {
        return $this->dr;
    }

    public function setDr(Dr $dr): self {
        $this->dr = $dr;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Usuario
     */
    public function setEmail(string $email): Usuario {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApiKey() {
        return $this->apiKey;
    }

    /**
     * @param mixed $apiKey
     * @return Usuario
     */
    public function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles() {
        $roles = [];
        foreach ($this->roles as $role)
            $roles[] = $role->getName();
        return $roles;
    }

    public function addRole(Role $role) {
        $this->roles->add($role);
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword() {
        // TODO: Implement getPassword() method.
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt() {
        // TODO: Implement getSalt() method.
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername() {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials() {
        // TODO: Implement eraseCredentials() method.
    }
}
