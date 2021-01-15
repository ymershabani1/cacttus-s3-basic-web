<?php
    // CRUD - Create, Read, Update, Delete
    $value = "This is the value 2!";
    $array = ["test", 1, "234", "!!!", -20];

    // create file
    file_put_contents("users.txt", $value . "\n", FILE_APPEND | LOCK_EX);
    file_put_contents("users.txt", serialize($array) . "\n", FILE_APPEND | LOCK_EX);

    // read file
    $fileContent = file_get_contents("users.txt");
    $lines = explode("\n", $fileContent);
    foreach ($lines as $line) {
        echo $line. "\n";
    }

    // update
    $newFileContent = "";
    $lineIdx = 0;
    foreach ($lines as $line) {
        $newFileContent .= 
            ( $lineIdx%2==0 ? $line: json_encode(unserialize($line)) ) . "\n";
        $lineIdx++;
    }
    file_put_contents("users2.txt",$newFileContent);
    file_put_contents("users3.txt", $newFileContent);

    // delete
    unlink("users3.txt");
    unlink("file2.php");

?>