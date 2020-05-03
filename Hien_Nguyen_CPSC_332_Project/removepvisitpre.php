<?php include("header.php"); ?>
<?php
// define variables and set to empty values
$presciptionId = $visitId = "";
$presciptionIdErr = $visitIdErr = $errmess = "";
$flag1 = $flag2 = $flag3 = "";

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
                $presciptionIdErr = "Presciption ID is NOT exists";
            } else {
                $flag1 = true;
            }
            mysqli_free_result($result);
        }
    }
    if (empty($_POST["visitId"])) {
        $visitIdErr = "Visit ID name is required";
    } else {
        $visitId = test_input($_POST["visitId"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z0-9 ]*$/", $visitId)) {
            $visitIdErr = "No special characters allowed";
        } else {
            $query1 = "SELECT visitId
                            FROM patientvisit
                            WHERE visitId = '" . $_POST["visitId"] . "';";
            $result = mysqli_query($conn, $query1);
            if (mysqli_num_rows($result) == 0) {
                $visitIdErr = "Visit ID is NOT exists";
            } else {
                $flag2 = true;
            }
            mysqli_free_result($result);
        }
    }
    if ($flag1 == true && $flag2 == true) {
        $query3 = "SELECT * FROM pvisitpresciption
        WHERE visitId = '" . $_POST["visitId"] . "'
        AND presciptionId = '" . $_POST["presciptionId"] . "';";
        $result = mysqli_query($conn, $query3);
        if (mysqli_num_rows($result) == 0) {
            $errmess = "The record is NOT in the record";
        } else {
            $flag3 = true;
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['clear'])) {
        $presciptionId = $visitId = "";
        $presciptionIdErr = $visitIdErr = "";
        $flag1 = $flag2 = $flag3 = "";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['remove'])) {
        if ($flag3 == true) {
            $query2 = "DELETE FROM pvisitpresciption 
                        WHERE presciptionId = '" . $_POST["presciptionId"] . "'
                        AND visitId = '" . $_POST["visitId"] . "';";
            mysqli_query($conn, $query2);
            include("backupdb.php"); 
            header("location:presciption.php");
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

<h2 style="padding-left: 50px;"><u>Remove patient presciption:</u></h2>
<p><span class="error" style="padding-left: 50px;">* required field</span></p>
<form method="post" style="padding-left: 100px; font-size:20px; font-weight: bold;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Presciption ID: <br><br><input type="text" name="presciptionId" value="<?php echo $presciptionId; ?>">
    <span class="error">* <?php echo $presciptionIdErr; ?></span>
    <br><br>
    Visit ID: <br><br><input type="text" name="visitId" value="<?php echo $visitId; ?>">
    <span class="error">* <?php echo $visitIdErr; ?></span>
    <br><br>
    <span class="error" style="color: red"><?php echo $errmess; ?></span>
    <br><br>
    <input type="submit" style="font-weight: bold;" name="remove" value="REMOVE">
    <input type="submit" style="font-weight: bold; background-color: yellow; width: 100px; margin-left: 20px;" name="clear" value="CLEAR">
    <input type="button" style="font-weight: bold; background-color: green; width: 200px; margin-left: 20px;" value="RECORD" onclick="location.href='presciptionrecord.php'">
    <input type="button" style="font-weight: bold; width: 200px; margin-left: 20px;" value="BACK" onclick="location.href='presciption.php'">
</form>
<h2 style="margin-left: 50px"><br><u>Presciption list: </u></h2>
<div style="margin-left: 200px">
    <?php
    $query4 = "SELECT presciptionId AS pId, presciptionname AS pn
        FROM presciption;";
    $result = mysqli_query($conn, $query4);
    print "<pre>";
    print "<table border=2>";
    print "<tr><td>ID</td><td>Name</td>";
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        print "\n";
        print "<tr><td>$row[pId]</td><td>$row[pn]</td></tr>";
    }
    print "</table>";
    print "</pre>";
    mysqli_free_result($result);
    ?>
</div>
<?php include("footer.php"); ?>