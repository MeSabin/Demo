window.addEventListener('load', function() {
   let profile = document.querySelector('#profile');
   let profileModal = document.querySelector('#profile_modal');

   profile.onclick = function() {
       if (profileModal.style.display == 'block') {
           profileModal.style.display = 'none';
       } else {
           profileModal.style.display = 'block';
       }
   }
});