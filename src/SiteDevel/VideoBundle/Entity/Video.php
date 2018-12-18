<?php

namespace SiteDevel\VideoBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use SiteDevel\UserBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class Video
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(
     *     targetEntity="SiteDevel\UserBundle\Entity\User",
     *     inversedBy="addedBy"
     * )
     * @ORM\JoinColumn(nullable=false)
     */
    private $addedBy;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1024, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=8196, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=4, nullable=false)
     */
    private $year;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var User[]
     *
     * @ORM\ManyToMany(
     *     targetEntity="SiteDevel\UserBundle\Entity\User",
     *     inversedBy="favouriteVideos"
     * )
     */
    private $favoritedBy;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getAddedBy()
    {
        return $this->addedBy;
    }

    /**
     * @param User $value
     *
     * @return $this
     */
    public function setAddedBy($value)
    {
        $this->addedBy = $value;

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
     *
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
     *
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
     *
     * @return $this
     */
    public function setYear($value)
    {
        $this->year = $value;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $value
     *
     * @return $this
     */
    public function setCreatedAt($value)
    {
        $this->createdAt = $value;

        return $this;
    }

    /**
     * @param User $value
     * @return $this
     */
    public function addFavoritedBy($value)
    {
        $this->favoritedBy[] = $value;

        return $this;
    }

    /**
     * @param User $value
     * @return $this
     */
    public function removeFavoritedBy($value)
    {
        if (($key = array_search($value, $this->favoritedBy, true)) !== false) {
            array_splice($this->favoritedBy, $key, 1);
        }

        return $this;
    }
}
