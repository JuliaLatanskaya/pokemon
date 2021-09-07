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
            ['name' => 'secondelement'],
            ['name' => 'firstelement']
        ];

        $expected_data = [
            ['name' => 'firstelement'],
            ['name' => 'secondelement']
        ];

        $this->assertEquals($expected_data, $pokemonService->sortByNameAsc($data));
    }

    public function testSortByNameAscManyElement()
    {
        self::bootKernel();

        $container = static::getContainer();

        $pokemonService = $container->get(PokemonService::class);

        $data = [
            ['name' => 'wave'],
            ['name' => 'secondelement'],
            ['name' => 'third'],
            ['name' => 'yani'],
            ['name' => 'firstelement'],
        ];

        $expected_data = [
            ['name' => 'firstelement'],
            ['name' => 'secondelement'],
            ['name' => 'third'],
            ['name' => 'wave'],
            ['name' => 'yani']
        ];

        $this->assertEquals($expected_data, $pokemonService->sortByNameAsc($data));
    }
}
