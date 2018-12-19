<?php

namespace SiteDevel\VideoBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializationContext;
use SiteDevel\VideoBundle\Entity\Video;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class VideoController extends FOSRestController
{
    /**
     * This method will add a video.
     *
     * @ApiDoc(
     *     headers={
     *         {
     *             "name"="X-AUTHORIZE-KEY",
     *             "description"="Authorization key"
     *         }
     *     },
     *     statusCodes={
     *         200="Successful",
     *         403="Unauthorized",
     *         500="Failed"
     *     }
     * )
     */
    public function postAddAction()
    {

    }

    /**
     * @param Video $video
     */
    public function postFavouriteAction(Video $video)
    {

    }

    /**
     */
    public function cgetListNotFavouriteAction()
    {

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
        $view = View::create($data, $statusCode, $headers);

        if ($serializationGroups) {
            $view->setSerializationContext(SerializationContext::create()->setGroups($serializationGroups));
        }

        return $view;
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
