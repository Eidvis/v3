<?php require_once('inc/header.php');
//var_dump($_GET['filename']);

// determines the path of a folder
$path = "./work/";

if (isset($_GET['dir']) && isset($_GET['path'])) {
    $path = $_GET['path'] . $_GET['dir'] . "/" ;
}

if (isset($_GET['dir2']) && isset($_GET['path2'])) {
    $path = $_GET['path2'] . "/" ;
    $dir=$_GET['dir2'];
}

if (isset($_GET['path']) && !isset($_GET['dir'])){
    $path = $_GET['path'];
}
  
// checks if there's oppened file and sets a filename, or makes a default .txt

if (isset($_GET['currentFile'])) {
    $filename = $_GET['currentFile'];
} else {
    $filename = "text.txt";
}

// defines current .txt file

if (isset($_GET['currentFile'])) {
    $current = file_get_contents($filename);
} elseif (file_exists($filename)) {         // check if text.txt file exist
    $current = file_get_contents($filename);
} else {
    $textFile = fopen($filename, "w");  // if there's no deined .txt file, creates a new text.txt file
    $current = file_get_contents($filename);
}

// checks if new content is submitted, if it is - writes it into a file
if (isset($_GET['content'])){
    $current = $_GET['content'];
    file_put_contents($filename, $current);
} 

// checks if new file name has been submitted, creates and saves .txt file if it is.
if (isset($_GET['filename'])){
    $filename = $_GET['filename'] . '.txt';
    $myfile = fopen($path . $filename, "w");
    $currentFile = 'text.txt';
    $current = "Crate a content for a new file";
}

// creates new folder
if (isset($_GET['newFolder'])) {
    mkdir($path . $_GET['newFolder'] , 0777, true);
}


// extracts files from a folder
$dirs = scandir($path);

$textArray=[];
$imageArray=[];
$dirArray=[];

$newDirArray = (array_slice($dirs,2)); // removes first two elements of array ( . and ..);

// puts folders, text files and images into seperate arrays
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




?>
<!-- Create new .txt file -->
            <input type="hidden" name="path" value="<?= $path ?>">
            <input type="submit" class="btn btn-primary" value="Submit">
        </form>
        </div>

<!-- Create new folder -->
        <div class="col-sm form-group rounded m-1 p-4" style="background-color: #e6e6e6">
            <form>
                <label for="folder"><h5 class="text-secondary">Create new folder</h5></label>
                <input type="text" class="form-control" id="folder" name="newFolder" value="">
                <br>
                <input type="hidden" name="path" value="<?= $path ?>">
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>

<!-- Import new file -->
        <div class="col-sm form-group rounded m-1 mr-3 p-4" style="background-color: #e6e6e6">
            <label for="newFile"><h5 class="text-secondary">Import new file</h5></label>
            <input type="file" id="exampleInputFile">
            <br><br>
            <button type="button" class="btn btn-primary">Submit</button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <br>
            <ul class="list-group">
           
<?php

//places a link to a parent folder if needed
if ($path != "./work/") {
    $pathToArray = explode('/', $path);
    array_pop($pathToArray);
    array_pop($pathToArray);
    $path2 = implode('/', $pathToArray);
    $dir2 = array_pop($pathToArray);
    echo '<li class="list-group-item"><a href="?dir2=' . $dir2  . '&path2=' . $path2 . '"><i class="fas fa-folder-open fa-lg">&nbsp</i>' . ".." . '</a></li>';
} 

// checks if arrays are not empty and echos them if they are not
if (isset($dirArray)){
    foreach ($dirArray as $dir) {
        echo '<li class="list-group-item"><a href="?dir=' . $dir  . '&path=' . $path . '"><i class="fas fa-folder fa-lg">&nbsp</i>' . $dir . '</a></li>';
    }
}

if (isset($textArray)){
    foreach ($textArray as $dir) {
        echo '<li class="list-group-item"><a href="?currentFile=' . $dir  .  '"><i class="fas fa-file-alt fa-lg">&nbsp</i>' . $dir . '</a></li>';
    }
}


if (isset($imageArray)){
    foreach ($imageArray as $dir) {
        echo '<li class="list-group-item"><a href="?image=' . $dir  .  '"><i class="fas fa-image fa-lg">&nbsp</i>' . $dir . '</a></li>';
    }
}

?>
            </ul>
        </div>
            <div class="col-md-8 form-group">
            <br>
            <form>
            <?php
                echo '<label for="comment"><h5 class="text-secondary">Edit ' . $filename . ' file</h5></label>';
                echo '<textarea class="form-control" rows="5" id="comment">' . $current . '</textarea><br>';
                echo '<input type="hidden" name="currentFile" value="' . $filename .'">';
                echo '<input type="submit" class="btn btn-primary" value="Submit">';
            ?>
            </form>
        </div>
    </div>
    <?= $path; ?>
    <?php require_once('inc/footer.php');?>

