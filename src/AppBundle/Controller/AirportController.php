<?php

namespace AppBundle\Controller;
 
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Airport;


class AirportController extends FOSRestController
{
    /**
     * @Rest\Get("/airport") 
     * @ApiDoc(
     *  resource=true,
     *  description="List of Real Airports"
     * )
     */
    public function getAction()
    {

        $restresult = $this->getDoctrine()->getRepository('AppBundle:Airport')->findBy([], ['code' => 'ASC']);
        if (empty($restresult)) {
            return new View("There are no Airports", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }
    
    /**
    * @Rest\Get("/airport/{code}")
    * @ApiDoc(
    *  resource=true,
    *  description="Return the Airport by Code",
    *  requirements={
    *      {"name"="code", "dataType"="string", "required"=true, "description"="Code of Airport"}
    *  }
    * )
    */
    public function codeAction($code)
    {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:Airport')->findBy(array('code'=>$code));
        if (empty($singleresult)) {
            return new View("Airport not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }
}
