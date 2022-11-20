/* INPUT APPLICATIONS */
const input = document.querySelectorAll("input");

input.forEach((fields) => {
  // APLICA O STYLE DOS INPUTS
  if (fields.value.length > 0) {
    fields.classList.add('input-user-ativo');
    fields.parentNode.querySelector('label').classList.add('label-user-ativo');
  }

  fields.addEventListener('blur', () => {
    if (fields.value != '') {
      fields.classList.add('input-user-ativo');
      fields.parentNode.querySelector('label').classList.add('label-user-ativo');
    } else {
      fields.classList.remove('input-user-ativo');
      fields.parentNode.querySelector('label').classList.remove('label-user-ativo');
    }
  });

  // VERIFICA OS CAMPOS EMAIL E PASSWORD E SO ATRIBUI OS ERROS
  if (fields.type == 'email' || fields.type == 'password') {
    fields.addEventListener('keyup', (x) => {
      let field = x.target;

      if (!field.validity.valid) {
        let tipo = field.type == 'email' ? 'Email inválido!' : 'Digite no minimo 5 caracteres';
        field.parentNode.querySelector('span').innerHTML = tipo;
        field.addEventListener('invalid', e => e.preventDefault());
      } else {
        field.parentNode.querySelector('span').innerHTML = "";
      }
    });
  }
});

/* ANIMAÇÃO DO ALERT */
setTimeout(() => {
  // document.querySelector("div.alert").style.opacity = "0";
}, 5001);

// /* DARK THEME */
console.log(window.matchMedia('(prefers-color-scheme: dark)'));