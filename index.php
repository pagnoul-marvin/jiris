<?php
if (file_exists(__DIR__ . '/database/database.php')) {
    require __DIR__ . '/database/database.php';
} else {
    die('Certains fichiers sont manquants');
}

$db = getPDO();

$statement = $db->query('SELECT * FROM jiri WHERE starting_at < now() ORDER BY starting_at DESC');
$passed_jiris = $statement->fetchAll();
$statement = $db->query('SELECT * FROM jiri WHERE starting_at > now() ORDER BY starting_at DESC');
$upcoming_jiris = $statement->fetchAll();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body class="flex flex-col-reverse gap-4">

<main class="flex flex-col gap-4">

    <h1 class="font-bold text-xl">Mes jurys</h1>

    <section>

        <h2>
            Jiris &agrave; venir
        </h2>
        <?php if (count($upcoming_jiris) !== 0): ?>
            <ol>
                <?php foreach ($upcoming_jiris as $jiri): ?>
                    <li><a href="/jiris?id=<?= $jiri->id ?>"><?= $jiri->name ?></a></li>
                <?php endforeach ?>
            </ol>
        <?php endif ?>

    </section>

    <section>

        <h2>
            Jiris passés
        </h2>
        <?php if (count($passed_jiris) !== 0): ?>
            <ol>
                <?php foreach ($passed_jiris as $jiri): ?>
                    <li><a href="/jiris?id=<?= $jiri->id ?>"><?= $jiri->name ?></a></li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>

    </section>

</main>

<nav>

    <h2 class="sr-only">Menu principal</h2>

    <ul class="flex gap-4">

        <li><a href="/jiris">Jiris</a></li>
        <li><a href="/contacts">Contacts</a></li>
        <li><a href="/projets">Projets</a></li>

    </ul>

</nav>
</body>
</html>



