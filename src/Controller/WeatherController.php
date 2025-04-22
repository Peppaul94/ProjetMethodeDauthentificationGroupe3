<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    #[Route('/admin/post', name: 'weather_show')]
    public function show(): Response
    {
        $city = 'paris';
        $apiKey = '439ed9f4dbadca391bff0ac13890511a';
        $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

        $data = json_decode(file_get_contents($url));

        return $this->render('admin/blog/index.html.twig', [
            'weather' => $data
        ]);
    }
}
?>
