<?php

/** @var \App\Models\Workout[] $workouts */
/** @var \App\Models\Exercise[] $exercises */
/** @var \App\Models\Workout|null $workout */
/** @var array<int, int> $exerciseCounts */
/** @var int[] $selectedExerciseIds */
$workout = $workout ?? null;
$selectedExerciseIds = $selectedExerciseIds ?? [];
$exerciseCounts = $exerciseCounts ?? [];
?>
<section class="page-heading">
    <h1>Workouts</h1>
    <p>Create workouts and assign exercises to them.</p>
</section>

<section class="content-section">
    <h2><?= $workout === null ? 'Add workout' : 'Edit workout' ?></h2>
    <form method="post"
          action="<?= $link->url($workout === null ? 'home.saveWorkout' : 'home.updateWorkout') ?>">
        <?php if ($workout !== null) { ?>
            <input type="hidden" name="id" value="<?= (int)$workout->id ?>">
        <?php } ?>
        <p>
            <label for="workout-name">Name</label><br>
            <input id="workout-name" type="text" name="name"
                   value="<?= htmlspecialchars($workout->name ?? '', ENT_QUOTES, 'UTF-8') ?>"
                   maxlength="100" required>
        </p>
        <fieldset class="exercise-checkboxes">
            <legend>Exercises</legend>
            <?php if (count($exercises) === 0) { ?>
                <p>No exercises available. Add an exercise first.</p>
            <?php } else { ?>
                <?php foreach ($exercises as $exercise) { ?>
                    <label class="exercise-checkbox">
                        <input type="checkbox" name="exerciseIds[]"
                               value="<?= (int)$exercise->id ?>"
                            <?= in_array((int)$exercise->id, $selectedExerciseIds, true) ? ' checked' : '' ?>>
                        <span><?= htmlspecialchars($exercise->name, ENT_QUOTES, 'UTF-8') ?></span>
                    </label>
                <?php } ?>
            <?php } ?>
        </fieldset>
        <button type="submit" class="button button-primary">
            <?= $workout === null ? 'Add workout' : 'Save changes' ?>
        </button>
        <?php if ($workout !== null) { ?>
            <a class="button" href="<?= $link->url('home.workouts') ?>">Cancel</a>
        <?php } ?>
    </form>
</section>

<section class="content-section">
    <h2>Workout list</h2>
    <?php if (count($workouts) === 0) { ?>
        <p>No workouts have been added yet.</p>
    <?php } else { ?>
        <div class="activity-list">
            <?php foreach ($workouts as $item) { ?>
                <article class="activity-item">
                    <div class="activity-information">
                        <h3><?= htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8') ?></h3>
                        <p><?= (int)($exerciseCounts[$item->id] ?? 0) ?> exercises</p>
                    </div>
                    <div>
                        <a class="button" href="<?= $link->url('home.editWorkout', ['id' => $item->id]) ?>">Edit</a>
                        <form method="post" action="<?= $link->url('home.deleteWorkout') ?>" style="display:inline">
                            <input type="hidden" name="id" value="<?= (int)$item->id ?>">
                            <button type="submit" class="button">Delete</button>
                        </form>
                    </div>
                </article>
            <?php } ?>
        </div>
    <?php } ?>
</section>
