<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Json</title>
</head>
<body>
    <div>
        <h1>Data get by JSON File </h1>
        <!-- <form id="form_data" > -->
            Name: <input type="text" name="name" id="name" ><br>
            E-mail: <input type="text" name="email" id="email"><br>
            <input type="submit" name="submit" id="submit">
        <!-- </form> -->
    </div>
    <div id="msg"></div>

    <div >
    <table border="1" id="table-data" cellpadding="10px" width="100%">
        <thead>
            <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Body</th>
            </tr>
        </thead>

    </table>
    </div>
</body>
</html>
<script src="jquery.min.js"></script>
<script>

$(document).ready(function(){
    $.getJSON(
        "json_encod.php",
        function(para){
            $.each(para, function(key,value){
                $("#table-data").append("<tr><td>" + value.post_id + "</td><td>" + value.post_title+ "</td><td>"+ value.post_discription + "</td></tr>");
            });
            
        }
    );
    $("#submit").click(function(){
        // $.ajax({
        // url:"../json/Json_form.php",
        // type:"POST",
        // data:$("#form_data").serialize(),
        // success: function(data){
        //     $("#msg").html(data);  
        // }
        // });
        var name = $("#name").val();
        var email = $("#email").val();
        $.post("Json_form.php",{n:name,e:email},function(data){
            $("#name").val("");
            $("#email").val("");
            $("#msg").html(data);  
        });
    });
    

});




</script>