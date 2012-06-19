$(document).ready(function(){
    showitem();
});
function showitem(){
    $.ajax({
        type:'GET',
        url:'/rent-band/Application/admin/getAllBook.php',
        dataType:'json',
        success:showitemCallBack
    });
}
function showitemCallBack(data){
    for(var i = 0; i< data.length; i++){
        var bgcolor = i % 2 == 0 ? "#FFF" : "#EDEDED";
        $("#tblbook tbody").append("<tr bgcolor='"+ bgcolor +"'>"+
                            "<td><img src='/rent-band/images/books/"+data[i].image+"' width='30px' target='_blank'/></td>"+
                            "<td>"+data[i].name+"</td>"+
                            "<td width= '90px' class='text-right'>"+data[i].dendaperhari.toCurrency(2)+"</td>"+
                            "<td width= '90px' class='text-right'>"+data[i].amount.toCurrency(2)+"</td>"+
                            "<td><input type='button' value='Update' id='"+ data[i].id +"'class='update'/></td>"+
                            "</tr>");
    }
	$(".update").click(updatePaket);
}
function updatePaket(){
	var id = $(this).attr("id");
	var editDialog = ModalDialog.Show();
        $('.Detail').load('/rent-band/views/admin/editPaket.html');
        setDataToUpdateDialog(id);
}
function createBook(){
	var editDialog = ModalDialog.Show();
        $('.Detail').load('/rent-band/views/admin/newPaket.html');
}
function closeDialogEdit(){
      $('.ModalDialog').remove();
}
function setDataToUpdateDialog(id){
    $.ajax({
        type:'GET',
        url:'/rent-band/Application/admin/getPaketById.php?id='+id,
        dataType:'json',
        success:function(data){
            $("#id").val(data.id);
            $("#name").val(data.name);
            $("#detail").val(data.detail);
            $("#dendaperhari").val(data.dendaperhari);
            $("#amount").val(data.amount);
        }
    });
}