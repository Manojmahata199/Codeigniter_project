<?php
$folderPath = '../sponsors-logo';
//$fileCount = count(glob($folderPath . '/*'));

//echo $fileCount;// + "<br>"+$folderPath;

$fileNames = scandir($folderPath);
$fileCount = count($fileNames);

$response = array(
  'count' => $fileCount,
  'names' => $fileNames
);

echo json_encode($response);

?>
