<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inspection Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hidden-section {
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .visible-section {
            display: block;
            opacity: 1;
        }

        .form-section {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .btn-next {
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Inspection Form</h2>
    {{-- <form method="POST" action="{{ route('inspection_forms.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Section 1: Inspection Type -->
        <div id="inspection-type-section" class="form-section visible-section">
            <h3>Choose Inspection Type</h3>
            <select name="inspection_type_id" class="form-select" required>
                @foreach($inspectionTypes as $inspectionType)
                    <option value="{{ $inspectionType->id }}">{{ $inspectionType->name }}</option>
                @endforeach
            </select>
            <button type="button" class="btn btn-primary btn-next" onclick="showNextSection('inspection-type-section', 'material-section')">Next</button>
        </div>

        <!-- Section 2: Material Details -->
        <div id="material-section" class="form-section hidden-section">
            <h3>Enter Material Details</h3>
            <input type="text" name="material_name" class="form-control mb-3" placeholder="Material Name" required>
            <input type="text" name="material_size" class="form-control mb-3" placeholder="Material Size" required>
            <button type="button" class="btn btn-primary btn-next" onclick="showNextSection('material-section', 'tolerance-section')">Next</button>
        </div>

        <!-- Section 3: Tolerance Check -->
        <div id="tolerance-section" class="form-section hidden-section">
            <h3>Check Tolerances</h3>
            <input type="text" name="length_tolerance" class="form-control mb-3" placeholder="Length Tolerance" required>
            <input type="text" name="width_tolerance" class="form-control mb-3" placeholder="Width Tolerance" required>
            <input type="text" name="thickness_tolerance" class="form-control mb-3" placeholder="Thickness Tolerance" required>
            <button type="button" class="btn btn-primary btn-next" onclick="showNextSection('tolerance-section', 'non-conformity-section')">Next</button>
        </div>

        <!-- Section 4: Non-Conformities -->
        <div id="non-conformity-section" class="form-section hidden-section">
            <h3>Non-Conformities</h3>
            <textarea name="non_conformities" class="form-control mb-3" placeholder="Describe Non-Conformities (if any)"></textarea>
            <button type="button" class="btn btn-primary btn-next" onclick="showNextSection('non-conformity-section', 'signature-section')">Next</button>
        </div>

        <!-- Section 5: Signatures -->
        <div id="signature-section" class="form-section hidden-section">
            <h3>Signatures</h3>
            <input type="text" name="manager_name" class="form-control mb-3" placeholder="Manager's Name" required>
            <input type="text" name="store_name" class="form-control mb-3" placeholder="Store Name" required>
            <input type="text" name="quality_inspector_name" class="form-control mb-3" placeholder="Quality Inspector Name" required>
            <input type="date" name="inspection_date" class="form-control mb-3" required>
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form> --}}
    <form method="POST" action="{{ route('inspection_forms.store') }}">
        @csrf
        <!-- Inspection Type -->
        <select name="inspection_type_id" required>
            <option value="">Select Inspection Type</option>
            @foreach ($inspectionTypes as $inspectionType)
                <option value="{{ $inspectionType->id }}">{{ $inspectionType->name }}</option>
            @endforeach
        </select>

        <!-- Material Details -->
        <input type="text" name="material_name" placeholder="Material Name" required>
        <input type="text" name="material_size" placeholder="Material Size" required>

        <!-- Tolerance Details -->
        <input type="text" name="length_tolerance" placeholder="Length Tolerance" required>
        <input type="text" name="width_tolerance" placeholder="Width Tolerance" required>
        <input type="text" name="thickness_tolerance" placeholder="Thickness Tolerance" required>

        <!-- Non-Conformities -->
        <textarea name="non_conformities" placeholder="Non Conformities"></textarea>

        <!-- Signatures -->
        <input type="text" name="manager_name" placeholder="Manager Name" required>
        <input type="text" name="store_name" placeholder="Store Name" required>
        <input type="text" name="quality_inspector_name" placeholder="Quality Inspector Name" required>

        <!-- Submit Button -->
        <button type="submit">Submit</button>
    </form>

</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function showNextSection(currentSection, nextSection) {
        const current = document.getElementById(currentSection);
        const next = document.getElementById(nextSection);

        current.classList.remove('visible-section');
        current.classList.add('hidden-section');

        setTimeout(() => {
            next.classList.remove('hidden-section');
            next.classList.add('visible-section');
        }, 500); // Delay for smooth transition
    }
</script>
</body>
</html>
