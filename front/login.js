document.getElementById("loginForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const email = document.getElementById("email").value;

  
  if (email === "admin@finca.com") {
    alert("Bienvenido administrador");
    window.location.href = "admin.html";
  } else {
    alert("Bienvenido vecino");
    window.location.href = "home.html";
  }
});
