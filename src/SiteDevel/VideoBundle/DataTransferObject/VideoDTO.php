<?php

namespace SiteDevel\VideoBundle\DataTransferObject;

use JMS\Serializer\Annotation as JMS;

/**
 * @JMS\ExclusionPolicy("all")
 */
class VideoDTO
{
    /**
     * @var int
     *
     * @JMS\Groups({"videos"})
     * @JMS\Expose()
     */
    private $id;

    /**
     * @var string
     *
     * @JMS\Groups({"videos"})
     * @JMS\Expose()
     */
    private $title;

    /**
     * @var string
     *
     * @JMS\Groups({"videos"})
     * @JMS\Expose()
     */
    private $description;

    /**
     * @var string
     *
     * @JMS\Groups({"videos"})
     * @JMS\Expose()
     */
    private $year;

    /**
     * @var string
     *
     * @JMS\Groups({"videos"})
     * @JMS\Expose()
     */
    private $createdAt;

    /**
     * @var string
     *
     * @JMS\Groups({"videos"})
     * @JMS\Expose()
     */
    private $addedBy;
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setId($value)
    {
        $this->id = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setTitle($value)
    {
        $this->title = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setDescription($value)
    {
        $this->description = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setYear($value)
    {
        $this->year = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setCreatedAt($value)
    {
        $this->createdAt = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddedBy()
    {
        return $this->addedBy;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setAddedBy($value)
    {
        $this->addedBy = $value;

        return $this;
    }
}
