<?php

namespace SiteDevel\VideoBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use SiteDevel\VideoBundle\Entity\Video;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Video[]
     *
     * @ORM\OneToMany(
     *     targetEntity="SiteDevel\VideoBundle\Entity\Video",
     *     mappedBy="addedBy"
     * )
     */
    private $videos;

    /**
     * @var Video[]
     *
     * @ORM\ManyToMany(
     *     targetEntity="SiteDevel\VideoBundle\Entity\Video",
     *     mappedBy="favoritedBy"
     * )
     */
    private $favouriteVideos;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return Video[]
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @param Video[] $value
     * @return $this
     */
    public function setVideos($value)
    {
        $this->videos = $value;

        return $this;
    }

    /**
     * @param Video $value
     *
     * @return $this
     */
    public function addVideo($value)
    {
        $this->videos[] = $value;

        return $this;
    }

    /**
     * @param Video $value
     *
     * @return $this
     */
    public function removeVideo($value)
    {
        if (($key = array_search($value, $this->videos, true)) !== false) {
            array_splice($this->videos, $key, 1);
        }

        return $this;
    }

    /**
     * @param Video $value
     * @return $this
     */
    public function addFavouriteVideo($value)
    {
        $this->favouriteVideos[] = $value;

        return $this;
    }

    /**
     * @param Video $value
     * @return $this
     */
    public function removeFavouriteVideo($value)
    {
        if (($key = array_search($value, $this->favouriteVideos, true)) !== false) {
            array_splice($this->favouriteVideos, $key, 1);
        }

        return $this;
    }
}
