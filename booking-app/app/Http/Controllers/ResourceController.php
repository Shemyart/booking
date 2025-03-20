<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceRequest;
use App\Http\Resources\BookingResource;
use App\Http\Resources\ResourceResource;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Interfaces\ResourceRepositoryInterface;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\ResponseField;

class ResourceController extends Controller
{
    public function __construct(
        protected BookingRepositoryInterface  $bookingRepository,
        protected ResourceRepositoryInterface $resourceRepository,
    )
    {
    }

    #[Group('Основные страницы')]
    #[ResponseField('data', ResourceResource::class, required: true)]
    public function index()
    {
        $resources = $this->resourceRepository->all();

        return ResourceResource::collection($resources);
    }

    #[Group('Основные страницы')]
    #[ResponseField('data', ResourceResource::class, required: true)]
    public function store(ResourceRequest $request)
    {
        $params = $request->validated();

        $resource = $this->resourceRepository->store($params);

        return new ResourceResource($resource);
    }

    #[Group('Основные страницы')]
    #[ResponseField('data', BookingResource::class, required: true)]
    public function bookings($id)
    {
        $resource = $this->resourceRepository->getById($id);
        return BookingResource::collection($resource->bookings);
    }

}
