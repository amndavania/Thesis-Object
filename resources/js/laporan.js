window.addEventListener("DOMContentLoaded", function () {
  var currencyCells = document.querySelectorAll(".currency");

  currencyCells.forEach(function (cell) {
    var amount = parseFloat(cell.textContent);

    if (!isNaN(amount)) {
      var formattedAmount = amount.toLocaleString("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
      });
      cell.textContent = formattedAmount;
    }
  });
});
