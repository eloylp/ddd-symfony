<?php
namespace DDD\Calculator\Infrastructure\Web\Symfony\CalculatorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SumController extends Controller
{
    public function sumAction(Request $request)
    {
        $calculatorSumService = $this->get("calculator_sum.operation");
        $sum1 = (int)$request->get("sum1");
        $sum2 = (int)$request->get("sum2");
        $result = $calculatorSumService->sum($sum1, $sum2);
        return $this->render('DDDCalculatorBundle:Result:result.html.twig', ["result" => $result]);
    }
}
