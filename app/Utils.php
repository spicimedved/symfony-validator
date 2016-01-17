<?php

namespace App;

use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class Utils
{
    public static function printViolations(ConstraintViolationListInterface $violations)
    {
        if ($violations->count() == 0) {
            echo "No violations\n";
        } else {
            /** @var ConstraintViolation $violation */
            foreach ($violations as $index => $violation) {
                echo $index .' ' . $violation->getPropertyPath(). ': ' . $violation->getMessage() . "\n";
            }
        }
        echo "\n";
    }
}