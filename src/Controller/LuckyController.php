<?php

namespace App\Controller;

use App\Repository\TinyPizzaRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController
{

    private $tinyPizzaRepository;

    public function __construct(TinyPizzaRepository $tinyPizzaRepository)
    {
        $this->tinyPizzaRepository = $tinyPizzaRepository;
    }

    /**
     * @Route("/pizzas")
     */
    public function getPizzas(): Response
    {
        $pizzas = $this->tinyPizzaRepository->findAll();

        return new Response(
            '<html><body>Pizzas: ' . $pizzas[0]->getName() . '</body></html>'
        );
    }

    /**
     * @Route("/lucky/number")
     */
    public function getNumber(): Response
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky number: ' . $number . '</body></html>'
        );
    }
}
