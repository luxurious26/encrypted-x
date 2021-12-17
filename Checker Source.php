<?php

// Source https://pandatechnology.xyz/EncryptedXKey/check.php
// It's made for Users not for Developers (Just don't confuse with developer keys)
// based on https://github.com/Panda-Respiratory/Roblox-Key-System

$database = include('database.php');
$blacklist = include('usedkey.php');

$sub = $_GET["key"];

if (in_array($sub, $blacklist,TRUE))
{
    echo "Used";
    return; 
}
if (in_array($sub, $database,TRUE)) {
    echo "Whitelisted"; 
    keytodb($sub);
} else {
    echo "Not Whitelisted"; 
}

function keytodb($generatedkey){
    $data = file_get_contents('usedkey.php');
    $data2 = str_replace("<?php", "",$data);
    $data3 = str_replace("?>", "",$data2);
    $data4 =  substr_replace($data3,'\'' . $generatedkey.'\'' . ',',-3,-3);
    file_put_contents('usedkey.php', '<?php' . $data4 . '?>');
    return $generatedkey;
}

?>
