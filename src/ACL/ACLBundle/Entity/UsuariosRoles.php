<?php

namespace ACL\ACLBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuariosRoles
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ACL\ACLBundle\Entity\UsuariosRolesRepository")
 */
class UsuariosRoles
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Usuarios", inversedBy="usuariosRoles")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */

    protected $usuarios;

    /**
     * @ORM\ManyToOne(targetEntity="Roles", inversedBy="usuariosRoles")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     */

    protected $roles;

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
     * Set usuarios
     *
     * @param \ACL\ACLBundle\Entity\Usuarios $usuarios
     * @return UsuariosRoles
     */
    public function setUsuarios(\ACL\ACLBundle\Entity\Usuarios $usuarios = null)
    {
        $this->usuarios = $usuarios;

        return $this;
    }

    /**
     * Get usuarios
     *
     * @return \ACL\ACLBundle\Entity\Usuarios
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Set roles
     *
     * @param \ACL\ACLBundle\Entity\Roles $roles
     * @return UsuariosRoles
     */
    public function setRoles(\ACL\ACLBundle\Entity\Roles $roles = null)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return \ACL\ACLBundle\Entity\Roles
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
