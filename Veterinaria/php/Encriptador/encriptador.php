<?php

$encryptionKey = 'geronim0-luc4s';
function encryptData($data) {
    global $encryptionKey;
    // Usa la función de cifrado de PHP (AES-256-CBC) para encriptar los datos
    $iv = random_bytes(16);
    $encryptedData = openssl_encrypt($data, 'aes-256-cbc', $encryptionKey, 0, $iv);

    // Devuelve el resultado junto con el IV para su posterior desencriptación
    return base64_encode($iv . $encryptedData);
}

function decryptData($data) {
    global $encryptionKey;
    // Decodifica la cadena base64 que contiene el IV y los datos cifrados
    $decodedData = base64_decode($data);

    // Extrae el IV y los datos cifrados
    $iv = substr($decodedData, 0, 16);
    $encryptedData = substr($decodedData, 16);

    // Usa la función de cifrado de PHP para desencriptar los datos
    $decryptedData = openssl_decrypt($encryptedData, 'aes-256-cbc', $encryptionKey, 0, $iv);

    // Devuelve el resultado desencriptado
    return $decryptedData;
}

/*
// Ejemplo de uso:
$dataToEncrypt = 'informacion_importante';

// Encripta los datos
$encryptedData = encryptData($dataToEncrypt);

// Imprime los datos encriptados
echo 'Datos encriptados: ' . $encryptedData . '<br>';

// Desencripta los datos
$decryptedData = decryptData($encryptedData);

// Imprime los datos desencriptados
echo 'Datos desencriptados: ' . $decryptedData;
*/
?>
