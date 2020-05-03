<?php include("header.php"); ?>
<?php
$vIdErr = "";
$vId = $docnote = "";
$flag1 = "";

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
            if (mysqli_num_rows($result) == 0) {
                $vIdErr = "Visit ID is NOT in the record";
            } else{
                $flag1 = true;
            }
        }
        mysqli_free_result($result);
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        if ($flag1 == true) {
            $query2 = "UPDATE patientvisit 
            SET docnote = '" . $_POST["docnote"] . "'
            WHERE visitId = '" . $_POST["vId"] . "';";
            mysqli_query($conn, $query2);
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

<h2 style="padding-left: 50px;"><u>Update doctor note:</u></h2>
<p><span class="error" style="padding-left: 50px;">* required field</span></p>
<form method="post" style="padding-left: 100px; font-size:20px; font-weight: bold;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Visit ID: <br><br><input type="text" name="vId" value="<?php echo $vId; ?>">
    <span class="error">* <?php echo $vIdErr; ?></span>
    <br><br>
    Doctor Note: <br><br><textarea rows="4" cols="70" name="docnote" style="font-size: 20px" value="<?php echo $docnote; ?>"></textarea>
    <br><br>
    <input type="submit" style="font-weight: bold;" name="update" value="UPDATE">
    <input type="submit" style="font-weight: bold; margin-left:50px; width:100px; background-color:orange" name="clear" value="CLEAR">
    <input type="button" style="font-weight: bold; background-color: green; width: 200px; margin-left: 20px;" name="record" value="RECORD" onclick="location.href='pvisitrecord.php'">
    <input type="button" style="font-weight: bold; width: 200px; margin-left: 20px;" value="BACK" onclick="location.href='pvisit.php'">
</form>
<?php include("footer.php"); ?>