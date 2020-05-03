<?php include("header.php"); ?>
<?php

$lastnameErr = $firstnameErr = $vIdErr = "";
$lastname = $firstname = $vId = $errmess = "";
$flag1 = $flag2 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && $flag2 != true) {
    if (empty($_POST["lastname"])) {
        $lastnameErr = "Last name is required";
    } else {
        $lastname = test_input($_POST["lastname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $lastname)) {
            $lastnameErr = "Only letters and white space allowed";
        }
    }
    if (empty($_POST["firstname"])) {
        $firstnameErr = "First name is required";
    } else {
        $firstname = test_input($_POST["firstname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $firstname)) {
            $firstnameErr = "Only letters and white space allowed";
        }
    }
    if (!empty($_POST["lastname"]) && !empty($_POST["firstname"])) {
        $query = "SELECT d.doctorId 
                        FROM doctor AS d , person AS p
                        WHERE (p.lastName = '" . $_POST["lastname"] . "'
                        AND p.firstName = '" . $_POST["firstname"] . "')
                        AND p.personId = d.personId
                        GROUP BY d.doctorId;";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 0) {
            $errmess = "Cannot find doctor " . $_POST["lastname"] . " " .
                $_POST["firstname"];
        } else {
            $flag1 = true;
        }
        mysqli_free_result($result);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $flag1 != true) {
    if (empty($_POST["vId"])) {
        $vIdErr = "Visit ID is required";
    } else {
        $vId = test_input($_POST["vId"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z0-9 ]*$/", $vId)) {
            $vIdErr = "No special characters allowed";
        } else {
            $query1 = "SELECT visitId 
                        FROM patientvisit
                        WHERE visitId = '" . $_POST["vId"] . "';";
            $result = mysqli_query($conn, $query1);
            if (mysqli_num_rows($result) == 0) {
                $vIdErr = "Visit ID is NOT in the record";
            } else {
                $flag2 = true;
            }
        }
        mysqli_free_result($result);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['clear'])) {
        $lastnameErr = $firstnameErr = $vIdErr = "";
        $lastname = $firstname = $vId = $errmess = "";
        $flag1 = $flag2 = "";
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2 style="padding-left: 50px;"><u>Search patient:</u></h2>
<p><span class="error" style="padding-left: 50px;">* required field</span></p>
<form method="post" style="padding-left: 100px; font-size:20px; font-weight: bold;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Visit ID: <br><br><input type="text" name="vId" value="<?php echo $vId; ?>">
    <span class="error">* <?php echo $vIdErr; ?></span>
    <br><br>
    <u>Or</u>
    <br><br>
    Doctor last name: <br><br><input type="text" name="lastname" value="<?php echo $lastname; ?>">
    <span class="error">* <?php echo $lastnameErr; ?></span>
    <br><br>
    Doctor first name: <br><br><input type="text" name="firstname" value="<?php echo $firstname; ?>">
    <span class="error">* <?php echo $firstnameErr; ?></span>
    <br><br>
    <span class="error" style="color: red"><?php echo $errmess; ?></span>
    <br><br>
    <input type="submit" style="font-weight: bold;" name="search" value="SEARCH">
    <input type="submit" style="font-weight: bold; margin-left:50px; width:100px; background-color:orange" name="clear" value="CLEAR">
    <input type="button" style="font-weight: bold; width: 200px; margin-left: 20px;" value="BACK" onclick="location.href='pvisit.php'">
    <br><br><br>
</form>
<div>
    <center>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['search'])) {
                if ($flag1 == true || $flag2 == true) {
                    $sql = "SELECT pvi.visitId AS vId, pvi.patientId AS pId, pav.lastName AS pln, pav.firstName AS pfn, 
                            pvi.doctorId AS dId, dv.lastName AS dln, dv.firstName AS dfn, (SELECT p.phone FROM
                            patient AS p WHERE p.patientId = pvi.patientId) AS phone,pvi.visitdate AS vd, pvi.docnote AS dn
                            FROM patientvisit AS pvi, patientview AS pav, doctorview AS dv
                            WHERE (pvi.patientId = pav.patientId
                            AND dv.doctorId = (SELECT doctorId FROM doctorview
                            WHERE lastName = '" . $_POST["lastname"] . "'
                            AND firstName ='" . $_POST["firstname"] . "')
                            AND pvi.doctorId = (SELECT doctorId FROM doctorview
                            WHERE lastName = '" . $_POST["lastname"] . "'
                            AND firstName ='" . $_POST["firstname"] . "'))
                            OR (pvi.visitId = '" . $_POST["vId"] . "'
                            AND dv.doctorId = pvi.doctorId
                            AND pvi.patientId = pav.patientId)
                            GROUP BY pvi.patientId;";
                    $result = mysqli_query($conn, $sql);
                    print "<pre>";
                    print "<table border=2>";
                    print "<tr><td>Visit ID</td><td>Patient ID</td><td>P last name</td><td>P first name</td><td>Doctor ID</td>
                    <td>D last name</td><td>D first name</td><td> Phone</td><td>Visit date</td><td>Doctor note</td>";
                    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                        print "\n";
                        print "<tr><td>$row[vId]</td><td>$row[pId]</td><td>$row[pln]</td><td> $row[pfn]</td>
                        <td> $row[dId]</td><td>$row[dln]</td><td>$row[dfn]</td><td>$row[phone]</td>
                        <td>$row[vd]</td><td>$row[dn]</td></tr>";
                    }
                    print "</table>";
                    print "</pre>";
                    mysqli_free_result($result);
                    $lastnameErr = $firstnameErr = $vIdErr = "";
                    $lastname = $firstname = $vId = $errmess = "";
                    $flag1 = $flag2 = "";
                }
            }
        }
        ?>
    </center>
</div>
<?php include("footer.php"); ?>