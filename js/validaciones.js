//const form = document.querySelector(".register");
var res1,res2,res3,res4,res5,res6,res7,res8,res9;
var expSoloLetras = "^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]+$";
var expSoloEmail =
  /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/;
var expPassFuerte =
  /(?=(.*[0-9]))(?=.*[\!@#$%^&*()\\[\]{}\-_+=|:;"'<>,./?])(?=.*[a-z])(?=(.*[A-Z]))(?=(.*)).{8,}/;
var expSoloNumeros = /^\d*$/;

function validar() {
  if (
    res1 == false ||
    res2 == false ||
    res3 == false ||
    res4 == false ||
    res5 == false ||
    res6 == false ||
    res7 == false ||
    res8 == false ||
    res9 == false
  ) {
    return false;
  } else {
    return true;
  }
}
//Letras
function soloLetras(e) {
  e =  document.getElementById(e);
  if (e.value.match(expSoloLetras) == null) {
    e.classList.add("invalid");
    res1 = false;
    //validar(res1, res2, res3, res4, res5, res6);
  } else {
    e.classList.remove("invalid");
    res1 = true;
    //validar(res1, res2, res3, res4, res5, res6);
  }
}
function soloLetras2(e) {
  e = document.getElementById(e);
  if (e.value.match(expSoloLetras) == null) {
    e.classList.add("invalid");
    res2 = false;
    //validar(res1, res2, res3, res4, res5, res6);
  } else {
    e.classList.remove("invalid");
    res2 = true;
    //validar(res1, res2, res3, res4, res5, res6);
  }
}
//Email
function soloEmail(e) {
  e = document.getElementById(e);
  if (e.value.match(expSoloEmail) == null) {
    e.classList.add("invalid");
    res3 = false;
    //validar(res1, res2, res3, res4, res5, res6);
  } else {
    e.classList.remove("invalid");
    res3 = true;
    //validar(res1, res2, res3, res4, res5, res6);
  }
}
function soloEmail2(e) {
  e = document.getElementById(e);
  if (e.value.match(expSoloEmail) == null) {
    e.classList.add("invalid");
    res4 = false;
    //validar(res1, res2, res3, res4, res5, res6);
  } else {
    e.classList.remove("invalid");
    res4 = true;
    //validar(res1, res2, res3, res4, res5, res6);
  }
}

//Pass
function passFuerte(e) {
  e = document.getElementById(e);
  if (e.value.match(expPassFuerte) == null) {
    e.classList.add("invalid");
    res5 = false;
    //validar(res1, res2, res3, res4, res5, res6);
  } else {
    e.classList.remove("invalid");
    res5 = true;
    //validar(res1, res2, res3, res4, res5, res6);
  }
}
function passFuerte2(e) {
  e = document.getElementById(e);
  if (e.value.match(expPassFuerte) == null) {
    e.classList.add("invalid");
    res6 = false;
    //validar(res1, res2, res3, res4, res5, res6);
  } else {
    e.classList.remove("invalid");
    res6 = true;
    //validar(res1, res2, res3, res4, res5, res6);
  }
}

//Numeros
function soloNumeros(e) {
    e =  document.getElementById(e);
    console.log("numeros:" + e.value.length);
    if (e.value.match(expSoloNumeros) == null || e.value.length != 8) {
      e.classList.add("invalid");
      res7 = false;
    } else {
      e.classList.remove("invalid");
      res7 = true;
    }
  }

//Telefono 10 digitos
function soloTelefono(e){
  e =  document.getElementById(e);
  if (e.value.match(expSoloNumeros) == null || e.value.length != 10){
    e.classList.add("invalid");
    res8 = false;
  } else {
    e.classList.remove("invalid");
    res8 = true;
  }
}
//Validar Grupo
function validarGrupo(e){
  e =  document.getElementById(e);
  if (e.value.match(expSoloNumeros) == null || e.value < 101 || e.value > 699){ 
      e.classList.add("invalid");
      res9 = false;
 } else {
    e.classList.remove("invalid");
    res9 = true;
  }
}

/*function soloLetras(valor) {
  var ExpRegSoloLetras = "^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]+$";
  var id = valor;
  var campo = document.getElementById(id);
  var contenido = campo.value;
  var nombre = "#" + id;
  if (contenido.match(ExpRegSoloLetras) == null) {
    $(nombre).addClass("invalid");
    letras = false;
  } else {
    $(nombre).removeClass("invalid");
    letras = true;
  }
}

function soloEmail(valor) {
  var ExpRegSoloEmail =
    /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/;
  var id = valor;
  var campo = document.getElementById(id);
  var contenido = campo.value;
  var nombre = "#" + id;
  if (contenido.match(ExpRegSoloEmail) == null) {
    $(nombre).addClass("invalid");
    email = false;
  } else {
    $(nombre).removeClass("invalid");
    email = true;
  }
}
function passFuerte(valor) {
  var ExpRegPassFuerte =
  /(?=(.*[0-9]))(?=.*[\!@#$%^&*()\\[\]{}\-_+=|:;"'<>,./?])(?=.*[a-z])(?=(.*[A-Z]))(?=(.*)).{8,}/;
  var id = valor;
  var campo = document.getElementById(id);
  var contenido = campo.value;
  var nombre = "#" + id;
  if (contenido.match(ExpRegPassFuerte) == null) {
    $(nombre).addClass("invalid");
    pass = false;
  } else {
    $(nombre).removeClass("invalid");
    pass = true;
  }
}

form.addEventListener('submit', (event) => {
    if(letras == false || email == false || pass == false){
        event.preventDefault();
    }
  });*/
