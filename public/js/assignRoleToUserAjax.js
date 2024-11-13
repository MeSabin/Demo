$(document).ready(function() {
   $(document).on('change', '.user-role', function() {
       if (confirm('Do you really want to assign this role?')) {


           let user_id = $(this).data('user-id');
           let role_id = $(this).val();
           let role = this;

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
                   setTimeout(()=>{
                       $('#user-role-assign').html('');
                   },3000)
               },
               error: function(error) {
                   console.log('Something error while storing the data through ajax');
               }
           });
       }
   });

});