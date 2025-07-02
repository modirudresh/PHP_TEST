<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("../config/connection.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

    header('Content-Type: application/json');

$response = ['status' => 'error', 'message' => 'Something went wrong.', 'errors' => []];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['firstname'] ?? '');
    $lastName = trim($_POST['lastname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $subjects = $_POST['subject'] ?? [];
    $languages = $_POST['languages'] ?? [];

    $errors = [];


    $checkStmt = $con->prepare("SELECT id FROM student WHERE email = ?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkStmt->store_result();
    if ($checkStmt->num_rows > 0) {
        $errors['email'] = 'Email already exists.';
    }
    $checkStmt->close();

    $imagePath = '';
    if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/uploads/';
        $uploadDirRelative = 'uploads/';

        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $tmpName = $_FILES['image_path']['tmp_name'];
        $originalName = basename($_FILES['image_path']['name']);
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($ext, $allowed)) {
            $errors['image_path'] = 'Allowed image types: jpg, jpeg, png, gif.';
        } elseif ($_FILES['image_path']['size'] > 2 * 1024 * 1024) {
            $errors['image_path'] = 'Max file size is 2MB.';
        } else {
            $newFileName = uniqid('img_', true) . '.' . $ext;
            $absolutePath = $uploadDir . $newFileName;
            $imagePath = $uploadDirRelative . $newFileName;

            if (!move_uploaded_file($tmpName, $absolutePath)) {
                $errors['image_path'] = 'Failed to move uploaded file.';
            }
        }
    } else {
        $errors['image_path'] = 'Please upload a profile image.';
    }

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $subjectStr = implode(', ', $subjects);
        $languageStr = implode(', ', $languages);

        $stmt = $con->prepare("
            INSERT INTO student 
            (firstname, lastname, email, password, image_path, gender, subjects, languages, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");

        if ($stmt === false) {
            $response['message'] = 'Database error: ' . $con->error;
        } else {
            $stmt->bind_param(
                'ssssssss',
                $firstName,
                $lastName,
                $email,
                $hashedPassword,
                $imagePath,
                $gender,
                $subjectStr,
                $languageStr
            );

            if ($stmt->execute()) {
                $response['status'] = 'success';
                $response['message'] = 'Student added successfully.';
                header('index.php');
            } else {
                $response['message'] = 'Insert failed: ' . $stmt->error;
            }

            $stmt->close();
        }
    }
    } else {
        $response['errors'] = $errors;
        $response['message'] = 'Please correct the errors below.';
    }

    echo json_encode($response);
    exit;
}
?>
