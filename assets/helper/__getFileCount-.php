<?php
$folderPath = '../../../public/assets/images/sponsors-logo';
$fileCount = count(glob($folderPath . '/*'));

echo $fileCount;// + "<br>"+$folderPath;
?>
