<?php include("header.php"); ?>
<?php
// define variables and set to empty values
$specialityId = $specialityname = "";
$specialityIdErr = $specialitynameErr = "";
$flag1 = $flag2 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["specialityId"])) {
        $specialityIdErr = "Speciality ID is required";
    } else {
        $specialityId = test_input($_POST["specialityId"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9]*$/", $specialityId)) {
            $specialityIdErr = "Only number allowed";
        } else {
            $query = "SELECT specialityId
                            FROM speciality
                            WHERE specialityId = '" . $_POST["specialityId"] . "';";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 0) {
                $specialityIdErr = "Speciality ID is NOT in the record";
            } else {
                $flag1 = true;
            }
            mysqli_free_result($result);
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["specialityname"])) {
        $specialitynameErr = "Speciality name is required";
    } else {
        $specialityname = test_input($_POST["specialityname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $specialityname)) {
            $specialitynameErr = "Only letters and white space allowed";
        } else {
            $query1 = "SELECT specialityname
                            FROM speciality
                            WHERE specialityname = '" . $_POST["specialityname"] . "';";
            $result = mysqli_query($conn, $query1);
            if (mysqli_num_rows($result) == 0) {
                $specialitynameErr = "Speciality name is NOT in the record";
            } else {
                $flag2 = true;
            }
            mysqli_free_result($result);
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['clear'])) {
        $specialityId = $specialityname = "";
        $specialityIdErr = $specialitynameErr = "";
        $flag1 = $flag2 = "";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['remove'])) {
        if ($flag1 == true || $flag2 == true) {
            $query2 = "DELETE FROM speciality 
                        WHERE specialityId = '" . $_POST["specialityId"] . "'
                        OR specialityname = '" . $_POST["specialityname"] . "';";
            mysqli_query($conn, $query2);
            $flag1 = $flag2 = "";
            include("backupdb.php"); 
        }
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

<h2 style="padding-left: 50px;"><u>Remove speciality (Can only remove if the data is NOT exists in other tables):</u></h2>
<p><span class="error" style="padding-left: 50px;">* required field</span></p>
<form method="post" style="padding-left: 100px; font-size:20px; font-weight: bold;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Speciality ID: <br><br><input type="text" name="specialityId" value="<?php echo $specialityId; ?>">
    <span class="error">* <?php echo $specialityIdErr; ?></span>
    <br>
    <p><u>OR:</u></p>
    Speciality name: <br><br><input type="text" name="specialityname" value="<?php echo $specialityname; ?>">
    <span class="error">* <?php echo $specialitynameErr; ?></span>
    <br><br><br>
    <input type="submit" style="font-weight: bold;" name="remove" value="REMOVE">
    <input type="submit" style="font-weight: bold; background-color: yellow; width: 100px; margin-left: 20px;" name="clear" value="CLEAR">
    <input type="button" style="font-weight: bold; background-color: green; width: 200px; margin-left: 20px;" value="RECORD" onclick="location.href='specialityrecord.php'">
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