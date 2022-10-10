@extends('dashboard.partials.app')

@section('title', 'News')

@section('css')
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/dropzone/css/dropzone.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet" type="text/css"
        media="screen">
    <link href="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet"
        type="text/css" media="screen">
    <link href="{{ asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet"
        type="text/css" media="screen">
    <link href="{{ asset('assets/css/wysiwyg.scss') }}" rel="stylesheet" type="text/css">
@endsection

@section('page-content')
    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper ">
        <!-- START PAGE CONTENT -->
        <div class="content ">
            <!-- START JUMBOTRON -->
            <div class="jumbotron" data-pages="parallax">
                <div class=" container-fluid   container-fixed-lg sm-p-l-0 sm-p-r-0">
                    <div class="inner">
                        <!-- START BREADCRUMB -->
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">News</a></li>
                            <li class="breadcrumb-item active">{{ $news->id != '' ? 'Edit' : 'Create' }}</li>
                        </ol>
                        <!-- END BREADCRUMB -->
                    </div>
                </div>
            </div>
            <!-- END JUMBOTRON -->
            <!-- START CONTAINER FLUID -->
            <div class="container-fluid container-fixed-lg">
                <!-- BEGIN PlACE PAGE CONTENT HERE -->

                <!-- START card -->
                <div class="card card-default">
                    <div class="card-body">
                        <form method="POST" action="{{ $news->id == '' ? route('news.store') : route('news.update', $news->id) }}" enctype="multipart/form-data">
                            @csrf
                            @if ($news->id != '')
                                @method('patch')
                            @endif
                            <div class="form-group form-group-default required">
                                <label>Title</label>
                                <input type="text" value="{{ old('title', $news->title) }}" name="title"
                                    class="form-control" required>
                            </div>
                            
                            <div class="form-group form-group-default">
                                <label for="content">Content</label>
                                <textarea name="content" class="form-control">{{ $news->content }}</textarea>
                            </div>
                            
                            <div class="form-group">
                                <label>Thumbnail</label>
                                <input type="file" accept="image/png,jpeg,jpg" name="thumbnail" class="form-control"
                                    multiple>
                            </div>

                            @if ($news->id != '')
                                <img src="{{ $urlStorage . '/images/news/' . $news->thumbnail }}" alt="thumbnail" class="img-thumbnail" width="120">
                            @endif

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ $news->id != '' ? 'Update' : 'Save' }}
                                </button>
                                <a href="{{ URL::previous() }}" class="btn btn-primary">
                                    Back
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END card -->
                <!-- END PLACE PAGE CONTENT HERE -->
            </div>
            <!-- END CONTAINER FLUID -->
        </div>
        <!-- END PAGE CONTENT -->
        <!-- START COPYRIGHT -->
        <!-- START CONTAINER FLUID -->
        @include('dashboard.partials.footer')
    </div>
    <!-- END PAGE CONTENT WRAPPER -->
@endsection

@section('javascript')

    <!-- BEGIN VENDOR JS -->
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/classie/classie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/jquery-autonumeric/autoNumeric.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/jquery-inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-form-wizard/js/jquery.bootstrap.wizard.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-typehead/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-typehead/typeahead.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/handlebars/handlebars-v4.0.5.js') }}"></script>
    <script src="{{ asset('assets/js/form_elements.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/wysiwyg.js') }}" type="text/javascript"></script>

    <script>
        
        $('#editor').wysiwyg({
  toolbar: [
    ['mode'],
    ['operations', ['undo', 'rendo', 'cut', 'copy', 'paste']],
    ['styles'],
    ['fonts', ['select', 'size']],
    ['text', ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'font-color', 'bg-color']],
    ['align', ['left', 'center', 'right', 'justify']],
    ['lists', ['unordered', 'ordered', 'indent', 'outdent']],
    ['components', ['table', /*'chart'*/]],
    ['intervals', ['line-height', 'letter-spacing']],
    ['insert', ['emoji', 'link', 'image', '<a href="https://www.jqueryscript.net/tags.php?/video/">video</a>', 'symbol', /*'bookmark'*/]],
    ['special', ['print', 'unformat', 'visual', 'clean']],
    /*['fullscreen'],*/
  ],
});
    </script>


    <!-- END VENDOR JS -->

    @if (Session::has('error'))
        <script>
            $(document).ready(function() {
                // Simple notification having bootstrap's .alert class
                $('.page-content-wrapper').pgNotification({
                    style: 'bar',
                    message: '{{ Session::get('status') }}',
                    position: 'top',
                    timeout: 4000,
                    type: 'danger'
                }).show();
            });
        </script>
    @endif
@endsection
