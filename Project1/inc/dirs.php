<?php

$a= str_replace('C:\xampp\htdocs\Project1','.', __DIR__);
die($a);
$path = ".\work/";
$dirs = scandir($path);

$textArray=[];
$imageArray=[];
$dirArray=[];

$newDirArray = (array_slice($dirs,2)); // removes first two elements of array ( . and ..);

// puts folders, text fimes and images into seperate arrays
foreach ($newDirArray as $fileOrDirectory) {
    if (pathinfo($fileOrDirectory, PATHINFO_EXTENSION) == "txt") {
        $textArray[]=$fileOrDirectory;
    } elseif (
        (pathinfo($fileOrDirectory, PATHINFO_EXTENSION) == "jpg") ||
        (pathinfo($fileOrDirectory, PATHINFO_EXTENSION) == "png") ||
        (pathinfo($fileOrDirectory, PATHINFO_EXTENSION) == "jpeg") ||
        (pathinfo($fileOrDirectory, PATHINFO_EXTENSION) == "gif") 
        ) {
        $imageArray[]=$fileOrDirectory;
    } else {
        $dirArray[]=$fileOrDirectory;
    }
}

// sorts arrays of folders, text and images alphabeticly

sort($textArray);
sort($imageArray);
sort($dirArray);

// checks if arrays are not empty and echos them if they are not
if (isset($dirArray)){
    foreach ($dirArray as $dir) {
        echo '<li class="list-group-item"><i class="fas fa-folder fa-lg">&nbsp</i><a href="?dir=' . $dir  .  '">' . $dir . '</a></li>';
    }
}

if (isset($textArray)){
    foreach ($textArray as $dir) {
        echo '<li class="list-group-item"><i class="fas fa-file-alt fa-lg">&nbsp</i><a href="?currentFile=' . $dir  .  '">' . $dir . '</a></li>';
    }
}


if (isset($imageArray)){
    foreach ($imageArray as $dir) {
        echo '<li class="list-group-item"><i class="fas fa-image fa-lg">&nbsp</i><a href="?image=' . $dir  .  '">' . $dir . '</a></li>';
    }
}






//echo pathinfo("vienas.txt", PATHINFO_EXTENSION);

