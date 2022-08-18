function removerTelefoneAdicional(elemento) {
  elemento.closest(".phone-input").remove();
}

$(function () {
  // código para adicionar/remover números de telefone

  $(".btn-add-phone").click(function () {
    cancelarbtn.disabled = false;
    if (document.getElementById("del_tel").style.display != "none") {
      $("#del_tel").toggle();
    }
    // if (document.getElementById("tel").style.display != "none") {
    //   $("#tel").toggle();
    // }

    var index = $(".phone-input").length;
    var num = "'(00) 0000-00009'";
    $(".telefone").append(
      "" +
        '<div class="phone-input">' +
        '<input type="tel" name="phone' +
        index +
        'number" placeholder="(00) 0000-00000" class="adicional" onkeypress="$(this).mask(' +
        num +
        ')"/ onkeyup="verificarTelefone(this)">' +
        '<button class="btn btn-danger btn-remove-phone btn-info" type="button" onclick="removerTelefoneAdicional(this)"><i class="gg-remove remove"></button>' +
        "</div>"
    );
  });

  $(".btn-del-phone").click(function () {
    cancelarbtn.disabled = false;

    document.querySelectorAll(".numeros").forEach((num) => {
      num.style.display != "none"
        ? (num.style.display = "none")
        : (num.style.display = "initial");
    });
    $(".btn-add-phone").toggle();
    $(".btn-del-phone").toggle();
    document.querySelectorAll(".numeros").forEach((num) => {
      $(".telefone").append(
        "" +
          '<div class="exclusao_tel">' +
          '<div class="del_num" id="del_tel' +
          '" name="del_tel' +
          '">' +
          num.innerHTML +
          '<span class="-btn">' +
          '<button class="btn btn-danger btn-remove-phone btn-info" type="button" onclick="deletar_tel(this)" id="del_telbtn' +
          '"><i class="gg-remove remove"></i></button>' +
          "</div>" +
          "</span>" +
          "<br>" +
          "</div>"
      );
    });
  });
});

function deletar_tel(tel) {
  let elemento = document.getElementById(tel.id.replace("btn", ""));
  if (elemento.style.opacity != "0.5") {
    elemento.style.opacity = "0.5";
    salvarbtn.disabled = false;
  } else {
    elemento.style.opacity = "1";
    salvarbtn.disabled = true;
  }
}
function verificarTelefone(input) {
  if (input.value.length == 15) {
    input.classList.remove("vermei");
    salvarbtn.disabled = false;
  } else {
    input.classList.add("vermei");
    salvarbtn.disabled = true;
  }
}

function verificar_input() {
  // se ouver entrada nos inputs, o botão de salvar é liberado

  let lista = document.getElementsByClassName("adicional");
  let tel_input = false;

  for (let i = 0; i < lista.length; i++) {
    // impede que o usuário salve o telefone adicionado sem que o mesmo esteja completo, com 15 dígitos
    if (lista[i].value.length < 15) {
      tel_input = false;
      lista[i].classList.add("vermei");
      document.getElementById("salvarbtn").disabled = true;
      break;
    } else {
      document.getElementById("salvarbtn").disabled = false;
      lista[i].classList.remove("vermei");
      tel_input = true;
    }
  }

  let deletar = false;
  let ranks = document.getElementsByClassName("del_num");

  if (document.getElementsByClassName("exclusao_tel")[0]) {
    for (let i = 0; i < ranks.length; i++) {
      if (ranks[i].style.opacity == "0.5") {
        deletar = true;
      }
    }
  }
}
