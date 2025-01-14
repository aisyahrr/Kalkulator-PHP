<?php

// Mendeklarasikan variabel untuk cookie
$number = "num";
$number_value="";
$simbol = "op";
$simbol_value="";

// Inisialisasi variabel
$num = isset($_POST['input']) ? $_POST['input'] : "";
$result = "";

// Jika tombol angka ditekan
if (isset($_POST['num'])) {
    $num .= $_POST['num']; // Menambahkan angka ke input yang ada
}

// Jika operator ditekan
if (isset($_POST['op'])) {
    $number_value = $_POST['input'];
    setcookie($number, $number_value, time() + (86400 * 30), "/"); // Simpan angka pertama ke cookie

    $simbol_value = $_POST['op']; // Simpan operator dari POST, bukan input
    setcookie($simbol, $simbol_value, time() + (86400 * 30), "/"); // Simpan operator ke cookie

    $num = "";
}

// Jika tombol hasil ditekan
if (isset($_POST['hasil'])) {
    $num = $_POST['input'];
    
    // Konversi nilai dari cookie dan input ke tipe numerik
    $input1 = isset($_COOKIE['num']) ? (float) $_COOKIE['num'] : 0;
    $input2 = (float) $num; 

    switch ($_COOKIE['op']) {
        case "+":
            $result = $input1 + $input2;
            break;
        case "-":
            $result = $input1 - $input2;
            break;
        case "x":
            $result = $input1 * $input2;
            break;
        case "/":
            if ($input2 != 0) {
                $result = $input1 / $input2;
            } else {
                $result = "Error";
            }
            break;
        default:
            $result = "Error";
            break;
    }
    
    // Menampilkan hasil di kolom input
    $num = $result;
}

// Jika tombol delete ditekan
if (isset($_POST['delete'])) {
    setcookie("num", "", time() - 3600, "/"); // Menghapus cookie num
    setcookie("op", "", time() - 3600, "/"); // Menghapus cookie operator
    $num = ""; // Mengosongkan input
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="image/njungf3.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Njunngf </title>
    <link rel="stylesheet" href="calcu.css">
</head>
<body>
    <div class="frame">
        <form action="" method="post">
            <br>
            <input type="text" class="forminput" name="input" value="<?php echo @$num?>"> <br><br>

            <div class="Operation">
                <input type="submit" class="number" name="num" value="7">
                <input type="submit" class="number" name="num" value="8">
                <input type="submit" class="number" name="num" value="9">
                <input type="submit" class="tanda" name="op" value="x"> <br>
                <input type="submit" class="number" name="num" value="4">
                <input type="submit" class="number" name="num" value="5">
                <input type="submit" class="number" name="num" value="6">
                <input type="submit" class="tanda" name="op" value="-"> <br>
                <input type="submit" class="number" name="num" value="1">
                <input type="submit" class="number" name="num" value="2">
                <input type="submit" class="number" name="num" value="3">
                <input type="submit" class="tanda" name="op" value="+"> <br>
                <input type="submit" class="delete" name="delete" value="C">
                <input type="submit" class="number" name="num" value="0">
                <input type="submit" class="hasil" name="hasil" value="=">
                <input type="submit" class="tanda" name="op" value="/">
            </div>

        </form>
    </div>
</body>
</html>