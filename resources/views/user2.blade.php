<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pekerjaan</title>

    <!-- External CSS and JS libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <style>
        body {
            background-color: #e9ecef;
            color: #212529;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        /* Button styling */
        .btn-secondary {
            margin: 10px !important;
            color: #fff !important;
            background-color: #5B99C2 !important;
            border-radius: 50px !important;
            padding: 10px 40px !important;
            font-size: 18px !important;
            font-weight: 700 !important;
            letter-spacing: 1px !important;
            transition: background-color 0.4s ease !important;
        }

        .btn-secondary:hover {
            background-color: #0056b3 !important;
            border-color: #0056b3;
        }

        /* Heading styling */
        h3 {
            margin-bottom: 30px;
            font-weight: bold;
            color: #343a40;
        }

        /* Table styling */
        table {
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
        }

        th,
        td {
            text-align: center;
            vertical-align: middle;
        }

        th {
            background-color: #5B99C2;
            color: #fff;
        }

        td {
            background-color: #f8f9fa;
        }

        /* Chart styling */
        #chart_div {
            margin-top: 50px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            /* Ensure the chart width is responsive */
            height: auto;
            /* Ensure the chart height adjusts */
        }
          .btn-custom {
            margin: 10px !important;
            color: #fff !important;
            background-color: #5B99C2 !important;
            border-radius: 50px !important;
            padding: 10px 40px !important;
            font-size: 18px !important;
            font-weight: 700 !important;
            letter-spacing: 1px !important;
            transition: background-color 0.4s ease !important;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .btn-secondary {
                padding: 10px 20px !important;
                font-size: 16px !important;
            }

            h3 {
                font-size: 1.5rem;
            }

            table th,
            table td {
                font-size: 14px;
            }

            #chart_div {
                padding: 15px;
                margin-top: 30px;
            }
        }

        @media (max-width: 576px) {
            .btn-secondary {
                padding: 8px 15px !important;
                font-size: 14px !important;
            }

            h3 {
                font-size: 1.2rem;
            }

            table th,
            table td {
                font-size: 12px;
            }

            #chart_div {
                height: 300px !important;
                /* Smaller chart height on mobile */
            }
        }
    </style>

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
                backgroundColor: '#ffffff',
                legend: {
                    position: 'bottom'
                },
                chartArea: {
                    width: '80%',
                    /* Adjust the chart area width */
                    height: '70%' /* Adjust the chart area height */
                },
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

        $(window).resize(function() {
            drawVisualization(); /* Redraw the chart when window is resized */
        });

        $(document).ready(function() {
            // Handle Add, Edit, Delete operations (your existing JS code for AJAX requests)
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="text-center">
            <a href="{{ route('user1') }}" class="btn btn-secondary mb-4">Lihat Halaman Grafik Lain</a>
            <button class="btn btn-custom" id="downloadPdf">Download as PDF></button>
        </div>

        <div class="pdf">

            <!-- Chart Section -->
            <div id="chart_div" style="width: 100%; height: 550px;"></div>

            <!-- Table Section -->
            <div class="mt-5">
                <h3 class="text-center">Data Pekerjaan</h3>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Pekerjaan</th>
                            <th>Laki-laki</th>
                            <th>Perempuan</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->pekerjaan }}</td>
                                <td>{{ $item->laki_laki }}</td>
                                <td>{{ $item->perempuan }}</td>
                                <td>{{ $item->jumlah }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('downloadPdf').addEventListener('click', function() {
            var element = document.querySelector('.pdf');
            html2pdf().from(element).set({
                margin: 0,
                filename: 'barchart_material.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2,
                    width: 1100
                },
                jsPDF: {
                    orientation: 'portrait',
                    unit: 'in',
                    format: 'letter',
                    compressPDF: true
                }
            }).save();
        });
    </script>

</body>

</html>
