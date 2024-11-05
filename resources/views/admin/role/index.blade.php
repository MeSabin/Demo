@extends('admin.dashboard.layout')
@section('pageName')
    Roles and Permissions
@endsection
@section('content')
    @if (session('create_roles_perm'))
        <x-alert>
            <div id="alert"
                class="bg-white absolute right-5 top-5 z-50 py-3 px-6 rounded-md border-2 border-green-500 flex flex-row items-center ">
                <img src="{{ asset('images/check-mark.png') }}" alt="Image not found" class="w-8">
                <p class="text-green-500 font-bold">{{ session('create_roles_perm') }}</p>
            </div>
        </x-alert>
    @endif
    <div class="w-full px-10">
        <a href="{{ route('roles.create') }}"
            class="bg-green-500 py-2 text-white hover:bg-green-600 duration-200 px-2 rounded-md">Create Role</a>
        <div>
            <table class="w-full overflow-hidden border border-gray-700 mt-10 rounded-md bg-gray-50">
                <thead class="bg-gray-600 text-white">
                    <tr class="">
                        <th class="text-center py-2">SN</th>
                        <th class="text-center py-2">Role</th>
                        <th class="text-center py-2">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $i = $roles->firstItem();
                    @endphp
                    @foreach ($roles as $role)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center">{{ $role->name }}</td>
                            <td class="text-center">
                                <a href="{{route('roles.edit', $role->id)}}" class="bg-blue-500 text-white px-2 rounded-md mr-2">Edit</a>
                                <a href="" class="bg-red-600 text-white px-2 rounded-md"
                                    onclick="deleteRoles({{ $role->id }});" id="role-{{ $role->id }}">Delete</a>
                                <form action="" method="post" id="role-{{ $role->id }}">
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-gray-500 mt-8">
                showing <strong>{{ $roles->firstItem() }}</strong> to <strong>{{ $roles->lastItem() }} </strong> of
                <strong>{{ $roles->total() }}</strong> entries
                {{ $roles->links() }}
            </div>
        </div>
    </div>
    <script>
        function deleteRoles(id) {
            if (confirm('Do you really want to delete this?')) {
                document.querySelector('role-' + id).submit();
            }
        }
    </script>
@endsection
