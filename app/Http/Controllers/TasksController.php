<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($project): Response
    {

        $project = Project::findOrFail($project);

        $tasks = $project
            ->tasks()
            ->with('users')
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($task) {

                return [
                    'id' => $task->id,
                    'title' => $task->title,
                    'description' => $task->description,
                    'due_date' => $task->due_date?->diffForHumans(),
                    'completed' => $task->completed,
                    'assigned_to' => $task->users->pluck('name', 'id'),
                ];

            });

        return Inertia::render('Projects/Tasks', [
            'project' => $project->only(['id', 'title']),
            'tasks' => $tasks,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
