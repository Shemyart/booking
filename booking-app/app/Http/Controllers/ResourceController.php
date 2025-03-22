<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceRequest;
use App\Http\Resources\BookingResource;
use App\Http\Resources\ResourceResource;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Interfaces\ResourceRepositoryInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
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
    #[ResponseField('data', ResourceCollection::class, required: true)]
    public function index(): ResourceCollection
    {
        $resources = $this->resourceRepository->all();

        return ResourceResource::collection($resources);
    }

    #[Group('Основные страницы')]
    #[BodyParam('name', 'string', 'Название ресурса', required: true)]
    #[BodyParam('type', 'string', 'Тип ресурса', required: true)]
    #[BodyParam('description', 'string', 'Описание ресурса', required: true)]
    #[ResponseField('data', ResourceResource::class, required: true)]
    public function store(ResourceRequest $request): ResourceResource
    {
        $params = $request->validated();

        $resource = $this->resourceRepository->store($params);

        return new ResourceResource($resource);
    }

    #[Group('Основные страницы')]
    #[UrlParam('id', 'integer', 'ID ресурса', required: true)]
    #[ResponseField('data', ResourceCollection::class, required: true)]
    public function bookings($id): ResourceCollection
    {
        $resource = $this->resourceRepository->getById($id);
        return BookingResource::collection($resource->bookings);
    }

}
