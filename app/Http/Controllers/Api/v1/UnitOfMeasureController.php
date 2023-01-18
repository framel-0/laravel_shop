<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitOfMeasure\StoreUnitOfMeasureRequest;
use App\Http\Requests\UnitOfMeasure\UpdateUnitOfMeasureRequest;
use App\Http\Resources\UnitOfMeasuresResource;
use App\Models\UnitOfMeasure;
use App\Repository\IUnitOfMeasureRepository;
use App\Traits\HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class UnitOfMeasureController extends Controller
{
    use HttpResponse;

    private $unitOfMeasureRepository;

    public function __construct(IUnitOfMeasureRepository $unitOfMeasureRepository)
    {
        $this->unitOfMeasureRepository = $unitOfMeasureRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UnitOfMeasuresResource::collection(
            $this->unitOfMeasureRepository->all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUnitOfMeasureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnitOfMeasureRequest $request)
    {
        $request->validated($request->all());

        $unitOfMeasure = $this->unitOfMeasureRepository->create([
            'description' => $request->description,
        ]);

        return $this->success(new UnitOfMeasuresResource($unitOfMeasure), null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnitOfMeasure  $unitOfMeasure
     * @return \Illuminate\Http\Response
     */
    public function show(UnitOfMeasure $unitOfMeasure)
    {
        $unitOfMeasure = $this->unitOfMeasureRepository->findById($unitOfMeasure->id);

        if (is_null($unitOfMeasure)) {
            return $this->error(null, 'Unit Of Measure Not Found', Response::HTTP_NOT_FOUND);
        }

        return $this->success(new UnitOfMeasuresResource($unitOfMeasure));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUnitOfMeasureRequest  $request
     * @param  \App\Models\UnitOfMeasure  $unitOfMeasure
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnitOfMeasureRequest $request,UnitOfMeasure $unitOfMeasure)
    {
        $request->validated($request->all());

        $unitOfMeasure = $this->unitOfMeasureRepository->findById($unitOfMeasure->id);

        if (is_null($unitOfMeasure)) {
            return $this->error(null, 'Unit Of Measure Not Found', Response::HTTP_NOT_FOUND);
        }

        $unitOfMeasure->description = is_null($request->description) ? $unitOfMeasure->description : $request->description;

        $result = $this->unitOfMeasureRepository->update($unitOfMeasure->id, $unitOfMeasure->toArray());

        if (is_null($result)) {
            return $this->error(null, 'Failed');
        }

        return $this->success($unitOfMeasure->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnitOfMeasure  $unitOfMeasure
     * @return \Illuminate\Http\Response
     */
    public function destroy($unitOfMeasure_id)
    {
        $unitOfMeasure = $this->unitOfMeasureRepository->findById($unitOfMeasure_id);

        if (is_null($unitOfMeasure)) {
            return $this->error(null, 'Unit Of Measure Not Found', Response::HTTP_NOT_FOUND);
        }

        $unitOfMeasure->delete();

        return $this->success(null, 'UnitOfMeasure Deleted Successfully', Response::HTTP_NO_CONTENT);
    }
}
