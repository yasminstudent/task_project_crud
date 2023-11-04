<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use App\Helpers\CurlRequest;
use GuzzleHttp\Client;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('tasks.display', [
            'tasks' => Task::all()->toArray()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('tasks.save', [
            'routeName' => 'task.store',
            'routeParams' => [],
            'pageName' => 'Criar Tarefa',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        // ----- VALIDAÇÃO DE PARÂMETROS -----
        $redirectError = 'task/create';
        $validator = $this->validateParametersSaveTask($request);
        if ($validator->fails()) {
            return redirect($redirectError)
                ->withErrors($validator)
                ->withInput();
        }
        // ----- FIM VALIDAÇÃO DE PARÂMETROS -----

        $task = new Task();
        return $this->saveTask($task, $request, $redirectError);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
        return view('tasks.save', [
            'routeName' => 'task.update',
            'routeParams' => [$id],
            'pageName' => 'Editar Tarefa',
            'task' => Task::all()->find($id)->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        // ----- VALIDAÇÃO DE PARÂMETROS -----
        if (!$id) {
            return redirect('task');
        }

        $redirectError = 'task/'.$id.'/edit';
        $validator = $this->validateParametersSaveTask($request);
        if ($validator->fails()) {
            return redirect($redirectError)
                ->withErrors($validator)
                ->withInput();
        }
        // ----- FIM VALIDAÇÃO DE PARÂMETROS -----

        $task = Task::all()->find($id);
        return $this->saveTask($task, $request, $redirectError);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Change task status.
     *
     * @param  int  $id
     * @return void
     */
    public function changeStatus($id)
    {
        $task = Task::all()->find($id);
        $task->is_done = 1 - $task->is_done;
        $task->save();
    }

    /**
     * Validate parameters to save task.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Validation\Validator
     */
    private function validateParametersSaveTask(Request $request)
    {
        return Validator::make($request->all(), [
            'title' => 'required|unique:tasks|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);
    }

    /**
     * Save task.
     *
     * @param  Task  $task
     * @param  \Illuminate\Http\Request  $request
     * @param  string $redirectError
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    private function saveTask(Task $task, Request $request, string $redirectError)
    {
        try {
            if ($request->input('description')) {
                $task->description = $request->input('description');
            }
            $task->title = $request->input('title');
            $task->save();

            return redirect('task');
        } catch (\Exception $e) {
            return redirect($redirectError)
                ->with('errorMessage', 'Erro ao salvar tarefa: '.$e->getMessage());
        }
    }
}
