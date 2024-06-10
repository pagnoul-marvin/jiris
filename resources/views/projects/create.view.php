<?php
/** @var array $contacts */
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"
          href="<?= public_path('css/app.css') ?>">
    <title>Cr&eacute;er un nouveau projet</title>
</head>
<body>
<?php
partials('common_html_start');
?>

<h1 class="font-bold text-2xl">Cr&eacute;er un nouveau projet</h1>

<section>

    <form action="/project" method="post" class="flex flex-col gap-8 bg-slate-50 p-4">

        <?php
        csrf_token() ?>

        <div class="flex flex-col gap-2">
            <label class="font-bold" for="name">Nom du projet &ast;&nbsp;: <small>au moins 3 caract&egrave;res, au plus
                    255</small></label>
            <input class="border border-grey-700 focus:invalid:border-pink-500 invalid:text-pink-600 rounded-md p-2"
                   id="name" name="name" type="text" placeholder="Ex : Mon Portfolio" required
                   value="<?= $_SESSION['old']['name'] ?? '' ?>">
        </div>

        <div class="flex flex-col gap-2">
            <label class="font-bold" for="starting_at">Date et heure de d&eacute;but &ast;&nbsp;: <small>au
                    format
                    2024-06-07 11:05</small></label>
            <input class="border border-grey-700 focus:invalid:border-pink-500 invalid:text-pink-600 rounded-md p-2"
                   id="starting_at" name="starting_at" type="text" placeholder="Ex : 2024-06-07 11:05" required
                   value="<?= $_SESSION['old']['starting_at'] ?? '' ?>">
        </div>

        <div class="flex flex-col gap-2">
            <label class="font-bold" for="ending_at">Date et heure de fin &ast;&nbsp;: <small>au
                    format
                    2024-06-07 11:05</small></label>
            <input class="border border-grey-700 focus:invalid:border-pink-500 invalid:text-pink-600 rounded-md p-2"
                   id="ending_at" name="ending_at" type="text" placeholder="Ex : 2025-06-07 11:05" required
                   value="<?= $_SESSION['old']['ending_at'] ?? '' ?>">
        </div>

        <div class="flex flex-col gap-2">
            <label class="font-bold" for="description">Description du projet &ast;&nbsp;: <small>3 caract&egrave;res au
                    minimum, au plus 500</small></label>
            <textarea class="border border-grey-700 focus:invalid:border-pink-500 invalid:text-pink-600 rounded-md p-2"
                      id="description" name="description"
                      placeholder="Ex : Mon portfolio est un projet où l'on retrouve toutes les informations de Marvin Pagnoul"
                      required rows="10"
            ><?= $_SESSION['old']['description'] ?? '' ?></textarea>
        </div>

        <div class="flex flex-col gap-2">
            <?php
            foreach ($contacts as $contact): ?>
                <div>
                    <input id="c-<?= $contact->id ?>"
                           type="checkbox"
                           name="contacts[]"
                           class="h-4 w-4"
                           value="<?= $contact->id ?>"
                    >
                    <label for="c-<?= $contact->id ?>"><?= $contact->name ?></label>
                    <select name="role-<?= $contact->id ?>"
                            id="role-<?= $contact->id ?>"
                            class="mx-2 p-2 rounded">
                        <option value="worker">Travailleur</option>
                        <option value="director">Directeur</option>
                    </select>
                    <label for="role-<?= $contact->id ?>"
                           class="font-bold sr-only">Rôle</label>
                </div>
            <?php
            endforeach; ?>
        </div>

        <button class="bg-blue-500 font-bold text-white rounded-md p-2 px-4 tracking-wider uppercase" type="submit">Cr&eacute;er
            ce projet
        </button>

    </form>

</section>

<?php
partials('common_html_end');
?>
</body>
</html>
