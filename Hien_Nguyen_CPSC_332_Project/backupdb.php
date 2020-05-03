<?php
include("connectiondata.php");

$dbbkloc =  "C:\\xampp\\htdocs\\Hien_Nguyen_CPSC_332_Project\\backup\\";
$bkName =  date("Ymd_His") . ".sql";
$location = $dbbkloc . $bkName;

exec("C:\\xampp\\mysql\\bin\\mysqldump.exe -uroot doctoroffice > " . $location);

$files = glob('C:\\xampp\\htdocs\\Hien_Nguyen_CPSC_332_Project\\backup\\*');

foreach($files as $file) { // iterate files
    // if file creation time is more than 5 minutes
    if ((time() - filectime($file)) > 86400) {  // <--24 hours : 86400 seconds; 
                                                // Set timer to delete the back up files
        unlink($file);
    }
}
?>
