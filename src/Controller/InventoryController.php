<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
    }
}
