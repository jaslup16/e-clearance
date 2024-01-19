<?php
require_once "vendor/autoload.php";

$faker = Faker\Factory::create();

$userSeed = [
    "superadmin" => [
        "email" => "super@admin.com",
        "password" => "superadmin",
    ],
    "admin" => [
        "email" => "admin@admin.com",
        "password" => "admin",
    ],
    "coadmin" => [
        [
            "email" => "coadmin1@admin.com",
            "password" => "coadmin1",
        ],
        [
            "email" => "coadmin2@admin.com",
            "password" => "coadmin2",
        ],
    ],
    "staff" => generateStaff($faker),
    "student" => generateStudent($faker),
    "dean" => generateDean($faker)
];


/**
 * @param \Faker\Generator
 * @return array
 */
function generateStaff($faker)
{
    $office = array("DSCC", "LIRC", "CIMS", "LABORATORY", "CSG", "CASHIER", "REGISTRAR");
    $staff = [];
    for ($x = 0; $x < count($office); $x++) {
        $stack = [
            "email" => $faker->unique->email(),
            "password" => $faker->unique->userName(),
            "name" => $faker->name(),
            "staff_office_id" => $x + 1,
        ];
        array_push($staff, $stack);
    }
    return [...$staff];
}

/**
 * @param \Faker\Generator
 * @param array $course
 * @return array
 */
function generateStudent($faker)
{
    $division = array("CCIS", "CEDAS", "COE", "CHS", "CABE");
    $course = [
        ["BSIT", "BSCS"], ["BSED", "BSPE"], ["BSC", "BSCE"], ["BSN", "BSP"], ["BSA", "BSMA"]
    ];

    $students = [];
    for ($x = 0; $x < count($division); $x++) {
        for ($i = 0; $i < 10; $i++) {
            $stack = [
                "email" => $faker->unique->email(),
                "password" => $faker->unique->userName(),
                "name" => $faker->name(),
                "course" => $course[$x][rand(0, 1)],
                "year" => rand(1, 4),
                "student_division_id" => $x + 1,
            ];
            array_push($students, $stack);
        }
    }
    return [...$students];
}

/**
 * @param \Faker\Generator
 * @param array $course
 * @return array
 */
function generateDean($faker)
{
    $division = array("CCIS", "CEDAS", "COE", "CHS", "CABE");
    $deans = [];
    for ($x = 0; $x < count($division); $x++) {
        $stack = [
            "email" => $faker->unique->email(),
            "password" => $faker->unique->userName(),
            "name" => $faker->name(),
            "dean_division_id" => $x + 1
        ];
        array_push($deans, $stack);
    }
    return [...$deans];
}
