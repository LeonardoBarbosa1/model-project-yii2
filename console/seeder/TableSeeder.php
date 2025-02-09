<?php

namespace console\seeder;

use antonyz89\seeder\helpers\CreatedAtUpdatedAt;
use Faker\Provider\pt_BR\Address;
use Faker\Provider\pt_BR\Company;
use Faker\Provider\pt_BR\Person;
use Faker\Provider\pt_BR\PhoneNumber;

abstract class TableSeeder extends \antonyz89\seeder\TableSeeder
{

    use CreatedAtUpdatedAt;

    public function __construct(array $config = [])
    {
        parent::__construct($config);

        $this->faker->addProvider(new Address($this->faker));
        $this->faker->addProvider(new Company($this->faker));
        $this->faker->addProvider(new Person($this->faker));
        $this->faker->addProvider(new PhoneNumber($this->faker));
    }

}