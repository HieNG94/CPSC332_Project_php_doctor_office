<?php include("header.php"); ?>
<?php
$lastnameErr = $firstnameErr = $speciality = "";
$lastname = $firstname = $specialityErr = $errmess = "";
$flag1 = $flag2 = "";

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
    if (isset($_POST['add'])) {
        if ($flag1 == true && $flag2 == true) {
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
            if (mysqli_num_rows($result) > 0) {
                $errmess = "*The record is already exists";
            } else {
                $query2 = "INSERT INTO doctorspeciality VALUES((SELECT d.doctorId 
                            FROM doctor AS d , person AS p
                            WHERE (p.lastName = '" . $_POST["lastname"] . "'
                            AND p.firstName = '" . $_POST["firstname"] . "')
                            AND p.personId = d.personId
                            GROUP BY d.doctorId), (SELECT specialityId 
                            FROM speciality
                            WHERE specialityname = '" . $_POST["speciality"] . "'));";
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
        $lastnameErr = $firstnameErr = $speciality = "";
        $lastname = $firstname = $specialityErr = "";
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

<h2 style="padding-left: 50px;"><u>Add doctor speciality:</u></h2>
<p><span class="error" style="padding-left: 50px;">* required field</span></p>
<form method="post" style="padding-left: 100px; font-size:20px; font-weight: bold;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Last name: <br><br><input type="text" name="lastname" value="<?php echo $lastname; ?>">
    <span class="error">* <?php echo $lastnameErr; ?></span>
    <br><br>
    First name: <br><br><input type="text" name="firstname" value="<?php echo $firstname; ?>">
    <span class="error">* <?php echo $firstnameErr; ?></span>
    <br><br>
    Speciality: <br><br><input type="text" name="speciality" value="<?php echo $speciality; ?>">
    <span class="error">* <?php echo $specialityErr; ?></span>
    <br><br>
    <span class="error" style="color: red"><?php echo $errmess; ?></span>
    <br><br>
    <input type="submit" style="font-weight: bold;" name="add" value="ADD">
    <input type="submit" style="font-weight: bold; margin-left:50px; width:100px; background-color:orange" name="clear" value="CLEAR">
    <input type="button" style="font-weight: bold; background-color: green; width: 200px; margin-left: 20px;" name="record" value="RECORD" onclick="location.href='docspecrecord.php'">
    <input type="button" style="font-weight: bold; width: 200px; margin-left: 20px;" value="BACK" onclick="location.href='doctorspecialities.php'">
</form>
<h2 style="margin-left: 50px"><br><u>Specialities list: </u></h2>
<div style="margin-left: 200px">
    <?php
    $query4 = "SELECT specialityId AS spId, specialityname AS spn
        FROM speciality";
    $result = mysqli_query($conn, $query4);
    print "<pre>";
    print "<table border=2>";
    print "<tr><td>ID</td><td>Name</td>";
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        print "\n";
        print "<tr><td>$row[spId]</td><td>$row[spn]</td></tr>";
    }
    print "</table>";
    print "</pre>";
    mysqli_free_result($result);
    ?>
</div>
<?php include("footer.php"); ?>