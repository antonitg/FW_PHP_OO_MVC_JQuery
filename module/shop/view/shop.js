function load_content(loadurl) {
    // console.log(loadurl);
    $('.pagination').empty();
    $("#books_releated").empty();
    getPaginationValues();

    friendlyURL('?page=shop&op=getFiltersSearch').then(function (data) {
        ajaxPromise(data, 'POST', 'JSON', { objenv: JSON.stringify(loadurl) }).then(function (jsonSearch) {
            console.log(jsonSearch);
            $('#result-content').empty();
            if (Object.keys(jsonSearch).length == 1) {
                details(jsonSearch[0]["registration"]);
            } else {
                $.each(jsonSearch, function (i, item) {
                    var reg = jsonSearch[i]['registration'];
                    $('<div></div>').attr({ 'id': `car_details_card_${reg}`, 'style': 'width: 18rem; flex-basis: 30.333333%; margin-bottom: 20px; background-color: floralwhite', 'class': 'card' }).appendTo('#result-content');
                    $(`#car_details_card_${reg}`).html(function () {
                        $('<img>').attr({ 'class': 'card-img-top', 'src': 'https://www.abc.es/media/peliculas/000/019/042/cars-2.jpg' }).appendTo('#car_details_card_' + reg);
                        $('<div></div>').attr({ 'class': 'card-body', 'id': `card-body_${reg}` }).appendTo('#car_details_card_' + reg);
                        $('<h5></h5>').attr({ 'class': 'card-title' }).append(document.createTextNode(jsonSearch[i]['brand'] + " " + jsonSearch[i]['model'])).appendTo('#card-body_' + reg);
                        $('<p></p>').attr({ 'class': 'card-text' }).append(document.createTextNode("Brand: " + jsonSearch[i]['brand'])).appendTo('#card-body_' + reg);
                        $('<p></p>').attr({ 'class': 'card-text' }).append(document.createTextNode("Registration Date: " + jsonSearch[i]['regdate'])).appendTo('#card-body_' + reg);
                        $('<p></p>').attr({ 'class': 'card-text' }).append(document.createTextNode("Condition: " + jsonSearch[i]['carcondition'])).appendTo('#card-body_' + reg);
                        $('<p></p>').attr({ 'class': 'card-text' }).append(document.createTextNode("Upgrades: " + jsonSearch[i]['upgrades'])).appendTo('#card-body_' + reg);
                        $('<p></p>').attr({ 'class': 'card-text' }).append(document.createTextNode("Price: " + jsonSearch[i]['price'] + " €")).appendTo('#card-body_' + reg);
                        $('<a></a>').attr({ 'class': 'btn btn-primary btn-details', 'id': `${reg}` }).append(document.createTextNode("Buy")).appendTo('#card-body_' + reg);
                        if (jsonSearch[i]['registrationfav'] != null) {
                            $('<i></i>').attr({ 'class': 'fas fa-heart unfav', 'id': `${reg}`, 'style': 'font-size:24px;margin-left:8px;vertical-align: middle; cursor:pointer;' }).appendTo('#card-body_' + reg);
                        } else {
                            $('<i></i>').attr({ 'class': 'far fa-heart unfav', 'id': `${reg}`, 'style': 'font-size:24px;margin-left:8px;vertical-align: middle; cursor:pointer;' }).appendTo('#card-body_' + reg);
                        }
                        $('<i></i>').attr({ 'class': 'fas fa-shopping-basket item-addcart', 'id': `${reg}`, 'style': 'font-size:24px;margin-left:8px;vertical-align: middle; cursor:pointer;' }).appendTo('#card-body_' + reg);
                    });
                });
            }
        }).catch(function (error) {
            console.log('Fail when trying to get the information.');
        });
    });
}
function pagination(url) {
    var showperpage = $("#num_pag_select").val();
    friendlyURL('?page=shop&op=getPagination').then(function (data) {
        ajaxPromise(data, 'POST', 'JSON', { objenv: JSON.stringify(url) }).then(function (jsonSearch) {
            console.log("Dins de pagination");
            if (Object.keys(jsonSearch).length / showperpage - Math.floor(Object.keys(jsonSearch).length / showperpage) == 0) {
                varnumfinal = Object.keys(jsonSearch).length / showperpage;
            } else {
                varnumfinal = (Math.floor(Object.keys(jsonSearch).length / showperpage)) + 1;
            }
            load_pagination(varnumfinal);
        }).catch(function (error) {
            console.log('Fail when trying to get the information.');
        });
    });

}
function load_pagination(numpages) {
    for (let i = 1; i < numpages + 1; i++) {
        $("<li></li>").attr({ "class": "page-item", "id": "index" + i }).appendTo(".pagination");
        $("<p></p>").attr({ "class": "page-link", "id": i }).append(document.createTextNode(i)).appendTo("#index" + i);
    }
}
function no_result(keyword) {
    $('#result-content').empty();
    $('<p></p>').attr({ 'class': 'text-danger h3' }).append(document.createTextNode('No results found for ' + keyword)).appendTo('#result-content');
}
function load_filters() {
    friendlyURL('?page=shop&op=loadFilters').then(function (data) {
        console.log("Dins de load filters friendly");
        ajaxPromise(data, 'POST', 'JSON').then(function (jsonSearch) {
            $.each(jsonSearch, function (i, item) {
                $("<option></option>").attr({ 'value': jsonSearch[i]["brand"] }).append(document.createTextNode(jsonSearch[i]["brand"] + "  " + jsonSearch[i]["num"])).appendTo("#brand_cat");
            });

        }).catch(function () {
            console.log('Fail when trying to get the information.');
        });
    });
}

