<?php

namespace AppBundle\Entity\ACL;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\Common\Collections\ArrayCollection;


/**
* AppBundle\Entity\ACL\Usuarios
*
* @ORM\Table(name="Usuarios")
* @ORM\Entity(repositoryClass="AppBundle\Entity\ACL\UsuariosRepository")
*/
class Usuarios implements UserInterface
{
  /**
  * @ORM\Column(type="integer")
  * @ORM\Id
  * @ORM\GeneratedValue(strategy="AUTO")
  */
  private $id;

  /**
  * @ORM\Column(type="string", length=100)
  */
  private $nombre;

  /**
  * @ORM\Column(type="string", length=255, unique=true)
  */
  private $username;

  /**
  * @ORM\Column(type="string", length=32)
  */
  private $salt;

  /**
  * @ORM\Column(type="string", length=128)
  */
  private $password;

  /**
  * @ORM\Column(type="string", length=255, unique=true)
  */
  private $email;

  /**
  * @ORM\Column(name="is_active", type="boolean")
  */
  private $isActive;

  /**
  * @ORM\Column(name="activado", type="boolean")
  */
  private $activado;

  // /**
  // * @ORM\ManyToMany(targetEntity="Roles", inversedBy="usuarios")
  // *
  // */
  // private $roles;

  /**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ACL\Roles", inversedBy="usuarios")
   * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
   */

  protected $roles;

  /**
  * @ORM\Column(name="codigo", type="text", nullable=true)
  */
  private $codigo;

  /**
   * @ORM\OneToMany(targetEntity="Elearn\ElearnBundle\Entity\CursoUsuarios", mappedBy="usuario")
   **/

  private $curso;

  public function __construct()
  {
    $this->isActive = true;
    $this->salt = md5(uniqid(null, true));
    $this->curso = new ArrayCollection();
    //$this->usuariosRoles = new ArrayCollection();
  }

  /**
  * @inheritDoc
  */
  public function getUsername()
  {
    return $this->username;
  }

  /**
  * @inheritDoc
  */
  public function getSalt()
  {
    return $this->salt;
  }

  /**
  * @inheritDoc
  */
  public function getPassword()
  {
    return $this->password;
  }

  /**
  * @inheritDoc
  */
  public function eraseCredentials()
  {
  }

  public function isEqualTo(UserInterface $user)
  {
    return $this->username === $user->getUsername();
  }

  public function isAccountNonExpired()
  {
    return true;
  }

  public function isAccountNonLocked()
  {
    return true;
  }

  public function isCredentialsNonExpired()
  {
    return true;
  }

  public function isEnabled()
  {
    return $this->isActive;
  }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Usuarios
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Usuarios
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuarios
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Usuarios
     */
    public function setEmail($email)
    {
        $this->email = $email;

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
     * Set isActive
     *
     * @param boolean $isActive
     * @return Usuarios
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }


    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Usuarios
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add curso
     *
     * @param \Elearn\ElearnBundle\Entity\CursoUsuarios $curso
     * @return Usuarios
     */
    public function addCurso(\Elearn\ElearnBundle\Entity\CursoUsuarios $curso)
    {
        $this->curso[] = $curso;

        return $this;
    }

    /**
     * Remove curso
     *
     * @param \Elearn\ElearnBundle\Entity\CursoUsuarios $curso
     */
    public function removeCurso(\Elearn\ElearnBundle\Entity\CursoUsuarios $curso)
    {
        $this->curso->removeElement($curso);
    }

    /**
     * Get curso
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return Usuarios
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set activado
     *
     * @param boolean $activado
     * @return Usuarios
     */
    public function setActivado($activado)
    {
        $this->activado = $activado;

        return $this;
    }

    /**
     * Get activado
     *
     * @return boolean
     */
    public function getActivado()
    {
        return $this->activado;
    }

    public function getRoles()
    {
        return $this->roles;
    }


    /**
     * Set roles
     *
     * @param \AppBundle\Entity\ACL\Roles $roles
     * @return Usuarios
     */
    public function setRoles(\AppBundle\Entity\ACL\Roles $roles = null)
    {
        $this->roles = $roles;

        return $this;
    }
}