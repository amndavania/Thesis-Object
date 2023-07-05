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

        var $balanceChart = $('#balance-chart');

        var balanceChart = new Chart($balanceChart, {
            type: 'bar',
            data: {
                labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                datasets: [
                    {
                        backgroundColor: '#007bff',
                        borderColor: '#007bff',
                        data: trendKeuangan[0],
                    },
                    {
                        backgroundColor: '#ced4da',
                        borderColor: '#ced4da',
                        data: trendKeuangan[1],
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
                        gridLines: {
                            display: true,
                            lineWidth: '4px',
                            color: 'rgba(0, 0, 0, .2)',
                            zeroLineColor: 'transparent'
                        },
                        ticks: $.extend({
                            beginAtZero: true,
                            callback: function (value) {
                                if (value >= 1000000) {
                                    value /= 1000000
                                    value += 'jt'
                                }
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
    })
</script>


<script>
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = {
        labels: [
        'Lunas',
        'Belum Lunas',
        'Belum Bayar',
        ],
        datasets: [
        {
            data: statusUKT,
            backgroundColor: ['#28a745', '#ffc107', '#dc3545']
        }
        ]
    }
    var pieOptions = {
        legend: {
        display: false
        }
    }
    var pieChart = new Chart(pieChartCanvas, {
        type: 'doughnut',
        data: pieData,
        options: pieOptions
    })

    $('#world-map-markers').mapael({
        map: {
        name: 'usa_states',
        zoom: {
            enabled: true,
            maxLevel: 10
        }
        }
    })
</script>


