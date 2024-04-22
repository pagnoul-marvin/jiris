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
        <link rel="stylesheet"
              href="<?= public_path('css/app.css') ?>">
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
                        <dd><?= \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $jiri->starting_at)
    ->locale('fr')
    ->diffForHumans() ?>
                        </dd>
                        <dd><?= \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $jiri->starting_at)
    ->locale('fr')
    ->toDateTimeString() ?>
                        </dd>
                    </div>
                </dl>
                <div>
                    <a href="/jiri/edit?id=<?= $jiri->id ?>"
                       class="underline text-blue-500">modifier ce jiri</a>
                </div>
                <?php
                component('forms.jiris.delete', ['id' => $jiri->id]) ?>
            </main>
            <?php
            component('navigations.main'); ?>
        </div>
    </body>
</html>