<?php include("header.php") ?>
<center>
    <h1><u>Doctor specialities list:</u></h1>
    <?php
    $sql = "SELECT dv.lastName AS ln, dv.firstName AS fn, sv.specialityname AS sn
    FROM doctorview AS dv, specview AS sv
    WHERE dv.doctorId = sv.doctorId;";
    $num = 0;
    $result = mysqli_query($conn, $sql);
    print "<pre>";
    print "<table border=2>";
    print "<tr><td></td><td>Last name</td><td>First name</td><td>Speciality</td>";
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        print "\n";
        $num = $num + 1;
        print "<tr><td>$num</td><td>$row[ln]</td><td> $row[fn]</td><td> $row[sn]</td></tr>";
    }
    print "</table>";
    print "</pre>";
    mysqli_free_result($result);
    ?>
</center>
</div>
<div class="footer" style="position: fixed; bottom: 35px; width:81.5%;">
    <button style="font-weight: bold; padding:10px; margin: 5px; width:150px" onclick="location.href='showalldocspec.php'">SHOW ALL</button>
    <button style="font-weight: bold; padding:10px; margin: 5px" onclick="location.href='addspeciality.php'">ADD SPECIALITY</button>
    <button style="font-weight: bold; padding:10px; margin: 5px" onclick="location.href='adddoctorspec.php'">ADD DOCTOR SPECIALITY</button>
    <button style="font-weight: bold; padding:10px; margin: 5px" onclick="location.href='updatedocspec.php'">UPDATE DOCTOR SPECIALITY</button>
    <button style="font-weight: bold; padding:10px; margin: 5px" onclick="location.href='removespeciality.php'">REMOVE SPECIALITY</button>
    <button style="font-weight: bold; padding:10px; margin: 5px" onclick="location.href='removedocspec.php'">REMOVE DOCTOR SPECIALITY</button>
    <button style="font-weight: bold; padding:10px; margin: 5px" onclick="location.href='docspecrecord.php'">RECORD DOCTOR SPECIALITY</button>
</div>
<?php include("footer.php"); ?>