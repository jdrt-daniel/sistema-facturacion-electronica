document.addEventListener("DOMContentLoaded", function () {});

function showModal() {
  const myModal = document.getElementById("myModal");
  const myInput = document.getElementById("myInput");

  myModal.addEventListener("shown.bs.modal", () => {
    myInput.focus();
  });

  myModal.show();
}
