<?php $__env->startSection('title', 'Lance Master | Home Page'); ?>

<?php $__env->startSection('content'); ?>

    <div class="video">
        <video autoplay controls>
            <source src="<?php echo e(asset($video->video_path)); ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.front-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/lance/resources/views/front/play.blade.php ENDPATH**/ ?>