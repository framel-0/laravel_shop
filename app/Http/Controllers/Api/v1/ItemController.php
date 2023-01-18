<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Item\StoreItemRequest;
use App\Http\Requests\Item\UpdateItemRequest;
use App\Http\Resources\ItemsResource;
use App\Traits\HttpResponse;
use App\Models\Item;
use App\Repository\IItemRepository;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends Controller
{
    use HttpResponse;

    private $itemRepository;

    public function __construct(IItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ItemsResource::collection(
            $this->itemRepository->all(['*'], ['category'])
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        $request->validated($request->all());

        $item = $this->itemRepository->create([
            'description' => $request->description,
            'category_id' => $request->category_id,
            'unit_of_measure_id' => $request->unit_of_measure_id,
            'location_id' => $request->location_id,
            'sale_price' => $request->sale_price,
            'cost_price' => $request->cost_price,
            'quantity' => $request->quantity,
        ]);

        return $this->success(new ItemsResource($item), null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        // $item = $this->itemRepository->findById($item_id);

        if (is_null($item)) {
            return $this->error(null, 'Item Not Found', Response::HTTP_NOT_FOUND);
        }

        return $this->success(new ItemsResource($item));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request,Item $item)
    {
        $request->validated($request->all());

        $item = $this->itemRepository->findById($item->id);

        if (is_null($item)) {
            return $this->error([], 'Item Not Found', Response::HTTP_NOT_FOUND);
        }

        $item->description = is_null($request->description) ? $item->description : $request->description;
        $item->category_id = is_null($request->category_id) ? $item->category_id : $request->category_id;
        $item->unit_of_measure_id = is_null($request->unit_of_measure_id) ? $item->unit_of_measure_id : $request->unit_of_measure_id;
        $item->location_id = is_null($request->location_id) ? $item->location_id : $request->location_id;
        $item->sale_price = is_null($request->sale_price) ? $item->sale_price : $request->sale_price;
        $item->cost_price = is_null($request->cost_price) ? $item->cost_price : $request->cost_price;
        $item->quantity = is_null($request->quantity) ? $item->quantity : $request->quantity;

        $result = $this->itemRepository->update($item->id, $item->toArray());

        if (is_null($result)) {
            return $this->error(null, 'Failed', Response::HTTP_NOT_MODIFIED);
        }

        return $this->success($item->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($item_id)
    {
        $item = $this->itemRepository->findById($item_id);

        if (is_null($item)) {
            return $this->error([], 'Item Not Found', Response::HTTP_NOT_FOUND);
        }

        $item->delete();

        return $this->success(null, 'Item Deleted Successfully', Response::HTTP_NO_CONTENT);
    }
}
