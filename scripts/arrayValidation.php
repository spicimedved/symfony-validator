<?php

require_once __DIR__ . '/_common.php';

use Symfony\Component\Validator\ValidatorBuilder;
use Symfony\Component\Translation\Translator;

use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\CardScheme;
use Symfony\Component\Validator\Constraints\DateTime;

// see http://symfony.com/doc/current/reference/constraints/Collection.html

// builder which creates Validator as we need
$builder = new ValidatorBuilder();
$builder->setTranslator(new Translator('cs_CZ'));
$validator = $builder->getValidator();


// Example no. 1
// -------------
//
// This example shows that Collection constrains checks
// if array field fulfill our constraints or
// if some array fields are missing or
// if there are some extra fields in validated array

echo "Example no. 1: \n";

$inputData = [
    'name' => '',
    'age' => '',
    'isActive' => '',
    'createdAt' => ''
];

$violations = $validator->validate($inputData, new Collection([
    'name' => new NotBlank(),
    'email' => new Email([
        'groups' =>  'test'
    ]),
]), ['test']);

App\Utils::printViolations($violations);



// Example no. 2
// -------------
//
// In this example, we can see that there are some options we can
// use to allow extra fields or ignore missing fields.
//
// If we want to use these options we have to put our constraints under
// the 'fields' key in options argument of Collection object.


echo "Example no. 2: \n";

$inputData = [
    'name' => 'Petr',
    'age' => '',
    'isActive' => '',
    'createdAt' => ''
];

$violations = $validator->validate($inputData, new Collection([
    'fields' => [
        'name' => new NotBlank(),
        'email' => new Email(),
    ],
    'allowExtraFields' => true,
    'allowMissingFields' => true,
]));

App\Utils::printViolations($violations);



// Example no. 3
// -------------
//
// In this example we can see more useful constraints. You can play with it

echo "Example no. 3: \n";

$inputData = [
    'name' => 'Jan',
    'age' => 20,
    'card' => '5111111111111111',   // Mastercard starts with range 51-55
    'note' => '',
    'email' => 'name@provider.com',
    'gender' => 'male',
    'isActive' => true,
    'createdAt' => new \DateTime(),
];

$violations = $validator->validate($inputData, new Collection([
    'name' => [
        new NotBlank(),
    ],
    'age' => [
        new NotBlank(),
        new Type([
            'type'=>'integer'
        ]),
        new Range([
            'min' => 18,
            'max' => 80,
            'minMessage' => "You must be at least {{ limit }} years old to enter.",
            'maxMessage' => "You are too old. Entering is not safe for you. Access is allowed only for persons younger than {{ limit }}",
        ]),
    ],
    'card' => [
        new NotBlank(),
        new CardScheme([
            'schemes' => ['MASTERCARD', 'VISA'],
        ]),
    ],
    'note' => [
        new Length([
            'min' => 20,
            'minMessage' => "Your note must have at least {{ limit }} characters",
        ]),
    ],
    'email' => [
        new NotBlank(),
        new Email(),
    ],
    'gender' => [
        new Choice([
            'choices' => ['male', 'female']
        ])
    ],
    'isActive' => [
        new NotBlank(),
        new Type([
            'type'=>'bool'
        ]),
    ],
    'createdAt' => [
        new NotBlank(),
        new DateTime(),
    ],
]));

App\Utils::printViolations($violations);