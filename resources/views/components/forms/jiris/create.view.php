<form action="/jiri"
      method="post"
      class="flex flex-col gap-6">
    <?php
    csrf_token() ?>
    <div class="flex flex-col gap-2">
        <?php
        component('forms.controls.label-and-input', [
            'name' => 'name',
            'label' => 'Nom <small>au moins 3 caractères, au plus 255</small>',
            'type' => 'text',
            'value' => '',
            'placeholder' => 'Mon examen de première session',
        ]);
    ?>

    </div>
    <div class="flex flex-col gap-2">
        <?php
    $date = \Carbon\Carbon::now()->format('Y-m-d H:i');
    component('forms.controls.label-and-input', [
        'name' => 'starting_at',
        'label' => "Date et heure de début <small>au format {$date}</small>",
        'type' => 'text',
        'value' => '',
        'placeholder' => $date,

    ]);
    ?>
    </div>
    <div>
        <?php
    component('forms.controls.button', ['text' => 'Créer ce jiri']) ?>
    </div>
    <?php
    $_SESSION['errors'] = [];
    $_SESSION['old'] = [];
    ?>
</form>