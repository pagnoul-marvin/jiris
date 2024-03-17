<?php
/** @var array $upcoming_jiris */
/** @var array $passed_jiris */
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">
    <title>Jiris</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<a class="sr-only"
   href="#main-menu">Aller au menu principal</a>
<div class="container mx-auto flex flex-col-reverse gap-6">
    <main class="flex flex-col gap-4">
        <h1 class="font-bold text-2xl">Jiris</h1>
        <form action="/">
            <label for="search" class="font-bold">Nom du jiri</label>
            <input type="text" id="search" name="search" class="border rounded-md px-2">
            <button type="submit" class="bg-blue-500 text-white rounded-md px-4">Chercher</button>
        </form>
        <section>
            <h2 class="font-bold">Jiris à venir</h2>
            <?php
            if (count($upcoming_jiris) > 0): ?>
                <ol>
                    <?php
                    foreach ($upcoming_jiris as $jiri): ?>
                        <li><a class="underline text-blue-500"
                               href="/jiri?id=<?= $jiri->id ?>"><?= $jiri->name ?></a></li>
                    <?php
                    endforeach ?>
                </ol>
            <?php
            endif ?>
        </section>
        <section>
            <h2 class="font-bold">Jiris passés</h2>
            <?php
            if (count($passed_jiris) > 0): ?>
                <ol>
                    <?php
                    foreach ($passed_jiris as $jiri): ?>
                        <li><a class="underline text-blue-500"
                               href="/jiri?id=<?= $jiri->id ?>"><?= $jiri->name ?></a></li>
                    <?php
                    endforeach ?>
                </ol>
            <?php
            endif ?>
        </section>
        <div>
            <a href="/jiri/create" class="underline text-blue-500">Créer un nouveau jiri</a>
        </div>
    </main>
    <nav id="main-menu">
        <h2 class="sr-only">Menu principal</h2>
        <ul class="flex gap-4">
            <li><a class="underline text-blue-500"
                   href="/jiris">Jiris</a></li>
            <li><a class="underline text-blue-500"
                   href="/contacts">Contacts</a></li>
            <li><a class="underline text-blue-500"
                   href="/projects">Projets</a></li>
        </ul>
    </nav>
</div>
</body>
</html>