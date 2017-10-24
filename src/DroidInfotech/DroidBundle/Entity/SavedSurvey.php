<?php

namespace DroidInfotech\DroidBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SavedSurvey
 *
 * @ORM\Table(name="saved_survey")
 * @ORM\Entity(repositoryClass="DroidInfotech\DroidBundle\Repository\SavedSurveyRepository")
 */
class SavedSurvey
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="surveytitle", type="string", length=255)
     */
    private $surveytitle;

    /**
     * @var string
     *
     * @ORM\Column(name="surveydesc", type="text")
     */
    private $surveydesc;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="answer", type="string", length=255)
     */
    private $answer;

    /**
     * @var int
     *
     * @ORM\Column(name="userId", type="integer")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="questionId", type="integer")
     */
    private $questionId;

    /**
     * @var int
     *
     * @ORM\Column(name="answerId", type="integer")
     */
    private $answerId;

    /**
     * @var int
     *
     * @ORM\Column(name="surveyId", type="integer")
     */
    private $surveyId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdOn", type="datetime")
     */
    private $createdOn;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set surveytitle
     *
     * @param string $surveytitle
     *
     * @return SavedSurvey
     */
    public function setSurveytitle($surveytitle)
    {
        $this->surveytitle = $surveytitle;

        return $this;
    }

    /**
     * Get surveytitle
     *
     * @return string
     */
    public function getSurveytitle()
    {
        return $this->surveytitle;
    }

    /**
     * Set surveydesc
     *
     * @param string $surveydesc
     *
     * @return SavedSurvey
     */
    public function setSurveydesc($surveydesc)
    {
        $this->surveydesc = $surveydesc;

        return $this;
    }

    /**
     * Get surveydesc
     *
     * @return string
     */
    public function getSurveydesc()
    {
        return $this->surveydesc;
    }

    /**
     * Set question
     *
     * @param string $question
     *
     * @return SavedSurvey
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set answer
     *
     * @param string $answer
     *
     * @return SavedSurvey
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return SavedSurvey
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set questionId
     *
     * @param integer $questionId
     *
     * @return SavedSurvey
     */
    public function setQuestionId($questionId)
    {
        $this->questionId = $questionId;

        return $this;
    }

    /**
     * Get questionId
     *
     * @return int
     */
    public function getQuestionId()
    {
        return $this->questionId;
    }

    /**
     * Set answerId
     *
     * @param integer $answerId
     *
     * @return SavedSurvey
     */
    public function setAnswerId($answerId)
    {
        $this->answerId = $answerId;

        return $this;
    }

    /**
     * Get answerId
     *
     * @return int
     */
    public function getAnswerId()
    {
        return $this->answerId;
    }

    /**
     * Set surveyId
     *
     * @param integer $surveyId
     *
     * @return SavedSurvey
     */
    public function setSurveyId($surveyId)
    {
        $this->surveyId = $surveyId;

        return $this;
    }

    /**
     * Get surveyId
     *
     * @return int
     */
    public function getSurveyId()
    {
        return $this->surveyId;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return SavedSurvey
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
