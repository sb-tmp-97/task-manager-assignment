<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;

class ProjectsController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {

        /**
         * Get and map projects
         */
        $projects = Project::query()
            ->with('tasks')
            ->get()
            ->map(function ($project) {

                return [
                    'id' => $project->id,
                    'title' => $project->title,
                    'tasks_total' => $project->tasks->count(),
                    'tasks_completed' => $project->tasks->where('completed', true)->count(),
                ];

            });

        /**
         * Return Inertia Render
         */
        return Inertia::render('Projects/Overview', [
            'projects' => $projects,
        ]);

    }

}
