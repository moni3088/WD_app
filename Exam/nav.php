<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stuff</title>
    <link rel="stylesheet" href="styles/style-nav.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<ul>
    <li><a class="active" href="#" onclick=logOut()>LogOut</a></li>
</ul>


<script>
    function logOut(){
        console.log("logout clicked");
        //pass data from the formto the server
        // url, data, callback
        $.post('api-logout-user.php', $('#frmUserReg').serialize(), function ( sData ) {
            console.log( sData );
            logInPage.style.display = "grid";
            adminDashboard.style.display = "none";
        });
    }
    function addUsers(){
        console.log("test addProducts");
    }

</script>

</body>
</html>