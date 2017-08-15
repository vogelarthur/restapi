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
use AppBundle\Entity\Flight;

class FlightController extends FOSRestController
{
    /**
    * @Rest\Post("/flight/")
    * @ApiDoc(
    *  resource=true,
    *  description="Create a flight for a trip",
    *  parameters={
    *      {"name"="departAirport", "dataType"="string", "required"=true, "format"="XXX", "description"="Code of Depart Airport"},
    *      {"name"="arriveAirport", "dataType"="string", "required"=true,"format"="XXX", "description"="Code of Arrival Airport"},
    *      {"name"="depart_time", "dataType"="string", "required"=true,"format"="99:99 AM/PM","description"="Hour of Depart"},
    *      {"name"="arrive_time", "dataType"="string", "required"=true,"format"="99:99 AM/PM","description"="Hour of Arrival"},
    *      {"name"="status", "dataType"="integer", "required"=true, "format"=" 1/Active 0/Inative", "description"="Status of Flight"}, 
    *  }
    * )
    */
    public function postAction(Request $request)
    {
        $data = new Flight();
        $departAirportId = $request->get('departAirportId');
        $arriveAirportId = $request->get('arriveAirportId');
        $departTime = $request->get('depart_time');
        $arriveTime = $request->get('arrive_time');
        $status = $request->get('status');
        
        if(empty($departAirportId) || empty($arriveAirportId) || empty($departTime) || empty($arriveTime) || empty($status))
        {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE); 
        }   
        $departAirport = $this->getDoctrine()->getRepository('AppBundle:Airport')->findBy(array('code'=>$departAirportId));
        if(empty($departAirport))
        {
            return new View("Depart Airport not found.", Response::HTTP_NOT_FOUND);
        }
        $arriveAirport = $this->getDoctrine()->getRepository('AppBundle:Airport')->findBy(array('code'=>$arriveAirportId));
        if(empty($arriveAirport)) 
        {
            return new View("Arrival Airport not found.", Response::HTTP_NOT_FOUND);
        }
        
        $data->setDepartAirportId($departAirportId);
        $data->setArriveAirportId($arriveAirportId);
        $data->setDepartTime($departTime);
        $data->setArriveTime($arriveTime);
        $data->setStatus($status);
      
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("Flight Added Successfully", Response::HTTP_OK);
    }
    
    /**
    * @Rest\Get("/flight/{depart}/{arrive}")
    * @ApiDoc(
    *  resource=true,
    *  description="Get Flights for a TRIP",
    *  requirements={
    *      {"name"="depart", "dataType"="string", "required"=true, "description"="Code of Depart Airport"},
    *      {"name"="arrive", "dataType"="string", "required"=true, "description"="Code of Arrival Airport"}
    *  }
    * )  
    */
    public function flightAction($depart, $arrive)
    {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:Flight')->findBy(array('departAirportId'=>$depart,'arriveAirportId'=>$arrive));
        if ($singleresult === null) {
            return new View("No flights for this trip are found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }
    
    /**
    * @Rest\Delete("/flight/{id}")
    * @ApiDoc(
    *  resource=true,
    *  description="Delete a Flight",
    *  requirements={
    *      {"name"="id", "dataType"="integer", "required"=true, "description"="Id of flight for delete"}
    *  }
    * )  
    */
    public function deleteAction($id)
    {
        $data = new Flight;
        $sn = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository('AppBundle:Flight')->find($id);
        if (empty($user)) 
        {
            return new View("Flight not found", Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($user);
            $sn->flush();
        }
        return new View("Deleted successfully", Response::HTTP_OK);
    }
}
