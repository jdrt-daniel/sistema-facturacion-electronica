function formSubmit(e) {
  e.preventDefault();

  const loginForm = document.getElementById("loginForm");

  const nickInput = loginForm.elements.nick;
  const claveInput = loginForm.elements.clave;

  const nick = nickInput.value;
  const clave = claveInput.value;

  if (nick && clave) {
    const url = base_url + "login/validar";
    fetch(url, {
      method: "POST",
      body: new FormData(loginForm),
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.status === "error") {
          document.getElementById("alert-error").style.display = "block";
          document.getElementById("alert-error-msg").innerHTML = data.msg;

          nickInput.classList.add("is-invalid");
          claveInput.classList.add("is-invalid");
        } else {
          document.location.href = "/";
        }
      });
  } else {
    if (!nick) nickInput.classList.add("is-invalid");
    if (!clave) claveInput.classList.add("is-invalid");
  }
}
