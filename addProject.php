<?php

use App\Models\Project;

if (!empty($_POST)){
    $project = new Project();
    $project->title = $_POST['title'];
    $project->description = $_POST['description'];
    $project->save();
    var_dump($_POST);
}

// uso de variables super globales
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Add Project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B"
    crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Add Project</h2>
    <form action="addProject.php" method="post">
    <label for="title">Title</label>
    <input type="text" name="title" id="title"><br/>
    <label for="description">Description</label>
    <input type="text" name="description" id="description"><br/>
    <button type="submit">Save</button>
    </form>
</body>
</html>