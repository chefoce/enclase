const togglePassword = document.querySelector("#togglePassword");
const togglePassword2 = document.querySelector("#togglePassword2");
const password = document.querySelector("#password");
const rePassword = document.querySelector("#rePassword");

togglePassword.addEventListener("click", function () {
    // toggle the type attribute
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    
    // toggle the icon
    this.classList.toggle("fa-eye-slash");
    this.classList.toggle("fa-eye");
});

togglePassword2.addEventListener("click", function () {
    // toggle the type attribute
    const type2 = rePassword.getAttribute("type") === "password" ? "text" : "password";
    rePassword.setAttribute("type", type2);
    
    // toggle the icon
    this.classList.toggle("fa-eye-slash");
    this.classList.toggle("fa-eye");
});

