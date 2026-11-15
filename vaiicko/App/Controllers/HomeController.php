<?php

namespace App\Controllers;

use App\Models\Exercise;
use App\Models\Workout;
use App\Models\WorkoutExercise;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Class HomeController
 * Handles actions related to the home page and other public actions.
 *
 * This controller includes actions that are accessible to all users, including a default landing page and a contact
 * page. It provides a mechanism for authorizing actions based on user permissions.
 *
 * @package App\Controllers
 */
class HomeController extends BaseController
{
    /**
     * Authorizes controller actions based on the specified action name.
     *
     * In this implementation, all actions are authorized unconditionally.
     *
     * @param string $action The action name to authorize.
     * @return bool Returns true, allowing all actions.
     */
    public function authorize(Request $request, string $action): bool
    {
        return true;
    }

    /**
     * Displays the default home page.
     *
     * This action serves the main HTML view of the home page.
     *
     * @return Response The response object containing the rendered HTML for the home page.
     */
    public function index(Request $request): Response
    {
        return $this->html();
    }

    /**
     * Displays the workout recording page.
     *
     * @return Response The response object containing the rendered HTML for the workout page.
     */
    public function trainingPlans(Request $request): Response
    {
        return $this->html();
    }

    public function workouts(Request $request): Response
    {
        $workouts = Workout::getAll(orderBy: 'created_at DESC');

        return $this->html([
            'workouts' => $workouts,
            'exerciseCounts' => $this->getWorkoutExerciseCounts($workouts),
            'exercises' => Exercise::getAll(orderBy: 'name ASC'),
        ]);
    }

    public function saveWorkout(Request $request): Response
    {
        $workout = new Workout();
        $workout->setFromRequest($request, ['name']);
        $workout->userId = 1;
        $workout->save();
        $this->saveWorkoutExercises($workout, $request->post('exerciseIds'));

        return $this->redirect($this->url('home.workouts'));
    }

    public function editWorkout(Request $request): Response
    {
        $workout = Workout::getOne((int)$request->get('id'));
        if ($workout === null) {
            return $this->redirect($this->url('home.workouts'));
        }

        return $this->html([
            'workout' => $workout,
            'selectedExerciseIds' => $this->getWorkoutExerciseIds($workout->id),
            'workouts' => Workout::getAll(orderBy: 'created_at DESC'),
            'exerciseCounts' => $this->getWorkoutExerciseCounts(Workout::getAll(orderBy: 'created_at DESC')),
            'exercises' => Exercise::getAll(orderBy: 'name ASC'),
        ], 'workouts');
    }

    public function updateWorkout(Request $request): Response
    {
        $workout = Workout::getOne((int)$request->post('id'));
        if ($workout !== null) {
            $workout->setFromRequest($request, ['name']);
            $workout->save();
            foreach (WorkoutExercise::getAll('workout_id = ?', [$workout->id]) as $workoutExercise) {
                $workoutExercise->delete();
            }
            $this->saveWorkoutExercises($workout, $request->post('exerciseIds'));
        }

        return $this->redirect($this->url('home.workouts'));
    }

    public function deleteWorkout(Request $request): Response
    {
        $workout = Workout::getOne((int)$request->post('id'));
        if ($workout !== null) {
            $workout->delete();
        }

        return $this->redirect($this->url('home.workouts'));
    }

    public function exercises(Request $request): Response
    {
        return $this->html(['exercises' => Exercise::getAll(orderBy: 'created_at DESC')]);
    }

    public function saveExercise(Request $request): Response
    {
        $exercise = new Exercise();
        $exercise->setFromRequest($request, ['name', 'description']);
        $exercise->userId = 1;
        $exercise->save();

        return $this->redirect($this->url('home.exercises'));
    }

    public function editExercise(Request $request): Response
    {
        $exercise = Exercise::getOne((int)$request->get('id'));
        if ($exercise === null) {
            return $this->redirect($this->url('home.exercises'));
        }

        return $this->html([
            'exercise' => $exercise,
            'exercises' => Exercise::getAll(orderBy: 'created_at DESC'),
        ], 'exercises');
    }

    public function updateExercise(Request $request): Response
    {
        $exercise = Exercise::getOne((int)$request->post('id'));
        if ($exercise !== null) {
            $exercise->setFromRequest($request, ['name', 'description']);
            $exercise->save();
        }

        return $this->redirect($this->url('home.exercises'));
    }

    public function deleteExercise(Request $request): Response
    {
        $exercise = Exercise::getOne((int)$request->post('id'));
        if ($exercise !== null) {
            $exercise->delete();
        }

        return $this->redirect($this->url('home.exercises'));
    }

    private function getWorkoutExerciseIds(?int $workoutId): array
    {
        if ($workoutId === null) {
            return [];
        }

        return array_map(
            static fn(WorkoutExercise $item): int => $item->exerciseId,
            WorkoutExercise::getAll('workout_id = ?', [$workoutId])
        );
    }

    private function getWorkoutExerciseCounts(array $workouts): array
    {
        $exerciseCounts = [];
        foreach ($workouts as $workout) {
            $exerciseCounts[$workout->id] = WorkoutExercise::getCount('workout_id = ?', [$workout->id]);
        }

        return $exerciseCounts;
    }

    private function saveWorkoutExercises(Workout $workout, mixed $exerciseIds): void
    {
        if (!is_array($exerciseIds)) {
            return;
        }

        $exerciseIds = array_unique(array_map('intval', $exerciseIds));
        foreach ($exerciseIds as $exerciseId) {
            if ($exerciseId <= 0 || Exercise::getOne($exerciseId) === null) {
                continue;
            }

            $workoutExercise = new WorkoutExercise();
            $workoutExercise->workoutId = (int)$workout->id;
            $workoutExercise->exerciseId = $exerciseId;
            $workoutExercise->save();
        }
    }
}
