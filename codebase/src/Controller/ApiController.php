<?php

namespace App\Controller;

use App\Service\PokemonService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/api/getPokemons", methods={"GET"})
     */
    public function getPokemons()
    {
        $pokemons = $this->service->getAllPokemons();

        return new JsonResponse($this->service->sortByNameAsc($pokemons));
    }

    /**
     * @Route("/api/getSinglePokemon", methods={"GET"})
     */
    public function getPokemonsDetails(Request $request)
    {
        if (!$request->get('url')) {
            throw new \Exception('URL param is required');
        }

        return new JsonResponse($this->service->getSinglePokemon(urldecode($request->get('url'))));
    }
}
