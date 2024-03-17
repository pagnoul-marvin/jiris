<?php
/** @var stdClass $jiri */
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
        <h1 class="font-bold text-2xl"><?= $jiri->name ?></h1>
        <dl>
            <div>
                <dt class="font-bold">Nom</dt>
                <dd><?= $jiri->name ?></dd>
            </div>
            <div>
                <dt class="font-bold">Date et heure de début</dt>
                <dd><?= $jiri->starting_at ?></dd>
            </div>
        </dl>
        <div>
            <a href="/jiri/edit?id=<?= $jiri->id ?>" class="underline text-blue-500">modifier ce jiri</a>
        </div>
        <form action="/jiri/delete" method="post">
            <input type="hidden" name="id" value="<?= $jiri->id ?>">
            <button type="submit" class="text-red-500">Supprimer ce jiri</button>
        </form>
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