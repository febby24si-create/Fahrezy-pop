<!DOCTYPE html>
<html>
<head>
    <title>Data Pegawai</title>
</head>
<body>
    <h1>Data Pegawai</h1>
    <p><strong>Nama:</strong> {{ $name }}</p>
    <p><strong>Umur:</strong> {{ $my_age }} tahun</p>
    <p><strong>Hobi:</strong></p>
    <ul>
        @foreach ($hobbies as $hobi)
            <li>{{ $hobi }}</li>
        @endforeach
    </ul>
    <p><strong>Tanggal Harus Wisuda:</strong> {{ $tgl_harus_wisuda }}</p>
    <p><strong>Sisa Hari Menuju Wisuda:</strong> {{ $time_to_study_left }} hari</p>
    <p><strong>Semester Saat Ini:</strong> {{ $current_semester }} ({{ $motivasi }})</p>
    <p><strong>Cita-cita:</strong> {{ $future_goal }}</p>
</body>
</html>

