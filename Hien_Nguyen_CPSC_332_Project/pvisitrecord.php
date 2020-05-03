<?php include("header.php"); ?>
<center>
    <h1><u>Visit record:</u></h1>
    <?php
    $sql = "SELECT visitId, dAction, patientId, doctorId, visitdate, datemodified,
    docnote
    FROM pvisitrecord";
    $result = mysqli_query($conn, $sql);
    print "<pre>";
    print "<table border=2>";
    print "<tr><td>VisitID</td><td>Action</td><td>Patient ID</td><td>Doctor ID</td><td>Visit date</td>
    <td>Modified date</td><td>Doctor note</td>";
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        print "\n";
        print "<tr><td>$row[visitId]</td><td>$row[dAction]</td><td> $row[patientId]</td><td> $row[doctorId]</td>
                        <td>$row[visitdate]</td><td>$row[datemodified]</td><td>$row[docnote]</td></tr>";
    }
    print "</table>";
    print "</pre>";
    mysqli_free_result($result);
    ?>
    <input type="button" style="font-weight: bold; width: 200px; margin-left: 20px;" value="BACK" onclick="location.href='pvisit.php'">
</center>
<?php include("footer.php"); ?>