<?php
$ds          = DIRECTORY_SEPARATOR;  //1
$storeFolder = '../attachment/goods';   //2
if (!empty($_FILES)) {
    $tempFile = $_FILES['file']['tmp_name'];          //3             
    $targetPath = $storeFolder . $ds;  //4
	$name = $_FILES['file']['name'];
	$file = explode('.',$name);
	$ext = $file[1];
	$filename = time().rand(10,20).".".$ext;
    $targetFile =  $targetPath. $filename;  //5
    move_uploaded_file($tempFile,$targetFile); //6
	echo substr($targetFile,2);
}
?>     