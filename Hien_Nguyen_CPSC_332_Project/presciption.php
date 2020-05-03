<?php include("header.php"); ?>
<center>
    <h1><u>Presciption list:</u></h1>
    <?php
    $sql = " SELECT pvp.visitId AS vId, pvi.lastName AS ln, pvi.firstName AS fn, 
    ps.presciptionId AS prId, ps.presciptionname AS pn
    FROM patientview AS pvi, patientvisit AS pav, pvisitpresciption AS pvp, presciption AS ps
    WHERE pvp.visitId = pav.visitId
    AND pvp.presciptionId = ps.presciptionId
    AND pvi.patientId = pav.patientId
    ORDER BY pvi.lastName, pvi.firstName;   ";
    $num = 0;
    $result = mysqli_query($conn, $sql);
    print "<pre>";
    print "<table border=2>";
    print "<tr><td></td><td>Visit ID</td><td>Patient last name</td><td>Patientfirst name</td>
    <td>Presciption ID</td><td>Presciption</td>";
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        print "\n";
        $num = $num + 1;
        print "<tr><td>$num</td><td>$row[vId]</td><td>$row[ln]</td><td> $row[fn]</td>
        <td> $row[prId]</td><td> $row[pn]</td></tr>";
    }
    print "</table>";
    print "</pre>";
    mysqli_free_result($result);
    ?>
</center>
</div>
<div class="footer" style="position: fixed; bottom: 35px; width:81.5%;">
    <button style="font-weight: bold; padding:10px; margin: 5px" onclick="location.href='searchpresciption.php'">SEARCH</button>
    <button style="font-weight: bold; padding:10px; margin: 5px" onclick="location.href='addpresciption.php'">ADD PRESCIPTION</button>
    <button style="font-weight: bold; padding:10px; margin: 5px" onclick="location.href='addpvisitpre.php'">ADD PATIENT PRESCIPTION</button>
    <button style="font-weight: bold; padding:10px; margin: 5px" onclick="location.href='removepresciption.php'">REMOVE PRESCIPTION</button>
    <button style="font-weight: bold; padding:10px; margin: 5px" onclick="location.href='removepvisitpre.php'">REMOVE PATIENT PRESCIPTION</button>
    <button style="font-weight: bold; padding:10px; margin: 5px" onclick="location.href='pvisitprerecord.php'">RECORD</button>
</div>
<?php include("footer.php"); ?>