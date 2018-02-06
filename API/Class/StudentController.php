<?php

namespace REST;

class StudentController
{
    protected $Student_DB;

    public function __construct(IStudentRepository $Student_DB)
    {
        $this->Student_DB=$Student_DB;
    }

    public function getStudents()
    {
        return $this->Student_DB->getAll();
    }

    public function getStudentNames()
    {
        return $this->Student_DB->getStudentNames();
    }

    public function addStudent($request, $response, array $args)
    {
        if (array_key_exists("id", $args) && array_key_exists("name", $args)) {
            $id = $args["id"];
            $name = $args["name"];
            if (!is_numeric($id) || !ctype_alpha($name)) {
                $n_response = $response->withStatus(400);
                return $n_response;
            }
        }
        $this->Student_DB->addStudent($id, $name);
        $n_response = $response->withStatus(200);
        return $n_response;
    }
}