function details(carid) {
    friendlyURL('?page=shop&op=getDetails').then(function (data) {
        ajaxPromise(data, 'POST', 'JSON', { registration: carid }).then(function (jsonCar) {
            console.log(jsonCar); // Debug
            $('.pagination').empty();
            $('#result-content').empty();
            $('<table></table>').attr({ 'id': 'car_details_table', 'class': 'table table-hover' }).appendTo('#result-content');
            $('#car_details_table').html(function () {
                for (row in jsonCar) {
                    if (row == "srcimg") {
                        $('<tr></tr>').attr({ 'id': row }).appendTo('#car_details_table');
                        $('<td></td>').attr({ 'id': `${row}index`, 'class': 'text-center' }).appendTo('#' + row);
                        $('<img>').attr({ 'id': `${row}content`, 'class': 'text-center', 'src': jsonCar[row] }).appendTo(`#${row}index`);
                    } else {
                        $('<tr></tr>').attr({ 'id': row }).appendTo('#car_details_table');
                        $('<td></td>').attr({ 'id': `${row}index` }).append(document.createTextNode(row)).appendTo('#' + row);
                        $('<td></td>').attr({ 'id': `${row}content` }).append(document.createTextNode(jsonCar[row])).appendTo('#' + row);
                    }
                }
            });
            $('<div></div>').attr({ 'id': 'books_releated' }).appendTo('#result-content');
            $('<button></button>').attr({ 'id': 'showmore', 'class': 'btn btn-info', 'style': 'margin-left: 39%; margin-right: 39%;' }).append(document.createTextNode("More")).appendTo('#result-content');
            load_api_books();
        }).catch(function () {
            console.log('Fail when trying to get the information.');
        });
    });

}
function load_api_books() {
    var offset = $("#books_releated")[0].childElementCount;
    var limit = 3;

    $.ajax({
        type: 'GET',
        dataType: 'JSON',
        url: 'https://www.googleapis.com/books/v1/volumes?q=car&maxResults=40&orderBy=newest',
    }).done(function (jsonCar) {
        console.log(offset, limit);
        console.log(jsonCar);

        for (i = offset; i < offset + limit; i++) {
            console.log(i);
            try {
                var foto = jsonCar.items[i].volumeInfo.imageLinks.thumbnail;
            }
            catch (err) {
                var foto = "http://books.google.com/books/content?id=cr4IyD5l1NQC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api";
            }
            var title = jsonCar.items[i].volumeInfo.title;
            var desc = jsonCar.items[i].volumeInfo.description;
            var link = jsonCar.items[i].volumeInfo.previewLink;
            var pags = jsonCar.items[i].volumeInfo.pageCount;
            $('<div></div>').attr({ 'class': 'Card1', 'id': 'book' + i }).appendTo("#books_releated");
            $('<div></div>').attr({ 'class': 'photo', 'style': 'background-image:url("' + foto + '");' }).appendTo("#book" + i);
            $('<ul></ul>').attr({ 'class': 'details', 'id': 'ulbook' + i }).appendTo("#book" + i);
            $('<h4></h4>').append(document.createTextNode(title)).appendTo('#ulbook' + i);
            $('<div></div>').attr({ 'class': 'description', 'id': 'description' + i }).appendTo('#book' + i);
            $('<div></div>').attr({ 'class': 'line', 'id': 'line' + i }).appendTo('#description' + i);
            $('<h1></h1>').attr({ 'class': 'product_name' }).append(document.createTextNode(title)).appendTo('#line' + i);
            $('<h1></h1>').attr({ 'class': 'product_price' }).append(document.createTextNode(pags + " Pags")).appendTo('#line' + i);
            $('<p></p>').attr({ 'class': 'summary' }).append(document.createTextNode(desc)).appendTo('#description' + i);
            $('<a></a>').attr({ 'href': link }).append(document.createTextNode("Read More")).appendTo('#description' + i);
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        if (console && console.log) {
            console.log("Error name/code: " + textStatus);
        }
    });
}
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: new google.maps.LatLng(37.88, -1.28),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var infowindow = new google.maps.InfoWindow();
    var markers = [];
    navigator.geolocation.getCurrentPosition(
        (position) => {
            const pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
            };
            infowindow.setPosition(pos);
            map.setCenter(pos);
            friendlyURL('?page=shop&op=getMapShop').then(function (data) {
                ajaxPromise(data, 'POST', 'JSON', { lat: pos["lat"], lon: pos["lng"] }).then(function (jsonSearch) {
                    console.log(jsonSearch);
                    $.each(jsonSearch, function (i, item) {
                        var myLatlng = new google.maps.LatLng(jsonSearch[i]["lat"], jsonSearch[i]["lon"]);
                        var newMarker = new google.maps.Marker({
                            position: myLatlng,
                            map,
                            title: "Car near!",
                        });
                        google.maps.event.addListener(newMarker, 'click', (function (newMarker, i) {
                            return function () {
                                infowindow.setContent("<b>" + jsonSearch[i]["brand"] + " " + jsonSearch[i]["model"] + "</b><br>" + jsonSearch[i]["carcondition"] + " " + jsonSearch[i]["price"] + "€" + "<br><img class='mapsimage' id='" + jsonSearch[i]["registration"] + "' style='height:110px;' src='" + jsonSearch[i]["src"] + "' alt='image in infowindow'>");
                                infowindow.open(map, newMarker);
                            }
                        })(newMarker, i));
                        markers.push(newMarker);
                    });
                }).catch(function () {
                    console.log('Fail when trying to get the information.');
                });
            });
        },
        () => {
            console.log(true, infoWindow, map.getCenter());
        }
    );
}
function getPaginationValues() {
    var filkeyword = $("#shop-search").val();
    var filbrand = $("#brand_cat").val();
    var filcondition = $("#condition_cat").val();
    var filmaxprice = $("#max_price").val();
    var filminprice = $("#min_price").val();
    var filshowing = $("#num_pag_select").val();
    var filpage = 1;
    if (filmaxprice == "") {
        filmaxprice = 99999999;
    }
    if (filminprice == "") {
        filminprice = 100;
    }
    var url = { keyword: filkeyword, brand: filbrand, condition: filcondition, minprice: filminprice, maxprice: filmaxprice, showing: filshowing, page: filpage, token: localStorage.getItem("token") };
    pagination(url);
}
function getSearchValues(filpage = 1) {
    var filkeyword = $("#shop-search").val();
    var filbrand = $("#brand_cat").val();
    var filcondition = $("#condition_cat").val();
    var filmaxprice = $("#max_price").val();
    var filminprice = $("#min_price").val();
    var filshowing = $("#num_pag_select").val();

    if (filmaxprice == "") {
        filmaxprice = 99999999;
    }
    if (filminprice == "") {
        filminprice = 100;
    }
    // var url = "keyword=" + keyword + "&brand=" + brand + "&condition=" + condition + "&minprice=" + minprice + "&maxprice=" + maxprice;
    var url = { keyword: filkeyword, brand: filbrand, condition: filcondition, minprice: filminprice, maxprice: filmaxprice, showing: filshowing, page: filpage, token: localStorage.getItem("token") };
    load_content(url);
}
function rmcart(carid) {
    friendlyURL('?page=shop&op=rmItemCart').then(function (data) {
        ajaxPromise(data, 'POST', '', { registration: carid, token: localStorage.getItem("token") }).then(function (jsonCar) {
            // console.log(jsonCar);
            loadcart();
        }).catch(function () {
            // console.log('Fail when trying to get the information.');
        });
    });
}
function addcart(carid) {
    friendlyURL('?page=shop&op=addItemCart').then(function (data) {
        ajaxPromise(data, 'POST', '', { registration: carid, token: localStorage.getItem("token") }).then(function (jsonCar) {
            loadcart();
            // console.log(jsonCar);
        }).catch(function () {
            // console.log('Fail when trying to get the information.');
        });
    });
}
function loadcart() {
    $('.cartul').remove();
    $('.price').empty();
    $('#tbodymodalcart').empty();
    friendlyURL('?page=shop&op=getCart').then(function (data) {
        ajaxPromise(data, 'POST', 'JSON', { token: localStorage.getItem("token") }).then(function (jsonCar) {
            // console.log(jsonCar);
            // Sidebar Cart
            if (jsonCar.length == undefined) {
                jsonCar = [jsonCar]; 
                if (!jsonCar[0].registration) {
                    return; 
                }
            }
            $('<ul></ul>').attr({ 'class': 'list-group cartul' }).appendTo(".sidebar");
            $('<li></li>').attr({ 'class': 'list-group-item active', 'id': 'test' }).append(document.createTextNode("Cart")).appendTo(".cartul");
            $('<span></span>').attr({ 'class': 'badge badge-primary badge-pill', 'style': 'background-color:darkblue;margin-left:8px;' }).append(document.createTextNode(Object.keys(jsonCar).length)).appendTo("#test");

            totalprice = 0;
            $.each(jsonCar, function (i, item) {
                console.log(totalprice);
                totalprice = totalprice + parseInt(jsonCar[i]["cartprice"]);
                $('<li></li>').attr({ 'class': 'list-group-item', 'id': jsonCar[i]["registration"], 'style': 'border: 3px solid #007bff;border-top: 0px;border-bottom: 0px;' }).append('<img src="' + jsonCar[i]["src"] + '" style="width:35%;height:35%;margin-right:8px;">', document.createTextNode(jsonCar[i]["brand"] + " " + jsonCar[i]["model"]), '<i class="fas fa-cart-arrow-down rmcart" id="' + jsonCar[i]["registration"] + '" style="margin-left:8px;font-size:22px;cursor:pointer;"></i>').appendTo(".cartul");
                // Modal Cart
                $('<tr></tr>').attr({ 'id': jsonCar[i]["registration"] + "modaltr" }).appendTo("#tbodymodalcart");
                $('<td></td>').attr({ 'id': jsonCar[i]["registration"] + "modaltdphoto", 'class': 'w-25' }).append($("<img>").attr({ 'src': jsonCar[i]["src"], 'class': 'img-fluid img-thumbnail' })).appendTo("#" + jsonCar[i]["registration"] + "modaltr");
                $('<td></td>').append(document.createTextNode(jsonCar[i]["brand"] + " " + jsonCar[i]["model"] + " - " + jsonCar[i]["carcondition"])).appendTo("#" + jsonCar[i]["registration"] + "modaltr");
                // if (jsonCar[i]["insurance"] === 1) {
                //     finalprice = (jsonCar[i]["price"]+jsonCar[i]["price"]/10);
                $('<td></td>').append(document.createTextNode(jsonCar[i]["price"])).appendTo("#" + jsonCar[i]["registration"] + "modaltr");
                // } else {ç
                if (jsonCar[i]["insurance"] == 1) {
                    $('<td></td>').append($('<button></button>').attr({ 'type': 'button', 'class': 'btn btn-danger rminsurance', 'id': jsonCar[i]["registration"] }).append(document.createTextNode('Remove Insurance -10%'))).appendTo("#" + jsonCar[i]["registration"] + "modaltr");
                } else {
                    $('<td></td>').append($('<button></button>').attr({ 'type': 'button', 'class': 'btn btn-success addinsurance', 'id': jsonCar[i]["registration"] }).append(document.createTextNode('Add Insurance +10%'))).appendTo("#" + jsonCar[i]["registration"] + "modaltr");
                }
                $('<td></td>').append(document.createTextNode(jsonCar[i]["cartprice"])).appendTo("#" + jsonCar[i]["registration"] + "modaltr");
                // }
                $('<td></td>').attr({ 'id': jsonCar[i]["registration"] + 'remove' }).appendTo("#" + jsonCar[i]["registration"] + "modaltr");
                $('<a></a>').attr({ 'class': 'btn btn-danger btn-sm rmcart', 'id': jsonCar[i]["registration"] }).append($('<i></i>').attr({ 'class': 'fa fa-times' })).appendTo('#' + jsonCar[i]["registration"] + 'remove');
            });
            $('<li></li>').attr({ 'class': 'list-group-item active', 'id': 'test' }).append($('<button></button>').attr({ 'type': 'button', 'class': 'btn btn-info firstcheckout', 'style': 'width:100%;height:100%;' }).append(document.createTextNode('Checkout'))).appendTo(".cartul");
            $('.price').append(document.createTextNode(totalprice + "$"));
        }).catch(function () {
            console.log('Fail when trying to get the information.');
        });
    });
}
function addinsurance(carid) {
    friendlyURL('?page=shop&op=addItemIns').then(function (data) {
        ajaxPromise(data, 'POST', '', { registration: carid, token: localStorage.getItem("token") }).then(function (jsonCar) {
            console.log(jsonCar);
            loadcart();
        }).catch(function () {
            console.log('Fail when trying to get the information.');
        });
    });

}
function rminsurance(carid) {
    friendlyURL('?page=shop&op=rmItemIns').then(function (data) {
        ajaxPromise(data, 'POST', '', { registration: carid, token: localStorage.getItem("token") }).then(function (jsonCar) {
            console.log(jsonCar);
            loadcart();
        }).catch(function () {
            console.log('Fail when trying to get the information.');
        });
    });

}
function finalcheckout() {
    $.ajax({
        type: 'GET',
        // dataType: 'JSON',
        url: 'module/shop/controller/controller_shop.php?op=checkout&token=' + localStorage.getItem("token"),
    }).done(function (jsonCar) {
        console.log(jsonCar);
        loadcart();
    }).fail(function (jqXHR, textStatus, errorThrown) {
        if (console && console.log) {
            console.log("Error name/code: " + textStatus);
        }
    });
}

