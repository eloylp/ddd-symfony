<?php
namespace DDD\Calculator\Infrastructure\Web\Symfony\CalculatorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('DDDCalculatorBundle:Index:index.html.twig');
    }
}
