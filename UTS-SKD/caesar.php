<?php
// Tabel substitusi karakter
$encryptionTable = [
    'A' => 'D',
    'B' => 'E',
    'C' => 'V',
    'D' => 'I',
    'E' => 'N',
    'F' => 'A',
    'G' => 'B',
    'H' => 'C',
    'I' => 'F',
    'J' => 'G',
    'K' => 'H',
    'L' => 'J',
    'M' => 'K',
    'N' => 'L',
    'O' => 'M',
    'P' => 'O',
    'Q' => 'P',
    'R' => 'Q',
    'S' => 'R',
    'T' => 'S',
    'U' => 'T',
    'V' => 'U',
    'W' => 'W',
    'X' => 'X',
    'Y' => 'Y',
    'Z' => 'Z'
];

// Fungsi untuk mengenkripsi teks
function encryptText($text, $table) {
    $encryptedText = "";
    $text = strtoupper($text); // Konversi teks ke huruf besar

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        // Periksa apakah karakter ada dalam tabel substitusi
        if (array_key_exists($char, $table)) {
            $encryptedText .= $table[$char];
        } else {
            // Jika karakter tidak ada dalam tabel substitusi, biarkan karakter asli
            $encryptedText .= $char;
        }
    }

    return $encryptedText;
}

// Fungsi untuk mendekripsi teks
function decryptText($text, $table) {
    $decryptedText = "";

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        // Cari karakter asli dalam tabel substitusi
        $originalChar = array_search($char, $table);
        if ($originalChar !== false) {
            $decryptedText .= $originalChar;
        } else {
            // Jika karakter tidak ada dalam tabel substitusi, biarkan karakter asli
            $decryptedText .= $char;
        }
    }

    return $decryptedText;
}

// Inisialisasi variabel
$text = "";
$processedText = "";
$operation = "encrypt"; // Default operation is encryption

// Memproses input saat formulir dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST["text"];
    $operation = $_POST["operation"];

    if ($operation == "encrypt") {
        $processedText = encryptText($text, $encryptionTable);
    } elseif ($operation == "decrypt") {
        $processedText = decryptText($text, $encryptionTable);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enkripsi dan Dekripsi Teks</title>
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

        textarea, input[type="radio"] {
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
        <h1>Caesar Chiper</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="text">Masukkan Teks:</label>
                <textarea class="form-control" rows="5" id="text" name="text"><?php echo $text; ?></textarea>
            </div>
            <div class="form-group">
                <label class="radio-inline"><input type="radio" name="operation" value="encrypt" <?php if ($operation == "encrypt") echo "checked"; ?>>Enkripsi</label>
                <label class="radio-inline"><input type="radio" name="operation" value="decrypt" <?php if ($operation == "decrypt") echo "checked"; ?>>Dekripsi</label>
            </div>
            <button type="submit" class="btn-primary">Proses</button>
        </form>

        <?php if (!empty($processedText)) : ?>
            <div class="result">
                <?php if ($operation == "encrypt") : ?>
                    <h2>Hasil Enkripsi:</h2>
                <?php elseif ($operation == "decrypt") : ?>
                    <h2>Hasil Dekripsi:</h2>
                <?php endif; ?>
                <p><?php echo $processedText; ?></p>
            </div>
        <?php endif; ?>

        <a href="vigenere.php"><button class="btn-default">Enkripsi Tahap Kedua</button></a>
    </div>

    <div class="salam-cinta">
        <p>Salam Cinta Aulia♥</p>
    </div>
</body>
</html>
