
<?php $__env->startSection('content'); ?>
<video-chat :user="<?php echo e($user); ?>" :others="<?php echo e($others); ?>" pusher-key="<?php echo e(config('broadcasting.connections.pusher.key')); ?>" pusher-cluster="<?php echo e(config('broadcasting.connections.pusher.options.cluster')); ?>"></video-chat>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\video-chat-demo\resources\views/video_chat/index.blade.php ENDPATH**/ ?>