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

<!-- DPA -->
<script>
    $(document).ready(function() {
        $('#dpatahunajaran').datepicker({
            format: 'yyyy',
            startView: 'years',
            minViewMode: 'years',
            autoclose: true
        });
    });
</script>

{{-- Script Laporan --}}

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

{{-- Script UKT --}}

<script>
    function handleStudentChange() {
      var selectedStudent = document.getElementById("mahasiswaID");
      var tahunAjaranInput = document.getElementById("tahunAjaran");

      var selectedForce = selectedStudent.options[selectedStudent.selectedIndex].getAttribute("data-force");

      $(tahunAjaranInput).datepicker('destroy');
      $(tahunAjaranInput).datepicker({
        format: 'yyyy',
        startView: 'years',
        minViewMode: 'years',
        autoclose: true,
        startDate: new Date(selectedForce, 0, 1)
      });

      $(tahunAjaranInput).val('');
      $(tahunAjaranInput).attr('placeholder', 'Pilih Tahun Ajaran');

    }

    var semesterSelect = document.getElementById('semester');
    semesterSelect.addEventListener('change', function()  {
        var selectedStudent = document.getElementById("mahasiswaID");
        var tahunAjaranInput = document.getElementById("tahunAjaran");
        var selectedForce = selectedStudent.options[selectedStudent.selectedIndex].getAttribute("data-force");

        var typeSelect = document.getElementById('type');

        var selectedSemester = parseInt(semesterSelect.value);

        var semester = ((parseInt(tahunAjaranInput.value) - parseInt(selectedForce)) * 2) + (selectedSemester === "GENAP" ? 0 : 1)

        if (semester > 2) {
            var dppOption = typeSelect.querySelector('option[value="DPP"]');
            if (dppOption) {
                dppOption.remove();
            }
        } else {
            var dppOption = typeSelect.querySelector('option[value="DPP"]');
            if (!dppOption) {
                var option = document.createElement('option');
                option.value = 'DPP';
                option.text = 'DPP';
                typeSelect.appendChild(option);
            }
        }
    });

    function handleYearChange() {
        var tahunAjaranInput = document.getElementById("tahunAjaran");
        var semesterSelect = document.getElementById('semester');
        var typeSelect = document.getElementById('type');

        semesterSelect.value = '';
        semesterSelect.setAttribute('placeholder', 'Pilih Semester');

        typeSelect.value = '';
        typeSelect.setAttribute('placeholder', 'Pilih Jenis Pembayaran');
    }

</script>

<script>
    $(document).ready(function() {
        $('#students_id').select2();
    });
</script>

<script>
    $(document).ready(function() {
        $('#mahasiswaID').select2();
    });
</script>

<script>
    $(document).ready(function() {
        $('#dpa_id').select2();
    });
</script>

<script>
  function updateData(id, dispensasi, student_id) {
      var url = '{{ route('uktdetail.index') }}?id=' + encodeURIComponent(id) + '&dispensasi=' + encodeURIComponent(dispensasi) + '&students_id=' + encodeURIComponent(student_id);
      window.location.href = url;
  }
</script>

<script>
    function updateKrs(dpa_id, lbs_id, student_id, status) {
    var url = '{{ url('daftar_mahasiswa') }}?dpa_id=' + encodeURIComponent(dpa_id) + '&lbs_id=' + encodeURIComponent(lbs_id) + '&student_id=' + encodeURIComponent(student_id) + '&status=' + encodeURIComponent(status);
    window.location.href = url;
}

  </script>

<script>
    $(document).ready(function() {
      $('#accounting_group_id').select2();
    });
</script>

<script>
    function handleFilterUktChange() {
        var filterUktSelect = document.getElementById("filterUkt");
        var mahasiswaContainer = document.getElementById("mahasiswaContainer");
        var fakultasContainer = document.getElementById("fakultasContainer");
        var datepickerContainer = document.getElementById("datepickerContainer");

        if (filterUktSelect.value === "student") {
            mahasiswaContainer.style.display = "block";
            fakultasContainer.style.display = "none";
            datepickerContainer.style.display = "none";
        } else if (filterUktSelect.value === "faculty") {
            mahasiswaContainer.style.display = "none";
            fakultasContainer.style.display = "block";
            datepickerContainer.style.display = "block";
        }
    }
</script>

{{-- Script Dashboar --}}
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

<script>
    $(document).ready(function() {
        $('.my-custom-select1').select2();
        $('.my-custom-select2').select2();
        $('#prodi_search_id').on('change', function() {
            var searchText = $(this).val().toLowerCase();
            $('#prodi_search_id option').each(function() {
                var optionText = $(this).text().toLowerCase();
                var showOption = optionText.includes(searchText);
                $(this).toggle(showOption);
            });
            $('.my-custom-select1').select2('destroy').select2();
        });

        $('#angkatan_search_id').on('change', function() {
            var searchText = $(this).val().toLowerCase();
            $('#angkatan_search_id option').each(function() {
                var optionText = $(this).text().toLowerCase();
                var showOption = optionText.includes(searchText);
                $(this).toggle(showOption);
            });
            
            $('.my-custom-select2').select2('destroy').select2();
        });
    });
</script>
