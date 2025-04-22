<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function show(): Response
    {
        $apiKey = '439ed9f4dbadca391bff0ac13890511a';
        $cities = ['Paris', 'Berlin', 'Moscow'];
        $weatherData = [];
    
        foreach ($cities as $city) {
            $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";
            $response = @file_get_contents($url);
    
            if ($response !== false) {
                $data = json_decode($response);
                if ($data !== null && isset($data->main)) {
                    $weatherData[] = $data;
                }
            }
        }

        return $this->render('default/homepage.html.twig', [
            'weatherData' => $weatherData,
        ]);
    }
}
?>
