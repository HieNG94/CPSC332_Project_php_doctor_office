<?php include("header.php"); ?>
<center>
    <h1><u>Patient presciption record:</u></h1>
    <?php
    $sql = "SELECT visitId AS vId, presciptionId AS pId, dAction, datemodified AS dm
            FROM  pvisitpresciptionrecord;";
    $result = mysqli_query($conn, $sql);
    print "<pre>";
    print "<table border=2>";
    print "<tr><td>Visit Id</td><td>Presciption ID</td><td>Action</td><td>Date</td>";
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        print "\n";
        print "<tr><td>$row[vId]</td><td>$row[pId]</td>
        <td> $row[dAction]</td><td> $row[dm]</td></tr>";
    }
    print "</table>";
    print "</pre>";
    mysqli_free_result($result);
    ?>
    <input type="button" style="font-weight: bold; width: 200px; margin-left: 20px;" value="BACK" onclick="location.href='presciption.php'">
</center>
<?php include("footer.php"); ?>