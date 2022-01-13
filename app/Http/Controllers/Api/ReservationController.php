<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateReservationRequest;
use App\Http\Requests\Api\CreateReservationRequest;
use App\Http\Resources\APICollection;
use App\Http\Resources\APIResource;
use App\Models\Reservation;
use Spatie\QueryBuilder\QueryBuilder;

class ReservationController extends Controller
{

    public function index()
    {
        $reservations = QueryBuilder::for(new Reservation())
            ->allowedSorts('reservation_room')
            ->jsonPaginate();
        return new APICollection($reservations);
    }

    public function store(CreateReservationRequest $request)
    {
         $reservation = Reservation::create($request->input('data.attributes'));
         return (new APIResource($reservation))
             ->response()
             ->header('Location', route('reservations.show', ['reservation' => $reservation]));
    }

    public function show(Reservation $reservation)
    {
        return new APIResource($reservation);
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $reservation->update($request->input('data.attributes'));
        return new APIResource($reservation);
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response(null, 204);
    }
}
