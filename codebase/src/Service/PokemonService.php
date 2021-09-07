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

    public function getSinglePokemon(string $url): array
    {
        $pokemon = [];
        $response = $this->client->request(
            'GET',
            $url
        );

        if ($response->getStatusCode() == 200 && $content = $response->toArray()) {
            $pokemon = [
                'logo' => $content['sprites']['front_default'],
                'details' => "It's weight is {$content['weight']}. It's height is {$content['height']}. It has " . count($content['abilities']) . ' abilities.',
            ];
        } else {
            throw new \Exception('Failed to receive info by : ' . $url);
        }

        return $pokemon;
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

        return array_merge($this->sortByNameAsc($less_than), [$pivot], $this->sortByNameAsc($greater_than));
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
        } else {
            throw new \Exception('Failed to receive info by : ' . 'https://pokeapi.co/api/v2/pokemon/');
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
                $pokemons = $content['results'];
            } else {
                throw new \Exception('Failed to get pokemons via url: ' . 'https://pokeapi.co/api/v2/pokemon/?limit=' . $count);
            }
        }

        return $pokemons;
    }
}
