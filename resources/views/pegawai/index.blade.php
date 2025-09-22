<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pegawai</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .hero-section {
            background: linear-gradient(135deg, #67b0d1, #3a82b4);
            color: white;
            padding: 50px 0;
            text-align: center;
            animation: fadeInDown 1s ease-in-out;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .card {
            margin-top: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s ease-in-out;
        }

        table tr {
            transition: background-color 0.3s ease;
        }

        table tr:hover {
            background-color: #f1f7ff;
        }

        .footer {
            margin-top: 50px;
            padding: 20px 0;
            background-color: #1be400;
            text-align: center;
            animation: fadeIn 1.5s ease-in-out;
        }

        .footer p {
            margin: 0;
            font-size: 0.9rem;
            color: #000000;
        }

        /* Animasi custom */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light animate__animated animate__fadeInDown">
        <div class="container">
            <a class="navbar-brand" href="#">Pegawai App</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="animate__animated animate__fadeInDown">Data Pegawai</h1>
            <p class="lead animate__animated animate__fadeIn animate__delay-1s">
                Informasi lengkap mengenai pegawai
            </p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="card-body">
                        <h4 class="mb-3 text-center">Profil</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>Nama</th>
                                <td>{{ $name }}</td>
                            </tr>
                            <tr>
                                <th>Umur</th>
                                <td>{{ $my_age }} tahun</td>
                            </tr>
                            <tr>
                                <th>Hobi</th>
                                <td>
                                    <ul class="mb-0">
                                        @foreach ($hobbies as $hobi)
                                            <li class="animate__animated animate__fadeInLeft">{{ $hobi }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal Harus Wisuda</th>
                                <td>{{ $tgl_harus_wisuda }}</td>
                            </tr>
                            <tr>
                                <th>Sisa Hari Menuju Wisuda</th>
                                <td class="fw-bold text-danger animate__animated animate__pulse animate__infinite">
                                    {{ $time_to_study_left }} hari
                                </td>
                            </tr>
                            <tr>
                                <th>Semester Saat Ini</th>
                                <td>
                                    {{ $current_semester }}
                                    <br>
                                    <span class="badge {{ $current_semester < 3 ? 'bg-success' : 'bg-danger' }} animate__animated animate__fadeIn">
                                        {{ $motivasi }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Cita-cita</th>
                                <td class="animate__animated animate__fadeInUp animate__delay-2s">
                                    {{ $future_goal }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Pegawai App. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
