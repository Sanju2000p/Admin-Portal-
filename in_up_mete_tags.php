<?php
require_once("fs_world.php");
$response = 0;
$meta_id = $_POST['meta_id'] ?? null;
$meta_name = $_POST['meta_name'] ?? null;
$meta_property = $_POST['meta_property'] ?? null;
$content = $_POST['content'] ?? null;
$menu_id = $_POST['menu_id'] ?? null;
$tag_id = $_POST['tag_id'] ?? null;
$course_id = $_POST['course_id'] ?? null;

if (!empty($meta_id)) {
    // Update existing meta information
    $UpdateData = mysqli_query($connection, "UPDATE meta SET name ='$meta_name', property ='$meta_property', content='$content', menu_id='$menu_id', tag_id='$tag_id', course_id='$course_id' WHERE meta_id='$meta_id' AND status='1'") or die(mysqli_error($connection));
    if ($UpdateData) {
        $response = 2; // Update successful
    } else {
        $response = -2; // Update failed
    }
} else {
    // Insert new meta information
    $InsertData = mysqli_query($connection, "INSERT INTO meta (name ,property, content, menu_id, tag_id, course_id) VALUES ('$meta_name', '$meta_property', '$content', '$menu_id', '$tag_id', '$course_id')") or die(mysqli_error($connection));
    if ($InsertData) {
        $response = 1; // Insertion successful
    } else {
        $response = -1; // Insertion failed
    }
}

// Send the response back to AJAX request
echo $response;
?>
