<section class="page-heading">
    <h1>Record Workout</h1>
    <p>Enter the weight and repetitions for each set.</p>
</section>

<section class="workout-information">
    <div class="workout-plan"><span>Workout</span><strong>Full Body A</strong></div>
    <div class="workout-date">
        <label for="workout-date">Date</label>
        <input type="date" id="workout-date" name="workout-date" value="2026-10-18" required>
    </div>
</section>

<form action="#" method="post" class="record-workout-form">
    <?php foreach ([
        'Bench Press' => 'bench-press',
        'Squats' => 'squats',
        'Deadlift' => 'deadlift',
    ] as $exercise => $name) { ?>
        <fieldset class="exercise-card">
            <legend class="visually-hidden"><?= $exercise ?></legend>
            <div class="exercise-header">
                <h2><?= $exercise ?></h2>
                <button type="button" class="button">Add Set</button>
            </div>
            <div class="set-table">
                <div class="set-row set-header"><span>Set</span><span>Weight (kg)</span><span>Reps</span></div>
                <?php for ($set = 1; $set <= 2; $set++) { ?>
                    <div class="set-row">
                        <span class="set-number"><?= $set ?></span>
                        <input type="number" name="<?= $name ?>-weight[]" placeholder="Enter weight" min="0" step="0.5"
                               aria-label="<?= $exercise ?>, séria <?= $set ?>, váha v kilogramoch" required>
                        <input type="number" name="<?= $name ?>-reps[]" placeholder="Enter reps" min="1" step="1"
                               aria-label="<?= $exercise ?>, séria <?= $set ?>, počet opakovaní" required>
                    </div>
                <?php } ?>
            </div>
        </fieldset>
    <?php } ?>

    <div class="form-actions">
        <button type="button" class="button">Add Exercise</button>
        <div class="finish-workout">
            <p>Save this workout to your history.</p>
            <button type="submit" class="button button-primary">Finish Workout</button>
        </div>
    </div>
</form>
