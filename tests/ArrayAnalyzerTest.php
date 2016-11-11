<?php

use Szykra\ArrayAnalyzer\ArrayAnalyzer;

class ArrayAnalyzerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Szykra\ArrayAnalyzer\Exception\MismatchArrayException
     */
    public function it_should_throw_exception_on_mismatched_array()
    {
        ArrayAnalyzer::checkOrderChange([1], [1, 2]);
    }

    /**
     * @test
     * @expectedException \Szykra\ArrayAnalyzer\Exception\MismatchElementsException
     */
    public function it_should_throw_exception_on_mismatched_elements()
    {
        ArrayAnalyzer::checkOrderChange([1, 3], [1, 2]);
    }

    /** @test */
    public function it_should_return_empty_array_on_empty_array()
    {
        $result = ArrayAnalyzer::checkOrderChange([], []);

        static::assertCount(0, $result);
    }

    /** @test */
    public function it_should_return_empty_array_on_the_same_array()
    {
        $result = ArrayAnalyzer::checkOrderChange([1, 2, 3], [1, 2, 3]);

        static::assertCount(0, $result);
    }

    /**
     * @test
     * @dataProvider movementDataProvider
     */
    public function it_should_return_array_with_information_about_movement($before, $after, $outcome)
    {
        $result = ArrayAnalyzer::checkOrderChange($before, $after);

        static::assertEquals($outcome, $result);
    }

    public function movementDataProvider()
    {
        return [
            [
                ['A', 'B', 'C'],
                ['B', 'C', 'A'],
                [
                    'from' => 0,
                    'to' => 2,
                    'element' => 'A'
                ]
            ],
            [
                ['A', 'B', 'C'],
                ['B', 'A', 'C'],
                [
                    'from' => 0,
                    'to' => 1,
                    'element' => 'A'
                ]
            ],
            [
                ['A', 'B', 'C'],
                ['A', 'C', 'B'],
                [
                    'from' => 1,
                    'to' => 2,
                    'element' => 'B'
                ]
            ],
            [
                ['A', 'B', 'C', 'D', 'E', 'F', 'G'],
                ['A', 'B', 'C', 'E', 'F', 'D', 'G'],
                [
                    'from' => 3,
                    'to' => 5,
                    'element' => 'D'
                ]
            ],
            [
                ['A', 'B', 'C'],
                ['A', 'B', 'C'],
                []
            ]
        ];
    }
}
