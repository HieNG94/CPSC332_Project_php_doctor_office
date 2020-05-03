<?php include("header.php"); ?>
<?php
$vIdErr = $pIdErr = $dId = $docnote = "";
$vId = $pId = $dIdErr = "";
$flag1 = $flag2 = $flag3 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["vId"])) {
        $vIdErr = "Visit ID is required";
    } else {
        $vId = test_input($_POST["vId"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9 ]*$/", $vId)) {
            $vIdErr = "Only numbers allowed";
        } else {
            $query1 = "SELECT visitId 
                        FROM patientvisit
                        WHERE visitId = '" . $_POST["vId"] . "';";
            $result = mysqli_query($conn, $query1);
            if (mysqli_num_rows($result) > 0) {
                $vIdErr = "Visit ID is already exists";
            } else {
                $flag1 = true;
            }
        }
        mysqli_free_result($result);
    }
    if (empty($_POST["pId"])) {
        $pIdErr = "Patient ID is required";
    } else {
        $pId = test_input($_POST["pId"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9 ]*$/", $pId)) {
            $pIdErr = "Only numbers allowed";
        } else {
            $query2 = "SELECT patientId
                        FROM patient
                        WHERE patientId = '" . $_POST["pId"] . "';";
            $result = mysqli_query($conn, $query2);
            if (mysqli_num_rows($result) == 0) {
                $pIdErr = "Patient ID is NOT in the record";
            } else {
                $flag2 = true;
            }
        }
        mysqli_free_result($result);
    }

    if (empty($_POST["dId"])) {
        $dIdErr = "Doctor ID is required";
    } else {
        $dId = test_input($_POST["dId"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z0-9 ]*$/", $dId)) {
            $dIdErr = "No special characters allowed";
        } else {
            $query3 = "SELECT doctorId 
                        FROM doctor
                        WHERE doctorId = '" . $_POST["dId"] . "';";
            $result = mysqli_query($conn, $query3);
            if (mysqli_num_rows($result) == 0) {
                $dIdErr = "Doctor ID is NOT in the record";
            } else {
                $flag3 = true;
            }
        }
        mysqli_free_result($result);
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        if ($flag1 == true && $flag2 == true && $flag3 == true) {
            $query4 = "INSERT INTO patientvisit VALUES('" . $_POST["vId"] . "',
                '" . $_POST["pId"] . "','" . $_POST["dId"] . "', CURRENT_TIMESTAMP(), '" . $_POST["docnote"] . "')";
            mysqli_query($conn, $query4);
            include("backupdb.php"); 
            header("location:pvisit.php");
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['clear'])) {
        $vIdErr = $pIdErr = $dId = $docnote = "";
        $vId = $pId = $dIdErr = "";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['docnote'])) {
        $docnote = "";
    } else {
        $docnote = test_input($_POST["docnote"]);
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

<h2 style="padding-left: 50px;"><u>Add visit:</u></h2>
<p><span class="error" style="padding-left: 50px;">* required field</span></p>
<form method="post" style="padding-left: 100px; font-size:20px; font-weight: bold;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Visit ID: <br><br><input type="text" name="vId" value="<?php echo $vId; ?>">
    <span class="error">* <?php echo $vIdErr; ?></span>
    <br><br>
    Patient ID: <br><br><input type="text" name="pId" value="<?php echo $pId; ?>">
    <span class="error">* <?php echo $pIdErr; ?></span>
    <br><br>
    Doctor ID: <br><br><input type="text" name="dId" value="<?php echo $dId; ?>">
    <span class="error">* <?php echo $dIdErr; ?></span>
    <br><br>
    Doctor Note: <br><br><textarea rows="4" cols="70" name="docnote" style="font-size: 20px" value="<?php echo $docnote; ?>"></textarea>
    <br><br>
    <input type="submit" style="font-weight: bold;" name="add" value="ADD">
    <input type="submit" style="font-weight: bold; margin-left:50px; width:100px; background-color:orange" name="clear" value="CLEAR">
    <input type="button" style="font-weight: bold; background-color: green; width: 200px; margin-left: 20px;" name="record" value="RECORD" onclick="location.href='pvisitrecord.php'">
    <input type="button" style="font-weight: bold; width: 200px; margin-left: 20px;" value="BACK" onclick="location.href='pvisit.php'">
</form>
<?php include("footer.php"); ?>