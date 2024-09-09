<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Population Data</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Use the latest jsPDF and html2canvas libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <style>
        /* Overall styling */
        body {
            background-color: #e9ecef !important;
            font-family: 'Poppins', sans-serif !important;
            color: #343a40 !important;
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
            color: #00050a !important;
            margin-bottom: 20px !important;
            font-weight: 700 !important;
        }

        /* Button customization */
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

        .btn-custom:hover {
            background-color: #0056b3 !important;
        }

        /* Table styling */
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

        /* Chart styling */
        #barchart_material {
            padding: 20px !important;
            background-color: #ffffff !important;
            border-radius: 12px !important;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
            width: 100% !important;
            /* Responsive width */
            height: 400px;
            /* Default height */
        }

        /* Text alignment and spacing */
        .text-center {
            margin-bottom: 40px !important;
        }

        /* Table border */
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6 !important;
        }

        /* Add custom hover effect on table rows */
        .table-hover tbody tr:hover {
            background-color: #f1f3f5 !important;
        }

        /* Responsive table */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto !important;
            }

            .btn-custom {
                padding: 10px 20px !important;
                font-size: 16px !important;
            }

            h3 {
                font-size: 24px !important;
            }
        }

        @media (max-width: 576px) {
            .btn-custom {
                padding: 8px 16px !important;
                font-size: 14px !important;
            }

            h3 {
                font-size: 20px !important;
            }
        }
    </style>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Year', 'JUMLAH', 'PRIA', 'WANITA'],
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

      
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }

        // Redraw the chart on window resize to make it responsive
        $(window).resize(function() {
            drawChart();
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="text-center">
            <a href="{{ route('user2') }}" class="btn btn-custom">Lihat Halaman Grafik Lain</a>
            <button class="btn btn-custom" id="downloadPdf">Download as PDF></button>

            <a href="{{ route('login') }}" class="btn btn-custom">Login</a>
        </div>
        <div class="pdf">
            <div id="barchart_material"></div>

            <div class="table-responsive mt-5">
                <h3 class="text-center">Data Penduduk</h3>
                <table class="table table-hover table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Tahun</th>
                            <th>Penduduk</th>
                            <th>Pria</th>
                            <th>Wanita</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($populations as $population)
                            <tr>
                                <td>{{ $population->year }}</td>
                                <td>{{ $population->penduduk }}</td>
                                <td>{{ $population->pria }}</td>
                                <td>{{ $population->wanita }}</td>
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
                    orientation: 'landscape',
                    unit: 'in',
                    format: 'letter',
                    compressPDF: true
                }
            }).save();
        });
    </script>
</body>

</html>
