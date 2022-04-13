<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Google</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>GOOGLE</h1>

<form action="" method="post">
    <input id="search" type="text" name="search" placeholder="Enter your word"><br>
    <input id="button" type="submit">
</form>

<?php
if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $dir = 'C:\xampp\htdocs\JASacademy\Exercise\file-google\files';
    $count = 0;
    $files = scandir($dir, 1);
    $ERROR_MESSAGE = "You've send an empty request, please enter right one!";

    if (!empty($search)) {

        foreach ($files as $lines) {
            if (strlen($lines) > 3 && strpos($lines, '.txt') !== false) {
                $fh = fopen('file-google/files/' . $lines, 'r');

                while (!feof($fh)) {
                    $content = strtolower(fgets($fh));
                    $content = str_replace(["\n", "\r"], "", $content);
                    $search = strtolower($search);
                    $words = explode(" ", $content);

                    foreach ($words as $word) {
                        if ($word == $search)
                            $count++;
                    }
                }

                if($count == 0){
                    continue;
                }else{
                    print '<p>' . 'Word ' . $search . ' occurs ' . $count . ' times in next file: ' . '<a href="files/' . $lines. '">' . $lines . '</a></p>';
                }

                $count = 0;
                fclose($fh);
            }
        }
    } else {
        ?>
        <p id="error">
            <?= $ERROR_MESSAGE?>
        </p>
        <?php
    }
}else{
    echo '';
}
?>

</body>
</html>