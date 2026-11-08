<?php

/** @var string $contentHTML */
/** @var \Framework\Auth\AppUser $user */
/** @var \Framework\Support\LinkGenerator $link */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LevelUP</title>
    <link rel="stylesheet" href="<?= $link->asset('css/style.css') ?>">
</head>
<body>
<div class="app">
    <header class="topbar">
        <a class="brand" href="<?= $link->url('home.index') ?>">LevelUP</a>
        <button class="profile-button" type="button" aria-label="Používateľský profil">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <circle cx="12" cy="8" r="4"></circle>
                <path d="M4.5 20a7.5 7.5 0 0 1 15 0"></path>
            </svg>
        </button>
    </header>
    <div class="layout">
        <aside class="sidebar">
            <nav class="navigation" aria-label="Hlavná navigácia">
                <a class="navigation-link <?= $link->url('home.index') === ($_SERVER['REQUEST_URI'] ?? '') ? 'active' : '' ?>"
                   href="<?= $link->url('home.index') ?>">Dashboard</a>
                <a class="navigation-link <?= $link->url('home.exercises') === ($_SERVER['REQUEST_URI'] ?? '') ? 'active' : '' ?>"
                   href="<?= $link->url('home.exercises') ?>">Exercises</a>
                <a class="navigation-link <?= $link->url('home.trainingPlans') === ($_SERVER['REQUEST_URI'] ?? '') ? 'active' : '' ?>"
                   href="<?= $link->url('home.trainingPlans') ?>">Training Plans</a>
                <a class="navigation-link" href="<?= $link->url('home.index') ?>#workout-history">Workout History</a>
                <a class="navigation-link" href="<?= $link->url('home.index') ?>#body-measurements">Body Measurements</a>
                <a class="navigation-link settings-link" href="<?= $link->url('home.index') ?>#settings">Settings</a>

            </nav>
        </aside>
        <main class="main-content">
            <?= $contentHTML ?>
        </main>
    </div>
</div>
</body>
</html>
