<?php
session_start();

$userName = $_POST["email"];
$userPass = $_POST["password"];

$sData = file_get_contents( '../data/admin.txt', FILE_USE_INCLUDE_PATH );
$aData = json_decode( $sData );

for($i = 0; $i < count($aData); $i++){
    if(($aData[$i]->userName == $userName)&&($aData[$i]->password == $userPass)){
        $_SESSION['sUserName'] = $userName;
        // send thi to the client
        $sjResponse = '{"login":"ok","user":"'.$userName.'"}';
        echo $sjResponse;
        exit;
    }
}
$sjResponse = '{"login":"error"}';
echo $sjResponse;
exit;


?>