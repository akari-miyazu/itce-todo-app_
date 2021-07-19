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
        <div class="card-header">タスク詳細一覧</div>
        <div class="card-body">
            <?php if($tasks->count()): ?>
                <table class="table table-striped">
                  <tr>
                    <th>タスク</th>
                    <th>状態</th>
                    <th>詳細メモ</th>
                    <th></th>
                  </tr>
                  <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($task->name); ?></td>
                    <td><?php echo e($task->status_label); ?></td>
                    <td><?php echo e($task->detail); ?></td>
                    <td><a href="<?php echo e(route('edit', ['id' => $task->id])); ?>">編集</a></td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
                <?php else: ?>
                <p>見つかりませんでした。</p>
                <?php endif; ?>
        <div></div>
        <div><a href="<?php echo e(url('/')); ?>" class="btn btn-primary">もどる</a></div>
        </div>
    </div>
</body>
</html>
<?php /**PATH /work/backend/resources/views/detail.blade.php ENDPATH**/ ?>