// Generar el hash de la contraseña con salting
$password = $_POST['password'];
$salt = "s3cr3t_s4lt"; // Salta personalizada para cada usuario
$hashedPassword = password_hash($password . $salt, PASSWORD_DEFAULT);

// Guardar el hash de la contraseña en la base de datos o donde sea necesario

// Verificar la contraseña
$passwordToCheck = $_POST['password'];
$hashedPasswordFromDB = "..." // Obtener el hash almacenado en la base de datos

if (password_verify($passwordToCheck . $salt, $hashedPasswordFromDB)) {
    echo "¡La contraseña es válida!";
} else {
    echo "Contraseña inválida.";
}