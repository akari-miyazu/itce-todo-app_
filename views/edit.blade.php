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
   <div class="card mb-3">
     <div class="card-header">タスクを編集</div>
     <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
          @foreach($errors->all() as $message)
            <p>{{ $message }}</p>
          @endforeach
        </div>
      @endif
       <form action="{{ route('edit', ['id' => $task->id]) }}" method="POST">
         @csrf
         <div class="form-group">
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ?? $task->name }}" />
            <div>プロジェクト</div>
            <input type="text" class="form-control" name="project" id="project" value="{{ old('project') ?? $task->project }}" />
           <label for="status">状態</label>
           <select name="status" id="status" class="form-control">
            @foreach(\App\Models\Task::STATUS as $key => $val)
              <option value="{{ $key }}"{{ $key == old('status', $task->status) ? 'selected' : '' }}>
                {{ $val['label'] }}
              </option>
            @endforeach
          </select>
           <div>期限</div>
           <input type="text" class="form-control" name="complete" id="complete" value="{{ old('complete') ?? date('Y/m/d/ H:i',strtotime($task->complete)) }}" />
           <div>詳細</div>
           <input type="text" class="form-control" name="detail" id="detail" value="{{ old('detail') ?? $task->detail }}" />
           <button type="submit" class="btn btn-outline-info mt-2"><i class="fas fa-plus fa-lg mr-2"></i>変更</button>
         </div>
       </form>
     </div>
   </div>
 </div>
</body>
</html>
