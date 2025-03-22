<?php

namespace App\Http\Controllers;

use App\Exceptions\BookingException;
use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingResource;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Interfaces\ResourceRepositoryInterface;
use App\Services\BookingService;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Resources\Json\ResourceCollection;
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
    #[ResponseField('data', ResourceCollection::class, required: true)]
    public function index(): ResourceCollection
    {
        $bookings = $this->bookingRepository->all();

        return BookingResource::collection($bookings);
    }

    #[Group('Основные страницы')]
    #[BodyParam('resource_id', 'integer', 'ID бронируемого ресурса', required: true)]
    #[BodyParam('user_id', 'integer', 'ID бронирующего пользователя', required: true)]
    #[BodyParam('start_time', 'string', 'Дата и время начала бронирования в формате Y-m-d H:i:s', required: true, example: '2025-03-25 10:00:00')]
    #[BodyParam('end_time', 'string', 'Дата и время окончания бронирования в формате Y-m-d H:i:s', required: true, example: '2025-03-25 12:00:00')]
    #[ResponseField('data', BookingResource::class, required: true)]
    public function store(BookingRequest $request): BookingResource|BookingException
    {
        $params = $request->validated();

        $resource = $this->resourceRepository->getById($params['resource_id']);

        $bookingService = new BookingService();
        $checkAvailiable = $bookingService->checkAvailiable($params);

        if(!$checkAvailiable){
            throw new BookingException();
        }
        $booking = $resource->bookings()->create($params);

        return new BookingResource($booking);
    }

    #[Group('Основные страницы')]
    #[UrlParam('id', 'integer', 'ID бронирования', required: true)]
    #[ResponseField('deleted', 'boolean', required: true)]
    public function destroy($id)
    {
        $booking = $this->bookingRepository->destroy($id);

        return response()->json([
            'deleted' => $booking
        ], '200');
    }
}
