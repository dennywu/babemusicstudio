
function CreateDivDetailPerHari() {
    $("#DivDetailReservasi").remove();
    $(".tabscontent").append("<div id='DivDetailReservasi'>" +
                            "<label class='headerContent'>Laporan Detail Penyewaan Per Hari</label><br /><br />" +
                            "<table id='PencarianDetailPenjualan'>" +
                            "<tr><td>Dari</td>" +
                            "<td><input type='text' name='dari' id='dari' readonly='readonly'/></td></tr>" +
                            "<tr><td>Sampai</td>" +
                            "<td><input type='text' name='sampai' id='sampai' readonly='readonly' /></td></tr>" +
                            "<tr><td colspan='3'>" +
                            "<button id='TampilLaporan' class='positive button'>Tampilkan Laporan</button>&nbsp;" +
                            "</td></tr></table></div>");

    var dates = $("#dari, #sampai").datepicker({dateFormat: 'yy-mm-dd',
        defaultDate: "+1w",
        gotoCurrent: true,
        changeMonth: true,
        numberOfMonths: 1,
        onSelect: function (selectedDate) {
            var option = this.id == "dari" ? "minDate" : "maxDate",
					instance = $(this).data("datepicker"),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings);
            dates.not(this).datepicker("option", option, date);
        }
    });
    SetDefaultDateDetailPerHari();
    $("#TampilLaporan").click(FindDetailReservationPerHari);
}
function DestroyTableDetailReservationPerHari() {
    ClearDataPencarian();
    SetDefaultDateDetailPerHari();
    $("div#DivTableDetailPenjualan").remove();
    $("#tabContainer").show();
}
function FindDetailReservationPerHari() {
    var dari = $("#dari").val();
    var sampai = $("#sampai").val();
    if (dari == "" || sampai == "")
        return alert("Semua Field Harus Di Isi");
    $("#tabContainer").hide();
    CreateTableDetailReservationPerHari();
    
    $.ajax({
        type: "POST",
        url: "/rent-band/Application/admin/SearchDetailRentalPerHari.php",
        data: {"dari": dari, "sampai": sampai},
        dataType: "json",
        beforeSend: AjaxStart,
        complete: AjaxEnd,
        success: InsertDetailReservationPerHariToTable
    });
}

function CreateTableDetailReservationPerHari() {
    $("div#DivTableDetailPenjualan").remove();
    $(".container-page").append("<div id='DivTableDetailPenjualan'>" +
                                     "<label id='Back' class='positive button' style='padding:5px;background-color:#ccc;cursor:pointer;'>Kembali Ke Pencarian</label>" +
                                     "<input type='text' id='no_reservation_search' placeholder='Search'/>" +
                                     "<img class='loadingSearchTransaction' src='/viona/images/loader.gif'/>" +
                                     "<label class='TenantName'>Dari: "+ $("#dari").val().toDefaultFormatDate() +" sampai: "+ $("#sampai").val().toDefaultFormatDate() +"</label>" +
                                     "<div class='DialogOverlay'></div>" +
                                     "<table width='100%' id='TableDetailPenjualan' class='tablesorter'><thead style='cursor:pointer;'><tr>" +
                                     "<th class='tanggal'>Tanggal</th>" +
                                     "<th class='noTransaksi'>Sisa Tagihan</th>" +
                                     "<th class='noTransaksi'>Total</th>" +
                                     "</thead><tbody></tbody><tfoot></tfoot></table></div>");
    $("#Back").click( DestroyTableDetailReservationPerHari);
}

function InsertDetailReservationPerHariToTable(data) {
    if (data == null || data.length == 0) {
        DestroyTableDetailReservationPerHari();
        return alert("Data Penjualan Tidak Di Temukan");
    }
    $("#TableDetailPenjualan tbody").empty();
    var color;
    var total = 0;
    $.each(data, function (item) {
        total += data[item].total;
        color = (item % 2 == 0) ? "#e3ecff" : "#fff";
        $("#TableDetailPenjualan tbody").append("<tr onclick='ShowDetailProduct(\"" + data[item].rentaldate + "\")'>" +
                                                "<td class='tanggal'>" + data[item].rentaldate.toDefaultFormatDate() + "</td>" +
                                                "<td class='tanggal'>" + data[item].outstanding.toCurrency(2) + "</td>" +
                                                "<td class='tanggal'>" + data[item].total.toCurrency(2) + "</td>" +
                                                "</tr>");
    });
        
    $('#no_reservation_search').quicksearch('table#TableDetailPenjualan tbody tr',
            {
                stripeRows: ['odd', 'even'],
                loader: 'img.loadingSearchTransaction'
            });
}
        

function ClearDataPencarian() {
    $("#dari").val('');
    $("#sampai").val('');
}
function SetDefaultDateDetailPerHari() {
    var now = new Date();
    var day = (now.getDate() < 10 ? '0':'') + now.getDate();
    var month = (now.getMonth() < 10 ? '0':'') + (now.getMonth()+1);
    var year = (now.getFullYear() < 10 ? '0':'') + now.getFullYear();
    $("#dari").val(year+"-"+month+"-"+day);
    $("#sampai").val(year+"-"+month+"-"+day);
}