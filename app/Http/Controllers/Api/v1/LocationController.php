<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Location\StoreLocationRequest;
use App\Http\Requests\Location\UpdateLocationRequest;
use App\Http\Resources\LocationsResource;
use App\Models\Location;
use App\Repository\ILocationRepository;
use App\Traits\HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class LocationController extends Controller
{
    use HttpResponse;

    private $locationRepository;

    public function __construct(ILocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LocationsResource::collection(
            $this->locationRepository->all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocationRequest $request)
    {
        $request->validated($request->all());

        $location = $this->locationRepository->create([
            'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'mobile_number' => $request->mobile_number,
        ]);

        return $this->success(new LocationsResource($location), null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        $location = $this->locationRepository->findById($location->id);

        if (is_null($location)) {
            return $this->error(null, 'Location Not Found', Response::HTTP_NOT_FOUND);
        }

        return $this->success(new LocationsResource($location));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocationRequest  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationRequest $request,Location $location)
    {
        $request->validated($request->all());

        $location = $this->locationRepository->findById($location->id);

        if (is_null($location)) {
            return $this->error(null, 'Location Not Found', Response::HTTP_NOT_FOUND);
        }

        $location->name = is_null($request->name) ? $location->name : $request->name;
        $location->address = is_null($request->address) ? $location->address : $request->address;
        $location->phone_number = is_null($request->phone_number) ? $location->phone_number : $request->phone_number;
        $location->mobile_number = is_null($request->mobile_number) ? $location->mobile_number : $request->mobile_number;

        $result = $this->locationRepository->update($location->id, $location->toArray());

        if (is_null($result)) {
            return $this->error(null, 'Failed');
        }

        return $this->success($location->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy($location_id)
    {
        $location = $this->locationRepository->findById($location_id);

        if (is_null($location)) {
            return $this->error(null, 'Location Not Found', Response::HTTP_NOT_FOUND);
        }

        $location->delete();

        return $this->success(null, 'Location Deleted Successfully', Response::HTTP_NO_CONTENT);
    }
}
