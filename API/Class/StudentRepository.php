<?php

namespace REST;

use Slim\PDO\Database;

require "../vendor/autoload.php";

interface IStudentRepository
{
    //Functions to be defined
    public function __construct();
    public function getStudentNames();
    public function getAll();
    public function addStudent($name, $id);
    public function updateName($id, $new_name);
}


class StudentRepository implements IStudentRepository
{
    //Queries and MYSQL connection
    protected $pdo;

    public function __construct()
    {
        //Database connection
        $dsn = 'mysql:host=localhost;dbname=College_DB;charset=utf8';
        $usr = 'root';
        $pwd = '';

        $this->pdo = new \Slim\PDO\Database($dsn, $usr, $pwd);
    }

    public function getStudentNames()
    {
        $array_val = array();
        $sql = 'SELECT name FROM Students';
        $cntrl=0;
        foreach ($this->pdo->query($sql) as $row) {
            $array_val[$cntrl]=$row["name"];
            $cntrl++;
        }

        return json_encode($array_val)  ;
    }

    public function getAll()
    {
        $array_val = array();
        $sql = 'SELECT * FROM Students';

        foreach ($this->pdo->query($sql) as $row) {
            $array_val[$row["id"]]=$row["name"];
        }

        return json_encode($array_val);
    }

    public function addStudent($id, $name)
    {

        $stmt = $this->pdo->prepare('INSERT into Students(id,name) values(:id,:namee)');
        $stmt->bindParam(":id", $id, \Slim\PDO\Database::PARAM_STR);
        $stmt->bindParam(":namee", $name, \Slim\PDO\Database::PARAM_STR);

        $stmt->execute();
    }

    public function updateName($id, $new_name)
    {
        $stmt = $this->pdo->prepare('UPDATE Students set name=:namee where id=:id');
        $stmt->bindParam(":id", $id, \Slim\PDO\Database::PARAM_STR);
        $stmt->bindParam(":namee", $new_name, \Slim\PDO\Database::PARAM_STR);

        $stmt->execute();
    }
}
