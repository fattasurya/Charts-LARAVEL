<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pekerjaan - Admin</title>

    <!-- External CSS and JS libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #e9ecef !important;
            font-family: 'Poppins', sans-serif !important;
            color: #343a40 !important;
        }

        .container {
            margin-top: 60px !important;
            background-color: #ffffff !important;
            padding: 30px !important;
            border-radius: 20px !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
            text-align: center;
        }

        h3 {
            color: #000000 !important;
            margin-bottom: 20px !important;
            font-weight: 700 !important;
        }

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
        }

        .btn-secondary-custom {
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

        .btn-secondary-custom:hover {
            background-color: #e0a800 !important;
            /* Darker yellow on hover */
        }

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
        }

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
        }

        .table {
            margin-top: 30px !important;
            background-color: #ffffff !important;
        }

        .table th {
            background-color: #5B99C2 !important;
            color: #fff !important;
            text-transform: uppercase !important;
            font-weight: 600 !important;
            border-bottom: 2px solid #0056b3 !important;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa !important;
        }

        #chart_div {
            padding: 20px !important;
            background-color: #ffffff !important;
            border-radius: 12px !important;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
            margin-bottom: 40px !important;
            width: 100% !important;
            /* Ensure the container takes full width */
            height: 400px !important;
            /* Set a fixed height */
            max-width: 1000px;
            /* Optional: Limit the maximum width */
            margin: 0 auto;
            /* Center the container horizontally */
        }


        .text-center {
            margin-bottom: 40px !important;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6 !important;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f3f5 !important;
        }

        .modal-header {
            background-color: #5B99C2 !important;
            color: white !important;
            border-bottom: 5px solid #0056b3 !important;
        }

        .modal-content {
            border-radius: 10px !important;
            border: none !important;
        }

        label {
            font-weight: bold !important;
            color: #4a4a4a !important;
        }

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

          @media (max-width: 768px) {
            .container {
                padding: 15px !important;
            }

            #chart_div {
                width: 100% !important;
                height: auto !important;
            }

            .table {
                font-size: 12px !important;
            }

            .table th,
            .table td {
                padding: 8px !important;
            }
        }

        @media (max-width: 576px) {
            .container {
                margin-top: 30px !important;
                padding: 10px !important;
            }

            h3 {
                font-size: 24px !important;
            }

            .btn-custom,
            .btn-secondary-custom,
            .btn-warning-custom,
            .btn-danger-custom {
                padding: 8px !important;
                font-size: 14px !important;
            }

            #chart_div {
                width: 100% !important;
                height: 300px !important;
            }

            .table {
                font-size: 10px !important;
            }

            .table th,
            .table td {
                padding: 5px !important;
            }

            .modal-content {
                padding: 10px !important;
            }
        }
    </style>

    <!-- JavaScript code for Google Charts and AJAX operations -->
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            var data = google.visualization.arrayToDataTable([
                ['Pekerjaan', 'Laki-laki', 'Perempuan', 'Jumlah'],
                @foreach ($data as $item)
                    ['{{ $item->pekerjaan }}', {{ $item->laki_laki }}, {{ $item->perempuan }}, {{ $item->jumlah }}],
                @endforeach
            ]);

            var options = {
                title: 'Penduduk Berumur 15 Tahun Ke Atas yang Bekerja Selama Seminggu yang Lalu Menurut Status Pekerjaan Utama dan Jenis Kelamin di Kota Jakarta Timur, 2020',
                vAxis: {
                    title: 'Total'
                },
                hAxis: {
                    title: 'Pekerjaan'
                },
                seriesType: 'bars',
                series: {
                    2: {
                        type: 'line'
                    }
                },
                colors: ['#81DAE3', '#CBE2B5', '#FF8A8A'],
                /* Harmonized blue, gray, and teal colors */
                backgroundColor: '#ffffff',
                legend: {
                    position: 'bottom'
                },
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
        $(window).resize(function() {
            drawVisualization();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('#addDataBtn').click(function() {
                $('#crudModal').modal('show');
                $('#crudForm')[0].reset();
                $('#modalTitle').text('Tambah Data Pekerjaan');
                $('#crudForm').attr('action', '{{ route('pekerjaan.store') }}');
                $('#crudForm input[name=_method]').val('POST');
                $('#submitBtn').text('Simpan');
            });

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

            $(document).on('click', '.editBtn', function() {
                var id = $(this).data('id');

                $.get('/pekerjaan/' + id + '/edit', function(data) {
                    if (data.error) {
                        Swal.fire({
                            title: 'Gagal!',
                            text: data.error,
                            icon: 'error',
                            confirmButtonText: 'Tutup',
                            background: '#f8d7da',
                            color: '#721c24',
                            confirmButtonColor: '#dc3545'
                        });
                    } else {
                        $('#crudModal').modal('show');
                        $('#modalTitle').text('Edit Data Pekerjaan');
                        $('#crudForm').attr('action', '/pekerjaan/' + id);
                        $('#crudForm input[name=_method]').val('PUT');
                        $('#submitBtn').text('Update');

                        $('#crudForm input[name=pekerjaan]').val(data.pekerjaan);
                        $('#crudForm input[name=laki_laki]').val(data.laki_laki);
                        $('#crudForm input[name=perempuan]').val(data.perempuan);
                        $('#crudForm input[name=jumlah]').val(data.jumlah);
                    }
                });
            });

            // Function to calculate total of laki_laki and perempuan fields
            function calculateTotal() {
                var laki_laki = parseInt($('#crudForm input[name=laki_laki]').val()) || 0;
                var perempuan = parseInt($('#crudForm input[name=perempuan]').val()) || 0;
                var total = laki_laki + perempuan;
                $('#crudForm input[name=jumlah]').val(total); // Set total value to jumlah field
            }

            $(document).ready(function() {
                // Trigger calculation when laki_laki or perempuan fields are changed
                $('#crudForm input[name=laki_laki], #crudForm input[name=perempuan]').on('input',
                    function() {
                        calculateTotal();
                    });

                // Your existing code for modal show, form submission, edit, and delete...
            });


            $(document).on('click', '.deleteBtn', function() {
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: 'Data ini akan dihapus!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    background: '#fff3cd',
                    color: '#856404',
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/pekerjaan/' + id,
                            method: 'DELETE',
                            success: function(response) {
                                Swal.fire({
                                    title: 'Terhapus!',
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
                                        'Ada masalah saat menghapus data',
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
                    }
                });
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <h3 class="text-center">Data Pekerjaan</h3>
        <a href="{{ route('charts1') }}" class="btn btn-custom">Lihat Halaman Grafik Lain</a>
        <button type="button" id="addDataBtn" class="btn-custom">Tambah Data</button>

        <!-- Chart Container -->
        <div id="chart_div"></div>

        <!-- Data Table -->
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pekerjaan</th>
                    <th>Laki-laki</th>
                    <th>Perempuan</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->pekerjaan }}</td>
                        <td>{{ $item->laki_laki }}</td>
                        <td>{{ $item->perempuan }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>
                            <button type="button" class="btn-secondary-custom editBtn"
                                data-id="{{ $item->id }}">Edit</button>
                            <button type="button" class="btn-danger-custom deleteBtn"
                                data-id="{{ $item->id }}">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal for Add/Edit -->
    <div class="modal fade" id="crudModal" tabindex="-1" role="dialog" aria-labelledby="crudModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Data Pekerjaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="crudForm" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan</label>
                            <input type="text" class="form-control" name="pekerjaan" required>
                        </div>
                        <div class="form-group">
                            <label for="laki_laki">Laki-laki</label>
                            <input type="number" class="form-control" name="laki_laki" required>
                        </div>
                        <div class="form-group">
                            <label for="perempuan">Perempuan</label>
                            <input type="number" class="form-control" name="perempuan" required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" required @readonly(true)>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-secondary-custom" data-dismiss="modal">Batal</button>
                        <button type="submit" id="submitBtn" class="btn-custom">Simpan</button>
                    </div>
                    <input type="hidden" name="_method" value="POST">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
