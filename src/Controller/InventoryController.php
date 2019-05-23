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
        
        $devices = [
            'name' => 'test'
        ];
        
        return $this->render('verwaltung.html.twig', ['devices' => $devices]);
    }
}
