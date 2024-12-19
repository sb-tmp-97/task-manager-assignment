<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project): Response
    {

        /**
         * Get all users as key:value
         */
        $users = User::all()->pluck('name', 'id');

        /**
         * Get all tasks for this project and map them
         */
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
                    'due_date' => $task->due_date?->toFormattedDateString(),
                    'completed' => $task->completed,
                    'assigned_to' => $task->users->pluck('name', 'id'),
                ];

            });

        /**
         * Return Inertia Render
         */
        return Inertia::render('Projects/Tasks', [
            'project' => $project->only(['id', 'title']),
            'users' => $users,
            'tasks' => $tasks,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request, Project $project): RedirectResponse
    {

        /**
         * Create Task
         */
        $task = $project
            ->tasks()
            ->create($request->safe([
                'title',
                'due_date',
            ]));

        /**
         * Assign to users
         */
        if($request->filled('assigned_to')) {

            $task
                ->users()
                ->attach($request->validated('assigned_to'));

        }

        /**
         * Redirect back to overview
         */
        return redirect()->route('projects.tasks.index', $project->id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Task $task)
    {
        //
    }
}
