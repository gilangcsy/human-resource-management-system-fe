<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title><?php echo $__env->yieldContent('title'); ?> &mdash; IDS Intranet</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="Meet pages - The simplest and fastest way to build web UI for your dashboard or app."
        name="description" />
    <meta content="Ace" name="author" />

    
    <link href="<?php echo e(asset('assets/plugins/pace/pace-theme-flash.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?php echo e(asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.css')); ?>" rel="stylesheet" type="text/css" media="screen" />
    <?php echo $__env->yieldContent('css'); ?>
    
    <link class="main-stylesheet" href="<?php echo e(asset('pages/css/pages.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- Please remove the file below for production: Contains demo classes -->
    <link class="main-stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet" type="text/css" />

</head>

<body class="fixed-header ">
    
    <?php echo $__env->make('dashboard.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- START PAGE-CONTAINER -->
    <div class="page-container ">
        <?php echo $__env->make('dashboard.partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldContent('page-content'); ?>
    </div>
    <!-- END PAGE CONTAINER -->
    <!--START QUICKVIEW -->
    <div id="quickview" class="quickview-wrapper" data-pages="quickview">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="">
                <a href="#quickview-notes" data-target="#quickview-notes" data-toggle="tab" role="tab">Notes</a>
            </li>
            <li>
                <a href="#quickview-alerts" data-target="#quickview-alerts" data-toggle="tab" role="tab">Alerts</a>
            </li>
            <li class="">
                <a class="active" href="#quickview-chat" data-toggle="tab" role="tab">Chat</a>
            </li>
        </ul>
        <a class="btn-icon-link invert quickview-toggle" data-toggle-element="#quickview" data-toggle="quickview"><i
                class="pg-icon">close</i></a>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- BEGIN Notes !-->
            <div class="tab-pane no-padding" id="quickview-notes">
                <div class="view-port clearfix quickview-notes" id="note-views">
                    <!-- BEGIN Note List !-->
                    <div class="view list" id="quick-note-list">
                        <div class="toolbar clearfix">
                            <ul class="pull-right ">
                                <li>
                                    <a href="#" class="delete-note-link"><i class="pg-icon">trash_alt</i></a>
                                </li>
                                <li>
                                    <a href="#" class="new-note-link" data-navigate="view"
                                        data-view-port="#note-views" data-view-animation="push"><i
                                            class="pg-icon">add</i></a>
                                </li>
                            </ul>
                            <button aria-label="" class="btn-remove-notes btn btn-xs btn-block hide"><i
                                    class="pg-icon">close</i>Delete</button>
                        </div>
                        <ul>
                            <!-- BEGIN Note Item !-->
                            <li data-noteid="1" class="d-flex justify-space-between">
                                <div class="left">
                                    <!-- BEGIN Note Action !-->
                                    <div class="form-check warning no-margin">
                                        <input id="qncheckbox1" type="checkbox" value="1">
                                        <label for="qncheckbox1"></label>
                                    </div>
                                    <!-- END Note Action !-->
                                    <!-- BEGIN Note Preview Text !-->
                                    <p class="note-preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                        minim veniam</p>
                                    <!-- BEGIN Note Preview Text !-->
                                </div>
                                <!-- BEGIN Note Details !-->
                                <div class="d-flex right justify-content-end">
                                    <!-- BEGIN Note Date !-->
                                    <span class="date">12/12/20</span>
                                    <a href="#" class="d-flex align-items-center" data-navigate="view"
                                        data-view-port="#note-views" data-view-animation="push">
                                        <i class="pg-icon">chevron_right</i>
                                    </a>
                                    <!-- END Note Date !-->
                                </div>
                                <!-- END Note Details !-->
                            </li>
                            <!-- END Note List !-->
                            <!-- BEGIN Note Item !-->
                            <li data-noteid="2" class="d-flex justify-space-between">
                                <div class="left">
                                    <!-- BEGIN Note Action !-->
                                    <div class="form-check warning no-margin">
                                        <input id="qncheckbox2" type="checkbox" value="1">
                                        <label for="qncheckbox2"></label>
                                    </div>
                                    <!-- END Note Action !-->
                                    <!-- BEGIN Note Preview Text !-->
                                    <p class="note-preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                        minim veniam</p>
                                    <!-- BEGIN Note Preview Text !-->
                                </div>
                                <!-- BEGIN Note Details !-->
                                <div class="d-flex right justify-content-end">
                                    <!-- BEGIN Note Date !-->
                                    <span class="date">12/12/20</span>
                                    <a href="#" class="d-flex align-items-center" data-navigate="view"
                                        data-view-port="#note-views" data-view-animation="push"><i
                                            class="pg-icon">chevron_right</i></a>
                                    <!-- END Note Date !-->
                                </div>
                                <!-- END Note Details !-->
                            </li>
                            <!-- END Note List !-->
                            <!-- BEGIN Note Item !-->
                            <li data-noteid="2" class="d-flex justify-space-between">
                                <div class="left">
                                    <!-- BEGIN Note Action !-->
                                    <div class="form-check warning no-margin">
                                        <input id="qncheckbox3" type="checkbox" value="1">
                                        <label for="qncheckbox3"></label>
                                    </div>
                                    <!-- END Note Action !-->
                                    <!-- BEGIN Note Preview Text !-->
                                    <p class="note-preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                        minim veniam</p>
                                    <!-- BEGIN Note Preview Text !-->
                                </div>
                                <!-- BEGIN Note Details !-->
                                <div class="d-flex right justify-content-end">
                                    <!-- BEGIN Note Date !-->
                                    <span class="date">12/12/20</span>
                                    <a href="#" class="d-flex align-items-center" data-navigate="view"
                                        data-view-port="#note-views" data-view-animation="push"><i
                                            class="pg-icon">chevron_right</i></a>
                                    <!-- END Note Date !-->
                                </div>
                                <!-- END Note Details !-->
                            </li>
                            <!-- END Note List !-->
                            <!-- BEGIN Note Item !-->
                            <li data-noteid="3" class="d-flex justify-space-between">
                                <div class="left">
                                    <!-- BEGIN Note Action !-->
                                    <div class="form-check warning no-margin">
                                        <input id="qncheckbox4" type="checkbox" value="1">
                                        <label for="qncheckbox4"></label>
                                    </div>
                                    <!-- END Note Action !-->
                                    <!-- BEGIN Note Preview Text !-->
                                    <p class="note-preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                        minim veniam</p>
                                    <!-- BEGIN Note Preview Text !-->
                                </div>
                                <!-- BEGIN Note Details !-->
                                <div class="d-flex right justify-content-end">
                                    <!-- BEGIN Note Date !-->
                                    <span class="date">12/12/20</span>
                                    <a href="#" class="d-flex align-items-center" data-navigate="view"
                                        data-view-port="#note-views" data-view-animation="push"><i
                                            class="pg-icon">chevron_right</i></a>
                                    <!-- END Note Date !-->
                                </div>
                                <!-- END Note Details !-->
                            </li>
                            <!-- END Note List !-->
                            <!-- BEGIN Note Item !-->
                            <li data-noteid="4" class="d-flex justify-space-between">
                                <div class="left">
                                    <!-- BEGIN Note Action !-->
                                    <div class="form-check warning no-margin">
                                        <input id="qncheckbox5" type="checkbox" value="1">
                                        <label for="qncheckbox5"></label>
                                    </div>
                                    <!-- END Note Action !-->
                                    <!-- BEGIN Note Preview Text !-->
                                    <p class="note-preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                        minim veniam</p>
                                    <!-- BEGIN Note Preview Text !-->
                                </div>
                                <!-- BEGIN Note Details !-->
                                <div class="d-flex right justify-content-end">
                                    <!-- BEGIN Note Date !-->
                                    <span class="date">12/12/20</span>
                                    <a href="#" class="d-flex align-items-center" data-navigate="view"
                                        data-view-port="#note-views" data-view-animation="push"><i
                                            class="pg-icon">chevron_right</i></a>
                                    <!-- END Note Date !-->
                                </div>
                                <!-- END Note Details !-->
                            </li>
                            <!-- END Note List !-->
                        </ul>
                    </div>
                    <!-- END Note List !-->
                    <div class="view note" id="quick-note">
                        <div>
                            <ul class="toolbar">
                                <li><a href="#" class="close-note-link"><i class="pg-icon">chevron_left</i></a>
                                </li>
                                <li><a href="#" data-action="Bold" class="fs-12"><i
                                            class="pg-icon">format_bold</i></a>
                                </li>
                                <li><a href="#" data-action="Italic" class="fs-12"><i
                                            class="pg-icon">format_italics</i></a>
                                </li>
                                <li><a href="#" class="fs-12"><i class="pg-icon">link</i></a>
                                </li>
                            </ul>
                            <div class="body">
                                <div>
                                    <div class="top">
                                        <span>21st april 2020 2:13am</span>
                                    </div>
                                    <div class="content">
                                        <div class="quick-note-editor full-width full-height js-input"
                                            contenteditable="true"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Notes !-->
            <!-- BEGIN Alerts !-->
            <div class="tab-pane no-padding" id="quickview-alerts">
                <div class="view-port clearfix" id="alerts">
                    <!-- BEGIN Alerts View !-->
                    <div class="view bg-white">
                        <!-- BEGIN View Header !-->
                        <div class="navbar navbar-default navbar-sm">
                            <div class="navbar-inner">
                                <!-- BEGIN Header Controler !-->
                                <a href="javascript:;" class="action p-l-10 link text-color" data-navigate="view"
                                    data-view-port="#chat" data-view-animation="push-parrallax">
                                    <i class="pg-icon">more_horizontal</i>
                                </a>
                                <!-- END Header Controler !-->
                                <div class="view-heading">
                                    Notications
                                </div>
                                <!-- BEGIN Header Controler !-->
                                <a href="#" class="action p-r-10 pull-right link text-color">
                                    <i class="pg-icon">search</i>
                                </a>
                                <!-- END Header Controler !-->
                            </div>
                        </div>
                        <!-- END View Header !-->
                        <!-- BEGIN Alert List !-->
                        <div data-init-list-view="ioslist" class="list-view boreded no-top-border">
                            <!-- BEGIN List Group !-->
                            <div class="list-view-group-container">
                                <!-- BEGIN List Group Header!-->
                                <div class="list-view-group-header text-uppercase">
                                    Calendar
                                </div>
                                <!-- END List Group Header!-->
                                <ul>
                                    <!-- BEGIN List Group Item!-->
                                    <li class="alert-list">
                                        <!-- BEGIN Alert Item Set Animation using data-view-animation !-->
                                        <a href="javascript:;" class="align-items-center" data-navigate="view"
                                            data-view-port="#chat" data-view-animation="push-parrallax">
                                            <p class="">
                                                <span class="text-warning fs-10"><i
                                                        class="pg-icon">circle_fill</i></span>
                                            </p>
                                            <p class="p-l-10 overflow-ellipsis fs-12">
                                                <span class="text-color">David Nester Birthday</span>
                                            </p>
                                            <p class="p-r-10 ml-auto fs-12 text-right">
                                                <span class="text-warning">Today <br></span>
                                                <span class="text-color">All Day</span>
                                            </p>
                                        </a>
                                        <!-- END Alert Item!-->
                                        <!-- BEGIN List Group Item!-->
                                    </li>
                                    <!-- END List Group Item!-->
                                    <!-- BEGIN List Group Item!-->
                                    <li class="alert-list">
                                        <!-- BEGIN Alert Item Set Animation using data-view-animation !-->
                                        <a href="#" class="align-items-center" data-navigate="view"
                                            data-view-port="#chat" data-view-animation="push-parrallax">
                                            <p class="">
                                                <span class="text-warning fs-10"><i
                                                        class="pg-icon">circle_fill</i></span>
                                            </p>
                                            <p class="p-l-10 overflow-ellipsis fs-12">
                                                <span class="text-color">Meeting at 2:30</span>
                                            </p>
                                            <p class="p-r-10 ml-auto fs-12 text-right">
                                                <span class="text-warning">Today</span>
                                            </p>
                                        </a>
                                        <!-- END Alert Item!-->
                                    </li>
                                    <!-- END List Group Item!-->
                                </ul>
                            </div>
                            <!-- END List Group !-->
                            <div class="list-view-group-container">
                                <!-- BEGIN List Group Header!-->
                                <div class="list-view-group-header text-uppercase">
                                    Social
                                </div>
                                <!-- END List Group Header!-->
                                <ul>
                                    <!-- BEGIN List Group Item!-->
                                    <li class="alert-list">
                                        <!-- BEGIN Alert Item Set Animation using data-view-animation !-->
                                        <a href="javascript:;" class="p-t-10 p-b-10 align-items-center"
                                            data-navigate="view" data-view-port="#chat"
                                            data-view-animation="push-parrallax">
                                            <p class="">
                                                <span class="text-complete fs-10"><i
                                                        class="pg-icon">circle_fill</i></span>
                                            </p>
                                            <p class="col overflow-ellipsis fs-12 p-l-10">
                                                <span class="text-color link">Jame Smith commented on your
                                                    status<br></span>
                                                <span class="text-color">“Perfection Simplified - Company
                                                    Revox"</span>
                                            </p>
                                        </a>
                                        <!-- END Alert Item!-->
                                    </li>
                                    <!-- END List Group Item!-->
                                    <!-- BEGIN List Group Item!-->
                                    <li class="alert-list">
                                        <!-- BEGIN Alert Item Set Animation using data-view-animation !-->
                                        <a href="javascript:;" class="p-t-10 p-b-10 align-items-center"
                                            data-navigate="view" data-view-port="#chat"
                                            data-view-animation="push-parrallax">
                                            <p class="">
                                                <span class="text-complete fs-10"><i
                                                        class="pg-icon">circle_fill</i></span>
                                            </p>
                                            <p class="col overflow-ellipsis fs-12 p-l-10">
                                                <span class="text-color link">Jame Smith commented on your
                                                    status<br></span>
                                                <span class="text-color">“Perfection Simplified - Company
                                                    Revox"</span>
                                            </p>
                                        </a>
                                        <!-- END Alert Item!-->
                                    </li>
                                    <!-- END List Group Item!-->
                                </ul>
                            </div>
                            <div class="list-view-group-container">
                                <!-- BEGIN List Group Header!-->
                                <div class="list-view-group-header text-uppercase">
                                    Sever Status
                                </div>
                                <!-- END List Group Header!-->
                                <ul>
                                    <!-- BEGIN List Group Item!-->
                                    <li class="alert-list">
                                        <!-- BEGIN Alert Item Set Animation using data-view-animation !-->
                                        <a href="#" class="p-t-10 p-b-10 align-items-center" data-navigate="view"
                                            data-view-port="#chat" data-view-animation="push-parrallax">
                                            <p class="">
                                                <span class="text-danger fs-10"><i
                                                        class="pg-icon">circle_fill</i></span>
                                            </p>
                                            <p class="col overflow-ellipsis fs-12 p-l-10">
                                                <span class="text-color link">12:13AM GTM, 10230, ID:WR174s<br></span>
                                                <span class="text-color">Server Load Exceeted. Take action</span>
                                            </p>
                                        </a>
                                        <!-- END Alert Item!-->
                                    </li>
                                    <!-- END List Group Item!-->
                                </ul>
                            </div>
                        </div>
                        <!-- END Alert List !-->
                    </div>
                    <!-- EEND Alerts View !-->
                </div>
            </div>
            <!-- END Alerts !-->
            <div class="tab-pane active no-padding" id="quickview-chat">
                <div class="view-port clearfix" id="chat">
                    <div class="view bg-white">
                        <!-- BEGIN View Header !-->
                        <div class="navbar navbar-default">
                            <div class="navbar-inner">
                                <!-- BEGIN Header Controler !-->
                                <a href="javascript:;" class="action p-l-10 link text-color" data-navigate="view"
                                    data-view-port="#chat" data-view-animation="push-parrallax">
                                    <i class="pg-icon">add</i>
                                </a>
                                <!-- END Header Controler !-->
                                <div class="view-heading">
                                    Chat List
                                    <div class="fs-11">Show All</div>
                                </div>
                                <!-- BEGIN Header Controler !-->
                                <a href="#" class="action p-r-10 pull-right link text-color">
                                    <i class="pg-icon">more_horizontal</i>
                                </a>
                                <!-- END Header Controler !-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END QUICKVIEW-->
    <!-- START OVERLAY -->
    <!-- END OVERLAY -->

    <!-- BEGIN VENDOR JS -->
    <script src="<?php echo e(asset('assets/plugins/pace/pace.min.js')); ?>" type="text/javascript"></script>
    <!--  A polyfill for browsers that don't support ligatures: remove liga.js if not needed-->
    <script src="<?php echo e(asset('assets/plugins/liga.js')); ?>" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/modernizr.custom.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-ui/jquery-ui.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/popper/umd/popper.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap/js/bootstrap.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery/jquery-easy.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-unveil/jquery.unveil.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-ios-list/jquery.ioslist.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-actual/jquery.actual.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js')); ?>"></script>
    <?php echo $__env->yieldContent('javascript'); ?>
    <!-- END VENDOR JS -->
    <!-- BEGIN CORE TEMPLATE JS -->
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="<?php echo e(asset('pages/js/pages.js')); ?>"></script>
    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="<?php echo e(asset('assets/js/scripts.js')); ?>" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->
    <!-- END CORE TEMPLATE JS -->

</body>

</html>
<?php /**PATH D:\College\SKRIPSI\App\human-resource-management-system-fe\resources\views/dashboard/partials/app.blade.php ENDPATH**/ ?>