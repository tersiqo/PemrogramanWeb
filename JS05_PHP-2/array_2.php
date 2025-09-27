<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
           <title>Informasi Dosen Sederhana</title>
    <style>
        table, th, td {
            border: 1px solid black; 
            border-collapse: collapse;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2; 
        }
    </style>
</head>
<body>
    <?php
    $Dosen = [
        'nama' => 'Elok Nur Hamdana',
        'domisili' => 'Malang',
        'jenis_kelamin' => 'Perempuan'];
?>

<table>
        <tr>
            <th colspan="2">Detail Profil</th>
        </tr>
        <?php
        foreach ($Dosen as $kunci => $nilai) {
            echo "<tr>";
            echo "<th>{$kunci}</th>"; 
            echo "<td>{$nilai}</td>"; 
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>