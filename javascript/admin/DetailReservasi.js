
function CreateDivDetailReservasi() {
    $("#DivDetailReservasi").remove();
    $(".tabscontent").append("<div id='DivDetailReservasi'>" +
                            "<label class='headerContent'>Laporan Detail Penyewaan</label><br /><br />" +
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
    SetDefaultDateDetailPenjualan();
    $("#TampilLaporan").click(FindDetailReservation);
}

function FindDetailReservation() {
    var dari = $("#dari").val();
    var sampai = $("#sampai").val();
    if (dari == "" || sampai == "")
        return alert("Semua Field Harus Di Isi");
    $("#tabContainer").hide();
    CreateTableDetailReservation();
    
    $.ajax({
        type: "POST",
        url: "/rent-band/Application/admin/SearchDetailReservation.php",
        data: {"dari": dari, "sampai": sampai},
        dataType: "json",
        beforeSend: AjaxStart,
        complete: AjaxEnd,
        success: InsertDetailReservationToTable
    });
}

function CreateTableDetailReservation() {
    $("div#DivTableDetailPenjualan").remove();
    $(".container-page").append("<div id='DivTableDetailPenjualan'>" +
                                     "<label id='Back' class='positive button' style='padding:5px;background-color:#ccc;cursor:pointer;'>Kembali Ke Pencarian</label>" +
                                     "<input type='text' id='no_reservation_search' placeholder='Search'/>" +
                                     "<img class='loadingSearchTransaction' src='/viona/images/loader.gif'/>" +
                                     "<label class='TenantName'>Dari: "+ $("#dari").val().toDefaultFormatDate() +" sampai: "+ $("#sampai").val().toDefaultFormatDate() +"</label>" +
                                     "<div class='DialogOverlay'></div>" +
                                     "<table width='100%' id='TableDetailPenjualan' class='tablesorter'><thead style='cursor:pointer;'><tr>" +
                                     "<th class='tanggal'>No Rental</th>" +
                                     "<th class='noTransaksi'>Nama Pelanggan</th>" +
                                     "<th class='noTransaksi'>Tanggal Penyewaan</th>" +
                                     "<th class='noTransaksi'>Sisa Tagihan</th>" +
                                     "<th class='IDR' >Total Harga</th></tr>" +
                                     "</thead><tbody></tbody><tfoot></tfoot></table></div>");
    $("#Back").click(DestroyTableDetailReservation);
}

function InsertDetailReservationToTable(data) {
    if (data == null || data.length == 0) {
        DestroyTableDetailReservation();
        return alert("Data Penjualan Tidak Di Temukan");
    }
    $("#TableDetailPenjualan tbody").empty();
    var color;
    var total = 0;
    $.each(data, function (item) {
        total += data[item].total;
        color = (item % 2 == 0) ? "#e3ecff" : "#fff";
        $("#TableDetailPenjualan tbody").append("<tr onclick='ShowDetailProduct(\"" + data[item].norental + "\")'>" +
                                                "<td class='tanggal'>" + data[item].norental + "</td>" +
                                                "<td class='noTransaksi'>" + data[item].customer + "</td>" +
                                                "<td class='noTransaksi'>" + data[item].rentaldate.toDefaultFormatDate() + "</td>" +
                                                "<td class='noTransaksi'>Rp. " + data[item].outstanding.toCurrency(2) + "</td>" +
                                                "<td class='noTransaksi'>Rp. " + data[item].total.toCurrency(2) + "</td>" +
                                                "</tr>");
    });
        
    $('#no_reservation_search').quicksearch('table#TableDetailPenjualan tbody tr',
            {
                stripeRows: ['odd', 'even'],
                loader: 'img.loadingSearchTransaction'
            });
}
        

function DestroyTableDetailReservation() {
    ClearDataPencarian();
    SetDefaultDateDetailPenjualan();
    $("div#DivTableDetailPenjualan").remove();
    $("#tabContainer").show();
}
function AjaxStart() {
    $("div.DialogOverlay").show();
}
function AjaxEnd() {
    $("div.DialogOverlay").hide();
}
function ClearDataPencarian() {
    $("#dari").val('');
    $("#sampai").val('');
    $("#tenant").val('');
    $("#tenantName").text('');
}
function SetDefaultDateDetailPenjualan() {
    var now = new Date();
    var day = (now.getDate() < 10 ? '0':'') + now.getDate();
    var month = (now.getMonth() < 10 ? '0':'') + (now.getMonth()+1);
    var year = (now.getFullYear() < 10 ? '0':'') + now.getFullYear();
    $("#dari").val(year+"-"+month+"-"+day);
    $("#sampai").val(year+"-"+month+"-"+day);
}