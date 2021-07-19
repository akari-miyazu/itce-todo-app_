<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



class EditController extends Controller
{
    /**
 * GET /folders/{id}/tasks/{task_id}/edit
 */
public function showEditForm(int $id )
{
    $task = Task::find($id);

    return view('edit', [
        'task' => $task,
    ]);
}

public function edit(int $id,Request $request)
{
    request()->validate(
        [
            'name'=> 'required|min:3|max:255'
        ],
        [
            'name.required'=> 'タスク内容を入力してください。',
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

    // 1
    $task = Task::find($id);

    // 2
    $task->name = $request->name;
    $task->status = $request->status;
    $task->complete = $request->complete;
    $task->detail = $request->detail;
    $task->project = $request->project;
    $task->save();

    // 3
    return redirect('/');

}

public function ShowTaskList(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Task::query(); //クエリの作成


        if (!empty($keyword)) {
            $query->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('status', 'LIKE', "%{$keyword}%")
                ->orWhere('complete', 'LIKE', "%{$keyword}%"); //検索機能
        }

        $tasks = $query->get(); //クエリデータを取得

        return view('namelist',[
            'tasks' => $tasks,
            'keyword' => $keyword,
        ]);
    }

    public function ShowProject(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Task::query(); //クエリの作成

        if (!empty($keyword)) {
            $query->where('project', 'LIKE', "%{$keyword}%"); //検索機能
        }

        $tasks = $query->get(); //クエリデータを取得

        return view('project',[
            'tasks' => $tasks,
            'keyword' => $keyword,
        ]);
    }

}


