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
    function handleFilterChange() {
        var filter = document.getElementById('filter').value;
        var datepicker = document.getElementById('datepicker');
        
        if (filter === 'year') {
            // Hanya izinkan pengguna memilih tahun\
            $(datepicker).datepicker('destroy');
            $(datepicker).datepicker({
                format: 'yyyy',
                startView: 'years',
                minViewMode: 'years',
                autoclose: true
            });
            datepicker.value = ''
            datepicker.setAttribute('placeholder', 'Pilih Tahun');
        } else if (filter === 'month') {
            // Izinkan pengguna memilih bulan dan tahun
            $(datepicker).datepicker('destroy');
            $(datepicker).datepicker({
                format: 'mm-yyyy',
                startView: 'months',
                minViewMode: 'months',
                autoclose: true
            });
            datepicker.value = ''
            datepicker.setAttribute('placeholder', 'Pilih Bulan');
        } else {
            // Reset datepicker jika filter tidak dipilih
            datepicker.value = '';
        }
    }
    
    // Inisialisasi datepicker saat halaman dimuat
    $(document).ready(function() {
        $('#datepicker').datepicker({
            format: 'mm-yyyy',
            startView: 'months',
            minViewMode: 'months',
            autoclose: true
        });
    });
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
    $(document).ready(function() {
      $('#accounting_group_id').select2();
    });
</script>

<script>
    $(function () {
        'use strict'

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode = 'index'
        var intersect = true

        var $salesChart = $('#balance-chart')
        // eslint-disable-next-line no-unused-vars
        var salesChart = new Chart($salesChart, {
            type: 'bar',
            data: {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [
                {
                backgroundColor: '#007bff',
                borderColor: '#007bff',
                data: [100000000, 200000000, 300000000, 250000000, 270000000, 250000000, 300000000, 100000000, 200000000, 300000000, 250000000, 270000000]
                },
                {
                backgroundColor: '#ced4da',
                borderColor: '#ced4da',
                data: [70000000, 170000000, 270000000, 200000000, 180000000, 150000000, 200000000, 70000000, 170000000, 270000000, 200000000, 180000000]
                }
            ]
            },
            options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                // display: false,
                gridLines: {
                    display: true,
                    lineWidth: '4px',
                    color: 'rgba(0, 0, 0, .2)',
                    zeroLineColor: 'transparent'
                },
                ticks: $.extend({
                    beginAtZero: true,

                    // Include a dollar sign in the ticks
                    callback: function (value) {
                    if (value >= 1000000) {
                        value /= 1000000
                        value += 'jt'
                    }

                    // return 'Rp' + value
                    return value
                    }
                }, ticksStyle)
                }],
                xAxes: [{
                display: true,
                gridLines: {
                    display: false
                },
                ticks: ticksStyle
                }]
            }
            }
        })

        var $visitorsChart = $('#visitors-chart')
        // eslint-disable-next-line no-unused-vars
        var visitorsChart = new Chart($visitorsChart, {
            data: {
            labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
            datasets: [{
                type: 'line',
                data: [100, 120, 170, 167, 180, 177, 160],
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                pointBorderColor: '#007bff',
                pointBackgroundColor: '#007bff',
                fill: false
                // pointHoverBackgroundColor: '#007bff',
                // pointHoverBorderColor    : '#007bff'
            },
            {
                type: 'line',
                data: [60, 80, 70, 67, 80, 77, 100],
                backgroundColor: 'tansparent',
                borderColor: '#ced4da',
                pointBorderColor: '#ced4da',
                pointBackgroundColor: '#ced4da',
                fill: false
                // pointHoverBackgroundColor: '#ced4da',
                // pointHoverBorderColor    : '#ced4da'
            }]
            },
            options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                // display: false,
                gridLines: {
                    display: true,
                    lineWidth: '4px',
                    color: 'rgba(0, 0, 0, .2)',
                    zeroLineColor: 'transparent'
                },
                ticks: $.extend({
                    beginAtZero: true,
                    suggestedMax: 200
                }, ticksStyle)
                }],
                xAxes: [{
                display: true,
                gridLines: {
                    display: false
                },
                ticks: ticksStyle
                }]
            }
            }
        })
        })

</script>

