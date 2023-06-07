<script>
    window.addEventListener('DOMContentLoaded', function() {
      var currencyCells = document.querySelectorAll('.currency');

      currencyCells.forEach(function(cell) {
        var amount = parseFloat(cell.textContent);

        if (!isNaN(amount)) {
          var formattedAmount = amount.toLocaleString('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 2 });
          cell.textContent = formattedAmount;
        }
      });
    });
</script>

<script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
    });

</script>

<script>
    $("#datepicker").datepicker( {
        format: "mm-yyyy",
        startView: "months",
        minViewMode: "months"
    });
</script>
