<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Unirest\Request as UniRest;
use App\Entity\Device;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class InventoryController extends AbstractController
{
    /**
     * @Route("/inventar", name="inventar")
     */
    public function createDevice(Request $request)
    {
        $device = new Device();
        $form = $this->createFormBuilder($device)
        ->add('id', TextType::class)
        ->add('name', TextType::class)
        ->add('description', TextType::class, ['label' => 'Beschreibung'])
        ->add('location', TextType::class, ['label' => 'Ort'])
        ->add('save', SubmitType::class, ['label' => 'Neues Gerät anlegen'])
        ->getForm();
        
        $form->handleRequest($request);
        $newDevice = false;
        $data = '';
        
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $headers = array('Accept' => 'application/json');
            
            //api Aufruf
            $newDevice = true;
            
        }
        
        return $this->render('inventarisierung.html.twig', [
            'form' => $form->createView(),
            'newDevice' => $newDevice,
            'data' => $data
        ]);
    }
    
    /**
     * @Route("/verwaltung", name="verwaltung")
     */
    public function getDevices()
    {
        

        $headers = array('Accept' => 'application/json');
        $query = array('foo' => 'hello', 'bar' => 'world');

        $response = UniRest::post('http://mockbin.com/request', $headers, $query);
        
       
              $json = '[{
        "id": "2356354556",
        "name": "Notenrechner Lehrer",
        "description": "Zentraler Notenrechner im Lehrerzimmer",
        "attributes": {
          "Nur Lehrer": "Ja",
          "Passwortgeschützt": "Ja",
          "Betriebssystem": "Windows 2000"
        },
        "location": {
          "name": "Lehrerzimmer",
          "description": "Keine Schüler (offiziell) erlaubt!"
        }
      },{
        "id": "777777",
        "name": "sdf",
        "description": "Monitor kaputt",
        "attributes": {
          "Nur Lehrer": "Ja",
          "Passwortgeschützt": "Ja",
          "Betriebssystem": "Windows 2000"
        },
        "location": {
          "name": "Z217",
          "description": "Keine Schüler (offiziell) erlaubt!"
        }
      }]';
        
        $devices = json_decode($json, true);

        
        return $this->render('verwaltung.html.twig', ['devices' => $devices]);
        //return $this->render('verwaltung.html.twig', ['devices' => $response]);
    }
    
    /**
     * @Route("/tickets", name="tickets")
     */
    public function getTickets()  {
        $json = '[{
	"id": "790",
	"device": "2356354556",
	"description": "Es sind zu viele schlechte Noten gespeichert - Bitte Festplatte neu formatieren.",
	"done": false
        }]';
        
        $tickets = json_decode($json, true);
        
        return $this->render('tickets.html.twig', ['tickets' => $tickets]);
    }
}
