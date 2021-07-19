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
   <h3 class="my-3">タスク管理ツール</h3>
   <div class="card mb-3">
     <div class="card-header">タスク新規追加</div>
     <div class="card-body">
       <form method="POST" action="<?php echo e(url('/task')); ?>">
         <?php echo csrf_field(); ?>
         <div class="form-group">
           <input type="text" name="name" class="form-control">
           <?php if($errors->has('name')): ?>
           <p class="text-danger"><?php echo e($errors->first('name')); ?></p>
           <?php endif; ?>
           <div>期限</div>
           <input type="datetime-local" name="complete" class="form-control">
           <button type="submit" class="btn btn-outline-info mt-2"><i class="fas fa-plus fa-lg mr-2"></i>追加</button>
           <div><a href="<?php echo e(url('/namelist')); ?>">タスク内容を検索</a></div>
         </div>
       </form>
     </div>
   </div>
   <div class="card">
     <div class="card-header">タスク一覧</div>
     <div class="card-body">
       <?php if(count($tasks) > 0): ?>
       <table class="table table-striped">
         <thead>
             <tr>
                 <th>タスク</th>
                 <th>入力時間</th>
                 <th>期限</th>
                 <th>状態</th>
                 <th></th>
                 <th></th>
             </tr>
         </thead>
         <tbody>
           <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <tr>
             <td><?php echo e($task->name); ?></td>
             <td><?php echo e($task->created_at->format("Y/m/d H:i")); ?></td>
             <td>  <?php if(isset($task->complete )): ?>
                　　　 <?php if($task->complete <date('Y-m-d H:i')): ?>
                         <span style="color:rgb(161, 56, 126)"><?php echo e(date('Y/m/d/ H:i',strtotime($task->complete))); ?></span>
                      <?php else: ?>
                         <?php echo e(date('Y/m/d/ H:i',strtotime($task->complete))); ?>

                      <?php endif; ?>
                   <?php else: ?>
                      <p></p>
                   <?php endif; ?>
             </td>
　　　　　　　 <td> <?php if($task->status < 2): ?>
                     <span style="color:rgb(161, 56, 126)"><?php echo e($task->status_label); ?></span>
                  <?php else: ?>
                     <span style="color:rgb(46, 140, 177)"><?php echo e($task->status_label); ?></span>
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
         </tbody>
       </table>
       <?php endif; ?>
     </div>
   </div>
 </div>
</body>
</html>
<?php /**PATH /work/backend/resources/views//tasks.blade.php ENDPATH**/ ?>