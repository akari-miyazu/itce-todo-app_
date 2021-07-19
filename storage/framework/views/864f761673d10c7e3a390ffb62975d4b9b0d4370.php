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
    
    <?php $__env->startSection('content'); ?>
     <div class="card-header">タスク詳細</div>
     <div class="card-body">
        <table class="table">
            <tr>
                <th>タスク</th>
                <td><?php echo e($task->name); ?></td>
            </tr>
            <tr>
                <th>期限日</th>
                <td><?php echo e($task->comolete); ?></td>
            </tr>
            <tr>
                <th>メモ</th>
                <td><?php echo e($task->memo); ?></td>
            </tr>
        </table>
           <div><a href="<?php echo e(url('/')); ?>" class="btn btn-primary">もどる</a></div>
         </div>
     </div>
    <?php $__env->stopSection(); ?>
   </div>
 </div>
</body>
</html>

<?php echo $__env->make('/', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/backend/resources/views/memo.blade.php ENDPATH**/ ?>