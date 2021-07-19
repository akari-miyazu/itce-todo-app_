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
        <div class="card-header">プロジェクト絞り込み</div>
        <div class="card-body">
            <form method="GET" action="{{ url('/project') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="keyword" class="form-control" value="{{$keyword}}">
                    <button type="submit" class="btn btn-outline-info mt-2"　value="検索"><i class="fas fa-plus fa-lg mr-2"></i>検索</button>
                </div>
            </form>
        </div>
        <div class="card-header">プロジェクト一覧</div>
        <div class="card-body">
            @if($tasks->count())
                <table class="table table-striped">
                  <tr>
                    <th>プロジェクト</th>
                    <th>タスク</th>
                    <th>状態</th>
                    <th>詳細メモ</th>
                    <th>期限</th>
                    <th></th>
                    <th></th>
                  </tr>
                  @foreach ($tasks as $task)
                  <tr>
                    <td>{{ $task->project }}</td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->status_label }}</td>
                    <td>{{ $task->detail }}</td>
                    <td> @if ($task->complete >1980-01-01)
                          {{ date('Y/m/d H:i',strtotime($task->complete)) }}
                        @else
                          <p></p>
                        @endif
                    </td>
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
                </table>
                @else
                <p>見つかりませんでした。</p>
                @endif
        <div></div>
        <div><a href="{{ url('/') }}" class="btn btn-primary">もどる</a></div>
        </div>
    </div>
</body>
</html>
