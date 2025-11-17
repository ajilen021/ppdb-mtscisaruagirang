<?php
// Masukkan password yang Anda inginkan di sini
$passwordSaya = 'tonghilap21';

// Generate hash yang aman menggunakan BCrypt
$hash = password_hash($passwordSaya, PASSWORD_DEFAULT);

echo 'Password Anda: ' . $passwordSaya . '<br>';
echo 'Hash yang dihasilkan (salin ini): <br>';
echo '<strong>' . $hash . '</strong>';

?>
