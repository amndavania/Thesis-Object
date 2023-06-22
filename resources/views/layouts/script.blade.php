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

<script>
    function exportToPDF() {
      fetch('<?php echo url("jurnal/export"); ?>')
        .then(response => response.json())
        .then(data => {
          const datepicker = data.datepicker;
          const html = data.html;
          const options = {
            filename: 'myPDF.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
          };

          const element = document.createElement('div');
          element.innerHTML = html;

          html2pdf().from(element).set(options).save();
        });
    }
    </script>

<script>
    const semesterSelect = document.getElementById('semester');
    const typeSelect = document.getElementById('type');

    semesterSelect.addEventListener('change', function() {
         const selectedSemester = parseInt(semesterSelect.value);

         if (selectedSemester !== 1 && selectedSemester !== 2) {
              const dppOption = typeSelect.querySelector('option[value="DPP"]');
              if (dppOption) {
                   dppOption.remove();
              }
         } else {
              const dppOption = typeSelect.querySelector('option[value="DPP"]');
              if (!dppOption) {
                   const option = document.createElement('option');
                   option.value = 'DPP';
                   option.text = 'DPP';
                   typeSelect.appendChild(option);
              }
         }
    });
</script>

<script>
    $(document).ready(function() {
        $('#students_id').select2();
    });
</script>

<script>
  function updateData(id, dispensasi, student_id) {
      var url = '{{ route('uktdetail.index') }}?id=' + encodeURIComponent(id) + '&dispensasi=' + encodeURIComponent(dispensasi) + '&students_id=' + encodeURIComponent(student_id);
      window.location.href = url;
  }
</script>

<script>
    function goBack() {
      window.history.back();
    }
  </script>

<script>
    $(document).ready(function() {
      $('#accounting_group_id').select2();
    });
</script>


