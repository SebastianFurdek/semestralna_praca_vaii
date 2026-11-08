<?php

/** @var \App\Models\Exercise[] $exercises */
/** @var \App\Models\Exercise|null $exercise */
$exercise = $exercise ?? null;
?>
<section class="page-heading">
    <h1>Exercises</h1>
    <p>Add, edit and remove exercises from your training database.</p>
</section>

<section class="content-section">
    <h2><?= $exercise === null ? 'Add exercise' : 'Edit exercise' ?></h2>
    <form method="post"
          action="<?= $link->url($exercise === null ? 'home.saveExercise' : 'home.updateExercise') ?>">
        <?php if ($exercise !== null) { ?>
            <input type="hidden" name="id" value="<?= (int)$exercise->id ?>">
        <?php } ?>
        <p>
            <label for="exercise-name">Name</label><br>
            <input id="exercise-name" type="text" name="name"
                   value="<?= htmlspecialchars($exercise->name ?? '', ENT_QUOTES, 'UTF-8') ?>"
                   maxlength="100" required>
        </p>
        <p>
            <label for="exercise-description">Description</label><br>
            <textarea id="exercise-description" name="description" rows="4"
                      maxlength="65535"><?= htmlspecialchars($exercise->description ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
        </p>
        <button type="submit" class="button button-primary">
            <?= $exercise === null ? 'Add exercise' : 'Save changes' ?>
        </button>
        <?php if ($exercise !== null) { ?>
            <a class="button" href="<?= $link->url('home.exercises') ?>">Cancel</a>
        <?php } ?>
    </form>
</section>

<section class="content-section">
    <h2>Exercise list</h2>
    <?php if (count($exercises) === 0) { ?>
        <p>No exercises have been added yet.</p>
    <?php } else { ?>
        <div class="activity-list">
            <?php foreach ($exercises as $item) { ?>
                <article class="activity-item">
                    <div class="activity-information">
                        <h3><?= htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8') ?></h3>
                        <p><?= nl2br(htmlspecialchars($item->description ?? '', ENT_QUOTES, 'UTF-8')) ?></p>
                    </div>
                    <div>
                        <a class="button" href="<?= $link->url('home.editExercise', ['id' => $item->id]) ?>">Edit</a>
                        <form method="post" action="<?= $link->url('home.deleteExercise') ?>" style="display:inline">
                            <input type="hidden" name="id" value="<?= (int)$item->id ?>">
                            <button type="submit" class="button">Delete</button>
                        </form>
                    </div>
                </article>
            <?php } ?>
        </div>
    <?php } ?>
</section>
