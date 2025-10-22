<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->getAll();
        return response()->json($data);
    }

    public function show($id)
    {
        $data = $this->service->getById($id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $created = $this->service->create($data);
        return response()->json($created, 201);
    }

    public function update(Request $request,$id)
    {
        $data = $request->all();
        $updated = $this->service->update($id, $data);
        return response()->json($updated);
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }


}
