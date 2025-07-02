<?php
include_once("../config/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $subjects = implode(",", $_POST['subject']);
    $languages = implode(",", $_POST['languages']);

    
    if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] == 0) {
        $imagePath = 'uploads/' . basename($_FILES['image_path']['name']);
        move_uploaded_file($_FILES['image_path']['tmp_name'], $imagePath);
    } else {
        $imagePath = $_POST['existing_image_path'];
    }

    
    $stmt = $con->prepare("UPDATE student SET firstname = ?, lastname = ?, email = ?, gender = ?, subjects = ?, languages = ?, image_path = ? WHERE id = ?");
    $stmt->bind_param("sssssssi", $firstname, $lastname, $email, $gender, $subjects, $languages, $imagePath, $id);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Student details updated successfully.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to update student details.'
        ]);
    }

    $stmt->close();
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
}
?>
