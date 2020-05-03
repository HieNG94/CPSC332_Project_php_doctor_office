<?php include("header.php"); ?>
<?php

$presciptionnameErr = "";
$presciptionname  = $errmess = "";
$flag1 = "";

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
                $flag1 = true;
            }
            mysqli_free_result($result);
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['clear'])) {
        $presciptionnameErr = "";
        $presciptionname  = $errmess = "";
        $flag1 = "";
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

<h2 style="padding-left: 50px;"><u>Search doctor:</u></h2>
<p><span class="error" style="padding-left: 50px;">* required field</span></p>
<form method="post" style="padding-left: 100px; font-size:20px; font-weight: bold;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Presciption name: <br><br><input type="text" name="presciptionname" value="<?php echo $presciptionname; ?>">
    <span class="error">* <?php echo $presciptionnameErr; ?></span>
    <br><br>
    <input type="submit" style="font-weight: bold;" name="search" value="SEARCH">
    <input type="submit" style="font-weight: bold; margin-left:50px; width:100px; background-color:orange" name="clear" value="CLEAR">
    <input type="button" style="font-weight: bold; width: 200px; margin-left: 20px;" value="BACK" onclick="location.href='presciption.php'">
    <br><br><br>
</form>
<div>
    <center>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['search'])) {
                if ($flag1 == true) {
                    $sql = "SELECT dv.doctorId AS dId, dv.lastName AS ln, dv.firstName AS fn, 
                    pvp.visitId AS vId, pav.visitdate AS vd
                    FROM doctorview AS dv, pvisitpresciption AS pvp, presciption AS p, patientvisit AS pav
                    WHERE dv.doctorId = pav.doctorId
                    AND pav.visitId = pvp.visitId
                    AND pvp.presciptionId = p.presciptionId
                    AND p.presciptionname = '".$_POST["presciptionname"]."';";
                    $result = mysqli_query($conn, $sql);
                    print "<pre>";
                    print "<table border=2>";
                    print "<tr><td>Doctor ID</td><td>D last name</td><td>D first name</td><td>Visit ID</td><td>Visit date</td>";
                    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                        print "\n";
                        print "<tr><td>$row[dId]</td><td>$row[ln]</td><td>$row[fn]</td><td> $row[vId]</td>
                        <td> $row[vd]</td></tr>";
                    }
                    print "</table>";
                    print "</pre>";
                    mysqli_free_result($result);
                    $presciptionnameErr = "";
                    $presciptionname  = $errmess = "";
                    $flag1 = "";
                }
            }
        }
        ?>
    </center>
</div>
<?php include("footer.php"); ?>