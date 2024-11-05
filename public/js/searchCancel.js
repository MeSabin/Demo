
let searchBar = document.querySelector('#search_bar');
let cancelIcon = document.querySelector('#cancel');

searchBar.oninput = function(){
    cancelIcon.style.display = 'block';
}
if(searchBar.value){
    cancelIcon.style.display ='block';
}
