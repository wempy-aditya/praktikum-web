<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
</head>

<body>
    <h1>Your Order Summary</h1>
    <ul>
        <?php foreach ($this->items as $item): ?>
            <li><?= $item->getInfo(); ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>