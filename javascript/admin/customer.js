$(document).ready(function(){
    showCustomer();
});
function showCustomer(){
    $.ajax({
        type:'GET',
        url:'/rent-band/Application/admin/getAllCustomer.php',
        dataType:'json',
        success:function(result){
            for(var i = 0; i< result.length; i++)
            {
                var bgcolor = i % 2 == 0 ? "#FFF" : "#EDEDED";
                $("#tblCustomer tbody").append("<tr bgcolor='"+ bgcolor +"'>"+
                                                "<td>"+ result[i].title +". "+ result[i].name +"</td>"+
                                                "<td>"+ result[i].address +"</td>"+
                                                "<td>"+ result[i].city +"</td>"+
                                                "<td>"+ result[i].state +"</td>"+
                                                "<td>"+ result[i].telp +"</td>"+
                                                "<td>"+ result[i].email +"</td>"+
                                                "</tr>");
            }
        }
    });
}