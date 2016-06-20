<?php

require 'Slim/Slim.php';
require 'dbConnection.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$app->get('/user', 'getUsers');
$app->post('/user', 'addUser');
$app->put('/user/:id', 'updateUser');
$app->delete('/user/:id', 'deleteUser');
$app->run();


function getUsers() {
    try {
        $db = getConnection();
        $stmt = $db->query('SELECT * FROM users ORDER BY id DESC');
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($data);
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function addUser() {
    global $app;
    $data = json_decode($app->request()->getBody());    
    $sql = "INSERT INTO users (email, forename, surname) VALUES (:email, :forename, :surname)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("email", $data->email);
        $stmt->bindParam("forename", $data->forename);
        $stmt->bindParam("surname", $data->surname);    
        $stmt->execute();
        $data->id = $db->lastInsertId();      
        echo json_encode($data); 
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function updateUser($id) {
    global $app;
    $data = json_decode($app->request()->getBody());   
    $sql = "UPDATE users SET email=:email, forename=:forename, surname=:surname WHERE id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("email", $data->email);
        $stmt->bindParam("surname", $data->surname);
        $stmt->bindParam("forename", $data->forename);     
        $stmt->bindParam("id", $id);
        $stmt->execute();       
        echo json_encode($data); 
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function deleteUser($id) {
    $sql = "DELETE FROM users WHERE id = :id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->execute();
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
