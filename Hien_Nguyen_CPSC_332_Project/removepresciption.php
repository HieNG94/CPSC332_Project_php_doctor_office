<?php include("header.php"); ?>
<?php
// define variables and set to empty values
$presciptionId = $presciptionname = "";
$presciptionIdErr = $presciptionnameErr = "";
$flag1 = $flag2 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["presciptionId"])) {
        $presciptionIdErr = "presciption ID is required";
    } else {
        $presciptionId = test_input($_POST["presciptionId"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z0-9]*$/", $presciptionId)) {
            $presciptionIdErr = "No special characters allowed";
        } else {
            $query = "SELECT presciptionId
                            FROM presciption
                            WHERE presciptionId = '" . $_POST["presciptionId"] . "';";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 0) {
                $presciptionIdErr = "presciption ID is NOT in the record";
            } else {
                $flag1 = true;
            }
            mysqli_free_result($result);
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["presciptionname"])) {
        $presciptionnameErr = "presciption name is required";
    } else {
        $presciptionname = test_input($_POST["presciptionname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $presciptionname)) {
            $presciptionnameErr = "Only letters and white space allowed";
        } else {
            $query1 = "SELECT presciptionname
                            FROM presciption
                            WHERE presciptionname = '" . $_POST["presciptionname"] . "';";
            $result = mysqli_query($conn, $query1);
            if (mysqli_num_rows($result) == 0) {
                $presciptionnameErr = "presciption name is NOT in the record";
            } else {
                $flag2 = true;
            }
            mysqli_free_result($result);
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['clear'])) {
        $presciptionId = $presciptionname = "";
        $presciptionIdErr = $presciptionnameErr = "";
        $flag1 = $flag2 = "";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['remove'])) {
        if ($flag1 == true || $flag2 == true) {
            $query2 = "DELETE FROM presciption 
                        WHERE presciptionId = '" . $_POST["presciptionId"] . "'
                        OR presciptionname = '" . $_POST["presciptionname"] . "';";
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

<h2 style="padding-left: 50px;"><u>Remove presciption (Can only remove if the data is NOT exists in other tables):</u></h2>
<p><span class="error" style="padding-left: 50px;">* required field</span></p>
<form method="post" style="padding-left: 100px; font-size:20px; font-weight: bold;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Presciption ID: <br><br><input type="text" name="presciptionId" value="<?php echo $presciptionId; ?>">
    <span class="error">* <?php echo $presciptionIdErr; ?></span>
    <br>
    <p><u>OR:</u></p>
    Presciption name: <br><br><input type="text" name="presciptionname" value="<?php echo $presciptionname; ?>">
    <span class="error">* <?php echo $presciptionnameErr; ?></span>
    <br><br><br>
    <input type="submit" style="font-weight: bold;" name="remove" value="REMOVE">
    <input type="submit" style="font-weight: bold; background-color: yellow; width: 100px; margin-left: 20px;" name="clear" value="CLEAR">
    <input type="button" style="font-weight: bold; background-color: green; width: 200px; margin-left: 20px;" value="RECORD" onclick="location.href='presciptionrecord.php'">
    <input type="button" style="font-weight: bold; width: 200px; margin-left: 20px;" value="BACK" onclick="location.href='presciption.php'">
</form>
<h2 style="margin-left: 50px"><br><u>Presciption list: </u></h2>
<div style="margin-left: 200px">
    <?php
    $query4 = "SELECT presciptionId AS spId, presciptionname AS spn
        FROM presciption";
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