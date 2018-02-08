<?php

namespace REST;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\PDO\Database;


interface IStudentRepository
{
    //Functions to be defined
    public function __construct();
    public function getStudentNames($id, $response);
    public function getAll(Response $response);
    public function addStudent(Response $response, $name, $id);
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

    public function getStudentNames($id,$response)
    {
        $stmt = $this->pdo->prepare('SELECT name FROM Students where id = :id');
        $stmt->bindParam(":id", $id, \Slim\PDO\Database::PARAM_STR);
        $stmt->execute();
        $val = $stmt->fetch();
        $n_resp = $response->withJson($val,200);

        return $n_resp;
    }

    public function getAll(Response $response)
    {
        $array_val = array();
        $sql = 'SELECT * FROM Students';
        foreach ($this->pdo->query($sql) as $row) {
            $array_val[$row["id"]]=$row["name"];
        }
        $n_resp = $response->withJson($array_val,200);

        return $n_resp;
    }

    public function addStudent(Response $response, $id, $name)
    {

        $stmt = $this->pdo->prepare('INSERT into Students(id,name) values(:id,:namee)');
        $stmt->bindParam(":id", $id, \Slim\PDO\Database::PARAM_STR);
        $stmt->bindParam(":namee", $name, \Slim\PDO\Database::PARAM_STR);
        $stmt->execute();
        $n_response = $response->withStatus(201);

        return $n_response;
    }
}
