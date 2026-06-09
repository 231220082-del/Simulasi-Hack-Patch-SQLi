<?php
$host = "localhost"; $user_db = "root"; $pass_db = ""; $db_name = "keamanan_db";
$conn = new mysqli($host, $user_db, $pass_db, $db_name);

$pesan = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_input = $_POST['username'];
    $pass_input = $_POST['password'];

    // ?? KODE RENTAN (VULNERABLE) - PENGGABUNGAN STRING LANGSUNG
    $sql = "SELECT * FROM users WHERE username = '$user_input' AND password = '$pass_input'";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pesan = "? Berhasil Login! Selamat datang, Role: " . $row['role'];
    } else {
        $pesan = "? Gagal Login! Cek kembali username/password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>SQLi Lab</title></head>
<body style="font-family:sans-serif; padding:20px;">
    <h2>Sistem Login Perusahaan</h2>
    <h3 style="color:blue;"><?= $pesan; ?></h3>
    
    <form method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" style="width:300px; padding:8px;"><br><br>
        
        <label>Password:</label><br>
        <input type="text" name="password" style="width:300px; padding:8px;"><br><br>
        
        <button type="submit">Masuk</button>
    </form>
</body>
</html>