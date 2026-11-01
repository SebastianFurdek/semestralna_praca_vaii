<section class="page-heading">
    <h1>Dashboard</h1>
    <p>Plan your training and review your recent workouts.</p>
</section>

<section class="summary-cards" aria-label="Prehľad tréningov">
    <article class="summary-card"><h2>Workouts this week</h2><div class="summary-value"></div><div class="summary-detail"></div></article>
    <article class="summary-card"><h2>Current training plan</h2><div class="summary-value"></div><div class="summary-detail"></div></article>
    <article class="summary-card"><h2>Training progress</h2><div class="summary-value"></div><div class="summary-detail"></div></article>
</section>

<section class="content-section">
    <h2>Upcoming workouts</h2>
    <div class="workout-list">
        <article class="workout-card">
            <p class="workout-date">Today · 18 Oct 2026</p>
            <h3>Full Body A</h3>
            <p class="workout-details">3 exercises · Approx. 45 min</p>
            <a class="button" href="<?= $link->url('home.trainingPlans') ?>">Record Workout</a>
        </article>
        <article class="workout-card">
            <p class="workout-date">Next session · 20 Oct 2026</p>
            <h3>Full Body B</h3>
            <p class="workout-details">4 exercises · Approx. 50 min</p>
            <a class="button" href="<?= $link->url('home.trainingPlans') ?>">Record Workout</a>
        </article>
    </div>
</section>

<section class="content-section" id="workout-history">
    <h2>Recent activity</h2>
    <div class="activity-list">
        <article class="activity-item"><div class="activity-information"><h3>Full Body B completed</h3><p>4 exercises · 12 sets</p></div><time datetime="2026-10-16">16 Oct 2026</time></article>
        <article class="activity-item"><div class="activity-information"><h3>Full Body A completed</h3><p>3 exercises · 9 sets</p></div><time datetime="2026-10-14">14 Oct 2026</time></article>
        <article class="activity-item"><div class="activity-information"><h3>Training plan updated</h3><p>Full body · 3 days per week</p></div><time datetime="2026-10-12">12 Oct 2026</time></article>
    </div>
</section>

<section id="body-measurements" aria-label="Body measurements"></section>
<section id="settings" aria-label="Nastavenia"></section>
