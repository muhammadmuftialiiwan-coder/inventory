<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ItemService;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Controllers\Api\BaseController;

class ItemController extends BaseController
{
    protected ItemService $svc;

    public function __construct(ItemService $svc)
    {
        $this->svc = $svc;
    }

    public function index(Request $request)
    {
        return $this->success(
            $this->svc->all(
                $request->category_id
            ),
            'Berhasil menarik semua data Item'
        );
    }

    public function store(StoreItemRequest $req)
    {
        $item = $this->svc->create($req->validated());

        return $this->success(
            $item,
            'Item berhasil dibuat',
            201
        );
    }

    public function show(int $id)
    {
        try {

            $item = $this->svc->find($id);

            return $this->success(
                $item,
                'Berhasil menarik satu data Item'
            );

        } catch (\Exception $e) {

            return $this->error(
                $e->getMessage(),
                404
            );
        }
    }

    public function update(UpdateItemRequest $req, $id)
    {
        $item = $this->svc->update(
            $id,
            $req->validated()
        );

        return $this->success(
            $item,
            'Item berhasil diperbarui'
        );
    }

    public function destroy($id)
    {
        $this->svc->delete($id);

        return $this->success(
            null,
            'Item berhasil dihapus'
        );
    }
}