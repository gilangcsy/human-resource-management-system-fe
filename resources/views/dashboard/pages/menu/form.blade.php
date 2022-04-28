@extends('dashboard.partials.app')

@section('title', 'Menu')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Menu</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">{{ $menu->id != '' ? 'Edit' : 'Add' }} Menu</h2>
            <p class="section-lead">
                You can {{ $menu->id != '' ? 'edit' : 'add' }} new menu here.
            </p>

            <form action="{{ $menu->id == '' ? route('menu.store') : route('menu.update', $menu->id) }}"
                method="POST" class="needs-validation" novalidate="">
                @csrf
                @if ($menu->id != '')
                    @method('patch')
                @endif
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name"
                                        value="{{ $menu->name != '' ? $menu->name : '' }}" class="form-control"
                                        autocomplete="off" required>
                                    <div class="invalid-feedback">Please fill in the name</div>
                                    @if($errors->has('name'))
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>URL</label>
                                    <input type="text" name="url"
                                        value="{{ $menu->url != '' ? $menu->url : '' }}" class="form-control"
                                        autocomplete="off">
                                    <div class="invalid-feedback">Please fill in the url</div>
                                    @if($errors->has('url'))
                                        <div class="text-danger">{{ $errors->first('url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Icon</label>
                                    <input type="text" name="icon"
                                        value="{{ $menu->icon != '' ? $menu->icon : '' }}" class="form-control"
                                        autocomplete="off">
                                    <div class="invalid-feedback">Please fill in the icon</div>
                                    @if($errors->has('icon'))
                                        <div class="text-danger">{{ $errors->first('icon') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Master Menu</label>
                                    <select class="form-control select2" name="master_menu" id="master_menu" {{ $menu->id != '' ? 'disabled' : '' }}>
                                        <option value="0" {{ $menu->master_menu == 0 ? 'selected' : '' }}>Master Menu</option>
                                        @foreach ($master_menu as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $menu->master_menu ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary">
                            {{ $menu->id != '' ? 'Update' : 'Save' }}
                        </button>
                        <a href="{{ URL::previous() }}" class="btn btn-primary">
                            Back
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/page/forms-advanced-forms.js') }}"></script>

@endsection


@push('active.menu')
    active
@endpush
