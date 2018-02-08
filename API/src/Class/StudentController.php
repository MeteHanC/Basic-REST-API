<?php

namespace REST;

use phpDocumentor\Reflection\Types\Integer;
use Slim\Http\Request;
use Slim\Http\Response;

class StudentController
{
    protected $Student_DB;

    public function __construct(IStudentRepository $Student_DB)
    {
        $this->Student_DB=$Student_DB;
    }

    public function getStudents(Request $request, Response $response, array $args)
    {
        return $this->Student_DB->getAll($response);
    }

    public function getStudentNames(Request $request, Response $response, array $args)
    {
        if (array_key_exists("id", $args)) {
            $id=$args["id"];
            if (!is_numeric($id)){
                $n_response = $response->withStatus(400);
                return $n_response;
            }
        }
        else {
            $n_resp = $response->withStatus(400);
            return $n_resp;
        }

        return $this->Student_DB->getStudentNames($id, $response);
    }

    public function addStudent(Request $request, Response $response, array $args)
    {
        if (array_key_exists("id", $args) && array_key_exists("name", $args)) {
            $id = $args["id"];
            $name = $args["name"];
            if (!is_numeric($id) || !ctype_alpha($name)) {
                $n_response = $response->withStatus(400);
                return $n_response;
            }
        }
        else {
            $n_resp = $response->withStatus(400);
            return $n_resp;
        }

        return $this->Student_DB->addStudent($response, $id, $name);
    }
}
