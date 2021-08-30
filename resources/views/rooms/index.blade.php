@extends('layouts.app')
@section('title','Rooms')
@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> {{__('Rooms')}}</h1>
                <p>{{__('List All Rooms')}}</p>
            </div>
            @include('component.breadcrumb')
        </div>
        @if(session('error'))
            <span type="hidden" id="status" data-value="{{session('error')}}" data-status="danger">
        @endif
        @if(session('success'))
            <span type="hidden" id="status" data-value="{{session('success')}}" data-status="success">
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-title-w-btn">
                        <h3 class="title">All Rooms</h3>
                        <p>
                            <a class="btn btn-primary icon-btn" href="{{ route('rooms.create') }}"><i class="fa fa-plus"></i>
                                Add Room
                            </a>
                        </p>
                    </div>
                    <div class="tile-body">
                        @include('component.search')
                        <table class="table table-responsive table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Room Number</th>
                                <th>Category</th>
                                <th width="50%">Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                            $i = ($rooms->currentPage()-1) * $rooms->perPage() +1;
                            @endphp
                            @foreach($rooms as $room)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{$room->room_number}}</td>
                                    <td>{{$room->category->category_name}}</td>
                                    <td>{{$room->description}}</td>
                                    <td>
                                        <a href="{{ route('rooms.show',$room->room_id) }}" class="btn btn-info">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('rooms.destroy',$room->room_id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                    $i++
                                @endphp
                            @endforeach
                            </tbody>
                        </table>web
                    </div>
                    <div class="tile-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                {{$rooms->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
