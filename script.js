const container = document.getElementById("container");
const registerBtn = document.getElementById("register");
const loginBtn = document.getElementById("login");

registerBtn.addEventListener("click", () => {
  container.classList.add("active");
  container.classList.add("right-panel-active");
});

loginBtn.addEventListener("click", () => {
  container.classList.remove("active");
  container.classList.remove("right-panel-active");
});
