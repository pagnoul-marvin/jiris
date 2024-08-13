<?php
/** @var stdClass $project */

/** @var array $contacts */

use Carbon\Carbon;

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
    <title><?= $project->name ?></title>
</head>
<?php
partials('common_html_start');
?>

<h1 class="font-bold text-2xl"><?= $project->name ?></h1>

<section>
    <h2>Date et heure (d&eacute;but et fin)&nbsp;:</h2>

    <strong>D&eacute;but&nbsp;:</strong>
    <time datetime="<?= Carbon::createFromFormat('Y-m-d H:i:s', $project->starting_at)
        ->toDateTimeString() ?>">le <?= Carbon::createFromFormat('Y-m-d H:i:s', $project->starting_at)
            ->locale('fr')
            ->format('d M Y') ?> à <?= Carbon::createFromFormat('Y-m-d H:i:s', $project->starting_at)
            ->locale('fr')
            ->format('H:i') ?></time>
    <br>

    <strong>Fin&nbsp;:</strong>
    <time datetime="<?= Carbon::createFromFormat('Y-m-d H:i:s', $project->ending_at)
        ->toDateTimeString() ?>">le <?= Carbon::createFromFormat('Y-m-d H:i:s', $project->ending_at)
            ->locale('fr')
            ->format('d M Y') ?> à <?= Carbon::createFromFormat('Y-m-d H:i:s', $project->ending_at)
            ->locale('fr')
            ->format('H:i') ?></time>

</section>

<section>

    <h2 class="font-bold text-xl">Qu'est-ce que &laquo;<?= $project->name ?>&raquo;&nbsp;?</h2>

    <p><?= $project->description ?></p>

</section>

<section>

    <h2 class="font-bold text-xl">Ces contacts y participent&nbsp;:</h2>

    <?php if (count($contacts) > 0): ?>
        <ul>
            <?php foreach ($contacts as $contact): ?>
                <li><?= $contact->name ?> - <?= ucfirst($contact->role) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun contact n'a particip&eacute; &agrave; ce projet</p>
    <?php endif; ?>

</section>

<?php if ($project->starting_at >= date('Y-m-d')): ?>

    <a class="underline text-blue-500" href='/project/edit?id=<?= $project->id ?>' hreflang='fr'
       title='Modifier ce projet'>Modifier ce projet</a>

<?php endif; ?>

<form action="/project"
      method="post">
    <?php
    method('delete') ?>
    <?php
    csrf_token() ?>
    <input type="hidden"
           name="id"
           value="<?= $project->id ?>">
    <?php
    component('forms.controls.button-danger', ['text' => 'Supprimer ce projet']); ?>
</form>


<div>
    <a class="bg-blue-500 font-bold text-white rounded-md p-2 px-4 tracking-wider uppercase" href="/projects"
       title="Revenir à la page des projets" hreflang="fr">Revenir &agrave; la page des projets</a>
</div>

<?php
partials('common_html_end');
?>
</html>
