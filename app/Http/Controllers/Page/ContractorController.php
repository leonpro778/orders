<?php


namespace App\Http\Controllers\Page;


use App\Http\Controllers\Controller;
use App\Models\Contractor;
use App\Models\RecordStatus;
use Illuminate\Http\Request;

class ContractorController extends Controller
{
    public function contractorsList()
    {
        $data = [
            'contractors' => Contractor::getContractorsList()
        ];
        return view('operator.contractors')->with($data);
    }

    public function addContractor(Request $request)
    {
        $contractor = Contractor::create(array_merge($request->all(), ['status' => RecordStatus::ACTIVE]));
        return redirect()->to('contractors')->with(['success' => __('auth.contractors_new_contractor_added')]);
    }

    public function editContractor($id)
    {
        $data = [
            'contractor' => Contractor::findorfail($id)
        ];
        return view('operator.contractor_edit')->with($data);
    }

    public function updateContractor(Request $request, $id)
    {
        $contractor = Contractor::findorfail($id);
        $contractor->fill($request->all());
        $contractor->save();
        return redirect()->to('contractors')->with(['success' => __('auth.contractors_contractor_updated')]);
    }

    public function deleteContractor($id)
    {
        Contractor::deleteContractor($id);
        return redirect()->to('contractors')->with(['success' => __('auth.contractors_contractor_removed')]);
    }
}
