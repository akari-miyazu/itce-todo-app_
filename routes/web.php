<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
use App\Http\Controllers\EditController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('tasks', [
        'tasks' => App\Models\Task::latest()->get()
    ]);
});

Route::get('/tasks/{id}/edit' ,[EditController::class,'showEditForm'])->name('edit');

Route::get('/tasklist' ,[EditController::class,'ShowTaskList'])->name('list');

Route::get('/project' ,[EditController::class,'ShowProject'])->name('project');

Route::post('/task', function (Request $request) {
    request()->validate(
        [
            'name'=> 'required|unique:tasks|min:3|max:255'
        ],
        [
            'name.required'=> 'タスク内容を入力してください。',
            'name.unique' => 'そのタスクは既に追加されています。',
            'name.min' => '3文字以上で入力してください。',
            'name.max' => '255文字以内で入力してください。'
        ]

    );

    request()->validate(
        [
            'detail'=> 'required'
        ],
        [
            'detail.required' => 'タスク詳細を入力してください。'
        ]

    );

    request()->validate(
        [
            'project'=> 'required'
        ],
        [
            'project.required' => 'プロジェクト名を入力してください。'
        ]

    );

    $task = new Task();
    $task->complete = request('complete');
    $task->name = request('name');
    $task->detail = request('detail');
    $task->project = request('project');
    $task->save();
    return redirect('/');
});

Route::post('/tasks/{id}/edit', [EditController::class,'edit']);

Route::delete('/task/{task}', function (Task $task) {
    $task->delete();
    return redirect('/');
});
