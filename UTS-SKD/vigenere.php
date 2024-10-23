<?php
// Fungsi enkripsi Vigenere Cipher
function vigenereEncrypt($text, $key) {
    $text = strtoupper($text);
    $key = strtoupper($key);
    $encryptedText = '';
    $keyLength = strlen($key);
    $keyIndex = 0;

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];

        // Abaikan karakter non-huruf
        if (!ctype_alpha($char)) {
            $encryptedText .= $char;
            continue;
        }

        // Hitung karakter baru berdasarkan Vigenere Cipher
        $charOffset = ord($char) - 65;
        $keyCharOffset = ord($key[$keyIndex % $keyLength]) - 65;
        $encryptedChar = chr((($charOffset + $keyCharOffset) % 26) + 65);

        $encryptedText .= $encryptedChar;
        $keyIndex++;
    }

    return $encryptedText;
}

// Fungsi dekripsi Vigenere Cipher
function vigenereDecrypt($text, $key) {
    $text = strtoupper($text);
    $key = strtoupper($key);
    $decryptedText = '';
    $keyLength = strlen($key);
    $keyIndex = 0;

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];

        // Abaikan karakter non-huruf
        if (!ctype_alpha($char)) {
            $decryptedText .= $char;
            continue;
        }

        // Hitung karakter asli berdasarkan Vigenere Cipher
        $charOffset = ord($char) - 65;
        $keyCharOffset = ord($key[$keyIndex % $keyLength]) - 65;
        $decryptedChar = chr(((($charOffset - $keyCharOffset) + 26) % 26) + 65);

        $decryptedText .= $decryptedChar;
        $keyIndex++;
    }

    return $decryptedText;
}

// Inisialisasi variabel
$text = "";
$key = "DEVINA"; // Kunci enkripsi/dekripsi yang ditetapkan
$encryptedText = "";
$decryptedText = "";
$operation = "encrypt"; // Default operasi adalah enkripsi

// Memproses input saat form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST["text"];
    $operation = $_POST["operation"];

    if ($operation == "encrypt") {
        $encryptedText = vigenereEncrypt($text, $key);
    } elseif ($operation == "decrypt") {
        $decryptedText = vigenereDecrypt($text, $key);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vigenere Cipher</title>
    <style>
        body {
            background-color: #fddde6; /* Pink nude */
            font-family: Arial, sans-serif;
            color: #444;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        h1 {
            text-align: center;
            color: #d48c9e;
        }

        textarea, input[type="text"], input[type="radio"] {
            margin: 10px 0;
            padding: 10px;
            width: 100%;
            border: 2px solid #d48c9e;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .radio-inline {
            margin-right: 20px;
        }

        .btn-primary {
            background-color: #f098b3;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #d48c9e;
        }

        .result {
            background-color: #fddde6;
            padding: 15px;
            margin-top: 20px;
            border-radius: 10px;
            color: #444;
        }

        .salam-cinta {
            text-align: center;
            color: #d48c9e;
            margin-top: 30px;
        }

        a {
            text-decoration: none;
        }

        .btn-default {
            background-color: #ffccd5;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            color: #444;
            cursor: pointer;
            display: block;
            margin: 20px auto;
            text-align: center;
        }

        .btn-default:hover {
            background-color: #ff9cb3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1> Vigenere Cipher</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="text">Masukkan teks:</label>
                <input type="text" class="form-control" name="text" id="text" value="<?php echo htmlspecialchars($text); ?>">
            </div>
            <div class="form-group">
                <label class="radio-inline">
                    <input type="radio" name="operation" value="encrypt" <?php if ($operation == "encrypt") echo "checked"; ?>> Enkripsi
                </label>
                <label class="radio-inline">
                    <input type="radio" name="operation" value="decrypt" <?php if ($operation == "decrypt") echo "checked"; ?>> Dekripsi
                </label>
            </div>
            <button type="submit" class="btn-primary">Proses</button>
        </form>

        <?php if (!empty($encryptedText) || !empty($decryptedText)): ?>
            <div class="result">
                <?php if ($operation == "encrypt"): ?>
                    <h2>Hasil Enkripsi</h2>
                    <p>Input: <?php echo htmlspecialchars($text); ?></p>
                    <p>Output: <?php echo htmlspecialchars($encryptedText); ?></p>
                <?php elseif ($operation == "decrypt"): ?>
                    <h2>Hasil Dekripsi</h2>
                    <p>Input: <?php echo htmlspecialchars($text); ?></p>
                    <p>Output: <?php echo htmlspecialchars($decryptedText); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <a href="Caesar.php"><button class="btn-default">Enkripsi Tahap Pertama</button></a>
    </div>

    <div class="salam-cinta">
        <p>Salam Cinta Aulia♥ </p>
    </div>
</body>
</html>
