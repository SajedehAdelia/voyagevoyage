<?php

namespace App\Controller;

use App\Entity\Country;
use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Faker\Generator;
use Faker\Factory;
class CountryController extends AbstractController
{
    #[Route('/country', name: 'app_country')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CountryController.php',
        ]);
    }

    #[Route("/api/countries", name: "country.getAll")]
    public function getAllPlaces(CountryRepository $repository, SerializerInterface $serializerInterface): JsonResponse
    {
        $countries = $repository->findAll();
        $jsonCountries = $serializerInterface->serialize($countries, 'json', ["groups" => 'getAllCountries']);
        return new JsonResponse($jsonCountries, Response::HTTP_OK,[], false);
    }
}
