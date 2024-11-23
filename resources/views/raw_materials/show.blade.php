<!-- resources/views/raw_materials/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Raw Material Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Material Name: {{ $rawMaterial->name }}</h5>
                <p><strong>Supplier:</strong> {{ $rawMaterial->supplier_name }}</p>
                <p><strong>Received Date:</strong> {{ $rawMaterial->received_date }}</p>
                <p><strong>Description:</strong> {{ $rawMaterial->description }}</p>

                <!-- Add Non-Conformities Section -->
                <h3>Non-Conformities</h3>
                <ul>
                    @foreach($rawMaterial->nonConformities as $nonConformity)
                        <li>
                            <strong>{{ $nonConformity->non_conformity_type }}:</strong>
                            {{ $nonConformity->description }}
                            (Status: {{ $nonConformity->status }})
                        </li>
                    @endforeach
                </ul>

                <h4>Add Non-Conformity</h4>
                <form action="{{ route('raw-material.storeNonConformity', $rawMaterial->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="non_conformity_type">Type</label>
                        <input type="text" class="form-control" id="non_conformity_type" name="non_conformity_type" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Non-Conformity</button>
                </form>

                <a href="{{ route('raw-material.index') }}" class="btn btn-primary">Back to Raw Materials</a>
            </div>
        </div>
    </div>
@endsection
