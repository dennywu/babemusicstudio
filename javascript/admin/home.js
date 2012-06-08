$(document).ready(function(){
    showPenyewaan();
});
function showPenyewaan(){
    $.ajax({
        type:"GET",
        url : "/rent-band/Application/admin/getAllRental.php",
        dataType: "json",
        success:showPenyewaanCallBack
    });
}
function showPenyewaanCallBack(data){
    data.reverse();
    for(var i = 0; i < data.length; i++){
        var bgcolor = i % 2 == 0 ? "#FFF" : "#EDEDED";
        $("#tblPenyewaan").append("<tr bgcolor='"+ bgcolor +"'>"+
                              "<td><span class='link' id='"+ data[i].id +"'>"+ data[i].norental +"</span></td>"+
                              "<td>"+ data[i].pelanggan +"</td>"+
                              "<td>"+ data[i].rentaldate.toDefaultFormatDate() +"</td>"+
                              "<td>"+ data[i].total.toCurrency(2) +"</td>"+
                              "<td>"+ data[i].status +"</td>"+
                              "</tr>");
    }
    $(".link").click(showDetail);
}
function showDetail(){
    var id = $(this).attr("id");
    $.ajax({
        type: 'GET',
        url: '/rent-band/Application/admin/getDetailRentalById.php?id='+id,
        dataType: 'json',
        success: showDetailCallBack
    });
}
function showDetailCallBack(data){
    console.log(data);
    $("#tblPenyewaan").hide();
    $(".container-page").load('/rent-band/views/admin/detailRental.html');
    var totalDenda= 0;
    setTimeout(function(){
        for(var i =0; i< data.items.length; i++){
            totalDenda += parseFloat(data.items[i].denda);
            $(".tblRentalCart tbody").append("<tr>"+
                            "<td width='60px'><a><img class='small-product' src='/rent-band/images/books/"+ data.items[i].image +"'></a></td>"+
                            "<td>"+
                                "<div class='detail-product'>"+
                                    "<span class='title-product'>"+data.items[i].name+"</span></br>"+
                                    "<span class='font10 c_abu'>"+ data.items[i].author +"</span></br></br>"+
                                    "<span class='font10 c_abu'>"+ data.items[i].publisher +"</span></br>"+
                                    "<span class='font10 c_abu'>Publisher: "+ data.items[i].published.toDefaultFormatDate() +"</span></br>"+
                                "</div>"+
                            "</td>"+
                            "<td>"+
                                "<div class='text-right'>"+ data.items[i].hargasatuan.toCurrency(2) +"</div>"+
                            "</td>"+
                            "<td>"+
                                "<div class='text-right'>"+ data.items[i].qty +
                                "</div>"+
                            "</td>"+
                            "<td>"+
                                "<div class='text-right'>"+ data.items[i].term +" Hari"+
                                "</div>"+
                            "</td>"+
                            "<td>"+
                                "<div class='text-right'>"+ data.items[i].total.toCurrency(2) +"</div>"+
                            "</td>"+
                            "<td>"+
                                "<div class='text-right'>"+ data.items[i].denda.toCurrency(2) +"</div>"+
                            "</td>"+
                            "</tr>");
        }
        $(".tblRentalCart tbody").append("<tr><td colspan='8'><div class='text-right'>Total Akhir : <strong>"+ (parseFloat(data.total) + totalDenda).toString().toCurrency(2) +"</strong></div></td></tr>");
        $(".tblRentalCart").append("<tr><td colspan='8'>"+
                                    "<div>Nomor Rental : <strong>"+ data.norental +"</strong></div>"+
                                    "</td></tr>");
        $(".tblRentalCart").append("<tr><td colspan='8'>"+
                                    "<div>Nama Pelanggan : <strong>"+ data.title +". "+ data.name +"</strong></div>"+
                                    "<div>Alamat : <strong>"+data.address+"</strong></div>"+
                                    "</td></tr>");
        $(".tblRentalCart").append("<tr><td colspan='8'>"+
                                    "<div>Tanggal Booking : <strong>"+ data.rentaldate.toDefaultFormatDateTime() +"</strong></div>"+
                                    "</td></tr>");
        $(".tblRentalCart").append("<tr><td colspan='8'>"+
                                    "<div>Berlaku Sampai Tanggal : <strong>"+ data.expiredate.toDefaultFormatDateTime() +"</strong></div>"+
                                    "</td></tr>");
        $(".tblRentalCart").append("<tr><td colspan='8'></td></tr>"+
                                    "<tr><td colspan='8'><div>"+
                                    "Terima Kasih <strong>"+data.title +". "+ data.name +"</strong>,<br/><br/>"+
                                    "Penyewaan buku ini akan berlaku sampai tanggal "+ data.expiredate.toDefaultFormatDateTime() +",<br/>"+
                                    "jika pada tanggal "+ data.expiredate.toDefaultFormatDateTime() +" anda belum mengambil buku penyewaan atau tidak konfirmasi maka status penyewaan anda <strong>Batal</strong>."+
                                    "Pembayaran dilakukan pada saat pengambilan buku sewaan.<br/><br/>"+
                                    "Untuk informasi lebih lanjut, hubungi : <br/>"+
                                    "Telp : XXXXXXXXXXXXX <br/>"+
                                    "<strong>Mei-hil Nagoya Center</strong>"+
                                    "</div>"+
                                    "</td></tr>");
        $(".tblRentalCart").append("<tr class='print'><td colspan='8'>"+
                                    "<div><input type='button' value='Cetak' onclick='cetak()'/></div>"+
                                    "</td></tr>");
        $(".tblRentalCart").append("<tr class='print'><td colspan='8'>"+
                                    "<div>Status: <select data='"+data.id+"' id='status' onchange='changeStatus()'><option value='Booking'>Booking</option><option value='Bayar'>Bayar</option><option value='Kembali'>Kembali</option><option value='Cancel'>Cancel</option></select></div>"+
                                    "</td></tr>");
        $("#status").val(data.status);
    }, 1000);
}

function cetak(){
    $(".print").hide();
    var print = $(".tblRentalCart");
    print.jqprint();
    $(".print").show();
}
function changeStatus(){
    var status = $("#status").val();
    var id = $("#status").attr("data");
    $.ajax({
        type:'POST',
        url:'/rent-band/Application/admin/updateStatus.php',
        data: {'id': id, 'status': status},
        dataType:'json',
        success: function(){
            alert("status berhasil diubah ke "+status);
        },
        error:function (a,b,c){
            alert("status berhasil diubah ke "+status);
        }
    });
}