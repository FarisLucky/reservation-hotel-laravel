<?php

namespace App\Http\Controllers;

use App\Http\Requests\Web\RoomRequest;
use App\Models\Categories;
use App\Models\Rooms;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
