<?php

require_once __DIR__ . '/_common.php';

use App\Entity\Person;
use Symfony\Component\Validator\ValidatorBuilder;

// builder which creates Validator as we need
$builder = new ValidatorBuilder();
$builder->addYamlMapping(__DIR__.'/../config/validation.yml');
//$builder->addXmlMapping(__DIR__.'/../config/validation.xml');
$ymlValidator = $builder->getValidator();


// Example no. 1
// -------------

echo "Example no. 1: \n";

$person = new Person();
//$person->setName("FakePetr");
//$person->setEmail("name@provider.com");
//$person->setPassword("FakePetr");

$violations = $ymlValidator->validate($person);

App\Utils::printViolations($violations);


// Example no. 2
// -------------

echo "Example no. 2 (groups): \n";

// New builder works new validation definition with groups
$builder = new ValidatorBuilder();
$builder->addYamlMapping(__DIR__.'/../config/validation-groups.yml');
$ymlValidator = $builder->getValidator();

$person = new Person();

//$violations = $ymlValidator->validate($person);
$violations = $ymlValidator->validate($person, null, ["Default", "Premium"]);

App\Utils::printViolations($violations);