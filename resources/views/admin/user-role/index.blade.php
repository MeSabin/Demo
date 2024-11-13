@extends('admin.dashboard.layout')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@section('pageName')
    User Role
@endsection
@section('content')
    <div class="w-full px-10">
        <p class="text-green-600 text-xl text-center font-bold rounded-md py-2 px-1" id="user-role-assign"></p>
        <table class="overflow-hidden bg-gray-100  rounded-md w-full">
            <thead class="bg-gray-600 text-white">
                <tr>
                    <th class="text-center py-2">SN</th>
                    <th class="text-center py-2">User</th>
                    <th class="text-center py-2">Role</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = $users->firstItem();
                @endphp
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-200 duration-200">
                        <td class="text-center py-2">{{ $i++ }}</td>
                        <td class="text-center py-2">{{ $user->name }}</td>
                        <td class="text-center py-2">
                            <select name="role" id="" class="border border-gray-800 rounded-md user-role"
                                data-user-id ="{{ $user->id }}">
                                @if ($user->userRole == null)
                                    <option value="">Select Role</option>
                                @endif
                                @php
                                    $default_user = '';
                                @endphp
                                @foreach ($roles as $role)
                                    @if ($user->userRole == null)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @else
                                        <option value="{{ $role->id }}" class="role-id" @selected($user->userRole->role->id === $role->id)>
                                            {{ $role->name }}</option>
                                    @endif
                                @endforeach


                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-gray-500 mt-8 flex items-center justify-between">
            <div>
                showing <strong>{{ $users->firstItem() }}</strong> to <strong>{{ $users->lastItem() }} </strong> of
                <strong>{{ $users->total() }}</strong> entries
            </div>
            {{ $users->links() }}
        </div>
    </div>

    {{-- <script src="{{ asset('js/assignRoleToUserAjax.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            $(document).on('change', '.user-role', function() {
                if (confirm('Do you really want to assign this role?')) {


                    let user_id = $(this).data('user-id');
                    let role_id = $(this).val();
                    // let role = this;

                    console.log('User id:' + user_id);
                    console.log('Role id:' + role_id);
                    $.ajax({
                        url: "{{ route('user_role.store') }}",
                        type: "post",
                        dataType: "json",
                        data: {
                            _token: "{{ csrf_token() }}",
                            user_id: user_id,
                            role_id: role_id
                        },

                        success: function(response) {
                            console.log('data properly fetched')
                            console.log(response.message);
                            $('#user-role-assign').html(response.message);
                            setTimeout(() => {
                                $('#user-role-assign').html('');
                            }, 3000)
                        },
                        error: function(error) {
                            console.log('Something error while storing the data through ajax');
                        }
                    });
                }
            });

        });
    </script>
@endsection
