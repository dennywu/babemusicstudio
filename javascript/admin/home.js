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
                              "<td>"+ data[i].outstanding.toCurrency(2) +"</td>"+
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
    setTimeout(function(){
        for(var i =0; i< data.items.length; i++){
            $(".tblRentalCart tbody").append("<tr>"+
                            "<td width='60px'><a><img class='small-product' src='/rent-band/images/books/"+ data.items[i].image +"'></a></td>"+
                            "<td>"+
                                "<div class='detail-product'>"+
                                    "<span class='title-product'>"+data.items[i].name+"</span></br>"+
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
                                "<div class='text-right'>"+ data.items[i].denda.toCurrency(2) +"</div>"+
                            "</td>"+
                            "<td>"+
                                "<div class='text-right'>"+ data.items[i].total.toCurrency(2) +"</div>"+
                            "</td>"+
                            "</tr>");
        }
        $(".tblRentalCart tbody").append("<tr><td colspan='8'><div class='text-right'>Total Akhir : <strong>"+ data.total.toString().toCurrency(2) +"</strong></div></td></tr>");
        $(".tblRentalCart").append("<tr><td colspan='8'>"+
                                    "<div>Nomor Rental : <strong>"+ data.norental +"</strong></div>"+
                                    "</td></tr>");
        $(".tblRentalCart").append("<tr><td colspan='8'>"+
                                    "<div>Status : <strong>"+ data.status +"</strong></div>"+
                                    "</td></tr>");
        if(data.status != "Booking"){
            $(".tblRentalCart").append("<tr><td colspan='8'>"+
                                    "<div>Sisa Tagihan : <strong>"+ data.outstanding.toCurrency(2) +"</strong></div>"+
                                    "</td></tr>");
        }
        $(".tblRentalCart").append("<tr><td colspan='8'>"+
                                    "<div>Nama Pelanggan : <strong>"+ data.title +". "+ data.name +"</strong></div>"+
                                    "<div>Alamat : <strong>"+data.address+"</strong></div>"+
                                    "</td></tr>");
        $(".tblRentalCart").append("<tr><td colspan='8'>"+
                                    "<div>Tanggal Booking : <strong>"+ data.rentaldate.toDefaultFormatDateTime() +"</strong></div>"+
                                    "</td></tr>");
        if(data.status == "Booking"){
            $(".tblRentalCart").append("<tr><td colspan='8'>"+
                                    "<div>Berlaku Sampai Tanggal : <strong>"+ data.expiredate.toDefaultFormatDateTime() +"</strong></div>"+
                                    "</td></tr>");
        }
        $(".tblRentalCart").append("<tr><td colspan='8'></td></tr>"+
                                    "<tr><td colspan='8'><div>"+
                                    "Terima Kasih <strong>"+data.title +". "+ data.name +"</strong>,<br/><br/>"+
                                    "Penyewaan alat band ini akan berlaku sampai tanggal "+ data.expiredate.toDefaultFormatDateTime() +",<br/>"+
                                    "jika pada tanggal "+ data.expiredate.toDefaultFormatDateTime() +" anda belum mengambil alat band yang disewa atau tidak konfirmasi maka status penyewaan anda <strong>Batal</strong>. "+
                                    "Pembayaran dilakukan pada saat pengambilan alat band. <br/><br/>"+
                                    "Untuk informasi lebih lanjut, hubungi : <br/>"+
                                    "<strong>Babe Music Studio</strong><br/>"+
                                    "Telp : 0778-393596 & 081372478680 <br/>"+
                                    "Alamat : Perumahan Puskopkar blok B4 no 8 Batu Aji, Batam<br/>"+
                                    "</div>"+
                                    "</td></tr>");
        $(".tblRentalCart").append("<tr class='print'><td colspan='8'>"+
                                    "<div><input type='button' value='Cetak' onclick='cetak()'/></div>"+
                                    "</td></tr>");
        if(data.status == "Booking"){
            $(".tblRentalCart").append("<tr class='print'><td colspan='8'>"+
                                    "<form action='/rent-band/Application/admin/AmbilBarang.php' method='POST'><div><input type='hidden' name='rentalid' value='"+ data.id +"'/><input type='submit' value='Pinjam'/></div></form>"+
                                    "</td></tr>");
        }
        if(data.isreturn != "true" && data.status != "Booking"){
            $(".tblRentalCart").append("<tr class='print'><td colspan='8'>"+
                                    "<form action='/rent-band/Application/admin/return.php' method='POST'><div><input type='hidden' name='rentalid' value='"+ data.id +"'/><input type='submit' value='Kembali'/></div></form>"+
                                    "</td></tr>");
        }
        if(data.status != "Lunas" && data.status != "Booking"){
            $(".tblRentalCart").append("<tr class='print'><td colspan='8'>"+
                                    "<div><form action='/rent-band/Application/admin/pembayaran.php' method='POST'>Pembayaran: <input type='hidden' name='rentalid' value='"+ data.id +"'/>"+
                                    "<input type='text' name='amount'/> <button type='submit'>Bayar</button></form></div>"+
                                    "</td></tr>");
        }
        if(data.status != "Booking"){
        $(".tblRentalCart").append("<tr><td colspan='8'>"+
                                    "<table cellpadding='0' cellspacing='0' id='riwayatPembayaran' width='350px'><tr><td colspan='2'><strong>Riwayat Pembayaran : </strong></td></tr></table>"+
                                    "</td></tr>");
        }
        showRiwayatPembayara(data.id);
    }, 1000);
}

function showRiwayatPembayara(rentalid){
    $.ajax({
        type:'GET',
        url:'/rent-band/Application/admin/getListPayment.php?id='+rentalid,
        dataType:'json',
        success:function(data){
            if(data.length == 0){
                $("#riwayatPembayaran").append("<tr><td colspan='2' align:'center'>Tidak Ada Pembayaran</td></tr>")
            }
            else{
                for(var i = 0; i< data.length;i++){
                    $("#riwayatPembayaran").append("<tr><td>"+ data[i].paymentdate.toDefaultFormatDateTime() +"</td><td>"+ data[i].amount.toCurrency(2) +"</td></tr>")
                }
            }
        }
    });
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