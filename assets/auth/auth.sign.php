<?php
session_start();
require_once("../../db/connexion.php");

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Email = $conn->real_escape_string($_POST['Email']);
    $Password = $conn->real_escape_string($_POST['Password']);

    if (empty($Email) || empty($Password)) {
        $response['message'] = 'Le  champ est  obligatoire';
    } else {
        $sql = "SELECT * FROM users WHERE Email='$Email' AND Password='$Password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $_SESSION['id'] = $user['id'];
            $_SESSION['Email'] = $user['Email'];
            $_SESSION['Role'] = $user['Role'];

            $response['success'] = true;
            $response['message'] = 'Successuful';
            $response['redirect_url'] = $user['Role'] == 'admin' ? '../../assets/pages/index.php' : ($user['Role'] == 'user' ? '../../assets/pages/indexs.php' : '../../assets/pages/indexs1.php');
        } else {
            $response['message'] = 'Email et/ou mot de passe incorrect';
        }
    }
    echo json_encode($response);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT id,Email,Password,Role, RessourceID FROM users";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $users = array();
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        echo json_encode(array('success' => true, 'users' => $users));
    } else {
        echo json_encode(array('success' => false, 'message' => 'No users found'));
    }
}
