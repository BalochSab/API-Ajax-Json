<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax Select</title>
</head>
<body>
    <h1>Ajax Show Data</h1>
    <div>
    id For Delete/update
        <input type="text"  id="id"> 
        <br>   
    Name
        <input type="text"  id="name">
        
        
    </div>
    <div>
        <input type="submit" value="Save" id="save">
        <input type="button" id="del" value="delete">
        <input type="button" id="upd" value="Update">
        <div id="d" style="display: none;">
                    
        </div>
        <p id="msg" ></p>
    </div>
    <!-- update form -->
    <div id='update'>
    
    </div>
    <!-- Show table  -->
    <table>        
    <tr>
        <th>Search</th>
        <th><input type='text' id='search'></th>
    </tr>
    </table>
    
    <div>
    <table id="show">
        <tr>
        <th>Id</th>
        <th>Name</th>
        <th colspan='2'>Control</th>
    </tr>
    </div>
</body>
<script src="jquery-3.5.1.min.js"></script>
<script>

$(document).ready(function(){

    //function for show data
        function dataload(page){
            $.ajax({
            url : "ajax/ajax-server.php",
            type : "POST",
            data: {page_id:page},
            success : function(data){
                $("#show").append(data);
            }
        });
        }

        dataload();
        //pagination 
        $(document).on("click","#pagination a",function(e){
            e.preventDefault();
            var page_id = $(this).data("id");
            dataload(page_id);
        });
        // Live Search text box
        $("#search").on("keyup",function(){
            var srch = $("#search").val();

            $.ajax({
                url: "ajax/search.php",
                type: "POST",
                data: {search : srch},
                success: function(data){
                    $("#show").html(data);
                }
            });
        });

        $("#save").on("click",function(e){
            e.preventDefault();
            var name = $("#name").val();
            $.ajax({
                url : "ajax/insert.php",
                type : "POST",
                data : {cat_name:name},
                success : function(data){
                    
                    if (data == 1) {
                        dataload();
                    }else{
                        $("#msg").html(data);
                        alert(data);
                    }
                }
            });
        });

//table Delete btn
        $(document).on("click",".btn-delete",function(){
            var cid = $(this).data("id");
            
            $.ajax({
                url : "ajax/delete.php",
                type : "POST",
                data : {id:cid},
                success : function(data){
                    
                    if (data == 1) {
                        dataload();
                    }else{
                        $("#d").html(data);
                        alert(data);
                    }
                }
            });
        });


////text boxt Delete btn
        $("#del").on("click",function(e){
            // e.preventDefault();
            var cid = $("#id").val();
            $.ajax({
                url : "ajax/delete.php",
                type : "POST",
                data : {id:cid},
                success : function(data){
                    
                    if (data == 1) {
                        dataload();
                    }else{
                        $("#msg").html(data);
                        alert(data);
                    }
                }
            });
        });

// UPDATE DATA TABLE BTN get data in text box
        $(document).on("click",".btn-update",function(){
            $("#d").show();

            var uid = $(this).data("uid");
            
            $.ajax({
                url : "ajax/get-update-data.php",
                type : "POST",
                data : {id:uid},
                success : function(data){
                        $("#d").html(data);
                }
            });
        });

// Update btn get form get-update data . php
        $(document).on("click",".update_save",function(){
            // e.preventDefault();
            var uid = $("#uid").val();
            var uname = $("#uname").val();
            $.ajax({
                url : "update.php",
                type : "POST",
                data : {id:uid, name:uname},
                success : function(data){
                    $("#d").hide();

                    if (data == 1) {
                        dataload();
                    }else{
                        $("#msg").html(data);
                        alert("update error!");
                    }
                    
                }
            });
        });

    
});



</script>
</html>