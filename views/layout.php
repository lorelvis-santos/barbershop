<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbershop | Agenda tu cita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/build/css/app.css">
    <?php echo $css ?? ""; ?>
</head>

<body>
    <div class="container-app">
        <div class="image">
        </div>

        <div class="app">
            <?php echo $content; ?>
        </div>
    </div>

    <!---------------------------SCRIPTS----------------------------->

    <?php echo $script ?? ""; ?>
    <script src="/build/js/modernizr.js"></script>
</body>

</html>