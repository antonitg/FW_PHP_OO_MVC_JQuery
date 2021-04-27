function register() {
  console.log("register");
  if (registervalidate()) {
    friendlyURL('?page=logreg&op=register').then(function (data) {
      ajaxPromise(data, 'POST', '', { fullname:$("#regfullname").val(),username:$("#regusername").val(),email:$("#regemail").val(),passwd:$("#regpasswd").val() }).then(function (jsonSearch) {
        console.log(jsonSearch);
      alertify.warning(jsonSearch);
    }).catch(function () {
      alertify.error('That username dont exist, you can register now or log in with an existent account.');  });
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
    friendlyURL('?page=logreg&op=login').then(function (data) {
      ajaxPromise(data, 'POST', 'JSON', { username: $("#logusername").val(),passwd:$("#logpasswd").val() }).then(function (jsonSearch) {
        console.log(jsonSearch);

      if (jsonSearch[2] === undefined){
        if (jsonSearch[1] == "warning"){
          alertify.warning(jsonSearch[0]);
        }
        console.log("bad"+jsonSearch[2]);
      } else {
        console.log("well"+jsonSearch[2]);
        alertify.warning(jsonSearch[0]);
        localStorage.setItem("token",jsonSearch[1]);
      window.location.href = window.location.pathname.replace("logreg",jsonSearch[2]);
      // console.log(window.location.pathname.replace("logreg",jsonSearch[2]));  
    }
    }).catch(function () {
      alertify.error('That username dont exist, you can register now or log in with an existent account.');  });
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
      login();
    }
  });
  $(document).on("keyup", ".formreg", function (tecla) {
    if (tecla.keyCode == 13) {
      register();
    }
  });
});
