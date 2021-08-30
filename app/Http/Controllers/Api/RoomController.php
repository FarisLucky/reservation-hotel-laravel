<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateRoomRequest;
use App\Http\Resources\Api\APICollection;
use App\Http\Resources\APIResource;
use App\Models\Reservation;
use App\Models\Rooms;
use Spatie\QueryBuilder\QueryBuilder;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = QueryBuilder::for(new Rooms())
            ->allowedSorts('rooms_number')
            ->jsonPaginate();
        return new APICollection($rooms);
    }

    public function store(UpdateRoomRequest $request)
    {
        $room = Reservation::create($request->input('data.attributes'));
        return (new APIResource($room))
            ->response()
            ->header('Location', route('rooms.show', ['rooms' => $room]));
    }

    public function show(Rooms $rooms)
    {
        return new APIResource($rooms);
    }

    public function update(UpdateRoomRequest $request, Rooms $rooms)
    {
        $rooms->update($request->input('data.attributes'));
        return new APIResource($rooms);
    }

    public function destroy(Rooms $rooms)
    {
        $rooms->delete();
        return response(null, 204);
    }
}
