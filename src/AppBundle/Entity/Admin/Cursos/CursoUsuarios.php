<?php

namespace AppBundle\Entity\Admin\Cursos;

use Doctrine\ORM\Mapping as ORM;

/**
 * CursoUsuarios
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Admin\Cursos\CursoUsuariosRepository")
 */
class CursoUsuarios
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Admin\Cursos\Cursos")
     * @ORM\JoinColumn(name="curso_id", referencedColumnName="id")
     **/
    private $cursos;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ACL\Usuarios", inversedBy="cursoUsuarios")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", onDelete="CASCADE")
     **/
    private $usuarios;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha_registro", type="datetime")
     */
    private $fechaRegistro;

    public function __construct()
    {
        $this->fechaRegistro = new \DateTime();
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
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return CursoUsuarios
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }


    /**
     * Set cursos
     *
     * @param \AppBundle\Entity\Admin\Cursos\Cursos $cursos
     *
     * @return CursoUsuarios
     */
    public function setCursos(\AppBundle\Entity\Admin\Cursos\Cursos $cursos = null)
    {
        $this->cursos = $cursos;

        return $this;
    }

    /**
     * Get cursos
     *
     * @return \AppBundle\Entity\Admin\Cursos\Cursos
     */
    public function getCursos()
    {
        return $this->cursos;
    }

    /**
     * Set usuarios
     *
     * @param \AppBundle\Entity\ACL\Usuarios $usuarios
     *
     * @return CursoUsuarios
     */
    public function setUsuarios(\AppBundle\Entity\ACL\Usuarios $usuarios = null)
    {
        $this->usuarios = $usuarios;

        return $this;
    }

    /**
     * Get usuarios
     *
     * @return \AppBundle\Entity\ACL\Usuarios
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }
}
