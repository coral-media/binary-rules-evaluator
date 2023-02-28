<?php

namespace CoralMedia\BinaryRulesEvaluator\Tests;

use CoralMedia\BinaryRulesEvaluator\BinaryRulesEvaluator;
use PHPUnit\Framework\TestCase;

class BinaryRulesEvaluatorTest extends TestCase
{
    /**
     * @dataProvider rulesProvider
     */
    public function testValidateBusinessRules($rules, $validate, $expectedResult)
    {
        $binaryRulesEvaluator = (new BinaryRulesEvaluator())->setRulesTable($rules);
        $this->assertEquals($expectedResult, $binaryRulesEvaluator->evaluate($validate));
    }

    public static function rulesProvider(): array
    {
        $rulesTable = [
            'resultOne' => [
                [
                    'condition1' => true,
                    'condition2' => false,
                    'condition3' => null,
                ]
            ],
            'resultTwo' => [
                [
                    'condition1' => false,
                    'condition2' => true,
                    'condition3' => null,
                ]
            ],
        ];
        return [
            'ScenarioOne' => [
                'rules' => $rulesTable,
                'validate' => [
                    'condition1' => true,
                    'condition2' => false,
                    'condition3' => null,
                ],
                'expectedResult' => 'resultOne'
            ],
            'ScenarioTwo' => [
                'rules' => $rulesTable,
                'validate' => [
                    'condition1' => false,
                    'condition2' => true,
                    'condition3' => null,
                ],
                'expectedResult' => 'resultTwo'
            ],
            'ScenarioThree' => [
                'rules' => $rulesTable,
                'validate' => [
                    'condition1' => null,
                    'condition2' => null,
                    'condition3' => null,
                ],
                'expectedResult' => false
            ]
        ];
    }
}