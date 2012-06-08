$(document).ready(function(){
    showCategory();
    if($.getUrlVars()[0] == "error")
        alert("Gagal Hapus Kategori. Ada buku yang menggunakan kategori ini");
    if($.getUrlVars()[0] == "errora")
        alert("Gagal Tambah Kategori. Nama kategori yang di tambah sudah terdapat di dalam daftar kategori");
});
function showCategory(){
    $.ajax({
        type:'GET',
        url:'/rent-band/Application/admin/getAllCategory.php',
        dataType:'json',
        success:function(result){
            for(var i = 0; i< result.length; i++)
            {
                var bgcolor = i % 2 == 0 ? "#FFF" : "#EDEDED";
                $("#tblCategory tbody").append("<tr bgcolor='"+ bgcolor +"' id='"+ result[i].id +"' name='"+ result[i].name +"'>"+
                                                "<td>"+ (i + 1) +"</td>"+
                                                "<td>"+ result[i].name +"</td>"+
                                                "<td><input type='button' value='update' class='update'/></td>"+
                                                "<td><a class='remove' href='/rent-band/Application/admin/deleteCategory.php?id="+result[i].id+"' title='Hapus Kategori'>X</a></td>"+
                                                "</tr>");
            }
            $("#tblCategory tbody").append("<tr><td colspan='4' style='text-align:center;'><input type='button' value='Tambah Kategori' onclick='AddCategory()'/></td></tr>");
            $(".update").click(updateCategory);
        }
    });
}
function updateCategory(){
    var id = $(this).parent().parent().attr("id");
    var name = $(this).parent().parent().attr("name");
    if($("#divUpdateCateogry").length > 0) $("#divUpdateCateogry").remove();
    $(".container-page").append("<div id='divUpdateCateogry'><form action='/rent-band/Application/admin/updateCategory.php' method='POST'><table cellpadding='5px' cellspacing='0'>"+
                                "<thead><tr><td>Ubah Kategori</td><td style='text-align:right;'><div class='remove' onclick='closeDialogUpdate()'>X</div></td></tr></thead>"+
                                "<tbody><tr>"+
                                "<td><input type='text' value='"+ name +"' name='categoryName'/><input type='hidden' value='"+ id +"' name='categoryid'/></td>"+
                                "<td><input type='submit' value='Ubah'/></td>"+
                                "</tr></tbody></table></div>");
}
function closeDialogUpdate(){
    $("#divUpdateCateogry").remove();
}
function AddCategory(){
    if($("#divUpdateCateogry").length > 0) $("#divUpdateCateogry").remove();
    $(".container-page").append("<div id='divUpdateCateogry'><form action='/rent-band/Application/admin/addCategory.php' method='POST'><table cellpadding='5px' cellspacing='0'>"+
                                "<thead><tr><td>Tambah Kategori</td><td style='text-align:right;'><div class='remove' onclick='closeDialogUpdate()'>X</div></td></tr></thead>"+
                                "<tbody><tr>"+
                                "<td><input type='text' value='' name='categoryName'/></td>"+
                                "<td><input type='submit' value='Tambah'/></td>"+
                                "</tr></tbody></table></div>");
}