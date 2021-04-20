function register() {
  if (registervalidate()) {
    $.ajax({
      type: 'GET',
      // dataType: 'JSON',
      url: 'module/logreg/controller/controller_logreg.php?op=register&fullname=' + $("#regfullname").val() + "&username=" + $("#regusername").val() + "&email=" + $("#regemail").val() + "&passwd=" + $("#regpasswd").val(),
    }).done(function (jsonSearch) {
      console.log(jsonSearch);
      alertify.warning(jsonSearch);
    }).fail(function (jqXHR, textStatus, errorThrown) {
      alertify.error('Something went wrong in the registration. Try again!');
    });
  }

}
function registervalidate() {
  return true;
}
function logout() {
  localStorage.removeItem("token");
  window.location.href = "index.php?page=logreg";
  alertify.warning("Your session has expired, login again");
}
function login() {
  if (loginvalidate()) {
    $.ajax({
      type: 'GET',
      dataType: 'JSON',
      url: 'module/logreg/controller/controller_logreg.php?op=login&username=' + $("#logusername").val() + "&passwd=" + $("#logpasswd").val(),
    }).done(function (jsonSearch) {
      if (jsonSearch["token"] === undefined){
        alertify.warning(jsonSearch);
        // console.log("bad");
      } else {
        // console.log("well");
        alertify.warning(jsonSearch["message"]);
        localStorage.setItem("token",jsonSearch["token"]);
      window.location.href = jsonSearch["page"];
      }
    }).fail(function (jqXHR, textStatus, errorThrown) {
      alertify.error('That username dont exist, you can register now or log in with an existent account.');
    });
  }
}
function loginvalidate() {
  return true;
}

$(document).on("keyup blur focus", "input, textarea", function (e) {
  // $(".form").find("input, textarea").on("keyup blur focus", function (e) {
  var $this = $(this),
    label = $this.prev("label");

  if (e.type === "keyup") {
    if ($this.val() === "") {
      label.removeClass("active highlight");
    } else {
      label.addClass("active highlight");
    }
  } else if (e.type === "blur") {
    if ($this.val() === "") {
      label.removeClass("active highlight");
    } else {
      label.removeClass("highlight");
    }
  } else if (e.type === "focus") {
    if ($this.val() === "") {
      label.removeClass("highlight");
    } else if ($this.val() !== "") {
      label.addClass("highlight");
    }
  }
});
$(document).on("click", ".tab a", function (e) {


  e.preventDefault();
  $(this).parent().addClass("active");
  $(this).parent().siblings().removeClass("active");

  target = $(this).attr("href");

  $(".tab-content > div").not(target).hide();

  $(target).fadeIn(600);
});
$(document).ready(function () {
  $(document).on("click", "#logbutton", function () {
      login();
  });
  $(document).on("click", "#regbutton", function () {
    register();
});
  $(document).on("keyup", ".formlog", function (tecla) {
    if (tecla.keyCode == 13) {
      alert("???");
      login();
    }
  });
  $(document).on("keyup", ".formreg", function (tecla) {
    if (tecla.keyCode == 13) {
      register();
    }
  });
});
