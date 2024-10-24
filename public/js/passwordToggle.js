
let password =  document.querySelector('#password');
let eye = document.querySelector('#eye');

eye.onclick = function() {
  if(password.type =='password'){
      password.type = 'text';
      eye.src = 'images/view.png';

  }
  else{
      password.type = 'password';
      eye.src = 'images/hide.png';
  }
}
