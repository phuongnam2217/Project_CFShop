<?php

namespace App\Http\Controllers;

use App\Models\ImportResource;
use App\Models\Resource;
use App\Models\Unit;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index() {
        $resources = Resource::all();
        $importResources = ImportResource::paginate(10);
        $units = Unit::all();
        return view('managers.resources.resource', compact('resources','importResources','units'));
    }

    public function store(Request $request) {
        $resource = new Resource;

        $resource->name = $request->input('name');
        $resource->unit_id = $request->unit_id;
        $resource->note = $request->note;

        $resource->save();

        $resources = Resource::all();
        $html = view('managers.resources.resource-table-form',compact('resources'))->render();
        return response()->json(['view'=>$html]);
    }

    public function delete($id) {
        $resource = Resource::findOrFail($id);
        $resource->delete();

        $resources = Resource::all();
        $html = view('managers.resources.resource-table-form',compact('resources'))->render();
        return response()->json(['view'=>$html]);
    }

    public function addResource(Request $request) {
        $importResource = new ImportResource;

        $importResource->resource_id = $request->resource_id;
        $importResource->unit_price = $request->unit_price;
        $importResource->quantity   = $request->quantity;
        $importResource->total_buy  = $request->unit_price*$request->quantity;
        $importResource->note       = $request->note;

        $importResource->save();

        $importResources = ImportResource::all();
        $html = view('managers.resources.importResource-table-form', compact('importResources'))->render();
        return response()->json(['view'=>$html]);
    }

    public function deleteResource($id) {
        $importResoure = ImportResource::findOrFail($id);
        $importResoure->delete();

        $importResources = ImportResource::all();
        $html = view('managers.resources.importResource-table-form', compact('importResources'))->render();
        return response()->json(['view'=>$html]);
    }

    public function search(Request $request) {
        $search = $request->input('search');
        $importResources = ImportResource::where('id','like', '%'.$search.'%')->paginate(10);

        $html = view('managers.resources.importResource-table-form', compact('importResources'))->render();
        return response()->json(['view'=>$html]);
    }
}
