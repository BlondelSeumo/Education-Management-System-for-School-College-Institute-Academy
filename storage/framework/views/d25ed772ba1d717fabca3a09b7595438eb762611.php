<?php $__env->startSection('main_content'); ?>
<?php
    $css= "background: linear-gradient(0deg, rgba(124, 50, 255, 0.6), rgba(199, 56, 216, 0.6)), url(".url($homePage->image).") no-repeat center;    background-size: cover;";
?>

 <style type="text/css">
     .client .events-item .card .card-body .date {
        max-width: 80px !important; 
     }
 </style>

  <?php if(isset($per["Image Banner"])): ?>
    <!--================ Home Banner Area =================-->
    <section class="container box-1420">
        <div class="home-banner-area" style="<?php echo e($css); ?>">
            <div class="banner-inner">
                <div class="banner-content">
                    <h5><?php echo e($homePage->title); ?></h5>
                    <h2><?php echo e($homePage->long_title); ?></h2>
                    <p><?php echo e($homePage->short_description); ?></p>
                    <a class="primary-btn fix-gr-bg semi-large" href="<?php echo e($homePage->link_url); ?>"><?php echo e($homePage->link_label); ?></a>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>


    <!--================ End Home Banner Area =================-->

    <!--================ News Area =================-->
    <section class="news-area section-gap-top">
        <div class="container">
            <div class="row">
                  <?php if(isset($per["Latest News"])): ?>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <h3 class="title">Latest News</h3>
                        </div>
                        <div class="col-lg-6 col-md-5 text-md-right text-left mb-30-lg">
                            <a href="<?php echo e(url('news-page')); ?>" class="primary-btn small fix-gr-bg">Browse All</a>
                        </div>
                    </div>
                    <div class="row">
                          <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="news-item">
                                <div class="news-img">
                                    <img class="img-fluid w-100" src="<?php echo e(asset($value->image)); ?>" alt="">
                                </div>
                                <div class="news-text">
                                    <p class="date">
                                       
<?php echo e($value->publish_date != ""? App\SmGeneralSettings::DateConvater($value->publish_date):''); ?>


                                    </p>
                                    <h4>
                                        <a href="<?php echo e(url('news-details/'.$value->id)); ?>">
                                            <?php echo e($value->news_title); ?>

                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>
                  <?php if(isset($per["Notice Board"])): ?>

                <div class="col-lg-3 notice-board-area">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="title">Notice Board</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="notice-board">
                                <?php $__currentLoopData = $notice_board; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="notice-item">
                                    <p class="date">
                                       
<?php echo e($notice->publish_on != ""? App\SmGeneralSettings::DateConvater($notice->publish_on):''); ?>


                                    </p>
                                    <a href="#" data-toggle="modal" data-target="#NoticeDetails<?php echo e($notice->id); ?>" ><h4><?php echo e($notice->notice_title); ?></h4></a> 
                                  <div class="modal fade admin-query" id="NoticeDetails<?php echo e($notice->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered  modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title dialog-notice-title"><?php echo e($notice->notice_title); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div> 
                                            <div class="modal-body">
                                                <div class="text-left">
                                                    <p class="text-left"><?php echo $notice->notice_message; ?></p>
                                                </div> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>

                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>   
                <?php endif; ?>
            </div>
        </div>
    </section>

 

    <!--================End News Area =================-->
    
  <?php if(isset($per["Academics"])): ?>
    <!--================ Academics Area =================-->
    <section class="academics-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <h3 class="title">Academics</h3>
                        </div>
                        <div class="col-lg-6 col-md-5 text-md-right text-left mb-30-lg">
                            <a href="<?php echo e(url('course')); ?>" class="primary-btn small fix-gr-bg">Browse All</a>
                        </div>
                    </div>
                    <div class="row">
                        <?php $__currentLoopData = $academics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $academic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="academic-item">
                                <div class="academic-img">
                                    <img class="img-fluid" src="<?php echo e(asset($academic->image)); ?>" alt="">
                                </div>
                                <div class="academic-text">
                                    <h4>
                                        <a href="<?php echo e(url('course-Details/'.$academic->id)); ?>"><?php echo e($academic->title); ?></a>
                                    </h4>
                                    <p>
                                        <?php echo substr($academic->overview, 0, 50); ?>

                                    </p>
                                    <div>
                                        <a href="<?php echo e(url('course-Details/'.$academic->id)); ?>" class="client-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

  <?php if(isset($per["Event List"])): ?>
    <!--================ End Academics Area =================-->

    <!--================ Events Area =================-->
    <section class="events-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <h3 class="title">Event List</h3>
                        </div>
                        <div class="col-lg-6 col-md-5 text-md-right text-left mb-30-lg">
                            <a href="#" class="primary-btn small fix-gr-bg">Browse All</a>
                        </div>
                    </div>
                    <div class="row">
                        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="events-item">
                                <div class="card">
                                    <img class="card-img-top" class="img-fluid" src="<?php echo e(asset($event->uplad_image_file)); ?>" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php echo e($event->event_title); ?>

                                        </h5>
                                        <p class="card-text">
                                            <?php echo e($event->event_location); ?>

                                        </p>
                                        <div class="date">
                                           
<?php echo e($event->from_date != ""? App\SmGeneralSettings::DateConvater($event->from_date):''); ?>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php endif; ?>
  <?php if(isset($per["Testimonial"])): ?>

    <!--================ End Events Area =================-->

    <!--================ Start Testimonial Area =================-->
    <section class="testimonial-area relative section-gap">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="active-testimonial owl-carousel">

                     <?php $__currentLoopData = $testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="single-testimonial text-center">
                        <div class="d-flex justify-content-center">
                            <div class="thumb">
                                <?php if(!empty($value->image)): ?>
                                <img class="img-fluid rounded-circle" src="<?php echo e(asset($value->image)); ?>" alt="">
                                    <?php else: ?>
                                    <img class="img-fluid rounded-circle" src="<?php echo e(asset('public/uploads/sample.jpg')); ?>" alt="">
                                    <?php endif; ?>
                            </div>
                            <div class="meta text-left">
                                <h4><?php echo e($value->name); ?></h4>
                                <p><?php echo e($value->designation); ?>, <?php echo e($value->institution_name); ?></p>
                            </div>
                        </div>
                        <p class="desc">
                            <?php echo e($value->description); ?>

                        </p>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>

    <?php endif; ?> 

    <!--================ End Testimonial Area =================-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontEnd.home.front_master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>