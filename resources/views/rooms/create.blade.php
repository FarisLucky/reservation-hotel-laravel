@extends('layouts.app')
@section('title')
    Create Room
@endsection

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> {{__('Create Room')}}</h1>
                <p>{{__('Create a room')}}</p>
            </div>
            @include('component.breadcrumb')
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <form action="{{ route('rooms.store') }}" method="post">
                        @csrf
                        @if(session('error'))
                            <span type="hidden" id="status" data-value="{{session('error')}}" data-status="danger">
                        @endif
                        <div class="d-flex justify-content-between mb-3">
                            <h3 class="tile-title mb-0">Form Room</h3>
                            <a href="{{route('rooms.index')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Back</a>
                        </div>
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label">Room number</label>
                                <input class="form-control @error('room_number') is-invalid @enderror" type="text" name="{{ __('room_number') }}" placeholder="Enter Room number" value="{{ old('room_number') }}">
                                @error('room_number')
                                <div class="form-control-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label">Category</label>
                                <select name="{{ __('category_id') }}" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="">-- Choose Category --</option>
                                    @foreach($category as $c)
                                    <option value="{{ $c->category_id }}" {{ old('category_id') == $c->category_id ? 'selected' : '' }}>
                                        {{ $c->category_name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('cateogry_id')
                                <div class="form-control-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" rows="4" name="{{ __('description') }}" placeholder="Enter your Description">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                            <div class="form-control-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="tile-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>&nbsp;&nbsp;&nbsp;
                            <button class="btn btn-secondary" type="reset"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('javascript')
    <script type="text/javascript" src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script>
        $('#category_id').select2();
    </script>
@endsection
