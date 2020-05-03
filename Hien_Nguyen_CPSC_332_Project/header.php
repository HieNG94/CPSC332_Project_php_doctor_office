<!DOCTYPE html>
<html>

<head>
    <title>CPSC 332 Project</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="header" style="background-color: #cccccc">
        <h1>DOCTOR'S OFFICE</h1>
        <p>A project of CPSC 332 class.</p>
    </div>
    <div class="row">
        <div class="leftcolumn">
            <div class="card" style="background-color: #cccccc; height:680px">
                <?php include("connectiondata.php"); ?>
                <li><a href="index.php">HOME</a></li>
                <li><a href="doctorspecialities.php">DOCTOR LIST</a></li>
                <li><a href="patient.php">PATIENT LIST</a></li>
                <li><a href="pvisit.php">VISIT RECORD</a></li>
                <li><a href="presciption.php">PRESCIPTION LIST</a></li>
                <li><a href="test.php">TEST LIST</a></li>
            </div>
        </div>
        <div class="rightcolumn">
            <div class="card">