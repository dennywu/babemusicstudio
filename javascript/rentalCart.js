$(document).ready(function(){
    $("#btncheckout").click(showInputCustomer);
});
function showInputCustomer(){
    $("#btncheckout").hide();
    $("#inputcust").load("/rent-band/views/inputCustomer.html");
}
function Booking(){
    var data = $("#frmInpuTCust").serialize();
    $.ajax({
        type:'POST',
        url: '/rent-band/Application/checkout.php',
        data: data,
        dataType:'json',
        success:showDetailRental
    });
}
function showDetailRental(data){
    $(".hide").hide();
    setReadonly($("input[type=number]"));
    $("#inputcust").remove();
    setInformation(data);
}
function setReadonly(el){
    for(var i =0; i< el.length; i++){
        el[i].setAttribute("readonly");
    }
}
function setInformation(data){
    $("#spanCart").empty().append("Keranjang Penyewaan: 0 Paket");
    
    $(".tblRentalCart").append("<tr><td colspan='8'>"+
                                "<div>Nomor Rental : <strong>"+ data.norental +"</strong></div>"+
                                "</td></tr>");
    $(".tblRentalCart").append("<tr><td colspan='8'>"+
                                "<div>Nama Pelanggan : <strong>"+ data.title +". "+ data.name +"</strong></div>"+
                                "<div>Alamat : <strong>"+data.address+"</strong></div>"+
                                "</td></tr>");
    $(".tblRentalCart").append("<tr><td colspan='8'>"+
                                "<div>Tanggal Booking : <strong>"+ data.rentaldate.date.toDefaultFormatDateTime() +"</strong></div>"+
                                "</td></tr>");
    $(".tblRentalCart").append("<tr><td colspan='8'>"+
                                "<div>Berlaku Sampai Tanggal : <strong>"+ data.expiredate.date.toDefaultFormatDateTime() +"</strong></div>"+
                                "</td></tr>");
    $(".tblRentalCart").append("<tr><td colspan='8'></td></tr>"+
                                "<tr><td colspan='8'><div>"+
                                "Terima Kasih <strong>"+data.title +". "+ data.name +"</strong>,<br/><br/>"+
                                "Penyewaan alat band ini akan berlaku sampai tanggal "+ data.expiredate.date.toDefaultFormatDateTime() +",<br/>"+
                                "jika pada tanggal "+ data.expiredate.date.toDefaultFormatDateTime() +" anda belum mengambil alat band yang disewa atau tidak konfirmasi maka status penyewaan anda <strong>Batal</strong>. "+
                                "Pembayaran dilakukan pada saat pengambilan alat band. <br/><br/>"+
                                "Untuk informasi lebih lanjut, hubungi : <br/>"+
                                "<strong>Babe Music Studio</strong><br/>"+
                                "Telp : 0778-393596 & 081372478680 <br/>"+
                                "Alamat : Perumahan Skopkar blok B4 no 8 Batu Aji, Batam<br/>"+
                                "</div>"+
                                "</td></tr>");
     
    $(".tblRentalCart").append("<tr class='print'><td colspan='8'>"+
                                "<div><input type='button' value='Cetak' onclick='cetak()'/></div>"+
                                "</td></tr>");
}

function cetak(){
    $(".print").hide();
    var print = $(".tblRentalCart");
    print.jqprint();
    $(".print").show();
}