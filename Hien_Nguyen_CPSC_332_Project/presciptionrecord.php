<?php include("header.php"); ?>
<center>
    <h1><u>Presciption record:</u></h1>
    <?php
    $sql = "SELECT daction, datemodified AS dm, presciptionID AS pID,
                    presciptionname AS pname
                    FROM presciptionrecord;";
    $num = 0;
    $result = mysqli_query($conn, $sql);
    print "<pre>";
    print "<table border=2>";
    print "<tr><td></td><td>presciption ID</td><td>presciption name</td><td>Action</td><td>Date</td>";
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        print "\n";
        $num = $num + 1;
        print "<tr><td>$num</td><td>$row[pID]</td><td>$row[pname]</td>
        <td> $row[daction]</td><td> $row[dm]</td></tr>";
    }
    print "</table>";
    print "</pre>";
    mysqli_free_result($result);
    ?>
    <input type="button" style="font-weight: bold; width: 200px; margin-left: 20px;" value="BACK" onclick="location.href='presciption.php'">
</center>
<?php include("footer.php"); ?>