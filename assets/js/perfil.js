/* ANIMAÇÃO DO ALERT */
setTimeout(()=>{
  document.querySelector("div.alert-perfil").style.opacity = "0";
}, 5001);

/* MUDA O ANO DO COPYRIGHT */
const ano_i = document.querySelector('i.ano');
let ano = new Date().getFullYear();
ano_i.innerHTML = ano;

/* RESPONSIVE MENU */
const menu = document.querySelector('.header-menu');

menu.addEventListener('click', () => {
  menu.classList.toggle('rotate');
  document.querySelector('.header-container').classList.toggle('show-navbar');
});