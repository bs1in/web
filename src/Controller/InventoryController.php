<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Unirest\Request as UniRest;

class InventoryController extends AbstractController
{
    /**
     * @Route("/inventar", name="inventar")
     */
    public function index()
    {
        return $this->render('inventarisierung.html.twig');
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
      }]';
        
        $devices = json_decode($json, true);

        
        return $this->render('verwaltung.html.twig', ['devices' => $devices]);
        //return $this->render('verwaltung.html.twig', ['devices' => $response]);
    }
}
