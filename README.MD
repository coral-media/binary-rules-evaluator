# Binary Rules Evaluator

## Purpose
Evaluate set of conditions avoiding redundant `if/else` statements.

## How it works
Having the following table:

|              | Condition1 | Condition2 | Condition2 |
|:-------------|:----------:|:----------:|:----------:|
| **Result1**  |    true    |   false    |   false    |
| **Result2**  |   false    |    true    |    true    |
| **Result3**  |    null    |    true    |   false    |
| **Result3**  |    true    |    null    |   false    |
 -------------------------------------------------------

We translate that table into an array
```php
$rulesTable = [
    'Result1' => [
        [
            'Condition1' => true,
            'Condition2' => false,
            'Condition3' => false
        ],
    ],
    'Result2' => [
        [
            'Condition1' => false,
            'Condition2' => true,
            'Condition3' => true
        ],
    ],
    'Result3' => [
        [
            'Condition1' => null,
            'Condition2' => true,
            'Condition3' => false
        ],
        [
            'Condition1' => true,
            'Condition2' => null,
            'Condition3' => false
        ],
    ],
];
```
Having as example the following inputs:
```php
$input1 = [true, null, false] //matches Result3
$input2 = [null, null, false] //matches none
```
The validator will return the condition label or false if
none matches. The `null` was added to represent unknown values
and will not be evaluated.

```php
$binaryRulesEvaluator = (new BinaryRulesEvaluator())
    ->setRulesTable($rulesTable);

$binaryRulesEvaluator->evaluate($input1); // 'Result3'
$binaryRulesEvaluator->evaluate($input2); // false
```

If more than one result share rules set, the method `validate`
will return the first matching result.

This utility class helps to keep code consistent, clean and maintainable.
Trust me, code with a lot of `if/elseif/else` statements can be
really messy and hard to understand.
Keep in mind almost always you would be able to turn any set of evaluations into a 
`true/false` table.