<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="jquery.min.js"></script>
</head>
<body>
    <h1>Using Api</h1>
    <br>
    <div >
    Search : <input type="text" name="search" id="search">
    </div><br>
    <div>
        
        <form>
            Category Name : <input type="text"  id="name">
            <input type="submit" value="Save" id="btnSave" name="submit">
        </form>
    </div><br>
    <div id="model" style="display: none;">
        <form>
            id: <input type="text" disabled id="uid">
            Category Name: <input type="text"  id="uname">
            <input type="submit" value="Save" id="update">
       </form>
    </div>
    <br>
    <div>
    <p id="show"></p>
        <table border="1">
            <thead>
                <tr>
                    <th>Category Id</th>
                    <th>Categroy Name</th>
                    <th>Number Of Post</th>
                    <th>Controlls</th>
                </tr>
            </thead>
            <tbody id="table_body">
            </tbody>
        </table>
    </div>
    
</body>
</html>

<script>
    $(document).ready(function(){
        //fatch all Data by api file
        
        function loadAllCategory(){
            $.ajax({
                url:"http://localhost/jqphp/api/fatch-all.php",
                type: "GET",
                success: function(data){
                    if (data.Status == false) {
                    $("#table_body").append("<tr><td colspan='3'><h3>"+ data.massage +"</h3></td></tr>");
                    }else{
                        $.each(data,function(key,value){
                            $("#table_body").append("<tr><td>"+value.category_id +"</td>"+
                            "<td>"+value.category_name +"</td>"+
                            "<td>"+ value.num_of_post +"</td>"+
                            "<td><button class='edit_btn' data-eid="+ value.category_id +">Edit</button>"+
                            "<button class='delete-btn' data-did="+ value.category_id +">Delete</button>"+
                            "</td></tr>");

                        });
                    }
                }
            });
        }

        loadAllCategory();    //this is ok

        //fatch single record in model box
        //ok
        $(document).on("click",".edit_btn",function(){
            $("#model").show();
            var eid = $(this).data("eid");
            var obj = { c_id:eid };
            var JsonId = JSON.stringify(obj);
            
            $.ajax({
                url:"http://localhost/jqphp/api/fatch-single.php",
                data:JsonId,
                type: "POST",
                success: function(data){
                $("#uid").val(data[0].category_id);
                $("#uname").val(data[0].category_name);
            }
            })
            
        });

        //data updata in database by model btn click
        $("#update").click(function(e){
            e.defaultPrevented();
            $("#model").hide();
            var uid = $("#uid").val();
            var uname = $("#uname").val();
            var objcon = {cid:uid,cname:uname};
            var dataJson = JSON.stringify(objcon);
            $.ajax({
                url:"http://localhost/jqphp/api/update.php",
                data:dataJson,
                type: "POST",
                success: function(upd){
                    if (upd.Status == false) {
                    $("#table_body").append("<tr><td colspan='3'><h3>"+ upd.massage +"</h3></td></tr>");
                    
                    }
                    else{
                        loadAllCategory();
                    }
                }
            });

        });

        //insert data 
        $("#btnSave").click(function(e){
            // e.defaultPrevented();
            var uname = $("#name").val();
            var objcon = {cname:uname};
            var dataJson = JSON.stringify(objcon);
            $.ajax({
                url:"http://localhost/jqphp/api/insert.php",
                data:dataJson,
                type: "POST",
                success: function(upd){
                    if (upd.Status != true) {
                    $("#table_body").append("<tr><td colspan='3'><h3>"+ upd.massage +"</h3></td></tr>");
                    
                    }
                    else{
                        loadAllCategory();
                        uname.val('');
                        alert("in true Contion");
                    }
                    alert("in  out of Contion");
                }
                
            });
            alert("in last btn Contion");
        });
    });

</script>
