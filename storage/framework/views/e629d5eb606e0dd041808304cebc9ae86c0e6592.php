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
        <div class="card-header">プロジェクト絞り込み</div>
        <div class="card-body">
            <form method="GET" action="<?php echo e(url('/project')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <input type="text" name="keyword" class="form-control" value="<?php echo e($keyword); ?>">
                    <button type="submit" class="btn btn-outline-info mt-2"　value="検索"><i class="fas fa-plus fa-lg mr-2"></i>検索</button>
                </div>
            </form>
        </div>
        <div class="card-header">プロジェクト一覧</div>
        <div class="card-body">
            <?php if($tasks->count()): ?>
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
                  <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($task->project); ?></td>
                    <td><?php echo e($task->name); ?></td>
                    <td><?php echo e($task->status_label); ?></td>
                    <td><?php echo e($task->detail); ?></td>
                    <td> <?php if($task->complete >1980-01-01): ?>
                          <?php echo e(date('Y/m/d H:i',strtotime($task->complete))); ?>

                        <?php else: ?>
                          <p></p>
                        <?php endif; ?>
                    </td>
                    <td>
                        <form method="POST" action="<?php echo e(url('/task/' . $task->id)); ?>">
                          <?php echo csrf_field(); ?>
                          <?php echo method_field('DELETE'); ?>
                          <button type="submit" class="btn btn-outline-danger" style="width: 100px;"><i class="far fa-trash-alt"></i> 削除</button>
                        </form>
                       </td>
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
<?php /**PATH /work/backend/resources/views/project.blade.php ENDPATH**/ ?>