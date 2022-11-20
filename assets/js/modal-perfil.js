/* MODAL CONFIRM DELETE */
const openModalButton = document.querySelector("#confirm");
const closeModalButton = document.querySelector("#close");
const redirectModalButton = document.querySelector("#delete");
const modal = document.querySelector("#modal");
const fade = document.querySelector("#fade");

redirectModalButton.addEventListener("click", () =>{
  window.location.href = "./perfil_deletar.php";
});

const toggleModal = () => {
  [modal, fade].forEach((elemento) => elemento.classList.toggle("hide"));
}

[openModalButton, closeModalButton, fade].forEach((elemento) => {
  elemento.addEventListener("click", () => toggleModal());
});