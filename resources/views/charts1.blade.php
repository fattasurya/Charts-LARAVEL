<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Include CSRF Token for AJAX requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Population Data - Admin</title>

    <!-- External CSS and JS libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Bootstrap JS and CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include SweetAlert2 for better alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- Google Charts loader -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <!-- Custom Styles to match the user page -->
    <style>
        /* Overall styling */
        body {
            background-color: #e9ecef !important;
            /* Light background */
            font-family: 'Poppins', sans-serif !important;
            color: #343a40 !important;
            /* Dark gray text */
        }

        /* Container styling */
        .container {
            margin-top: 60px !important;
            background-color: #ffffff !important;
            padding: 30px !important;
            border-radius: 20px !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
        }

        /* Header and title styling */
        h3 {
            color: #000000 !important;
            /* Bright blue heading */
            margin-bottom: 20px !important;
            font-weight: 700 !important;
        }

        /* Button customization */
        .btn-custom {
            margin: 10px !important;
            color: #fff !important;
            /* White text */
            background-color: #5B99C2 !important;
            /* Bright blue */
            border-radius: 50px !important;
            /* More rounded buttons */
            padding: 10px 40px !important;
            font-size: 18px !important;
            font-weight: 700 !important;
            letter-spacing: 1px !important;
            transition: background-color 0.4s ease !important;
        }

        .btn-custom:hover {
            background-color: #0056b3 !important;
            /* Dark blue on hover */
        }

        /* Secondary button */
        .btn-secondary-custom {
            margin: 10px !important;
            color: #fff !important;
            background-color: #6c757d !important;
            /* Secondary gray color */
            border-radius: 50px !important;
            padding: 10px 40px !important;
            font-size: 18px !important;
            font-weight: 700 !important;
            letter-spacing: 1px !important;
            transition: background-color 0.4s ease !important;
        }

        .btn-secondary-custom:hover {
            background-color: #5a6268 !important;
            /* Darker gray on hover */
        }

        /* Warning button */
        /* Centering buttons */
        .text-center-buttons {
            text-align: center !important;
        }

        /* Warning button */
        .btn-warning-custom {
            margin: 5px !important;
            /* Reduced margin */
            color: #fff !important;
            background-color: #FFC700 !important;
            /* Warning yellow color */
            border-radius: 25px !important;
            /* Less rounded */
            padding: 8px 20px !important;
            /* Reduced padding */
            font-size: 16px !important;
            /* Smaller font size */
            font-weight: 600 !important;
            /* Slightly lighter font weight */
            letter-spacing: 0.5px !important;
            /* Adjusted letter spacing */
            transition: background-color 0.4s ease !important;
        }

        .btn-warning-custom:hover {
            background-color: #e0a800 !important;
            /* Darker yellow on hover */
        }

        /* Danger button */
        .btn-danger-custom {
            margin: 5px !important;
            /* Reduced margin */
            color: #fff !important;
            background-color: #dc3545 !important;
            /* Danger red color */
            border-radius: 25px !important;
            /* Less rounded */
            padding: 8px 20px !important;
            /* Reduced padding */
            font-size: 16px !important;
            /* Smaller font size */
            font-weight: 600 !important;
            /* Slightly lighter font weight */
            letter-spacing: 0.5px !important;
            /* Adjusted letter spacing */
            transition: background-color 0.4s ease !important;
        }

        .btn-danger-custom:hover {
            background-color: #c82333 !important;
            /* Darker red on hover */
        }


        /* Table styling */
        .table {
            margin-top: 30px !important;
            background-color: #ffffff !important;
        }

        .table th {
            background-color: #5B99C2 !important;
            /* Blue table headers */
            color: #fff !important;
            text-transform: uppercase !important;
            font-weight: 600 !important;
            border-bottom: 2px solid #0056b3 !important;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa !important;
            /* Lighter row shading */
        }

        /* Chart styling */
        /* Chart styling */
        #barchart_material {
            padding: 20px !important;
            background-color: #ffffff !important;
            border-radius: 12px !important;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
            margin-bottom: 40px !important;
            max-width: 100%;
            width: 100%;
            height: auto;
        }


        /* Text alignment and spacing */
        .text-center {
            margin-bottom: 40px !important;
        }

        /* Table border */
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6 !important;
            /* Light gray borders */
        }

        /* Add custom hover effect on table rows */
        .table-hover tbody tr:hover {
            background-color: #f1f3f5 !important;
            /* Slight highlight on hover */
        }

        /* Modal Styles */
        .modal-header {
            background-color: #5B99C2 !important;
            color: white !important;
            border-bottom: 5px solid #0056b3 !important;
        }

        .modal-content {
            border-radius: 10px !important;
            border: none !important;
        }

        /* Form Labels */
        label {
            font-weight: bold !important;
            color: #4a4a4a !important;
        }

        /* SweetAlert Styles */
        .swal2-popup {
            border-radius: 10px !important;
            font-family: 'Poppins', sans-serif !important;
        }

        .swal2-title {
            font-size: 18px !important;
            font-weight: bold !important;
        }

        .swal2-confirm {
            background-color: #007bff !important;
            color: #ffffff !important;
        }

        .swal2-cancel {
            background-color: #6c757d !important;
            color: #ffffff !important;
        }

        .table-cell-center {
            text-align: center;
            /* Centers the content horizontally */
            vertical-align: middle;
            /* Centers the content vertically */
        }
    </style>

    <!-- JavaScript code for Google Charts and AJAX operations -->
    <script type="text/javascript">
        // Load Google Charts
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        // Draw the chart with population data
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Year', 'PENDUDUK', 'PRIA', 'WANITA'],
                @foreach ($populations as $population)
                    ['{{ $population->year }}', {{ $population->penduduk }}, {{ $population->pria }},
                        {{ $population->wanita }}
                    ],
                @endforeach
            ]);

            var options = {
                chart: {
                    title: 'PENDUDUK INDONESIA',
                    subtitle: '',
                },
                bars: 'horizontal',
                hAxis: {
                    title: 'Jumlah',
                },
                vAxis: {
                    title: 'Tahun',
                },
                colors: ['#81DAE3', '#CBE2B5', '#FF8A8A'],
                /* Vibrant color palette */
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }

        $(window).resize(function() {
            drawChart();
        });


        // Setup AJAX headers with CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            // Add Data Button
            $('#addDataBtn').click(function() {
                $('#crudModal').modal('show');
                $('#crudForm')[0].reset();
                $('#modalTitle').text('Tambah Data Penduduk');
                $('#crudForm').attr('action', '{{ route('populations.store') }}');
                $('#crudForm input[name=_method]').val('POST');
                $('#submitBtn').text('Simpan');
            });

            // Form Submit (Create & Update)
            $('#crudForm').submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();
                var actionUrl = $(this).attr('action');
                var method = $('#crudForm input[name=_method]').val();

                $.ajax({
                    url: actionUrl,
                    method: method,
                    data: formData,
                    success: function(response) {
                        $('#crudModal').modal('hide');
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            background: '#d4edda',
                            color: '#155724',
                            confirmButtonColor: '#28a745',
                            timer: 3000,
                            timerProgressBar: true
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Gagal!',
                            text: xhr.responseJSON.error ||
                                'Ada masalah saat menyimpan data',
                            icon: 'error',
                            confirmButtonText: 'Coba Lagi',
                            background: '#f8d7da',
                            color: '#721c24',
                            confirmButtonColor: '#dc3545',
                            timer: 3000,
                            timerProgressBar: true
                        });
                    }
                });
            });

            // Edit Button
            $(document).on('click', '.editBtn', function() {
                var id = $(this).data('id');

                $.get('/populations/' + id + '/edit', function(data) {
                    if (data.error) {
                        Swal.fire({
                            title: 'Gagal!',
                            text: data.error,
                            icon: 'error',
                            confirmButtonText: 'Coba Lagi',
                            background: '#f8d7da',
                            color: '#721c24',
                            confirmButtonColor: '#dc3545'
                        });
                        return;
                    }
                    $('#crudModal').modal('show');
                    $('#modalTitle').text('Edit Data Penduduk');

                    $('#crudForm').attr('action', '/populations/' + id);
                    $('#crudForm input[name=_method]').val('PUT');
                    $('#year').val(data.year);
                    $('#penduduk').val(data.penduduk);
                    $('#pria').val(data.pria);
                    $('#wanita').val(data.wanita);
                    $('#submitBtn').text('Update');
                }).fail(function(xhr, status, error) {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Gagal memuat data untuk diedit: ' + error,
                        icon: 'error',
                        confirmButtonText: 'Coba Lagi',
                        background: '#f8d7da',
                        color: '#721c24',
                        confirmButtonColor: '#dc3545'
                    });
                });
            });

            // Delete Button
            $(document).on('click', '.deleteBtn', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus dan tidak dapat dipulihkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/populations/' + id,
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Dihapus!',
                                    text: response.success,
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                    background: '#d4edda',
                                    color: '#155724',
                                    confirmButtonColor: '#28a745',
                                    timer: 3000,
                                    timerProgressBar: true
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Ada masalah saat menghapus data: ' +
                                        error,
                                    icon: 'error',
                                    confirmButtonText: 'Coba Lagi',
                                    background: '#f8d7da',
                                    color: '#721c24',
                                    confirmButtonColor: '#dc3545'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <!-- Navigation Buttons -->
        <div class="text-center">
            <a href="{{ route('charts2') }}" class="btn btn-custom">Lihat Halaman Grafik Lain</a>
            <!-- Logout Button -->
            <form action="{{ url('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-warning-custom">Keluar</button>
            </form>
        </div>

        <!-- Chart Section -->
        <div id="barchart_material" style="width: 100%; height: 500px;"></div>

        <!-- Button to open the modal -->
        <div class="text-center">
            <button id="addDataBtn" class="btn btn-custom">Tambah Data</button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="crudModal" tabindex="-1" role="dialog" aria-labelledby="crudModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Tambah Data Penduduk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="color: white;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="crudForm" action="" method="POST">
                            @csrf
                            <input type="hidden" name="_method">
                            <div class="form-group">
                                <label for="year">Tahun</label>
                                <input type="text" class="form-control" id="year" name="year" required>
                            </div>
                            <div class="form-group">
                                <label for="penduduk">Penduduk</label>
                                <input type="text" class="form-control" id="penduduk" name="penduduk" required>
                            </div>
                            <div class="form-group">
                                <label for="pria">Pria</label>
                                <input type="text" class="form-control" id="pria" name="pria" required>
                            </div>
                            <div class="form-group">
                                <label for="wanita">Wanita</label>
                                <input type="text" class="form-control" id="wanita" name="wanita" required>
                            </div>
                            <button type="submit" class="btn btn-custom" id="submitBtn">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- List Data -->
        <!-- Table Responsive -->
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Tahun</th>
                        <th>Penduduk</th>
                        <th>Pria</th>
                        <th>Wanita</th>
                        <th>Aksi</th> <!-- Kolom untuk tombol aksi (Edit/Hapus) -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($populations as $population)
                        <tr>
                            <td>{{ $population->year }}</td>
                            <td>{{ $population->penduduk }}</td>
                            <td>{{ $population->pria }}</td>
                            <td>{{ $population->wanita }}</td>
                            <td class="table-cell-center">
                                <!-- Tombol Edit dan Hapus -->
                                <button class="btn btn-warning-custom editBtn"
                                    data-id="{{ $population->id }}">Edit</button>
                                <button class="btn btn-danger-custom deleteBtn"
                                    data-id="{{ $population->id }}">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>
