<?php

namespace App\Http\Controllers;

use App\Http\Requests\Web\RoomRequest;
use App\Models\Categories;
use App\Models\Rooms;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RoomController extends Controller
{

    public function index()
    {
        $rooms = Rooms::with('category')->orderByDesc('created_at')->paginate(10);
        return view('rooms.index',compact('rooms'));
    }

    public function create()
    {
        $category = Categories::all();
        return view('rooms.create', compact('category'));
    }

    public function store(RoomRequest $request)
    {
        try {
            Rooms::create($request->validated());
        } catch (QueryException $queryException) {
            return redirect()->back()->with('error',$queryException->getMessage());
        } catch (\HttpException $httpException) {
            return redirect()->back()->with('error',$httpException->getMessage());
        }
        return redirect()
            ->route('rooms.index')
            ->with('success','Berhasil ditambahkan');
    }

    public function edit(Rooms $room)
    {
        if(!$room->exists) {
            abort(404, 'Room tidak ditemukan');
        }
        $room->load('category');
        $category = Categories::all();
        return view('rooms.edit',compact('room','category'));
    }

    public function update(RoomRequest $request, Rooms $room)
    {
        try {
            $data = Arr::except($request->validated(),'room_id');
            $room->update($data);
        } catch (QueryException $queryException) {
            return redirect()->back()->with('error',$queryException->getMessage());
        } catch (\HttpException $httpException) {
            return redirect()->back()->with('error',$httpException->getMessage());
        }
        return redirect()
            ->back()
            ->with('success','Berhasil diubah');
    }

    public function destroy(Rooms $room)
    {
        try {
            if ($room->delete()) {
                return redirect()->back()->with('success','Berhasil dihapus');
            }
        } catch (QueryException $queryException) {
            return redirect()->back()->with('error',$queryException->getMessage());
        } catch (\HttpException $httpException) {
            return redirect()->back()->with('error',$httpException->getMessage());
        }
    }
}
