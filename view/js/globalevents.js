function cambiarIdioma(lang) {
  // lang = lang || localStorage.getItem('app-lang') || 'en';
  // localStorage.setItem('app-lang', lang);
  $.ajax({
    type: 'GET',
    dataType: 'JSON',
    url: 'view/lang/'+ lang + '.json',
  }).done(function (jsonLang) {
    var elems = document.querySelectorAll('[data-tr]');
    for (var x = 0; x < elems.length; x++) {
      elems[x].innerHTML = jsonLang[elems[x].getAttribute('data-tr')];
    }
  })
}
$(document).ready(function () {
  $('#translate-bt span').on('click', function () {
    cambiarIdioma(this.getAttribute('id'));
  })
});
