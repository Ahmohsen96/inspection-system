<!-- resources/views/raw_materials/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Raw Materials</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Material Name</th>
                    <th>Supplier</th>
                    <th>Received Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rawMaterials as $rawMaterial)
                    <tr>
                        <td>{{ $rawMaterial->name }}</td>
                        <td>{{ $rawMaterial->supplier_name }}</td>
                        <td>{{ $rawMaterial->received_date }}</td>
                        <td>
                            <a href="{{ route('raw-material.show', $rawMaterial->id) }}" class="btn btn-primary">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
