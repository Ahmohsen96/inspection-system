@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="text-center">Incoming Raw Material</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('raw-material.store') }}">
        @csrf

        <!-- General Information -->
        <div class="form-group mb-3">
            <label for="supplier_name">Supplier Name</label>
            <input type="text" id="supplier_name" name="supplier_name" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="po_no">P.O. No</label>
            <input type="text" id="po_no" name="po_no" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="po_date">P.O. Date</label>
            <input type="date" id="po_date" name="po_date" class="form-control" required>
        </div>

        <!-- Materials Section -->
        <h4>Materials</h4>
        <table class="table table-bordered" id="materials-table">
            <thead>
                <tr>
                    <th>Material</th>
                    <th>Grade</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="materials[0][material_name]" class="form-control" required></td>
                    <td><input type="text" name="materials[0][grade]" class="form-control"></td>
                    <td><input type="number" name="materials[0][quantity]" class="form-control"></td>
                    <td>
                        <select name="materials[0][status]" class="form-control">
                            <option value="Checked">Checked</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </td>
                    <td><input type="text" name="materials[0][remarks]" class="form-control"></td>
                    <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
                </tr>
            </tbody>
        </table>
        <button type="button" id="add-material" class="btn btn-primary">Add Material</button>

        <!-- Tolerance and Thickness Check Section -->
        <h4 class="mt-4">Tolerance Checks and Quality Control</h4>
        <table class="table table-bordered" id="tolerance-table">
            <thead>
                <tr>
                    <th>Check Type</th>
                    <th>Length Tolerance</th>
                    <th>Width Tolerance</th>
                    <th>Thickness Tolerance</th>
                    <th>Deformation</th>
                    <th>Damage</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="tolerances[0][check_type]" class="form-control" required></td>
                    <td><input type="text" name="tolerances[0][length_tolerance]" class="form-control" required></td>
                    <td><input type="text" name="tolerances[0][width_tolerance]" class="form-control" required></td>
                    <td><input type="text" name="tolerances[0][thickness_tolerance]" class="form-control" required></td>
                    <td>
                        <select name="tolerances[0][deformation]" class="form-control">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
                    </td>
                    <td>
                        <select name="tolerances[0][damage]" class="form-control">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
                    </td>
                    <td><input type="text" name="tolerances[0][remarks]" class="form-control"></td>
                    <td><button type="button" class="btn btn-danger remove-tolerance-row">Remove</button></td>
                </tr>
            </tbody>
        </table>
        <button type="button" id="add-tolerance" class="btn btn-primary">Add Tolerance Check</button>

        <button type="submit" class="btn btn-success mt-4">Submit</button>
    </form>
</div>

<script>
    let rowCount = 1;
    let toleranceRowCount = 1;

    // Materials section: Add a new material row
    document.getElementById('add-material').addEventListener('click', function () {
        const table = document.getElementById('materials-table').querySelector('tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><input type="text" name="materials[${rowCount}][material_name]" class="form-control" required></td>
            <td><input type="text" name="materials[${rowCount}][grade]" class="form-control"></td>
            <td><input type="number" name="materials[${rowCount}][quantity]" class="form-control"></td>
            <td>
                <select name="materials[${rowCount}][status]" class="form-control">
                    <option value="Checked">Checked</option>
                    <option value="Rejected">Rejected</option>
                </select>
            </td>
            <td><input type="text" name="materials[${rowCount}][remarks]" class="form-control"></td>
            <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
        `;
        table.appendChild(newRow);
        rowCount++;
    });

    // Tolerance section: Add a new tolerance row
    document.getElementById('add-tolerance').addEventListener('click', function () {
        const table = document.getElementById('tolerance-table').querySelector('tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><input type="text" name="tolerances[${toleranceRowCount}][check_type]" class="form-control" required></td>
            <td><input type="text" name="tolerances[${toleranceRowCount}][length_tolerance]" class="form-control" required></td>
            <td><input type="text" name="tolerances[${toleranceRowCount}][width_tolerance]" class="form-control" required></td>
            <td><input type="text" name="tolerances[${toleranceRowCount}][thickness_tolerance]" class="form-control" required></td>
            <td>
                <select name="tolerances[${toleranceRowCount}][deformation]" class="form-control">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </td>
            <td>
                <select name="tolerances[${toleranceRowCount}][damage]" class="form-control">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </td>
            <td><input type="text" name="tolerances[${toleranceRowCount}][remarks]" class="form-control"></td>
            <td><button type="button" class="btn btn-danger remove-tolerance-row">Remove</button></td>
        `;
        table.appendChild(newRow);
        toleranceRowCount++;
    });

    // Remove row functionality for materials section
    document.getElementById('materials-table').addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });

    // Remove row functionality for tolerance section
    document.getElementById('tolerance-table').addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-tolerance-row')) {
            e.target.closest('tr').remove();
        }
    });
</script>
@endsection
