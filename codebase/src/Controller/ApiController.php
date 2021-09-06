<?php

namespace App\Controller;

use App\Service\PokemonService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiController extends AbstractController
{
    private $service;

    public function __construct(PokemonService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/api/getPokemons")
     */
    public function getPokemons()
    {
//        $data = [
//        [
//            'id' => 1,
//            'name' => 'First',
//            'details' => 'Our desc ...',
//            'img_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/1.png'
//        ],
//        [
//            'id' => 2,
//            'name' => 'Second',
//            'details' => 'Your component library for ...',
//            'img_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/2.png'
//        ]];

        $pokemons = $this->service->getAllPokemons();

        return new JsonResponse([$this->service->sortByNameAsc($pokemons)]);

    }
}
