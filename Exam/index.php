<?php
session_start();

$sName = "";
$logIn = "";
$auth = "";
$dataCategory="";
if( isset( $_SESSION['sUserName'] ) )
{
    // show the welcome page
    // echo "YES";
    $auth  = "show";
}else{
    $logIn = "show";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stuff</title>
    <link rel="stylesheet" href="styles/style-main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>


<div id = "logInPage" class="page <?php echo $logIn;?>">
    <div>
        <h2> Please log in to start your day!</h2>
        <form id = "frmAdminLogin">
         <input type ="text" class="emailImput" name = "email" placeholder="email">
         <input type ="text" class="passImput"name = "password" placeholder="password">
         <button type = "button" id="btnLogIn">LogIn</button>

         <div id="lblLoginError" class="cMarginTop10"></div>
        </form>
    </div>
</div>


<div id = "adminDashboard" class="page <?php echo $auth;?>">
    <nav>
        <?php require_once("nav.php"); ?>
    </nav>

    <div id="container">

        <div class="column1">

            <button type="button" id = "btnShowUsers">Show users</button>
            <button type="button" id = "btnShowProducts">Show products</button>

            <h2>Add User</h2>
            <form id = "frmUserReg">
                <input type ="text" name = "firstName" placeholder="first name">
                <input type ="text" name = "lastName" placeholder="last name">
                <input type ="text" name = "userName" placeholder="username">
                <input type ="text" name = "email" placeholder="email">
                <input type ="text" name = "password" placeholder="password">
                <button type = "button" id="btnSaveUser">Save User</button>
                <button type = "button" id="btnEditUser">Edit User</button>
                <button type = "button" id="btnDeleteUser">Delete User</button>
            </form>
            <h2>Add Product</h2>
            <form id = "frmProdReg">
                <input type ="text" id="prodName" name = "productName" placeholder="product name">
                <input type ="text" id="prodCat" name = "productCategory" placeholder="category">
                <input type ="text" id="price" name = "price" placeholder="price">
                <input type ="text" id="stock" name = "stock" placeholder="stock">
                <button type = "button" id="btnSaveProduct">Save Product</button>
                <button type = "button" id="btnEditProduct">Edit Product</button>
                <button type = "button" id="btnDeleteProduct">Delete Product</button>
            </form>
        </div>

        <div class="column2">
            <h2 id="listType">List <?php echo $dataCategory?></h2>
            <table id = "tableData"></table>
        </div>

    </div>
</div>


<script>
    // $('body').css('background-color','blue');

    //get data from server(reload page)
    //$.get()
    //$.getJSON() -> instead of JSON parse.
    //$.ajax().done().fail(); -> chaining the fucntions with . in callback
    /* $.getJSON('api-get-users.php', function(ajUsers){

         for(var i = 0; i<ajUsers.length; i++){
             var sDivUser = '<div>\
                              <span>'+ajUsers[i].id+'</span>\
                              <span>'+ajUsers[i].name+'</span>\
                             </div>'
             $('#container').append(sDivUser);
         }
     });*/

    var selectedId="";

    $('#btnSaveUser').click(function(){
        console.log("brnSaveUser clicked");

        $.post('api/api-add-user.php', $('#frmUserReg').serialize(), function ( sData ) {
            console.log( sData );
        });
    });

    $('#btnSaveProduct').click(function(){
        console.log("brnSaveUser clicked");

        $.post('api/api-add-product.php', $('#frmProdReg').serialize(), function ( sData ) {
            console.log( sData );
        });
    });

    $('#btnLogIn').click(function(){
        console.log("is admin clicked");
        //pass data from the formto the server
        // url, data, callback
        $.post('../api/api-verify-admin.php', $('#frmAdminLogin').serialize(), function ( sData ) {
            console.log( sData );
            var jData = JSON.parse(sData);
            if(jData.login == "ok"){
                console.log("yeureka!");
                adminDashboard.style.display = "grid";
                logInPage.style.display = "none";

            }else{
                console.log("non-yeureka!");
                $("#lblLoginError").append("<p>Username or password are wrong.<br>" +
                    "Please try again!</p>");
            }
        });
    });

    $('#btnLogOut').click(function(){
        console.log("logout clicked");
        //pass data from the formto the server
        // url, data, callback
        $.post('.api/api-logout-user.php', $('#frmUserReg').serialize(), function ( sData ) {
            console.log( sData );
            logInPage.style.display = "grid";
            adminDashboard.style.display = "none";
        });
    });

    $('#btnShowUsers').click(function(){
        console.log("x");
        var sTrTdElements='<tr>' +
            '<th>Id</th>' +
            '<th>First Name</th>' +
            '<th>Last Name</th>' +
            '<th>Email</th>' +
            '</tr>';
        $.getJSON( 'api/api-get-users.php' , function( jData ){
            console.log("xx");
                console.log(jData);
                for(var i = 0; i<jData.length; i++){
                    console.log(jData[i].id);
                    sTrTdElements += '<tr>'+
                        '<td id="'+jData[i].id+'"onclick='+"getContent(this)"+'>'+jData[i].id+'</td>'+
                        '<td>'+jData[i].firstName+'</td>'+
                        '<td>'+jData[i].lastName+'</td>'+
                        '<td>'+jData[i].email+'</td>'+
                        '</tr>';
                }
                tableData.innerHTML = sTrTdElements;
        }); // AJAX

    });

    $('#btnShowProducts').click(function(){
        console.log("x");
        var sTrTdElements='<tr>' +
            '<th>Id</th>' +
            '<th>Name</th>' +
            '<th>Category</th>' +
            '<th>Price</th>' +
            '<th>Stock</th>' +
            '</tr>';
        $.getJSON( 'api/api-get-products.php' , function( jData ){
            console.log("xx");
            console.log(jData);
            for(var i = 0; i<jData.length; i++){
                console.log(jData[i].id);
                sTrTdElements += '<tr>'+
                    '<td id="'+jData[i].id+'"onclick='+"getContent(this)"+'>'+jData[i].id+'</td>'+
                    '<td>'+jData[i].productName+'</td>'+
                    '<td>'+jData[i].productCategory+'</td>'+
                    '<td>'+jData[i].price+'</td>'+
                    '<td>'+jData[i].stock+'</td>'+
                    '</tr>';
            }
            tableData.innerHTML = sTrTdElements;
        }); // AJAX

    });

    $('#btnDeleteUser').click(function(){
        if(selectedId!=""){
            $.getJSON(   'api/api-delete-user.php?id='+selectedId ,
                $('#frmUser').serialize(),
                function( jData ){
                    console.log( jData );
                    selectedId="";
            }); // AJAX
        }
    });

    $('#btnDeleteProduct').click(function(){
        if(selectedId!=""){
            $.getJSON(   'api/api-delete-product.php?id='+selectedId ,
                $('#frmProdReg').serialize(),
                function( jData ){
                    console.log( jData );
                    selectedId="";
                }); // AJAX
        }
    });

    $('#btnEditUser').click(function(){
       if(selectedId!=""){
           $.post(   'api/api-edit-user.php?id='+selectedId ,
               $('#frmUserReg').serialize(),
               function( jData ){
                   console.log( jData );
                   selectedId="";
               }); // AJAX
       }
    });



    function getContent(elem){
        elem.style.backgroundColor = "#b6a19e";
        console.log('This is the id you clicked on: '+elem.innerHTML);
        selectedId=elem.innerHTML;

    }

</script>

</body>
</html>