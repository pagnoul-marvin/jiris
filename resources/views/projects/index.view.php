<?php
/** @var array $passed_projects */
/** @var array $upcoming_projects */
/** @var array $in_progress_projects */
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">
    <title>Projets</title>
    <link rel="stylesheet"
          href="<?= public_path('css/app.css') ?>">
</head>
<?php
partials('common_html_start');
?>

<h1 class="font-bold text-2xl">Vos projets</h1>

<section>

    <h2 class="font-bold text-xl">Voici les projets &agrave; venir&nbsp;:</h2>

    <?php if (!empty($upcoming_projects)): ?>

        <?php component('projects.list', [
            'projects' => $upcoming_projects,
        ]) ?>

    <?php else: ?>
        <p>Aucun projet</p>
    <?php endif; ?>

</section>

<section>

    <h2 class="font-bold text-xl">Voici les projets pass&eacute;s&nbsp;:</h2>

    <?php if (!empty($passed_projects)): ?>

        <?php component('projects.list', [
            'projects' => $passed_projects,
        ]) ?>

    <?php else: ?>
        <p>Aucun projet</p>
    <?php endif; ?>

</section>

<section>

    <h2 class="font-bold text-xl">Voici les projets en cours&nbsp;:</h2>

    <?php if (!empty($in_progress_projects)): ?>

        <?php component('projects.list', [
            'projects' => $in_progress_projects,
        ]) ?>

    <?php else: ?>
        <p>Aucun projet</p>
    <?php endif; ?>

</section>

<div>
    <a href="/project/create"
       class="underline text-blue-500 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 24 24"
             fill="currentColor"
             class="w-6 h-6">
            <path fill-rule="evenodd"
                  d="M5.625 1.5H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875ZM12.75 12a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V18a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V12Z"
                  clip-rule="evenodd" />
            <path d="M14.25 5.25a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963A5.23 5.23 0 0 0 16.5 7.5h-1.875a.375.375 0 0 1-.375-.375V5.25Z" />
        </svg>
        <span>Créer un nouveau project</span></a>
</div>

<?php
partials('common_html_end');
?>
</html>
