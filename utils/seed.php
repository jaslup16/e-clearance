<?php
class Seed
{
    public $db;
    protected $userData;

    public function __construct($userSeed, $host, $user, $password, $database, $port)
    {
        $this->db = new mysqli($host, $user, $password, $database, $port);
        $this->userData = $userSeed;
    }

    public function run()
    {
        $this->seedSuperAdmin();
        $this->seedAdmin();
        $this->seedCoAdmin();
        $this->seedDean();
        $this->seedStaff();
        $this->seedStudent();
    }

    protected function seedSuperAdmin()
    {
        $email = $this->userData['superadmin']['email'];
        $password = $this->userData['superadmin']['password'];

        try {
            $userSql = "INSERT INTO Users (email, password) value('{$email}', '{$password}')";
            $this->addUser($userSql, 1);
            echo "\nSuccesfull superadmin seed";
        } catch (Exception $e) {
            echo "\nException caught: " . $e->getMessage() . PHP_EOL;
        }
    }

    protected function seedAdmin()
    {
        $email = $this->userData['admin']['email'];
        $password = $this->userData['admin']['password'];
        try {
            $userSql = "INSERT INTO Users (email, password) value('{$email}', '{$password}')";
            $this->addUser($userSql, 2);
            echo "\nSuccesfull admin seed";
        } catch (Exception $e) {
            echo "\nException caught: " . $e->getMessage() . PHP_EOL;
        }
    }

    protected function seedCoAdmin()
    {
        try {
            foreach ($this->userData["coadmin"] as $coadmin) {
                $email = $coadmin['email'];
                $password = $coadmin['password'];

                $userSql = "INSERT INTO Users (email, password) values ('{$email}', '{$password}')";
                $this->addUser($userSql, 3);
            }

            echo "\nSuccesfull coadmin seed";
        } catch (Exception $e) {
            echo "\nException caught: " . $e->getMessage() . PHP_EOL;
        }
    }

    protected function seedDean()
    {
        try {
            foreach ($this->userData["dean"] as $dean) {
                $email = $dean['email'];
                $password = $dean['password'];
                $name = $dean['name'];
                $divisionId = $dean["dean_division_id"];

                $userSql = "INSERT INTO Users (email, password) values ('{$email}', '{$password}')";
                $userId =  $this->addUser($userSql, 4);

                $deanSql = "INSERT INTO Deans (name, dean_division_id, dean_user_id) values ('{$name}', {$divisionId}, {$userId})";
                $this->db->query($deanSql);
            }
            echo "\nSuccesfull dean seed";
        } catch (Exception $e) {
            echo "\nException caught: " . $e->getMessage() . PHP_EOL;
        }
    }

    protected function seedStaff()
    {

        try {
            foreach ($this->userData["staff"] as $staff) {
                $email = $staff['email'];
                $password = $staff['password'];
                $name = $staff['name'];
                $officeId = $staff["staff_office_id"];

                $userSql = "INSERT INTO Users (email, password) value('{$email}', '{$password}')";
                $userId = $this->addUser($userSql, 5);

                $staffSql = "INSERT into Staffs (name, staff_office_id, staff_user_id) values ('{$name}', {$officeId}, {$userId})";
                $this->db->query($staffSql);
            }
            echo "\nSuccesfull staff seed";
        } catch (Exception $e) {
            echo "\nException caught: " . $e->getMessage() . PHP_EOL;
        }
    }


    protected function seedStudent()
    {
        // $this->dd($this->userData["student"]);
        try {
            foreach ($this->userData["student"] as $student) {
                
                $email = $student['email'];
                $password = $student['password'];
                $name = $student['name'];
                $course = $student['course'];
                $year = $student['year'];
                $divisionId = $student['student_division_id'];

                $userSql = "INSERT INTO Users (email, password) values ('{$email}', '{$password}')";
                $userId =  $this->addUser($userSql, 6);

                $studentSql = "INSERT INTO Students (name, course, year, student_division_id, student_user_id) values ('{$name}', '{$course}', {$year}, {$divisionId}, {$userId})";
                $this->db->query($studentSql);
                $studentId = $this->db->insert_id;

                $clearanceSql = "INSERT INTO Clearances (student_id) values ({$studentId})";
                $this->db->query($clearanceSql);
            }
            echo "\nSuccesfull student seed";
        } catch (Exception $e) {
            echo "\nException caught: " . $e->getMessage() . PHP_EOL;
        }
    }

    protected function addUser($sql, $level)
    {
        $this->db->query($sql);
        $userId = $this->db->insert_id;
        $this->addRole($userId, $level);
        return $userId;
    }

    protected function addRole($userId, $level)
    {
        $roleSql = "INSERT INTO Roles (user_id, level_id) value({$userId}, {$level})";
        $this->db->query($roleSql);
    }
    public function dd($value)
    {
        print_r($value);
        die();
    }
}


const DATA_PATH = __DIR__;
$config = require_once "config.php";
require DATA_PATH . "/data/user.php";

$seed = new Seed($userSeed, ...$config["database"]);
$seed->run();
