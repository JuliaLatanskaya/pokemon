<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IndexController extends AbstractController
{
    /**
     * @Template("index.html.twig")
     * @Route("/{reactRouting}", name="index", requirements={"reactRouting"=".+"}, defaults={"reactRouting": null})
     */
    public function index()
    {
        return [];
    }
}
