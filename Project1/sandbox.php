<?php require_once('inc/header.php');
//var_dump($_GET['filename']);
  
// checks if there's oppened file and sets a filename if it is

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
    $textFile = fopen($filename, "w");  // if there's no any .txt file, creates a new text.txt file
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
    $myfile = fopen($filename, "w");
    $currentFile = 'text.txt';
    $current = "Crate a content for a new file";
}



// create new folder
if (isset($_GET['newFolder'])) {
    mkdir('work/' . $_GET['newFolder'] , 0777, true);
}

?>
<!-- Create new .txt file -->
            <input type="submit" class="btn btn-primary" value="Submit">
        </form>
        </div>

<!-- Create new folder -->
        <div class="col-sm form-group rounded m-1 p-4" style="background-color: #e6e6e6">
            <form>
                <label for="folder"><h5 class="text-secondary">Create new folder</h5></label>
                <input type="text" class="form-control" id="folder" name="newFolder" value="">
                <br>
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
                if ($handle = opendir('.')) {
                    while (false !== ($entry = readdir($handle))) {
                         if ($ext = pathinfo($entry, PATHINFO_EXTENSION) == "txt") {
                             $path_parts = pathinfo($entry);
                             echo '<li class="list-group-item"><i class="fas fa-file-alt fa-lg">&nbsp</i><a href="?currentFile=' . $entry  .  '">' . $entry . '<br></a></li>';
                         } elseif ($ext = pathinfo($entry, PATHINFO_EXTENSION) == "jpg") {
                            echo '<li class="list-group-item"><i class="fas fa-image fa-lg">&nbsp</i><a href="?pav=' . $entry  . '">' . $entry . '<br></a></li>';
                         }        
                    }
                    closedir($handle);
                 }
            ?>
                <li class="list-group-item"><i class="fas fa-folder fa-lg"></i>Cras justo odio</li>
                <li class="list-group-item"><i class="fas fa-folder-open fa-lg"></i>Dapibus ac facilisis in</li>
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
    <?php require_once('inc/footer.php');?>

