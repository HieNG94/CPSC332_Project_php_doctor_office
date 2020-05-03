<?php include("header.php"); ?>
<?php
// define variables and set to empty values
$lastnameErr = $firstnameErr = $speciality = $newspeciality =  "";
$lastname = $firstname = $specialityErr = $newspecialityErr = $errmess = "";
$flag1 = $flag2 = $flag3 = $flag4 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["speciality"])) {
        $specialityErr = "Speciality is required";
    } else {
        $speciality = test_input($_POST["speciality"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $speciality)) {
            $specialityErr = "Only letters and white space allowed";
        } else {
            $query1 = "SELECT specialityId 
                            FROM speciality
                            WHERE specialityname = '" . $_POST["speciality"] . "';";
            $result = mysqli_query($conn, $query1);
            if (mysqli_num_rows($result) == 0) {
                $specialityErr = "Speciality is NOT exists";
            } else {
                $flag2 = true;
            }
        }
        mysqli_free_result($result);
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["newspeciality"])) {
        $newspecialityErr = "Speciality is required";
    } else {
        $newspeciality = test_input($_POST["newspeciality"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $newspeciality)) {
            $newspecialityErr = "Only letters and white space allowed";
        } else {
            $query1 = "SELECT specialityId 
                            FROM speciality
                            WHERE specialityname = '" . $_POST["newspeciality"] . "';";
            $result = mysqli_query($conn, $query1);
            if (mysqli_num_rows($result) == 0) {
                $newspecialityErr = "Speciality is NOT exists";
            } else {
                $flag3 = true;
            }
        }
        mysqli_free_result($result);
        if ($_POST["speciality"] == $_POST["newspeciality"]) {
            $newspecialityErr = "Cannot update the same speciality";
        } else {
            $flag4 = true;
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        if ($flag1 == true && $flag2 == true && $flag3 == true && $flag4 == true) {
            $query3 = "SELECT *
                        FROM doctorspeciality AS dsp
                        WHERE (SELECT d.doctorId 
                        FROM doctor AS d , person AS p
                        WHERE (p.lastName = '" . $_POST["lastname"] . "'
                        AND p.firstName = '" . $_POST["firstname"] . "')
                        AND p.personId = d.personId
                        GROUP BY d.doctorId) =  dsp.doctorId
                        AND ( SELECT specialityId 
                        FROM speciality
                        WHERE specialityname = '" . $_POST["speciality"] . "') = dsp.specialityId;";
            $result = mysqli_query($conn, $query3);
            if (mysqli_num_rows($result) == 0) {
                $errmess = "*The record is NOT exists";
            } else {
                $query2 = "UPDATE doctorspeciality AS dsp 
                                SET dsp.specialityId = (SELECT specialityId 
                            FROM speciality
                            WHERE specialityname = '" . $_POST["newspeciality"] . "') 
                                WHERE (SELECT d.doctorId 
                            FROM doctor AS d , person AS p
                            WHERE (p.lastName = '" . $_POST["lastname"] . "'
                            AND p.firstName = '" . $_POST["firstname"] . "') 
                            AND p.personId = d.personId
                            GROUP BY d.doctorId) = dsp.doctorId
                            AND 
                            (SELECT specialityId 
                            FROM speciality
                            WHERE specialityname = '" . $_POST["speciality"] . "') = dsp.specialityId;";
                mysqli_query($conn, $query2);
                mysqli_free_result($result);
                include("backupdb.php"); 
                header("location:doctorspecialities.php");
            }
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['clear'])) {
        $lastnameErr = $firstnameErr = $speciality = $newspeciality =  "";
        $lastname = $firstname = $specialityErr = $newspecialityErr = $errmess = "";
        $flag1 = $flag2 = $flag3 = "";
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

<h2 style="padding-left: 50px;"><u>Update doctor speciality:</u></h2>
<p><span class="error" style="padding-left: 50px;">* required field</span></p>
<form method="post" style="padding-left: 100px; font-size:20px; font-weight: bold;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Last name: <br><br><input type="text" name="lastname" value="<?php echo $lastname; ?>">
    <span class="error">* <?php echo $lastnameErr; ?></span>
    <br><br>
    First name: <br><br><input type="text" name="firstname" value="<?php echo $firstname; ?>">
    <span class="error">* <?php echo $firstnameErr; ?></span>
    <br><br>
    Old Speciality: <br><br><input type="text" name="speciality" value="<?php echo $speciality; ?>">
    <span class="error">* <?php echo $specialityErr; ?></span>
    <br><br>
    New speciality: <br><br><input type="text" name="newspeciality" value="<?php echo $newspeciality; ?>">
    <span class="error">* <?php echo $newspecialityErr; ?></span>
    <br><br>
    <span class="error" style="color: red"><?php echo $errmess; ?></span>
    <br><br>
    <input type="submit" style="font-weight: bold;" name="update" value="UPDATE">
    <input type="submit" style="font-weight: bold; margin-left:20px; width:100px; background-color:orange" name="clear" value="CLEAR">
    <input type="button" style="font-weight: bold; background-color: green; width: 200px; margin-left: 20px;" name="record" value="RECORD" onclick="location.href='docspecrecord.php'">
    <input type="button" style="font-weight: bold; width: 200px; margin-left: 20px;" value="BACK" onclick="location.href='doctorspecialities.php'">
</form>
<?php include("footer.php"); ?>