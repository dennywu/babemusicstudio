String.prototype.toCurrency = function(rounder) {
    aDigits = parseFloat(this).toFixed(rounder).split(".");
    aDigits[0] = aDigits[0].split("").reverse().join("")
                                    .replace(/(\d{3})(?=\d)/g, "$1,").split("").reverse().join("");
    return "Rp "+ aDigits.join(".");
}

Number.prototype.ToCurrencyWithSymbol = function (ccyCode, rounder) {
    var symbol = ccyCode.ConvertToCurrencySymbol();
    aDigits = this.toFixed(rounder).split(".");
    aDigits[0] = aDigits[0].split("").reverse().join("")
                                    .replace(/(\d{3})(?=\d)/g, "$1,").split("").reverse().join("");
    return symbol + aDigits.join(".");
}

String.prototype.ConvertToCurrencySymbol = function () {
    if (this == "IDR")
        return "Rp. ";
    else if (this == "USD")
        return "$ ";
}