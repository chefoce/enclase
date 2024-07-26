const togglePassword = document.querySelector("#togglePassword");
const togglePassword2 = document.querySelector("#togglePassword2");
const togglePassword3 = document.querySelector("#togglePassword3");
const passwordAdmin = document.querySelector("#passwordAdmin");
const passwordNuevo = document.querySelector("#passwordNuevo");
const rePasswordNuevo = document.querySelector("#rePasswordNuevo");

togglePassword.addEventListener("click", function () {
    // toggle the type attribute
    const type2 = passwordAdmin.getAttribute("type") === "password" ? "text" : "password";
    passwordAdmin.setAttribute("type", type2);
    
    // toggle the icon
    this.classList.toggle("fa-eye-slash");
    this.classList.toggle("fa-eye");
});

togglePassword2.addEventListener("click", function () {
    // toggle the type attribute
    const type2 = passwordNuevo.getAttribute("type") === "password" ? "text" : "password";
    passwordNuevo.setAttribute("type", type2);
    
    // toggle the icon
    this.classList.toggle("fa-eye-slash");
    this.classList.toggle("fa-eye");
});

togglePassword3.addEventListener("click", function () {
    // toggle the type attribute
    const type2 = rePasswordNuevo.getAttribute("type") === "password" ? "text" : "password";
    rePasswordNuevo.setAttribute("type", type2);
    
    // toggle the icon
    this.classList.toggle("fa-eye-slash");
    this.classList.toggle("fa-eye");
});