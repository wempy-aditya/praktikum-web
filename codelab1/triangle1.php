<?php
// Ambil nilai dari parameter URL, jika tidak ada, default ke 5
$n = isset($_GET['row']) ? (int)$_GET['row'] : 5;

for ($i = 1; $i <= $n; $i++) {
    // Cetak spasi
    for ($j = $i; $j < $n; $j++) {
        echo "&nbsp;&nbsp;";
    }

    // Cetak bintang
    for ($k = 1; $k <= (2 * $i - 1); $k++) {
        echo "*";
    }

    // Pindah ke baris berikutnya
    echo "<br>";
}
?>
