<!DOCTYPE html>
<html lang="ja">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Basic Tasks</title>
 <!-- <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
 <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
 <div class="container">
   <h3 class="my-3">タスク管理ツール</h3>
   <div class="card mb-3">
     <div class="card-header">タスク新規追加</div>
     <div class="card-body">
       <form method="POST" action="{{ url('/task') }}">
         @csrf
         <div class="form-group">
           <input type="text" name="name" class="form-control">
           @if ($errors->has('name'))
           <p class="text-danger">{{ $errors->first('name') }}</p>
           @endif
           <div>プロジェクト名</div>
           <input type="text" name="project" class="form-control">
           @if ($errors->has('project'))
           <p class="text-danger">{{ $errors->first('project') }}</p>
           @endif
           <div>期限</div>
           <input type="datetime-local" name="complete" class="form-control">
           <div>詳細</div>
           <textarea name="detail" id="detail" rows="5" class="form-control"></textarea>
            @if ($errors->has('detail'))
            <p class="text-danger">{{ $errors->first('detail') }}</p>
            @endif
           <button type="submit" class="btn btn-outline-info mt-2"><i class="fas fa-plus fa-lg mr-2"></i>追加</button>
           <div><a href="{{ route('list') }}">タスク一覧を検索</a></div>
           <div><a href="{{ route('project') }}">プロジェクト　タスク分類</a></div>
         </div>
       </form>
     </div>
   </div>
   <div class="card">
     <div class="card-header">タスク一覧</div>
     <div class="card-body">
       @if (count($tasks) > 0)
       <table class="table table-striped">
         <thead>
             <tr>
                 <th>タスク</th>
                 <th>入力時間</th>
                 <th>期限</th>
                 <th>状態</th>
                 <th>メモ</th>
                 <th></th>
                 <th></th>
             </tr>
         </thead>
         <tbody>
           @foreach ($tasks as $task)
           <tr>
             <td>{{ $task->name }}</td>
             <td>{{ $task->created_at->format("Y/m/d H:i") }}</td>
             <td> @if ($task->complete >1980-01-01)
                   @if ($task->complete <date('Y-m-d H:i'))
                     <span style="color:rgb(161, 56, 126)">{{ date('Y/m/d H:i',strtotime($task->complete)) }}</span>
                   @else
                     {{ date('Y/m/d H:i',strtotime($task->complete)) }}
                   @endif
                  @else
                   <p></p>
                  @endif
             </td>
　　　　　　　 <td> @if($task->status < 2)
                     <span style="color:rgb(161, 56, 126)">{{ $task->status_label }}</span>
                  @else
                     <span style="color:rgb(46, 140, 177)">{{ $task->status_label }}</span>
                  @endif
            </td>
            <td>{{ $task->detail }}</td>
　　　　　　　 <td>
              <form method="POST" action="{{ url('/task/' . $task->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger" style="width: 100px;"><i class="far fa-trash-alt"></i> 削除</button>
              </form>
             </td>
             <td><a href="{{ route('edit', ['id' => $task->id]) }}">編集</a></td>
           </tr>
           @endforeach
         </tbody>
       </table>
       @endif
     </div>
   </div>
 </div>
</body>
</html>
