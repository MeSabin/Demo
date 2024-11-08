@extends('admin.dashboard.layout')
@section('pageName')
    Roles and Permissions
@endsection
@section('content')
    <div class="shadow-md py-10 my-10 px-6 w-1/2">
        @if (isset($update))
            <form action="{{ route('roles.update', $role->id) }}" method="post">
                @method('PUT')
            @else
                <form action="{{ route('roles.store') }}" method="post">
        @endif
        @csrf
        <div class="flex flex-col mb-4">
            <label for="">Role Type:</label>
            @if (isset($update))
                <input type="text" name="name" class="border border-gray-600 rounded-md px-2 py-1"
                    value="{{ $role->name }}">
            @else
                <input type="text" name="name" class="border border-gray-600 rounded-md px-2 py-1"
                    value="{{ old('name') }}">
            @endif
            <span class="text-red-600">
                @error('name')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <div class="flex flex-col items-start gap-2">
            <label for="">Permissions:</label>
            @if (isset($update))
                @php
                    $rolePermissions = $role->permissions()->pluck('permissions.id')->toArray();
                @endphp
            @endif

            @foreach ($groupedPermissions as $key => $group)
                <h4 class="text-gray-700 font-bold mt-4">{{ $key }}</h4>

                @foreach ($group as $permission)
                    <div class="flex flex-row gap-1">
                        <div>
                            <input type="checkbox" name="permissions[]" id="checkbox-{{ $permission->id }}"
                                value="{{ $permission->id }}"
                                @if (isset($update)) @checked(in_array($permission->id, $rolePermissions)) @endif>
                        </div>
                        <div>
                            <label for="checkbox-{{ $permission->id }}">{{ $permission->title }}</label>
                        </div>
                    </div>
                @endforeach
            @endforeach
            <span class="text-red-600">
                @error('permissions')
                    {{ $message }}
                @enderror
            </span>
        </div>
        @if (isset($update))
            <button type="submit"
                class="bg-green-500 hover:bg-green-600 duration-200 py-1 px-2 rounded-md text-white w-full">Update</button>
        @else
            <button type="submit"
                class="bg-green-500 hover:bg-green-600 duration-200 py-1 px-2 rounded-md text-white w-full">Assign</button>
        @endif

        </form>
    </div>
@endsection
