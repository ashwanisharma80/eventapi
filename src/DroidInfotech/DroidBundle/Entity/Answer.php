<?php

namespace DroidInfotech\DroidBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Answer Class
 *
 * @ORM\Entity(repositoryClass="AnswersRepository")
 * @ORM\Table(name="answers")
 */
class Answer
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Answer text
     *
     * @ORM\Column(name="text", type="string")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="answers")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     */
    private $questions;
      /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdOn", type="datetime")
     */
    private $createdOn;
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
     * Set text
     *
     * @param string $text
     * @return Answer
     */
    public function setText($text)
    {
        $this->text = $text;
    
        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

   
    /**
     * Set questions
     *
     * @param \DroidInfotech\DroidBundle\Entity\Question $questions
     *
     * @return Answer
     */
    public function setQuestions(\DroidInfotech\DroidBundle\Entity\Question $questions = null)
    {
        $this->questions = $questions;

        return $this;
    }

    /**
     * Get questions
     *
     * @return \DroidInfotech\DroidBundle\Entity\Question
     */
    public function getQuestions()
    {
        return $this->questions;
    }
    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return Survey
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }
}
