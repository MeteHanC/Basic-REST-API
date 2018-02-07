<?php

use Slim\Http\Request;

use Slim\Http\Response;

// Routes

 $app->get('/get_names', 'StudentController:getStudentNames');
 $app->get("/get_all", "StudentController:getStudents");
 $app->post("/add_student/[{id}[/{name}]]", "StudentController:addStudent");
