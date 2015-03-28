<?php

namespace Quiz\QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioQuizOpciones
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Quiz\QuizBundle\Entity\UsuarioQuizOpcionesRepository")
 */
class UsuarioQuizPreguntasOpciones
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
     * @ORM\ManyToOne(targetEntity="Elearn\ElearnBundle\Entity\Cursos", inversedBy="calificacion")
     * @ORM\JoinColumn(name="curso_id", referencedColumnName="id")
     */

    private $cursos;

    /**
     * @ORM\ManyToOne(targetEntity="Elearn\ElearnBundle\Entity\Modulos", inversedBy="calificacion")
     * @ORM\JoinColumn(name="modulo_id", referencedColumnName="id")
     */

    private $modulos;

    /**
     * @ORM\ManyToOne(targetEntity="Elearn\ElearnBundle\Entity\Secciones", inversedBy="calificacion")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
    private $items;

    /**
     * @ORM\ManyToOne(targetEntity="Quiz", inversedBy="calificacion")
     * @ORM\JoinColumn(name="quiz_id", referencedColumnName="id")
     */
    private $quizes;

    /**
     * @ORM\ManyToOne(targetEntity="Preguntas", inversedBy="calificacion")
     * @ORM\JoinColumn(name="pregunta_id", referencedColumnName="id")
     */

    private $preguntas;

    /**
     * @ORM\ManyToOne(targetEntity="Opciones", inversedBy="calificacion")
     * @ORM\JoinColumn(name="opcion_id", referencedColumnName="id")
     */

    private $opciones;

    /**
     * @var string
     *
     * @ORM\Column(name="calificacion", type="boolean")
     */
    private $calificacion;

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
     * Set cursos
     *
     * @param \Elearn\ElearnBundle\Entity\Cursos $cursos
     * @return UsuarioQuizPreguntasOpciones
     */
    public function setCursos(\Elearn\ElearnBundle\Entity\Cursos $cursos = null)
    {
        $this->cursos = $cursos;

        return $this;
    }

    /**
     * Get cursos
     *
     * @return \Elearn\ElearnBundle\Entity\Cursos
     */
    public function getCursos()
    {
        return $this->cursos;
    }

    /**
     * Set modulos
     *
     * @param \Elearn\ElearnBundle\Entity\Modulos $modulos
     * @return UsuarioQuizPreguntasOpciones
     */
    public function setModulos(\Elearn\ElearnBundle\Entity\Modulos $modulos = null)
    {
        $this->modulos = $modulos;

        return $this;
    }

    /**
     * Get modulos
     *
     * @return \Elearn\ElearnBundle\Entity\Modulos
     */
    public function getModulos()
    {
        return $this->modulos;
    }

    /**
     * Set items
     *
     * @param \Elearn\ElearnBundle\Entity\Secciones $items
     * @return UsuarioQuizPreguntasOpciones
     */
    public function setItems(\Elearn\ElearnBundle\Entity\Secciones $items = null)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Get items
     *
     * @return \Elearn\ElearnBundle\Entity\Secciones
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set quizes
     *
     * @param \Quiz\QuizBundle\Entity\Quiz $quizes
     * @return UsuarioQuizPreguntasOpciones
     */
    public function setQuizes(\Quiz\QuizBundle\Entity\Quiz $quizes = null)
    {
        $this->quizes = $quizes;

        return $this;
    }

    /**
     * Get quizes
     *
     * @return \Quiz\QuizBundle\Entity\Quiz
     */
    public function getQuizes()
    {
        return $this->quizes;
    }

    /**
     * Set preguntas
     *
     * @param \Quiz\QuizBundle\Entity\Preguntas $preguntas
     * @return UsuarioQuizPreguntasOpciones
     */
    public function setPreguntas(\Quiz\QuizBundle\Entity\Preguntas $preguntas = null)
    {
        $this->preguntas = $preguntas;

        return $this;
    }

    /**
     * Get preguntas
     *
     * @return \Quiz\QuizBundle\Entity\Preguntas
     */
    public function getPreguntas()
    {
        return $this->preguntas;
    }

    /**
     * Set opciones
     *
     * @param \Quiz\QuizBundle\Entity\Opciones $opciones
     * @return UsuarioQuizPreguntasOpciones
     */
    public function setOpciones(\Quiz\QuizBundle\Entity\Opciones $opciones = null)
    {
        $this->opciones = $opciones;

        return $this;
    }

    /**
     * Get opciones
     *
     * @return \Quiz\QuizBundle\Entity\Opciones
     */
    public function getOpciones()
    {
        return $this->opciones;
    }

    /**
     * Set calificacion
     *
     * @param boolean $calificacion
     * @return UsuarioQuizPreguntasOpciones
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;

        return $this;
    }

    /**
     * Get calificacion
     *
     * @return boolean 
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }
}