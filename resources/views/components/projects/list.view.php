<?php
/** @var array $projects */
?>

<?php
if (count($projects) > 0) : ?>
    <ol>
        <?php
        foreach ($projects as $project): ?>
            <li><a class="underline text-blue-500"
                   href="/project?id=<?= $project->id ?>"><?= $project->name ?></a></li>
        <?php endforeach; ?>
    </ol>
<?php endif; ?>


