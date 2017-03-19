<?php

namespace DDD\CalculatorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('DDDCalculatorBundle:Index:index.html.twig');
    }
}
