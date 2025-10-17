<!DOCTYPE html>
<html>
<head>
<title>Contoh Form dengan PHP</title>
</head>
<body>
<h2>Form Contoh</h2>
<form method="POST" action="proses_lanjut.php">
    <label for="buah">Pilih Buah:</label>
    <select name="buah" id="buah">
        <option value="Apel">Apel</option>
        <option value="Pisang">Pisang</option>
        <option value="Mangga">Mangga</option>
        <option value="Jeruk">Jeruk</option>
    </select>
    <br><br>

    <label>Pilih Warna Favorit:</label><br>
    <input type="checkbox" name="warna[]" value="merah"> Merah<br>
    <input type="checkbox" name="warna[]" value="biru"> Biru<br>
    <input type="checkbox" name="warna[]" value="hijau"> Hijau<br>
    <br>

    <label>Pilih Jenis Kelamin:</label><br>
    <input type="radio" name="jenis_kelamin" value="laki-laki"> Laki-laki<br>
    <input type="radio" name="jenis_kelamin" value="perempuan"> Perempuan<br>
    <br>

    <input type="submit" value="Submit">
</form>
</body>
</html>