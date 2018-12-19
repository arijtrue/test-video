<?php

namespace SiteDevel\VideoBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializationContext;
use SiteDevel\UserBundle\Entity\User;
use SiteDevel\VideoBundle\DataTransferObject\VideoDTO;
use SiteDevel\VideoBundle\Entity\Video;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use SiteDevel\VideoBundle\Form\VideoDTOType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class VideoController extends FOSRestController
{
    /**
     * List all videos which were not favourited by this user.
     *
     * @Rest\Route(
     *     path="/not-favourited",
     *     methods={"GET"},
     *     defaults={
     *          "_format": "json"
     *     }
     * )
     *
     * @ApiDoc(
     *     headers={
     *          {
     *              "name"="apikey",
     *              "description"="Authorization key",
     *              "required"="true"
     *          }
     *     },
     *     statusCodes={
     *         200="Successful",
     *         403="Unauthorized",
     *         500="Failed"
     *     },
     *     output={
     *         "class"="array<SiteDevel\VideoBundle\DataTransferObject\VideoDTO>",
     *         "groups"={"videos"},
     *     },
     *     section="Video"
     * )
     *
     * @param ParamFetcherInterface $paramFetcher
     * @param Request $request
     *
     * @return View
     */
    public function notFavouritedAction(ParamFetcherInterface $paramFetcher, Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();
        $list = $this->getDoctrine()->getManager()
            ->getRepository('SiteDevelVideoBundle:Video')
            ->getNotFavouritedByUser($user)
        ;

        return $this->view(
            $this->get('site_devel_video.assembler.video_assembler')->packDTOs($list),
            Response::HTTP_OK,
            [],
            ['videos']
        );
    }

    /**
     * This method will add a video.
     *
     * @Rest\Route(
     *     path="/add",
     *     methods={"POST"},
     *     defaults={
     *          "_format": "json"
     *     }
     * )
     *
     * @ApiDoc(
     *     headers={
     *         {
     *             "name"="apikey",
     *             "description"="Authorization key",
     *             "required"="true"
     *         }
     *     },
     *     statusCodes={
     *         201="Created",
     *         403="Unauthorized",
     *         500="Failed"
     *     },
     *     input={
     *         "class"="SiteDevel\VideoBundle\Form\VideoDTOType",
     *         "name"=""
     *     },
     *     output={
     *         "class"="SiteDevel\VideoBundle\DataTransferObject\VideoDTO",
     *         "groups"={"videos"}
     *     },
     *     section="Video"
     * )
     *
     * @param ParamFetcherInterface $paramFetcher
     * @param Request $request
     *
     * @return View
     */
    public function addAction(ParamFetcherInterface $paramFetcher, Request $request)
    {
        $videoDTO = new VideoDTO();
        $form = $this->createNamelessForm(VideoDTOType::class, $videoDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $video = $this
                ->get('site_devel_video.assembler.video_assembler')
                ->unpackDTOFromForm($this->getUser(), $videoDTO)
            ;
            $em = $this->getDoctrine()->getManager();
            $em->persist($video);
            $em->flush();

            return $this->view(
                $this->get('site_devel_video.assembler.video_assembler')->packDTO($video),
                Response::HTTP_CREATED,
                [],
                ['videos']
            );
        }

        return $this->view(
            [
                'message' => $form->getErrors(true),
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR,
            [],
            ['videos']
        );
    }

    /**
     * This method will make this video favourited.
     *
     * @Rest\Route(
     *     path="/favourite/{video}",
     *     methods={"PATCH"},
     *     defaults={
     *          "_format": "json"
     *     }
     * )
     *
     * @ApiDoc(
     *     headers={
     *         {
     *             "name"="apikey",
     *             "description"="Authorization key",
     *             "required"="true"
     *         }
     *     },
     *     requirements={
     *         {
     *             "name"="video",
     *             "dataType"="integer",
     *             "description"="Video Id, can be obtained with getting '/api/not-favourited' call",
     *             "required"="true"
     *         }
     *     },
     *     statusCodes={
     *         200="Successful",
     *         403="Unauthorized",
     *         500="Failed"
     *     },
     *     section="Video"
     * )
     */
    public function favouriteAction(ParamFetcherInterface $paramFetcher, Request $request, Video $video)
    {
        $video->addFavoritedBy($this->getUser());
        $em = $this->getDoctrine()->getManager();
        $em->persist($video);
        $em->flush();

        return $this->view([], Response::HTTP_OK);
    }

    /**
     * @param null $data
     * @param null $statusCode
     * @param array $headers
     * @param array $serializationGroups
     * @return View
     */
    protected function view($data = null, $statusCode = null, array $headers = [], array $serializationGroups = [])
    {
        $context = new SerializationContext();

        if ($serializationGroups) {
            $context->setGroups($serializationGroups);
        }

        return new Response(
            $this->container->get('jms_serializer')->serialize($data, 'json', $context),
            $statusCode,
            $headers
        );
    }

    /**
     * @param null $type
     * @param null $data
     * @param array $options
     * @return \Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     */
    private function createNamelessForm($type = null, $data = null, array $options = [])
    {
        return $this->container->get('form.factory')->createNamed(null, $type, $data, $options);
    }
}