function fav(carid, action) {
    if (action == "fav") {
        friendlyURL('?page=shop&op=addItemFav').then(function (data) {
            ajaxPromise(data, 'POST', '', { registration: carid, token: localStorage.getItem("token") }).then(function (jsonCar) {
                console.log(jsonCar);
                loadcart();
            }).catch(function () {
                console.log('Fail when trying to get the information.');
            });
        });
    } else if (action == "unfav") {
        friendlyURL('?page=shop&op=rmItemFav').then(function (data) {
            ajaxPromise(data, 'POST', '', { registration: carid, token: localStorage.getItem("token") }).then(function (jsonCar) {
                console.log(jsonCar);
                loadcart();
            }).catch(function () {
                console.log('Fail when trying to get the information.');
            });
        });
    }
}
$(document).ready(function () {
    // loadcart();


    load_filters();
    if (document.getElementById("map") != null) {
        var script = document.createElement('script');
        script.src = "https://maps.googleapis.com/maps/api/js?key=" + MAPAPI + "&callback=initMap";
        script.async;
        script.defer;
        document.getElementsByTagName('script')[0].parentNode.appendChild(script);
    }
    switch (localStorage.getItem("op")) {
        case null:
            getSearchValues();
            break;
        case "search":
            switch (localStorage.getItem("value")) {
                case "KM0":
                    var url = { keyword: '%', brand: '%', condition: 'New', minprice: 100, maxprice: 99999999, showing: 10, page: 1, token: localStorage.getItem("token") };
                    load_content(url);
                    break;
                case "Seat":
                    var url = { keyword: '%', brand: 'Seat', condition: '%', minprice: 100, maxprice: 99999999, showing: 10, page: 1, token: localStorage.getItem("token") };
                    load_content(url);
                    break;
                case "Luxury":
                    var url = { keyword: '%', brand: '%', condition: '%', minprice: 200000, maxprice: 99999999, showing: 10, page: 1, token: localStorage.getItem("token") };
                    // var url = "keyword=%&brand=%&condition=%&minprice=200000&maxprice=99999999&showing=10&page=1" + "&user=" + localStorage.getItem("token");
                    load_content(url);
                    break;
                case "Preowned":
                    var url = { keyword: '%', brand: '%', condition: 'Used', minprice: 100, maxprice: 99999999, showing: 10, page: 1, token: localStorage.getItem("token") };
                    // var url = "keyword=%&brand=%&condition=Used&minprice=100&maxprice=99999999&showing=10&page=1" + "&user=" + localStorage.getItem("token");
                    load_content(url);
                    break;
                case "BMW":
                    var url = { keyword: '%', brand: 'BMW', condition: '%', minprice: 100, maxprice: 99999999, showing: 10, page: 1, token: localStorage.getItem("token") };
                    // var url = "keyword=%&brand=BMW&condition=%&minprice=100&maxprice=99999999&showing=10&page=1" + "&user=" + localStorage.getItem("token");
                    load_content(url);
                    break;
                case "global":
                    var url = { keyword: localStorage.getItem("keyword"), brand: localStorage.getItem('brand'), condition: localStorage.getItem('condition'), minprice: 100, maxprice: 99999999, showing: 10, page: 1, token: localStorage.getItem("token") };
                    // var url = "keyword=" + localStorage.getItem("keyword") + "&brand=" + localStorage.getItem('brand') + "&condition=" + localStorage.getItem('condition') + "&minprice=100&maxprice=99999999&showing=10&page=1" + "&user=" + localStorage.getItem("token");
                    load_content(url);
                    break;
                default:
                    getSearchValues();
            };
            break;
        case "details":
            details(localStorage.getItem("value"));
            break;
        default:
            getSearchValues();
    };
    //Event Listeners to the search input
    $(document).on("click", ".rmcart", function () {
        if (localStorage.getItem("token") == null) {
            window.location.href = "index.php?page=logreg";
            alertify.warning("You must be logged in to rate products");
        } else {
            rmcart($(this).attr('id'));
            // this.removeAttribute('class');
            // this.setAttribute('class', 'fas fa-shopping-basket');
        }
    });
    $(document).on("click", ".item-addcart", function () {
        if (localStorage.getItem("token") == null) {
            window.location.href = "index.php?page=logreg";
            alertify.warning("You must be logged in to rate products");
        } else {
            addcart($(this).attr('id'));
            // this.removeAttribute('class');
            // this.setAttribute('class', 'fas fa-shopping-basket');
        }
    });
    $(document).on("click", ".unfav", function () {
        if (localStorage.getItem("token") == null) {
            window.location.href = "index.php?page=logreg";
            alertify.warning("You must be logged in to rate products");
        } else {
            fav($(this).attr('id'), 'fav');
            this.removeAttribute('class');
            this.setAttribute('class', 'fas fa-heart fav');
        }
    });
    $(document).on("click", ".fav", function () {
        if (localStorage.getItem("token") == null) {
            window.location.href = "index.php?page=logreg";
            alertify.warning("You must be logged in to rate products");
        } else {
            fav($(this).attr('id'), 'unfav');
            this.removeAttribute('class');
            this.setAttribute('class', 'far fa-heart unfav');
        }
    });

    $(document).on("click", ".firstcheckout", function () {
        $('#cartModal').modal('show');
    });
    $(document).on("click", ".addinsurance", function () {
        addinsurance($(this).attr('id'));
    });
    $(document).on("click", ".rminsurance", function () {
        rminsurance($(this).attr('id'));
    });
    $(document).on("click", "#finalcheckout", function () {
        finalcheckout();
    });

    $('#shop-search').on('change', function () {
        getSearchValues();
    });
    $('.fa-search').on('click', function () {
        getSearchValues();
    });
    //Event Listener for the "Buy" button
    $('.btn-details').on('click', function () {
        details(this.getAttribute("id"));
    });
    $(document).on("click", ".btn-details", function () {
        details($(this).attr('id'));
    });
    //Event Listener for the car in the map
    $(document).on("click", ".mapsimage", function () {
        details($(this).attr('id'));
    });
    //Event listener for the pagination 
    $(document).on("click", ".page-link", function () {
        getSearchValues($(this).attr('id')); // or var clickedBtnID = this.id
    });
    // Event listeber for show more releated books
    $(document).on("click", "#showmore", function () {
        load_api_books();
    });

});