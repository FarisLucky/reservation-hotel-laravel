<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateRoomRequest;
use App\Http\Requests\Api\CreateRoomRequest;
use App\Http\Resources\APICollection;
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

    public function store(CreateRoomRequest $request)
    {
        $room = Reservation::create($request->input('data.attributes'));
        return (new APIResource($room))
            ->response()
            ->header('Location', route('rooms.show', ['rooms' => $room]));
    }

    public function show(Rooms $room)
    {
		if(!$room->exists()){
			throw new ModelNotFoundException();
		}
		return new APIResource($room);
    }

    public function update(UpdateRoomRequest $request, Rooms $room)
    {
        $room->update($request->input('data.attributes'));
        return new APIResource($room);
    }

    public function destroy(Rooms $room)
    {
        $room->delete();
        return response(null, 204);
    }
}
