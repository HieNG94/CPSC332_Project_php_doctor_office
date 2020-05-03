<?php include("header.php"); ?>
<center>
    <h1><u>Patient visit:</u></h1>
    <?php
    $sql = "SELECT pvi.visitId AS vId, pvi.patientId AS pId, pav.lastName AS pln, pav.firstName AS pfn, 
	pvi.doctorId AS dId, dv.lastName AS dln, dv.firstName AS dfn, pvi.visitdate AS vd, pvi.docnote AS dn
	FROM patientvisit AS pvi, patientview AS pav, doctorview AS dv
	WHERE pvi.patientId = pav.patientId
	AND pvi.doctorId = dv.doctorId
	GROUP BY pvi.patientId, pvi.doctorId, pvi.visitdate
	ORDER BY pvi.visitdate;";
    $result = mysqli_query($conn, $sql);
    print "<pre>";
    print "<table border=2>";
    print "<tr><td>Visit ID</td><td>Patient ID</td><td>P last name</td><td>P first name</td><td>Doctor ID</td>
    <td>D last name</td><td>D first name</td><td> Visit date</td><td>Doctor note</td>";
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        print "\n";
        print "<tr><td>$row[vId]</td><td>$row[pId]</td><td>$row[pln]</td><td> $row[pfn]</td>
        <td> $row[dId]</td><td>$row[dln]</td><td>$row[dfn]</td><td>$row[vd]</td><td>$row[dn]</td></tr>";
    }
    print "</table>";
    print "</pre>";
    mysqli_free_result($result);
    ?>
</center>
</div>
<div class="footer" style="position: fixed; bottom: 35px; width:81.5%;">
    <button style="font-weight: bold; padding:10px; margin: 5px" onclick="location.href='searchpvisit.php'">SEARCH</button>
    <button style="font-weight: bold; padding:10px; margin: 5px" onclick="location.href='addvisit.php'">ADD VISIT</button>
    <button style="font-weight: bold; padding:10px; margin: 5px" onclick="location.href='updatepvisit.php'">UPDATE VISIT</button>
    <button style="font-weight: bold; padding:10px; margin: 5px" onclick="location.href='removevisit.php'">REMOVE VISIT</button>
    <button style="font-weight: bold; padding:10px; margin: 5px" onclick="location.href='pvisitrecord.php'">RECORD</button>
</div>
<?php include("footer.php"); ?>