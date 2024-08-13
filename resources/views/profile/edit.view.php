<?php
/** @var array $user_info */
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">
    <title>Modifier votre profil</title>
    <link rel="stylesheet"
          href="<?= public_path('css/app.css') ?>">
</head>
<?php
partials('common_html_start');
?>

<h1 class="font-bold text-2xl">Modifier votre profil</h1>


<form action="/profile"
      method="post"
      class="flex flex-col gap-8">
    <?php method('patch')?>
    <?php csrf_token() ?>
    <div class="flex flex-col gap-2">
        <?php
        component('forms.controls.label-and-input', [
            'name' => 'name',
            'label' => 'Votre prénom',
            'type' => 'text',
            'value' => '',
            'placeholder' => 'Votre nom actuel : '.$user_info->name,
        ]);
        ?>

    </div>
    <div class="flex flex-col gap-2">
        <?php
        component('forms.controls.label-and-input', [
            'name' => 'email',
            'label' => 'Adresse email<small class="block font-normal">doit être valide et enregistrée dans notre système</small>',
            'type' => 'email',
            'value' => '',
            'placeholder' => 'votre adresse mail actuelle : '.$user_info->email,
        ]);
        ?>

    </div>
    <div class="flex flex-col gap-2">
        <?php
        component('forms.controls.label-and-input', [
            'name' => 'password',
            'label' => 'Votre nouveau mot de passe<small class="block font-normal">au moins 8 caractères, des lettres, des chiffres et des caractères spéciaux (+-*/%!?_)</small>',
            'type' => 'password',
            'value' => '',
            'placeholder' => '',

        ]);
        ?>
    </div>

    <div class="flex flex-col gap-2">
        <?php
        component('forms.controls.label-and-input', [
            'name' => 'old-password',
            'label' => 'Votre ancien mot de passe',
            'type' => 'password',
            'value' => '',
            'placeholder' => '',

        ]);
        ?>
    </div>
    <div>
        <?php
        component('forms.controls.button', ['text' => 'Modifier vos informations']) ?>
    </div>
    <?php
    $_SESSION['errors'] = [];
    $_SESSION['old'] = [];
    ?>
</form>

<?php
partials('common_html_end');
?>

</html>
