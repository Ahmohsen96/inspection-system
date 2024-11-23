<?php
namespace App\Http\Controllers;

use App\Models\NonConformity;
use App\Models\RawMaterial;
use App\Models\RawMaterialDetail;
use App\Models\ToleranceCheck;
use Illuminate\Http\Request;

class RawMaterialController extends Controller
{

    public function index()
    {
        // Get all raw materials (you can adjust this query as needed)
        $rawMaterials = RawMaterial::all();

        // Return a view with raw materials
        return view('raw_materials.index', compact('rawMaterials'));
    }

    public function show($id)
    {
        // Retrieve the raw material based on the ID
        $rawMaterial = RawMaterial::findOrFail($id);

        // Return a view to display the raw material details
        return view('raw_materials.show', compact('rawMaterial'));
    }

    public function storeNonConformity(Request $request, $rawMaterialId)
    {
        $request->validate([
            'non_conformity_type' => 'required|string',
            'description' => 'required|string',
        ]);

        NonConformity::create([
            'raw_material_id' => $rawMaterialId,
            'non_conformity_type' => $request->non_conformity_type,
            'description' => $request->description,
        ]);

        return redirect()->route('raw-material.show', $rawMaterialId);
    }
    // Show the form
    public function create()
    {
        return view('raw_materials.create');
    }

    // Store the form data
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'supplier_name' => 'required|string|max:255',
    //         'po_no'         => 'required|string|max:255',
    //         'po_date'       => 'required|date',
    //         'invoice_number'=> 'nullable|string|max:255',
    //         'received_date' => 'nullable|date',
    //         'ordered_by'    => 'nullable|string|max:255',
    //         'brand_name'    => 'nullable|string|max:255',
    //         'inspection_type'=> 'nullable|string|max:255',
    //         'po_quantity'   => 'nullable|integer',
    //         'remarks'       => 'nullable|string',
    //     ]);

    //     RawMaterial::create($validated);

    //     return redirect()->route('raw-material.create')->with('success', 'Raw Material saved successfully!');
    // }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'supplier_name' => 'required|string|max:255',
    //         'po_no' => 'required|string|max:255',
    //         'po_date' => 'required|date',
    //         // Validate other fields...
    //         'materials.*.material_name' => 'required|string|max:255',
    //         'materials.*.grade' => 'nullable|string|max:255',
    //         'materials.*.quantity' => 'nullable|integer',
    //         'materials.*.status' => 'nullable|in:Checked,Rejected',
    //         'materials.*.remarks' => 'nullable|string',
    //     ]);

    //     // Save the raw material data
    //     $rawMaterial = RawMaterial::create($validated);

    //     // Save the materials
    //     if ($request->has('materials')) {
    //         foreach ($request->materials as $material) {
    //             $rawMaterial->materials()->create($material);
    //         }
    //     }

    //     return redirect()->route('raw-material.create')->with('success', 'Raw material and materials saved successfully!');
    // }

    public function store(Request $request)
{
    $validated = $request->validate([
        'supplier_name' => 'required|string|max:255',
        'po_no' => 'required|string|max:255',
        'po_date' => 'required|date',
        'materials' => 'required|array',
        'materials.*.material_name' => 'required|string|max:255',
        'materials.*.quantity' => 'required|numeric',
        'materials.*.status' => 'required|in:Checked,Rejected',
        'tolerances' => 'required|array',
        'tolerances.*.check_type' => 'required|string|max:255',
        'tolerances.*.length_tolerance' => 'required|string|max:255',
        'tolerances.*.width_tolerance' => 'required|string|max:255',
        'tolerances.*.thickness_tolerance' => 'required|string|max:255',
        'tolerances.*.deformation' => 'required|in:No,Yes',
        'tolerances.*.damage' => 'required|in:No,Yes',
        'tolerances.*.remarks' => 'nullable|string|max:255',
    ]);

    // Store Raw Material
    $rawMaterial = RawMaterial::create([
        'supplier_name' => $validated['supplier_name'],
        'po_no' => $validated['po_no'],
        'po_date' => $validated['po_date'],
    ]);

    // Store Materials
    foreach ($request->materials as $material) {
        RawMaterialDetail::create([
            'raw_material_id' => $rawMaterial->id,
            'material_name' => $material['material_name'],
            'grade' => $material['grade'],
            'quantity' => $material['quantity'],
            'status' => $material['status'],
            'remarks' => $material['remarks'],
        ]);
    }

    // Store Tolerances
    foreach ($request->tolerances as $tolerance) {
        ToleranceCheck::create([
            'raw_material_id' => $rawMaterial->id,
            'check_type' => $tolerance['check_type'],
            'length_tolerance' => $tolerance['length_tolerance'],
            'width_tolerance' => $tolerance['width_tolerance'],
            'thickness_tolerance' => $tolerance['thickness_tolerance'],
            'deformation' => $tolerance['deformation'],
            'damage' => $tolerance['damage'],
            'remarks' => $tolerance['remarks'],
        ]);
    }

    return redirect()->route('raw-material.index')->with('success', 'Raw material created successfully.');
}

}
