<?php


namespace App\Http\Controllers\Page;


use App\Http\Controllers\Controller;
use App\Models\RecordStatus;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function unitsList()
    {
        $data = [
            'units' => Unit::getUnitsList()
        ];
        return view('operator.units')->with($data);
    }

    public function addUnit(Request $request)
    {
        Unit::create(['name' => $request->name, 'status' => RecordStatus::ACTIVE]);
        return redirect()->to('units');
    }

    public function updateUnit(Request $request, $unit_id)
    {
        $unit = Unit::find($unit_id);
        $unit->update(['name' => $request->name]);
        return redirect()->to('units')->with(['success' => __('auth.units_unit_updated')]);
    }

    public function deleteUnit($unit_id)
    {
        Unit::deleteUnit($unit_id);
        return redirect()->to('units');
    }
}
