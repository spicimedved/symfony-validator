<?php

require_once __DIR__ . '/_common.php';

use Symfony\Component\Validator\ValidatorBuilder;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

// builder which creates Validator as we need
$builder = new ValidatorBuilder();
$validator = $builder->getValidator();


// Example no. 1
// -------------

echo "Example no. 1: \n";

$violations = $validator->validate('', new NotBlank());

App\Utils::printViolations($violations);


// Example no. 2
// -------------

echo "Example no. 2: \n";

$violations = $validator->validate('', [
    new Length([
        'min' => 3
    ])
]);

App\Utils::printViolations($violations);


// Example no. 3
// -------------

echo "Example no. 3: \n";

$violations = $validator->validate('', [
    new NotBlank(),
    new Length([
        'min' => 3
    ]),
]);

App\Utils::printViolations($violations);