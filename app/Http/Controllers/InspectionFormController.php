<?php

namespace App\Http\Controllers;

use App\Models\InspectionForm;
use App\Models\InspectionType;
use App\Models\Material;
use App\Models\NonConformity;
use App\Models\RawMaterial;
use App\Models\Signature;
use App\Models\ToleranceCheck;
use Illuminate\Http\Request;

class InspectionFormController extends Controller
{
    //
    public function index()
    {
        // Retrieve data or any processing required for the inspection index page
        $inspectionForms = InspectionForm::all(); // or any query to get inspection forms

        return view('inspection_forms.index', compact('inspectionForms'));
    }
    public function create()
    {
        // Retrieve any necessary data to populate the form
        $rawMaterials = RawMaterial::all(); // Assuming you have a RawMaterial model
        $inspectionTypes = InspectionType::all(); // Assuming you have an InspectionType model

        return view('inspection_forms.create', compact('rawMaterials', 'inspectionTypes'));
    }


    public function store(Request $request)
{
    $validated = $request->validate([
        'inspection_type_id' => 'required|exists:inspection_types,id',
        'material_name' => 'required|string',
        'material_size' => 'required|string',
        'length_tolerance' => 'required|string',
        'width_tolerance' => 'required|string',
        'thickness_tolerance' => 'required|string',
        'non_conformities' => 'nullable|string',
        'manager_name' => 'required|string',
        'store_name' => 'required|string',
        'quality_inspector_name' => 'required|string',
        'inspection_date' => 'required|date',
    ]);

    // dd('Validation Passed', $validated);


    // Create inspection form
    $inspectionForm = InspectionForm::create([
        'inspection_type_id' => $request->input('inspection_type_id'),
        // 'inspection_type_id' => $request->input('inspection_type_id'),
        // 'inspection_type_id' => $request->input('inspection_type_id'),
        // 'inspection_type_id' => $request->input('inspection_type_id'),
        // 'inspection_type_id' => $request->input('inspection_type_id'),
        // 'inspection_type_id' => $request->input('inspection_type_id'),
    ]);

    // Create material entry
    $material = Material::create([
        'inspection_form_id' => $inspectionForm->id,
        'name' => $request->input('material_name'),
        'size' => $request->input('material_size'),
    ]);

    // Create tolerance check
    $toleranceCheck = ToleranceCheck::create([
        'inspection_form_id' => $inspectionForm->id,
        'length_tolerance' => $request->input('length_tolerance'),
        'width_tolerance' => $request->input('width_tolerance'),
        'thickness_tolerance' => $request->input('thickness_tolerance'),
    ]);

    // Create non-conformities if any
    if ($request->input('non_conformities')) {
        NonConformity::create([
            'inspection_form_id' => $inspectionForm->id,
            'description' => $request->input('non_conformities'),
        ]);
    }

    // Create signatures
    Signature::create([
        'inspection_form_id' => $inspectionForm->id,
        'manager_name' => $request->input('manager_name'),
        'store_name' => $request->input('store_name'),
        'quality_inspector_name' => $request->input('quality_inspector_name'),
    ]);

    // Redirect after successful creation
    return redirect()->route('inspection.index')->with('success', 'Inspection Form Created Successfully');
}

}
