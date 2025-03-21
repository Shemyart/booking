<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingResource;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Interfaces\ResourceRepositoryInterface;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\ResponseField;

class BookingController
{
    public function __construct(
        protected BookingRepositoryInterface  $bookingRepository,
        protected ResourceRepositoryInterface $resourceRepository,
    )
    {
    }
    #[Group('Основные страницы')]
    #[Endpoint('GET api/v1/bookings')]
    #[ResponseField('data', BookingResource::class, required: true)]
    public function index()
    {
        $bookings = $this->bookingRepository->all();

        return BookingResource::collection($bookings);
    }

    #[Group('Основные страницы')]
    #[ResponseField('data', BookingResource::class, required: true)]
    public function store(BookingRequest $request)
    {
        $params = $request->validated();

        $resource = $this->resourceRepository->getById($params['resource_id']);

        $booking = $resource->bookings()->create($params);

        return new BookingResource($booking);
    }

    #[Group('Основные страницы')]
    public function destroy($id)
    {
        $this->bookingRepository->destroy($id);

        return response()->noContent();
    }
}
