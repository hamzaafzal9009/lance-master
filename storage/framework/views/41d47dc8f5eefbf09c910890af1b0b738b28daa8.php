<?php $__env->startSection('title', 'Lance Master | Home Page'); ?>

<?php $__env->startSection('content'); ?>
    <div id="carousalTop" class="carousel slide mt-5" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousalTop" data-slide-to="0" class="active"></li>
            <li data-target="#carousalTop" data-slide-to="1"></li>
            <li data-target="#carousalTop" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?php echo e(asset('assets/front/images/banner1.jpg')); ?>" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="<?php echo e(asset('assets/front/images/banner2.jpg')); ?>" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="<?php echo e(asset('assets/front/images/banner3.jpg')); ?>" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carousalTop" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousalTop" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="playRow mt-4">
        <div class="heading">
            <h2>Recommended For You</h2>
        </div>
        <div class="playList">
            <?php $__currentLoopData = $recommendedVideos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div>
                    <div class="boxImg">
                        <img src="<?php echo e(asset($video->thumbnail)); ?>" data-href="<?php echo e(URL::to('/video', $video->id)); ?>"
                            class="video-list clickable" />
                        
                        <div class="px-3">
                            <div class="title">
                                <div>
                                    <?php echo e($video->title); ?>

                                    <p class="float-right">
                                        <?php if(isset($video->view)): ?>
                                            <?php if(sizeof($video->view) > 0): ?>
                                                <?php echo e($video->views->total_views); ?> Views
                                            <?php endif; ?>
                                        <?php else: ?>
                                            0 Views
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="details">
                                <div class="profile-pic">
                                    <img src="<?php echo e(asset('assets/front/images/dummy.jpg')); ?>" alt="">
                                </div>
                                <div class="video-details">
                                    <div class="channel">
                                        <a href="<?php echo e(route('channel.index', $video->user->id)); ?>" class="color-white">
                                            <span class="text-capitalize"><?php echo e($video->user->name); ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="playRow mt-4">
    <br></br>
        <div class="heading">
            <h2>Watch List</h2>
        </div>
        <div class="playList">
            <?php $__currentLoopData = $watchListVideos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div>
                    <div class="boxImg">
                        <video controls width='100%' id="recommendedVideoPlayer<?php echo e($video->id); ?>" height='200px' onclick="playVideo(this.id);">
                            <source src="<?php echo e(asset($video->video_path)); ?>">
                        </video>
                        <div class="px-3">
                            <div class="title">
                                <div>
                                    <?php echo e($video->title); ?>

                                    <p class="float-right">
                                        <?php if(isset($video->views)): ?>
                                                <?php echo e($video->views->total_views); ?> Views
                                        <?php else: ?>
                                            0 Views
                                        <?php endif; ?>
                                    </p>
                                    <p><h5 style="color:grey;font-size:10px;">Uploaded on 
                                    <?php echo e(date('d-M-Y', strtotime($video->created_at))); ?> 
                                    </h6></p>
                                </div>
                            </div>
                            <div class="details">
                                <div class="profile-pic">
                                    <img src="<?php echo e(asset('assets/front/images/dummy.jpg')); ?>" alt="">
                                </div>
                                <div class="video-details">
                                    <div class="channel">
                                        <a href="" class="color-white">
                                            <span class="text-capitalize"><?php echo e($video->user->name); ?></span> Channel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="playRow mt-4">
        <div class="heading">
            <h2>Watch History</h2>
        </div>
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"/>
        <?php $__currentLoopData = $watchedHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="playList">
                <div>
                    <div class="boxImg">
                        <video controls width='100%' class="watched-videos" id="<?php echo e($video->v_id); ?>" data-id="<?php echo e($video->v_id); ?>" height='200px'>
                            <source src="<?php echo e(asset($video->video_path)); ?>">
                        </video>
                        <div class="px-3">
                            <div class="title">
                                <div>
                                    <?php echo e($video->title); ?>

                                    <p class="float-right">
                                        <?php if(isset($video->view)): ?>
                                            <?php if(sizeof($video->view) > 0): ?>
                                                <?php echo e($video->views->total_views); ?> Views
                                            <?php endif; ?>
                                        <?php else: ?>
                                            0 Views
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="details">
                                <div class="profile-pic">
                                    <img src="<?php echo e(asset('assets/front/images/dummy.jpg')); ?>" alt="">
                                </div>
                                <div class="video-details">
                                    <div class="channel">
                                        <a href="" class="color-white">
                                            <span class="text-capitalize"><?php echo e($video->userHistory->name); ?></span> Channel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.front-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/lance/resources/views/front/index.blade.php ENDPATH**/ ?>