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
        $response = '';
        
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $headers = array('Accept' => 'application/json');
            $query = array('name' => 'test', 'id' => 'test');
            
            //api Aufruf
            $headers = array('Accept' => 'application/json');
            $response = UniRest::post('http://10.244.0.130:8080/api/devices', $headers, $query);
            $newDevice = true;
            
        }
        
        return $this->render('inventarisierung.html.twig', [
            'form' => $form->createView(),
            'newDevice' => $newDevice,
            'data' => $data,
            'response' => $response
        ]);
    }
    
    /**
     * @Route("/verwaltung", name="verwaltung")
     */
    public function getDevices()
    {
        $headers = array('Accept' => 'application/json');
        $response = UniRest::get('http://10.244.0.130:8080/api/devices', $headers);
        $devices = json_decode($response->raw_body, true);
       
        return $this->render('verwaltung.html.twig', ['devices' => $devices]);
    }
    
    /**
     * @Route("/tickets", name="tickets")
     */
    public function getTickets()  {
        $headers = array('Accept' => 'application/json');
        $response = UniRest::get('http://10.244.0.130:8080/api/tickets', $headers);
        $tickets = json_decode($response->raw_body, true);

        return $this->render('tickets.html.twig', ['tickets' => $tickets]);
    }
}
