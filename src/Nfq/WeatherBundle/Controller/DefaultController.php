<?php

namespace Nfq\WeatherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Guzzle\Http\Client;

class DefaultController extends Controller
{
    /**
     * @Route("/weather/{city}")
     */
    public function indexAction($city)
    {
        $client = new Client('http://api.openweathermap.org');
        $request = $client->get('/data/2.5/weather?q='.$city.'&units=metric&appid=890a788d763cb01cb1ec97e28aadf1ea');
        $response = $request->send();
        $data = $response->json();
        $temperature = $data['main']['temp'];

        return $this->render('NfqWeatherBundle:Default:index.html.twig', ["city"=> $city, "temperature" => $temperature]);
    }
}
