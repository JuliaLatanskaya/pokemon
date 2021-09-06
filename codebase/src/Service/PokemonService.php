<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class PokemonService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function sortByNameAsc(array $pokemons): array
    {
        if (count($pokemons) <= 1) {
            return $pokemons;
        }

        $less_than = [];
        $greater_than = [];

        $pivot = $pokemons[0];

        for ($i = 1; $i < count($pokemons); $i++) {
            if (strcasecmp($pokemons[$i]['name'], $pivot['name']) > 0) {
                array_push($greater_than, $pokemons[$i]);
            } else {
                array_push($less_than, $pokemons[$i]);
            }
        }

        return array_merge($this->sortByNameAsc($less_than), $pivot, $this->sortByNameAsc($greater_than));
    }

    public function getPokemonAmount(): int
    {
        $response = $this->client->request(
            'GET',
            'https://pokeapi.co/api/v2/pokemon/'
        );

        if ($response->getStatusCode() == 200 && $content = $response->toArray()) {
            if (isset($content['count'])) {
                return $content['count'];
            }
        }

        return 0;
    }

    public function getAllPokemons(): array
    {
        $pokemons = [];
        $count = $this->getPokemonAmount();

        if ($count) {
            $response = $this->client->request(
                'GET',
                'https://pokeapi.co/api/v2/pokemon/?limit=' . $count
            );

            if ($response->getStatusCode() == 200 && $content = $response->toArray()) {
                foreach ($content['results'] as $el) {
                    $pokemons[] = ['name' => $el['name'], 'url' => $el['url'],
                        'details' => 'Our desc ...',
                        'img_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/2.png'];
                }
            }
        }

        return $pokemons;
    }
}
