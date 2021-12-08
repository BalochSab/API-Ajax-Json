<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>More load..</title>
</head>
<body>
    <div id="table-show">
        <table id="loadData" border="1">
        <thead>
            <tr>
            <th>Id</th>
            <th>Name</th>
            </tr>
        </thead>
       
        </table>
    </div>
</body>
</html>
<script src="jqphp/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    function loadData(page){
        $.ajax({
            url:"ajax-pagi.php",
            type:"POST",
            data: {page_no:page},
            success: function(data){
                $("#loadData").append(data);
            }
        });
    }
    loadData();
    $(document).on("click","#ajaxbtn",function(){
        var pid = $("#ajaxbtn").data("id");
        
        loadData(pid);
        $("#pagi").remove();
        
    });
});

</script>