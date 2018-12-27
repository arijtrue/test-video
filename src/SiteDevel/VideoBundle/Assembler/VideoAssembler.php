<?php

namespace SiteDevel\VideoBundle\Assembler;

use SiteDevel\VideoBundle\Entity\User;
use SiteDevel\VideoBundle\DataTransferObject\VideoDTO;
use SiteDevel\VideoBundle\Entity\Video;

class VideoAssembler
{
    const FORMAT_CREATED_AT = 'Y-m-d H:i:s';

    /**
     * Unpacks into newly created entity, don't used with already created movies, as copy will be created with different adding date.
     *
     * @param User $user
     * @param VideoDTO $videoDTO
     *
     * @return Video
     */
    public function unpackDTOFromForm(User $user, VideoDTO $videoDTO)
    {
        $video = new Video();

        return $video
            ->setTitle($videoDTO->getTitle())
            ->setDescription($videoDTO->getDescription())
            ->setYear($videoDTO->getYear())
            ->setAddedBy($user)
        ;
    }

    /**
     * @return VideoDTO
     */
    public function packDTO(Video $video)
    {
        $videoDTO = new VideoDTO();

        return $videoDTO
            ->setId($video->getId())
            ->setTitle($video->getTitle())
            ->setDescription($video->getDescription())
            ->setYear($video->getYear())
            ->setCreatedAt($video->getCreatedAt()->format(self::FORMAT_CREATED_AT))
            ->setAddedBy($video->getAddedBy()->getUsername())
        ;
    }

    /**
     * @param Video[] $videos
     *
     * @return VideoDTO[]
     */
    public function packDTOs($videos)
    {
        $list = [];

        foreach ($videos as $video) {
            $list[] = $this->packDTO($video);
        }

        return $list;
    }
}
