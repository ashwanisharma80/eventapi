<?php
namespace DroidInfotech\DroidBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Question
 *
 * @ORM\Entity(repositoryClass="DroidInfotech\DroidBundle\Repository\QuestionsRepository")
 * @ORM\Table(name="questions")
 */
class Question
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
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="questions")
     */
    private $answers;
    /**
     * @ORM\ManyToOne(targetEntity="Survey", inversedBy="question")
     * @ORM\JoinColumn(name="survey_id", referencedColumnName="id")
     */
    private $surveys;
    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255)
     */
    private $text;
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
     * @return Question
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
     * Constructor
     */
    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }
    
    /**
     * Add answer
     *
     * @param \BK\VotingBundle\Entity\Answer $answer
     * @return Question
     */
    public function addAnswer(\DroidInfotech\DroidBundle\Entity\Answer $answer)
    {
        $this->answers[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \Answer $answer
     */
    public function removeAnswer(\DroidInfotech\DroidBundle\Entity\Answer $answer)
    {
        $this->answers->removeElement($answer);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Set surveys
     *
     * @param \DroidInfotech\DroidBundle\Entity\Survey $surveys
     *
     * @return Question
     */
    public function setSurveys(\DroidInfotech\DroidBundle\Entity\Survey $surveys = null)
    {
        $this->surveys = $surveys;

        return $this;
    }

    /**
     * Get surveys
     *
     * @return \DroidInfotech\DroidBundle\Entity\Survey
     */
    public function getSurveys()
    {
        return $this->surveys;
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
