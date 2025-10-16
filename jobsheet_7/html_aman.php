<?php
$input = ""; 

if (isset($_POST['input'])) {
    
    $input = $_POST['input'];
    
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label for="input_field">Masukkan Teks:</label>
    <input type="text" name="input" id="input_field" value="<?php echo $input; ?>">
    <input type="submit" value="Submit">
</form>

<?php
if (!empty($input)) {
    echo "<hr>Hasil Input yang Telah Diamankan: <strong>" . $input . "</strong>";
}
?>