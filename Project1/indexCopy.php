<?php
  
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

?>
<!DOCTYPE html>
<html>
<body>
    
    <?php
    if (isset($_GET['pav'])) {
        echo 'You are now seeing a picture<br>';
        echo '<img src="' . $_GET['pav'] . '" alt="Smiley face" height="200" width="300" name="currentFile" value="' . $filename .'">';
     } else {
        echo 'You are now edditing <b>' . $filename . '</b> file<br>';
        echo '<textarea rows="4" cols="50" name="content" form="usrform">' . $current . '</textarea>';
        echo '<form action="" id="usrform">';
        echo '<input type="hidden" name="currentFile" value="' . $filename .'">';
        echo '<input type="submit">';
        echo '</form>';
     }
    ?>

    <br>

<!-- 3. Add new file name -->

    <form action="">
        New file name:<br>
        <input type="text" name="filename" value="">
        <br>
        <input type="submit" value="Submit">
    </form> 
    <br>
</body>
</html>

<?php 
if ($handle = opendir('.')) {
    while (false !== ($entry = readdir($handle))) {
         if ($ext = pathinfo($entry, PATHINFO_EXTENSION) == "txt") {
             $path_parts = pathinfo($entry);
             echo '<a href="?currentFile=' . $entry  .  '">' . $entry . '<br></a>';
         } elseif ($ext = pathinfo($entry, PATHINFO_EXTENSION) == "jpg") {
            //$path_parts = pathinfo($entry);
            echo '<a href="?pav=' . $entry  . '">' . $entry . '<br></a>';
            // echo '<a href="?pav=' . $entry  . '&filename=' . $path_parts['filename']  .  '">' . $entry . '<br></a>';
         }        
    }
    closedir($handle);
 }


