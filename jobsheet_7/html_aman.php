<!DOCTYPE html>
<html>
<head>
    <title>Form Validasi Email</title>
    <style>
        .error { color: red; }
    </style>
</head>
<body>
    <h2>Form Validasi Email</h2>
    <?php
    $emailErr = "";
    $email = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }

        if (empty($email)) {
            $emailErr = "Email harus diisi!";
        } else {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                
                $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
                
                echo "<p style='color: green;'><strong>Data berhasil disimpan!</strong></p>";
                echo "<p>Email yang tervalidasi dan diamankan: <strong>" . $email . "</strong></p>";

            } else {
                $emailErr = "Format email tidak valid!";
                
                $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
            }
        }
    }
    ?>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="email_field">Email:</label>
        <input type="text" name="email" id="email_field" value="<?php echo $email; ?>">
        
        <span class="error"><?php echo $emailErr; ?></span><br><br>
        
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>