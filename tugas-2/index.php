<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemrograman Website 2024</title>
    <!-- <link rel="stylesheet" href="./styles.css">  -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            padding: 20px;
            margin: 0;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            padding: 10px;
            margin: 5px 0;
            background-color: #f8f9fa;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Pemrograman Website 2024</h1>
        <form method="POST" action="index.php">
            <label for="number">Masukkan Bilangan Bulat Positif (n):</label>
            <input type="number" id="number" name="number" min="1" required>
            <button type="submit">Submit</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mengambil input dari form
            $n = (int)$_POST['number'];

            if ($n > 0) {
                echo "<h2>Hasil:</h2>";
                echo "<ul>";

                // Panggil fungsi untuk mencetak hasil
                printNumbers($n);

                echo "</ul>";
            } else {
                echo "<p>Harap masukkan bilangan bulat positif.</p>";
            }
        }

        // Fungsi untuk mencetak bilangan dengan perulangan dan percabangan
        function printNumbers($n)
        {
            for ($i = 1; $i <= $n; $i++) {
                echo "<li>";
                if ($i % 4 === 0 && $i % 6 === 0) {
                    echo "Pemrograman Website 2024";
                } elseif ($i % 5 === 0) {
                    echo "2024";
                } elseif ($i % 4 === 0) {
                    echo "Pemrograman";
                } elseif ($i % 6 === 0) {
                    echo "Website";
                } else {
                    echo $i;
                }
                echo "</li>";
            }
        }
        ?>
    </div>

</body>

</html>