$(document).ready(function () {
            CreateTabMenu();

        });
        function CreateTabMenu() {
            $(".container-page").append("<div id='tabContainer'>" +
                    "<div class='tabs'>" +
                    "<ul><li id='tabHeader_1'>Detail Penyewaan</li>" +
                    "<li id='tabHeader_2'>Ringkasan Per Hari</li></ul>" +
                    //"<li id='tabHeader_3'>Ringkasan Per Bulan</li></ul>"+
                    "</div><div class='tabscontent'>" +
                    "</div></div>");
            $("#tabHeader_1").click(CreateDivDetailReservasi);
            InitTab();
        }
        function InitTab() {
            var container = document.getElementById("tabContainer");
            var navitem = container.querySelector(".tabs ul li");
            var ident = navitem.id.split("_")[1];
            navitem.parentNode.setAttribute("data-current", ident);
            navitem.setAttribute("class", "tabActiveHeader");
            CreateDivDetailReservasi();
            var tabs = container.querySelectorAll(".tabs ul li");
            for (var i = 0; i < tabs.length; i++) {
                tabs[i].onclick = DisplayPage;
            }
        }

        function DisplayPage() {
            var current = this.parentNode.getAttribute("data-current");
            document.getElementById("tabHeader_" + current).removeAttribute("class");
            var ident = this.id.split("_")[1];
            if (ident == 1) {
                this.setAttribute("class", "tabActiveHeader");
                CreateDivDetailPenjualan();
                $("#DivSummary").hide();
                $("#DivSummaryPerkasir").hide();
                $("#DivRingkasanPerHari").hide();
                this.parentNode.setAttribute("data-current", ident);
            }
            else if (ident == 2) {
                this.setAttribute("class", "tabActiveHeader");
                CreateDivDetailPerHari();
                $("#DivDetailPenjualan").hide();
                $("#DivSummaryPerkasir").hide();
                $("#DivRingkasanPerHari").hide();
                this.parentNode.setAttribute("data-current", ident);
            }
            else if (ident == 3) {
                this.setAttribute("class", "tabActiveHeader");
                CreateDivDetailPerBulan();
                $("#DivDetailPenjualan").hide();
                $("#DivSummary").hide();
                $("#DivRingkasanPerHari").hide();
                this.parentNode.setAttribute("data-current", ident);
            }
        }