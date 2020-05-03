<?php include("header.php"); ?>
<center>
    <h1><u>Specialities record:</u></h1>
    <?php
    $sql = "SELECT userID, daction, datemodified AS dm, specialityID AS pID,
                    specialityname AS sname
                    FROM specialityrecord;";
    $num = 0;
    $result = mysqli_query($conn, $sql);
    print "<pre>";
    print "<table border=2>";
    print "<tr><td></td><td>User</td><td>Action</td><td>Date</td><td>Speciality ID</td><td>Speciality name</td>";
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        print "\n";
        $num = $num + 1;
        print "<tr><td>$num</td><td>$row[userID]</td><td> $row[daction]</td><td> $row[dm]</td>
                        <td>$row[pID]</td><td>$row[sname]</td></tr>";
    }
    print "</table>";
    print "</pre>";
    mysqli_free_result($result);
    ?>
    <input type="button" style="font-weight: bold; width: 200px; margin-left: 20px;" value="BACK" onclick="location.href='doctorspecialities.php'">
</center>
<?php include("footer.php"); ?>