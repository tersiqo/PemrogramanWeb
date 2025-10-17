<!DOCTYPE html>
<html>
<head>
<title>Form Input dengan Validasi AJAX</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<h1>Form Input dengan Validasi</h1>
<form id="myForm" method="post" action="proses_validasi.php">
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama">
    <span id="nama-error" style="color: red;"></span><br>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email">
    <span id="email-error" style="color: red;"></span><br>

    <input type="submit" value="Submit">
</form>

<div id="status-ajax" style="margin-top: 20px; color: green; font-weight: bold;"></div>

<script>
$(document).ready(function() {
    $("#myForm").submit(function(event) {
        event.preventDefault(); 
        
        var form = $(this);
        var nama = $("#nama").val();
        var email = $("#email").val();
        var valid = true;

        $("#status-ajax").text("");

        if (nama === "") {
            $("#nama-error").text("Nama harus diisi.");
            valid = false;
        } else {
            $("#nama-error").text("");
        }

        if (email === "") {
            $("#email-error").text("Email harus diisi.");
            valid = false;
        } else {
            $("#email-error").text("");
        }

        if (valid) {
            $("#status-ajax").text("Mengirim data...");
            
            $.ajax({
                url: form.attr("action"), 
                type: form.attr("method"), 
                data: form.serialize(),
                success: function(response) {
                    $("#status-ajax").html("Data Terkirim. Respons Server: " + response);
                },
                error: function() {
                    $("#status-ajax").html("Terjadi kesalahan saat menghubungi server.");
                }
            });
        }
    });
});
</script>
</body>
</html>