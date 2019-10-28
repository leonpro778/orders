<?php


namespace App\Http\Controllers\Page;


use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\RecordStatus;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function buildingsList()
    {
        $data = [
            'buildings' => Building::getBuildingsList()
        ];
        return view('operator.buildings')->with($data);
    }

    public function addBuilding(Request $request)
    {
        Building::create(['name' => $request->name, 'code' => $request->code, 'status' => RecordStatus::ACTIVE]);
        return redirect()->to('buildings');
    }

    public function updateBuilding(Request $request, $building_id)
    {
        $building = Building::find($building_id);
        $building->update(['name' => $request->name, 'code' => $request->code]);
        return redirect()->to('buildings')->with(['success' => __('auth.buildings_building_updated')]);
    }

    public function deleteBuilding($building_id)
    {
        Building::deleteBuilding($building_id);
        return redirect()->to('buildings');
    }
}
