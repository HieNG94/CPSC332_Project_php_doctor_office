<?php include("header.php"); ?>
<center>
    <h1><u>Doctor specialities record:</u></h1>
    <?php
    $sql = "SELECT p.lastName AS ln, p.firstName AS fn, dsr.dAction AS dAction,
                    dsr.datemodified AS dm, sp.specialityname AS sn
                    FROM doctorspecialityrecord AS dsr, person AS p, doctor AS d, speciality AS sp
                    WHERE p.personId = d.personId 
                    AND d.doctorId = dsr.doctorId
                    AND dsr.specialityId = sp.specialityId
                    GROUP BY p.lastName, p.firstName, dsr.dAction, dsr.datemodified, sp.specialityname;";
    $num = 0;
    $result = mysqli_query($conn, $sql);
    print "<pre>";
    print "<table border=2>";
    print "<tr><td></td><td>Last name</td><td>First name</td><td>Action</td><td>Date</td><td>Speciality name</td>";
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        print "\n";
        $num = $num + 1;
        print "<tr><td>$num</td><td>$row[ln]</td><td> $row[fn]</td><td> $row[dAction]</td>
                        <td>$row[dm]</td><td>$row[sn]</td></tr>";
    }
    print "</table>";
    print "</pre>";
    mysqli_free_result($result);
    ?>
    <input type="button" style="font-weight: bold; width: 200px; margin-left: 20px;" value="BACK" onclick="location.href='doctorspecialities.php'">
</center>
<?php include("footer.php"); ?>