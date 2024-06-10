<?php
/** @var stdClass $project */
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
    <title>Modifier <?= $project->name ?></title>
</head>
<?php
partials('common_html_start');
?>

<h1 class="font-bold text-2xl">Modifier <?= $project->name ?></h1>

<form class="flex flex-col gap-8 bg-slate-50 p-4" action="/project" method="POST">

    <?php
    method('patch') ?>
    <?php
    csrf_token() ?>
    <input type="hidden"
           name="id"
           value="<?= $project->id ?>">

    <small>Les champs dot&eacute;s d&rsquo;une &laquo;&ast;&raquo; sont obligatoires.</small>

    <div class="flex flex-col gap-2">
        <label class="font-bold" for="name">Changer le nom&nbsp;: &ast; <small>au moins 3 caract&egrave;res, au plus
                255</small></label>
        <input class="border border-grey-700 focus:invalid:border-pink-500 invalid:text-pink-600 rounded-md p-2"
               id="name" name="name" type="text" placeholder="Nom actuel : <?= $project->name ?>" required
               value="<?= $_SESSION['old']['name'] ?? '' ?>">
    </div>
    <?php if (isset($_SESSION['errors']['name'])): ?>
        <p class="text-red-500">Le nom ne correspond pas au format attendu.</p>
    <?php endif; ?>

    <div class="flex flex-col gap-2">
        <label class="font-bold" for="started">Changer la date et l&rsquo;heure de d&eacute;but&nbsp;: &ast; <small>au
                format
                2024-06-07 11:05</small></label>
        <input class="border border-grey-700 focus:invalid:border-pink-500 invalid:text-pink-600 rounded-md p-2"
               id="started" name="starting_at" type="text"
               placeholder="Date et heure de début actuelle : <?= $project->starting_at ?>" required
               value="<?= $_SESSION['old']['starting'] ?? '' ?>">
    </div>
    <?php if (isset($_SESSION['errors']['starting'])): ?>
        <p class="text-red-500">La date et l&rsquo;heure ne correspondent pas au format attendu.</p>
    <?php endif; ?>

    <div class="flex flex-col gap-2">
        <label class="font-bold" for="ended">Changer la date et l&rsquo;heure de fin&nbsp;: &ast; <small>au format
                2024-06-07
                11:05</small></label>
        <input class="border border-grey-700 focus:invalid:border-pink-500 invalid:text-pink-600 rounded-md p-2"
               id="ended" name="ending_at" type="text"
               placeholder="Date et heure de fin actuelle : <?= $project->ending_at ?>" required
               value="<?= $_SESSION['old']['ending'] ?? '' ?>">
    </div>
    <?php if (isset($_SESSION['errors']['ending'])): ?>
        <p class="text-red-500">La date et l&rsquo;heure ne correspondent pas au format attendu.</p>
    <?php endif; ?>

    <div class="flex flex-col gap-2">
        <label class="font-bold" for="description">Changer la description&nbsp;: &ast; <small>au minimum 3 caract&egrave;res,
                au
                plus 500</small></label>
        <textarea class="border border-grey-700 focus:invalid:border-pink-500 invalid:text-pink-600 rounded-md p-2"
                  id="description" name="description" rows="10"
                  placeholder="Description actuelle : <?= $project->description ?>"
                  required><?= $_SESSION['old']['description'] ?? '' ?></textarea>
    </div>
    <?php if (isset($_SESSION['errors']['description'])): ?>
        <p class="text-red-500">La description ne correspond pas au format attendu.</p>
    <?php endif; ?>

    <button class="bg-blue-500 font-bold text-white rounded-md p-2 px-4 tracking-wider uppercase" type="submit">Modifier
        ce projet
    </button>
</form>

<?php
partials('common_html_end');
?>
</html>