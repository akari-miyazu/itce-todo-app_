<!DOCTYPE html>
<html lang="ja">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Basic Tasks</title>
 <!-- <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>"> -->
 <link type="text/css" rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>">
</head>
<body>
 <div class="container">
   <div class="card mb-3">
     <div class="card-header">タスクを編集</div>
     <div class="card-body">
        <?php if($errors->any()): ?>
        <div class="alert alert-danger">
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p><?php echo e($message); ?></p>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      <?php endif; ?>
       <form action="<?php echo e(route('edit', ['id' => $task->id])); ?>" method="POST">
         <?php echo csrf_field(); ?>
         <div class="form-group">
            <input type="text" class="form-control" name="name" id="name" value="<?php echo e(old('name') ?? $task->name); ?>" />
            <div>プロジェクト</div>
            <input type="text" class="form-control" name="project" id="project" value="<?php echo e(old('project') ?? $task->project); ?>" />
           <label for="status">状態</label>
           <select name="status" id="status" class="form-control">
            <?php $__currentLoopData = \App\Models\Task::STATUS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($key); ?>"<?php echo e($key == old('status', $task->status) ? 'selected' : ''); ?>>
                <?php echo e($val['label']); ?>

              </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
           <div>期限</div>
           <input type="text" class="form-control" name="complete" id="complete" value="<?php echo e(old('complete') ?? date('Y/m/d/ H:i',strtotime($task->complete))); ?>" />
           <div>詳細</div>
           <input type="text" class="form-control" name="detail" id="detail" value="<?php echo e(old('detail') ?? $task->detail); ?>" />
           <button type="submit" class="btn btn-outline-info mt-2"><i class="fas fa-plus fa-lg mr-2"></i>変更</button>
         </div>
       </form>
     </div>
   </div>
 </div>
</body>
</html>
<?php /**PATH /work/backend/resources/views/edit.blade.php ENDPATH**/ ?>