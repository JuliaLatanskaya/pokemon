<?php

namespace App\Tests\Service;

use App\Service\PokemonService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PokemonServiceTest extends KernelTestCase
{
    public function testSortByNameAscEmpty()
    {
        self::bootKernel();

        $container = static::getContainer();

        $pokemonService = $container->get(PokemonService::class);

        $this->assertEquals([], $pokemonService->sortByNameAsc([]));
    }

    public function testSortByNameAscOneElement()
    {
        self::bootKernel();

        $container = static::getContainer();

        $pokemonService = $container->get(PokemonService::class);

        $data[] = ['name' => 'test', 'url' => 'test', 'details' => 'test', 'img_url' => 'test'];

        $this->assertEquals($data, $pokemonService->sortByNameAsc($data));
    }

    public function testSortByNameAscTwoElement()
    {
        self::bootKernel();

        $container = static::getContainer();

        $pokemonService = $container->get(PokemonService::class);

        $data = [
            ['name' => 'secondelement', 'url' => 'test', 'details' => 'test', 'img_url' => 'test'],
            ['name' => 'firstelement', 'url' => 'test', 'details' => 'test', 'img_url' => 'test']
        ];

        $expected_data = [
            ['name' => 'firstelement', 'url' => 'test', 'details' => 'test', 'img_url' => 'test'],
            ['name' => 'secondelement', 'url' => 'test', 'details' => 'test', 'img_url' => 'test']
        ];

        $this->assertEquals($expected_data, $pokemonService->sortByNameAsc($data));
    }

    public function testSortByNameAscManyElement()
    {
        self::bootKernel();

        $container = static::getContainer();

        $pokemonService = $container->get(PokemonService::class);

        $data = [
            ['name' => 'wave', 'url' => 'test', 'details' => 'test', 'img_url' => 'test'],
            ['name' => 'secondelement', 'url' => 'test', 'details' => 'test', 'img_url' => 'test'],
            ['name' => 'third', 'url' => 'test', 'details' => 'test', 'img_url' => 'test'],
            ['name' => 'yani', 'url' => 'test', 'details' => 'test', 'img_url' => 'test'],
            ['name' => 'firstelement', 'url' => 'test', 'details' => 'test', 'img_url' => 'test'],
        ];

        $expected_data = [
            ['name' => 'firstelement', 'url' => 'test', 'details' => 'test', 'img_url' => 'test'],
            ['name' => 'secondelement', 'url' => 'test', 'details' => 'test', 'img_url' => 'test'],
            ['name' => 'third', 'url' => 'test', 'details' => 'test', 'img_url' => 'test'],
            ['name' => 'wave', 'url' => 'test', 'details' => 'test', 'img_url' => 'test'],
            ['name' => 'yani', 'url' => 'test', 'details' => 'test', 'img_url' => 'test']
        ];

        $this->assertEquals($expected_data, $pokemonService->sortByNameAsc($data));
    }
}
