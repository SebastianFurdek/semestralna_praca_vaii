<?php

namespace App\Controllers;

use App\Models\Exercise;
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
}
