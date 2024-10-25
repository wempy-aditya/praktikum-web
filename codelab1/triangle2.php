<?php
// Ambil nilai dari parameter URL, jika tidak ada, default ke 5
$n = isset($_GET['row']) ? (int)$_GET['row'] : 5;

for ($i = $n; $i >= 1; $i--) {
    // Cetak spasi
    for ($j = $n; $j > $i; $j--) {
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
