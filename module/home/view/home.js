function homeLoadCat() {
    friendlyURL('?page=home&op=homeLoadCat').then(function (data) {
        ajaxPromise(data, 'POST', 'JSON').then(function (jsonSearch) {
            $.each(jsonSearch, function (i, item) {
                var h5def = $('<h5></h5>').append(document.createTextNode(jsonSearch[i]['id']));
                if (i == 0) {
                    $('<li></li>').attr({ 'data-slide-to': i, 'class': 'active', 'data-target': '#carouselExampleCaptions' }).appendTo('.carousel-indicators');
                    $('<div></div>').attr({ "class": "carousel-item active", "id": "1st" + jsonSearch[i]['id'] }).appendTo('#carousel-item-container');
                } else {
                    $('<li></li>').attr({ 'data-slide-to': i, 'class': '', 'data-target': '#carouselExampleCaptions' }).appendTo('.carousel-indicators');
                    $('<div></div>').attr({ "class": "carousel-item", "id": "1st" + jsonSearch[i]['id'] }).appendTo('#carousel-item-container');
                };
                $('<img>').attr({ "src": jsonSearch[i]['src'], "class": "d-block w-100 cat-img", 'id': jsonSearch[i]["id"] }).appendTo('#1st' + jsonSearch[i]['id']);
                $('<div></div>').attr({ "class": "carousel-caption d-none d-md-block", "id": '#2nd' + jsonSearch[i]['id'] }).appendTo('#1st' + jsonSearch[i]['id']).append(h5def);
                //Print Cat buttons
                $('<span></span>').attr({ 'class': 'span-cat-home', "id": "Cat" + jsonSearch[i]['id'] }).appendTo('#cat-btn-container');
                $('<h></h>').attr({ 'class': 'btn-cat-home btn btn-outline-dark btn-lg', 'id': jsonSearch[i]["id"] }).append(document.createTextNode(jsonSearch[i]['id'])).appendTo("#Cat" + jsonSearch[i]['id']);
            });

            //Arrows
            $('<a></a>').attr({ 'class': 'carousel-control-prev', 'href': '#carouselExampleCaptions', 'role': 'button', 'data-slide': 'prev' }).appendTo('#carousel-item-container');
            $('<span></span>').attr({ 'class': 'carousel-control-prev-icon', 'aria-hidden': 'true' }).appendTo('.carousel-control-prev');
            $('<span></span>').attr({ 'class': 'sr-only' }).append(document.createTextNode('Previous')).appendTo('.carousel-control-prev');
            $('<a></a>').attr({ 'class': 'carousel-control-next', 'href': '#carouselExampleCaptions', 'role': 'button', 'data-slide': 'next' }).appendTo('#carousel-item-container');
            $('<span></span>').attr({ 'class': 'carousel-control-next-icon', 'aria-hidden': 'true' }).appendTo('.carousel-control-next');
            $('<span></span>').attr({ 'class': 'sr-only' }).append(document.createTextNode('Next')).appendTo('.carousel-control-next');
            //Event Listeners
            //Category Buttons
            $('.btn-cat-home').on('click', function () {
                redirect_shop('search', this.getAttribute('id'));

            });
            //Category Images
            $('.cat-img').on('click', function () {
                redirect_shop('search', this.getAttribute('id'));
            });
        }).catch(function () {
            console.log('Fail when trying to get the information.');
        });
    });
}
function homeLoadSliderProd() {
    friendlyURL('?page=home&op=homeLoadSliderProd').then(function (data) {
        console.log("Dins de load slider friendly");
        ajaxPromise(data, 'POST', 'JSON').then(function (jsonSearch) {
            console.log("Dins de load slider promiseaaa " + jsonSearch);
            var owl = $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            });
            $.each(jsonSearch, function (i, item) {
                owl.trigger('add.owl.carousel', [jQuery('<div id="' + jsonSearch[i]["registration"] + '" class="item"><h4>' + jsonSearch[i]["brand"] + '  ' + jsonSearch[i]["model"] + '</h4> <img src="' + jsonSearch[i]["src"] + '" class="user-image"></div>')]);
            });
            //OWL trigger to refresh the carousel content
            owl.trigger('refresh.owl.carousel');
            //Event Listeners
            //Single Car
            $('.item').on('click', function () {
                redirect_shop('details', this.getAttribute('id'));
            }); 
        }).catch(function () {
            console.log('Fail when trying to get the information.');
        });
    });
    $("#owlcarousel").owlCarousel({
        navigation: true,
        pagination: true,
        slideSpeed: 1000,
        stopOnHover: true,
        autoPlay: true,
        items: 5,
        itemsDesktopSmall: [1024, 3],
        itemsTablet: [600, 1],
        itemsMobile: [479, 1]
    });
};
function redirect_shop(op, value) {
    localStorage.setItem("op", op);
    localStorage.setItem("value", value);
    window.location.href = "index.php?page=shop&op=list";

}
$(document).ready(function () {
    localStorage.removeItem("op");
    localStorage.removeItem("value");
    // load_randprods();
    // load_cat_carousel();
    homeLoadCat();
    homeLoadSliderProd();

});
