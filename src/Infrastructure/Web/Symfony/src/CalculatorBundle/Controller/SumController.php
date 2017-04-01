<?php
namespace DDD\Infrastructure\Web\Symfony\CalculatorBundle\Controller;


use DDD\Calculator\Domain\CalculatorSumRequest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SumController extends Controller
{
    public function sumAction(Request $request)
    {
        $calculatorSumService = $this->get("calculator_sum.service");
        $sum1 = (int)$request->get("sum1");
        $sum2 = (int)$request->get("sum2");

        $calculatorRequest = new CalculatorSumRequest($sum1, $sum2);
        $result = $calculatorSumService->sum($calculatorRequest);

        return $this->render('DDDCalculatorBundle:Result:result.html.twig', ["result" => $result->toArray()]);
    }
}
