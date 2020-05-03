<?php include("header.php"); ?>
<center>
    <h1><u>Patient list:</u></h1>
    <?php
    $sql = "SELECT p.personId AS pId, p.lastName as ln, p.firstName AS fn,
                    pt.dob AS dob, p.street AS street, p.city AS city,
                    p.state AS st, p.zipcode AS z, p.phone AS phone, p.ssn AS ssn
                    FROM person AS p, patient AS pt
                    WHERE p.personId = pt.personId;";
    $result = mysqli_query($conn, $sql);
    print "<pre>";
    print "<table border=2>";
    print "<tr><td>ID</td><td>Last name</td><td>First name</td><td>DOB</td>
                    <td>Street</td><td>City</td><td>State</td><td>Zipcode</td><td>Phone</td>
                    <td>SSN</td>";
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        print "\n";
        print "<tr><td>$row[pId]</td><td>$row[ln]</td><td> $row[fn]</td>
                <td> $row[dob]</td><td> $row[street]</td><td> $row[city]</td>
                <td> $row[st]</td><td> $row[z]</td><td> $row[phone]</td><td> $row[ssn]</td></tr>	";
    }
    print "</table>";
    print "</pre>";
    mysqli_free_result($result);
    ?>
</center>
<?php include("footer.php"); ?>