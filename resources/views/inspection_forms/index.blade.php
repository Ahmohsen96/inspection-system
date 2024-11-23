<!-- resources/views/inspection_forms/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Inspection Forms</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Raw Material</th>
                <th>Inspection Type</th>
                <th>Manager Name</th>
                <th>Store Name</th>
                <th>Quality Inspector Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($inspectionForms as $form)
                <tr>
                    <td>{{ $form->id }}</td>
                    <td>{{ $form->rawMaterial->supplier_name ?? 'N/A' }}</td>
                    <td>{{ $form->inspectionType->name ?? 'N/A' }}</td>
                    <td>{{ $form->manager_name }}</td>
                    <td>{{ $form->store_name }}</td>
                    <td>{{ $form->quality_inspector_name }}</td>
                    <td>
                        <a href="{{ route('inspection_forms.show', $form->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('inspection_forms.edit', $form->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('inspection_forms.destroy', $form->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No Inspection Forms Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
