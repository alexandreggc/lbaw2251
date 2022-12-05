// admin-panel/home
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})


function showProduct(){
  const img = document.querySelector('#edit_form .form-select option:checked');
  document.getElementById('productImg').setAttribute('src', img.dataset.img);
  console.log(img.dataset.img);
  console.log(document.getElementById('productImg'));
}
