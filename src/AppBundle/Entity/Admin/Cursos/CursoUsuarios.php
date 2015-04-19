<?php

namespace AppBundle\Entity\Admin\Cursos;

use Doctrine\ORM\Mapping as ORM;

/**
 * CursoUsuarios
 *
 * @ORM\Table()
 * @ORM\Entity
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
     * @ORM\ManyToOne(targetEntity="Cursos")
     * @ORM\JoinColumn(name="curso_id", referencedColumnName="id")
     **/
    private $curso;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ACL\Usuarios", inversedBy="usuarioscurso")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     **/
    private $usuario;

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
     * Set curso
     *
     * @param \AppBundle\Entity\Admin\Cursos\Cursos $curso
     * @return CursoUsuarios
     */
    public function setCurso(\AppBundle\Entity\Admin\Cursos\Cursos $curso = null)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return \AppBundle\Entity\Admin\Cursos\Cursos 
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\ACL\Usuarios $usuario
     * @return CursoUsuarios
     */
    public function setUsuario(\AppBundle\Entity\ACL\Usuarios $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \AppBundle\Entity\ACL\Usuarios 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}