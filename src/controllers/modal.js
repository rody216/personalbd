// Obtener elementos del DOM
const modal = document.getElementById("ventanaModal");
const modalBtn = document.getElementById("abrirModal");
const closeBtn = document.getElementsByClassName("cerrar")[0];
const guardarBtn = document.getElementById("guardarBtn");

// Abrir el modal al hacer clic en el botón
modalBtn.onclick = function () {
  modal.style.display = "block";
};

// Cerrar el modal al hacer clic en la 'x'
closeBtn.onclick = function () {
  modal.style.display = "none";
};

// Cerrar el modal al hacer clic fuera del contenido
window.onclick = function (event) {
  if (event.target === modal) {
    modal.style.display = "none";
  }
};

// Función para guardar los datos ingresados
guardarBtn.onclick = function () {
  const continente = document.getElementById("continente").value;
  const pais = document.getElementById("pais").value;
  const ciudad = document.getElementById("ciudad").value;

  // Aquí puedes hacer lo que desees con los datos ingresados,
  // por ejemplo, enviarlos a un servidor o procesarlos en JavaScript.
  console.log("Continente:", continente);
  console.log("País:", pais);
  console.log("Ciudad:", ciudad);

  // Cerrar el modal después de guardar los datos
  modal.style.display = "none";
};