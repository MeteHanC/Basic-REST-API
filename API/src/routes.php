<?php

use Slim\Http\Request;

use Slim\Http\Response;

// Routes

 $app->get('/', function (Request $request, Response $response, array $args) {
    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
 });

 $app->get('/get_names', 'StudentController:getStudentNames');
 $app->get("/get_all", "StudentController:getStudents");
 $app->post("/add_student/[{id}[/{name}]]", "StudentController:addStudent");
