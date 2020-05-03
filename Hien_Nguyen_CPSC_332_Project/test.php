<?php include("header.php"); ?>
<center>
    <h1><u>Test list:</u></h1>
    <?php
    $sql = "SELECT pvi.lastName AS ln, pvi.firstName AS fn, t.testname AS tn
    FROM patientview AS pvi, test AS t, pvisittest AS pvt, patientvisit AS pav
    WHERE pvi.patientId = pav.patientId
    AND pav.visitId = pvt.visitId
    AND pvt.testId = t.testId;";
    $num = 0;
    $result = mysqli_query($conn, $sql);
    print "<pre>";
    print "<table border=2>";
    print "<tr><td></td><td>Last name</td><td>First name</td><td>Test</td>";
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        print "\n";
        $num = $num + 1;
        print "<tr><td>$num</td><td>$row[ln]</td><td> $row[fn]</td><td> $row[tn]</td></tr>";
    }
    print "</table>";
    print "</pre>";
    mysqli_free_result($result);
    ?>
</center>
</div>
<?php include("footer.php"); ?>