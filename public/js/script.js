$(document).ready(function() {

    ///////////////////////// INIT //////////

    var addRoomPopup = $('.add-room-popup');
    var deleteRoomPopup = $('.delete-room-popup');
    var addFilmPopup = $('.add-film-popup');
    var addSeancePopup = $('.add-seance-popup');
    var deleteSeancePopup = $('.delete-seance-popup');

    ///////////////////////// ACCORDEON //////////

    $('.conf-step__header').click(function() {
        $(this).toggleClass('conf-step__header_closed');
        $(this).toggleClass('conf-step__header_opened');
    });

    ////////////////////////  OPEN POPUP  ////////////

    function openPopUp(popup) {
        $('.overlay').fadeIn(400, () => {
            popup.css('display', 'block').animate({ opacity: 1 }, 200);
        });
    };

    ////////////////////////  CLOSE POPUP  //////////

    function closePopUp() {
        $('.div-popup').animate({ opacity: 0 }, 200, () => {
            $('.div-popup').css('display', 'none');
            $('.overlay').fadeOut(400);
        });
    };
    $('.close-popup, .overlay').on("click", () => { closePopUp() });

    ///////////////////////  CHECK INPUT ON EMPTY IN POPUP  //////////

    function checkInput(popupBtn, popupInput) {
        popupBtn.prop('disabled', true);
        popupInput.on('input', () => {
            var flag = true;
            popupInput.each(function() {
                if ($(this).val() != '') {
                    flag = false;
                } else {
                    return (flag = true);
                }
            });
            popupBtn.prop('disabled', flag);
        });
    };

    ////////////////////////  DELETE ROOM POPUP  //////////

    function deleteRoom(currentRoom, popup) {
        openPopUp(popup);
        var hallId = currentRoom.data('id');
        $('.delete-room-form > .conf-step__button-accent').on('click', () => {
            $.ajax({
                url: 'api/deleteHall',
                type: 'post',
                data: {
                    id: hallId
                },
                headers: {
                    Accept: 'application/json',
                    Authorization: localStorage.getItem('token_type') + ' ' + localStorage.getItem('access_token')
                }
            }).done(function(data) {
                $('.conf-step__radio').filter(function(index) {
                    return ($(this).val() == currentRoom.parent().text().trim());
                }).parent().remove();
                $('.conf-step__seances-hall').filter(function(index) {
                    return ($(this).children('h3').text().trim() == currentRoom.parent().text().trim());
                }).remove();
                currentRoom.parent().remove();
                closePopUp();
            }).fail(function(data) {
                console.log(data);
            });
        });
    };

    $('.conf-step__button-trash').on("click", (event) => {
        var room = $(event.target);
        deleteRoom(room, deleteRoomPopup);
    });

    ////////////////////////  ADD ROOM POPUP  //////////

    var addRoomBtn = $('.add-room-form > .conf-step__button-accent');
    $('#add-room').on("click", () => {
        openPopUp(addRoomPopup);
        checkInput(addRoomBtn, $('.add-room-form > .conf-step__input'));
    });
    addRoomBtn.on('click', () => {
        var roomInputName = $('.add-room-form > .conf-step__input').val();
        $.ajax({
            url: 'api/addHall',
            type: 'post',
            data: {
                name: roomInputName
            },
            headers: {
                Accept: 'application/json',
                Authorization: localStorage.getItem('token_type') + ' ' + localStorage.getItem('access_token')
            }
        }).done(function(data) {
            var roomListElem = $('<li>');
            var roomTrashBtn = $('<button>', {class:"conf-step__button conf-step__button-trash", 'data-id':data.id});
            roomListElem
                .text(roomInputName)
                .append(roomTrashBtn)
                .insertAfter($('.conf-step__list > li:last'));
            roomTrashBtn.on("click", (event) => {
                var room = $(event.target);
                deleteRoom(room, deleteRoomPopup);
            });
            var roomLi = $('<li>');
            var roomInputRadio = $('<input>', {type: 'radio', class: 'conf-step__radio', name:'chairs-hall', value: roomInputName, checked: false, 'data-id': data.id});
            var roomSpan = $('<span>', {class: 'conf-step__selector', text: roomInputName });
            roomLi.append(roomInputRadio);
            roomLi.append(roomSpan);
            $('.conf-step__selectors-box:first').append(roomLi);
            var cloneRomeLi = roomLi.clone();
            cloneRomeLi.children('input').prop('name', 'prices-hall');
            $('.conf-step__selectors-box:last').append(cloneRomeLi);
            var seancesHall = $('<div>', {class: 'conf-step__seances-hall ui-droppable'});
            var seanceTitle = $('<h3>', {class: 'conf-step__seances-title', text: roomInputName});
            var seanceTimeLine = $('<div>', {class: 'conf-step__seances-timeline ui-droppable', 'data-id': data.id});
            seancesHall.append(seanceTitle);
            seancesHall.append(seanceTimeLine);
            $('.conf-step__seances').append(seancesHall);
            $('.chairs-change-box input').on('change', function() {
                var current = event.target;
                loadMap(current);
            });
            $('.price-change-box input').on('change', function() {
                var current = event.target;
                loadPrice(current);
            });
            dragnDropInSeance();
            closePopUp();
            $('.add-room-form > .conf-step__input').val('');
        }).fail(function(data) {
            console.log(data);
        });
    });

    ////////////////////////  ADD FILM POPUP  //////////

    var addFilmBtn = $('.add-film-form > .conf-step__button-accent');
    $('#add-film').on("click", () => {
        openPopUp(addFilmPopup);
        checkInput(addFilmBtn, $('.add-film-form > .conf-step__input'));
    });
    addFilmBtn.on('click', () => {
        $.ajax({
            url: 'api/addFilm',
            type: 'post',
            data: {
                'title': $('[name=film-name]').val(),
                'duration': $('[name=film-duration]').val(),
                'poster': $('[name=film-poster]').val(),
                'description': $('[name=film-description]').val(),
                'country': $('[name=film-country]').val()
            },
            headers: {
                Accept: 'application/json',
                Authorization: localStorage.getItem('token_type') + ' ' + localStorage.getItem('access_token')
            }
        }).done(function(data) {
            console.log(data);
            var filmId = data.id;
            var filmName = data.title;
            var filmDuration = data.duration;
            var filmPoster;
            if(data.poster.indexOf('http') + 1) {
                filmPoster = data.poster;
            } else {
                filmPoster = 'i/' + data.poster;
            }
            var filmDiv = $('<div>', {class: 'conf-step__movie ui-draggable ui-draggable-handle', 'data-id': filmId});
            filmImg = $('<img>', {class:'conf-step__movie-poster', alt: 'poster',src: filmPoster});
            var filmTitle = $('<h3>', {class:'conf-step__movie-title', text: filmName});
            var filmP = $('<p>', {class:'conf-step__movie-duration', text: filmDuration + ' минут'});
            filmDiv.append(filmImg);
            filmDiv.append(filmTitle);
            filmDiv.append(filmP);
            $('.conf-step__movies').append(filmDiv);
            closePopUp();
            $('[name=film-name]').val('');
            $('[name=film-duration]').val('');
            $('[name=film-poster]').val('');
            dragnDropInSeance();
            deleteFilm();
        }).fail(function(data) {
            console.log(data);
        });
    });

    ////////////////////////  INSERT ONLY NUMERIC ON INPUT  //////////

    $(".conf-step__legend .conf-step__input").on('keypress', (event) => {
        event = event || window.event;
        if (event.charCode && event.charCode != 0 && (event.charCode < 48 || event.charCode > 57))
            return false;
    });

    ////////////////////////  EDIT ROOM PARAMETERS  //////////

    var rowInput = $('.conf-step__legend:first .conf-step__input:first');
    var chairInput = $('.conf-step__legend:first .conf-step__input:last');
    var chairStandart = $('.conf-step__chair_standart:first');
    var chairVip = $('.conf-step__chair_vip:first');
    var chairDisabled = $('.conf-step__chair_disabled:first');
    function editRoomRow() {
        rowInput.on('keyup', () => {
            var roomHall = $('.conf-step__hall-wrapper');
            var currentRowCount = $('.conf-step__row').length;
            var currentChairsCount = $('.conf-step__row:first .conf-step__chair').length;
            if(currentRowCount < rowInput.val()) {
                for (var i = currentRowCount; i < rowInput.val(); i++) {
                    var newRow = $('<div>', {class:'conf-step__row', id: 1+i});
                    for(var j=0; j<currentChairsCount; j++) {
                        newRow.append(chairStandart.clone());
                    }
                    roomHall.append(newRow);
                };
            } else if(currentRowCount > rowInput.val()) {
                for (var i = currentRowCount; i >= rowInput.val(); i--) {
                    $('.conf-step__row:eq('+i+')').remove();
                }
            };
            changeChairStatus();
        });
        chairInput.on('keyup', () => {
            var currentChairsCount = $('.conf-step__row:first .conf-step__chair').length;
            if(currentChairsCount < chairInput.val()) {
                for (var i = currentChairsCount; i < chairInput.val(); i++) {
                    $('.conf-step__row').append(chairStandart.clone());
                };

            } else if(currentChairsCount > chairInput.val()) {
                for (var i = currentChairsCount; i >= chairInput.val(); i--) {
                    $('.conf-step__row').each(function () {
                        $(this).children('.conf-step__chair:eq('+i+')').remove();
                    });
                };
            };
            changeChairStatus();
        });
    };

    function changeChairStatus() {
        $('.conf-step__hall .conf-step__chair').on('click', function() {
            if ($(this).hasClass('conf-step__chair_disabled')) {
                $(this).removeClass('conf-step__chair_disabled').addClass('conf-step__chair_standart');
            } else if ($(this).hasClass('conf-step__chair_standart')) {
                $(this).removeClass('conf-step__chair_standart').addClass('conf-step__chair_vip');
            } else if (($(this).hasClass('conf-step__chair_vip'))) {
                $(this).removeClass('conf-step__chair_vip').addClass('conf-step__chair_disabled');
            };
        });
    };
    changeChairStatus();
    editRoomRow();

    ////////////////////////  CHAIRS CHANGE PARAMETERS  //////////

    function loadMap(currCheckBox) {
        $.ajax({
            url: 'api/getHall',
            type: 'post',
            data: {
                'id': $(currCheckBox).data('id')
            },
            headers: {
                Accept: 'application/json',
                Authorization: localStorage.getItem('token_type') + ' ' + localStorage.getItem('access_token')
            }
        }).done(function(data) {
            $('.conf-step__hall-wrapper').empty();
            var chairsMap = JSON.parse(data.map);
            for (var row in chairsMap) {
                var currentRow = chairsMap[row];
                $('<div/>', { class: 'conf-step__row', id: row }).appendTo($('.conf-step__hall-wrapper'));
                for (var chair in currentRow) {
                    if (currentRow[chair] === 's') {
                        chairStandart.clone().appendTo($('#' + row));
                    } else if (currentRow[chair] === 'v') {
                        chairVip.clone().appendTo($('#' + row));
                    } else {
                        chairDisabled.clone().appendTo($('#' + row));
                    };
                };
            };
            rowInput.val(data.rows);
            chairInput.val(data.chairs);
            changeChairStatus();
        }).fail(function(data) {
            console.log(data);
        });
    };

    $('.chairs-change-box input').on('change', function() {
        var current = event.target;
        loadMap(current);
        $('.chairs-change-box input').attr('checked', false);
        $(current).attr('checked', true);
    });
    loadMap($('.chairs-change-box input:checked'));

    $('.cencel-chairs').on('click', ()=>{
        rowInput.val('');
        chairInput.val('');
        $('.conf-step__hall-wrapper').empty();
    });

    ////////////////////////  PRICES CHANGE PARAMETERS  //////////

    var standartPrice = $('.standart-price');
    var vipPrice = $('.vip-price');

    function loadPrice(currCheckBox) {
        $.ajax({
            url: 'api/getHall',
            type: 'post',
            data: {
                'id': $(currCheckBox).data('id')
            },
            headers: {
                Accept: 'application/json',
                Authorization: localStorage.getItem('token_type') + ' ' + localStorage.getItem('access_token')
            }
        }).done(function(data) {
            standartPrice.val(data['price']);
            vipPrice.val(data['price_vip']);
        }).fail(function(data) {
            console.log(data);
        });
    };

    $('.price-change-box input').on('change', function() {
        var current = event.target;
        loadPrice(current);
        $('.price-change-box input').attr('checked', false);
        $(current).attr('checked', true);
    });
    loadPrice($('.price-change-box input:checked'));

    $('.cencel-prices').on('click', ()=>{
        standartPrice.val('');
        vipPrice.val('');
    });

    ////////////////////////  UPDATE ROOM PARAMETERS ON DB  //////////

    var saveChairsBtn = $('.save-chairs');
    var savePricesBtn = $('.save-prices');
    saveChairsBtn.on('click', () => {
        var currentMap = {};
        var countRows = 0;
        $('.conf-step__row').each(function() {
            countRows++;
            var countChairs = 1;
            var currentRow = {};
            $(this).children().each(function() {
                if ($(this).hasClass('conf-step__chair_disabled')) {
                    currentRow[countChairs++] = 'f';
                } else if ($(this).hasClass('conf-step__chair_standart')) {
                    currentRow[countChairs++] = 's';
                } else if (($(this).hasClass('conf-step__chair_vip'))) {
                    currentRow[countChairs++] = 'v';
                };
                currentMap[countRows] = currentRow;
            });
        });
        var currentRadioBtn = $('.chairs-change-box input:checked');
        $.ajax({
            url: 'api/updateHall',
            type: 'post',
            data: {
                'id': currentRadioBtn.data('id'),
                'rows': rowInput.val(),
                'chairs': chairInput.val(),
                'map': JSON.stringify(currentMap),
            },
            headers: {
                Accept: 'application/json',
                Authorization: localStorage.getItem('token_type') + ' ' + localStorage.getItem('access_token')
            }
        }).done(function(data) {
            console.log(data);
        }).fail(function(data) {
            console.log(data);
        });
    });
    savePricesBtn.on('click', () => {
        var currentRadioBtn = $('.price-change-box input:checked');
        $.ajax({
            url: 'api/updatePrices',
            type: 'post',
            data: {
                'id': currentRadioBtn.data('id'),
                'price': standartPrice.val(),
                'vip': vipPrice.val()
            },
            headers: {
                Accept: 'application/json',
                Authorization: localStorage.getItem('token_type') + ' ' + localStorage.getItem('access_token')
            }
        }).done(function(data) {
            console.log(data);
        }).fail(function(data) {
            console.log(data);
        });
    });

    ////////////////////////  DRAG-N-DROP FILMS  //////////

    var addSeance = $('.add-seance-form > .conf-step__button-accent');
    var deleteSeance = $('.delete-seance-form > .conf-step__button-accent');
    var currentTimeLine, currentFilm;

    function dragnDropInSeance() {
        $('.conf-step__movie').draggable({
            containment: '.draggable',
            zIndex: 100,
            revert: true,
            scope: '1',
            opacity: 0.8
        });
        $('.conf-step__seances-timeline').droppable({
            activeClass: 'droppable',
            scope: '1',
            drop: function(event, ui) {
                currentTimeLine = $(event.target);
                currentFilm = $(ui.helper);
                openPopUp(addSeancePopup);
            }
        });
    };
    dragnDropInSeance();

    function addSeanceinTimeLine(currentTimeLine, currentFilm, dataId, currentTime) {
        var timelineWidth = currentTimeLine.css("width");
        var filmTitle = currentFilm.children('h3').text();
        var filmDuration = currentFilm.children('.conf-step__movie-duration').text();
        var filmBgColor = currentFilm.css('background-color');
        var seanceTime = currentTime;
        var seanceDiv = $('<div>', {class:'conf-step__seances-movie ui-draggable ui-draggable-handle', 'data-id': dataId});
        var seanceP = $('<p>', {class:'conf-step__seances-movie-title', text: filmTitle});
        var senaceStart = $('<p>', {class:'conf-step__seances-movie-start', text: seanceTime});
        var timelineInMinutes = parseInt(timelineWidth) / (60 * 24);
        var num = seanceTime.split(':');
        var seanceTimeInMinutes = (num[0] * 60) + +num[1];
        seanceDiv.css('width', parseInt(filmDuration) * timelineInMinutes);
        seanceDiv.css('left', seanceTimeInMinutes * timelineInMinutes);
        seanceDiv.css('background-color', filmBgColor);
        seanceDiv.append(seanceP);
        seanceDiv.append(senaceStart);
        currentTimeLine.append(seanceDiv);
    };

    function getSeances() {
        $.ajax({
            url: 'api/getSeances',
            type: 'post',
            headers: {
                Accept: 'application/json',
                Authorization: localStorage.getItem('token_type') + ' ' + localStorage.getItem('access_token')
            }
        }).done(function(data) {
            console.log(data);
            for (var seance of data) {
                var currentTimeLine = $(".conf-step__seances-timeline[data-id='" + seance.hall_id + "']");
                var currentFilm = $(".conf-step__movie[data-id='" + seance.film_id + "']");
                var dataId = seance.id;
                var currentTime = seance.time;
                addSeanceinTimeLine(currentTimeLine, currentFilm, dataId, currentTime);
            }
        }).fail(function(data) {
            console.log(data);

        });
    };
    getSeances();

    addSeance.on('click', () => {
        $.ajax({
            url: 'api/addSeance',
            type: 'post',
            data: {
                'time': $('.add-seance-form > input').val(),
                'filmId': currentFilm.data('id'),
                'hallId': currentTimeLine.data('id')
            },
            headers: {
                Accept: 'application/json',
                Authorization: localStorage.getItem('token_type') + ' ' + localStorage.getItem('access_token')
            }
        }).done(function(data) {
            console.log(data);
            addSeanceinTimeLine(currentTimeLine, currentFilm, data.id, $('.add-seance-form > input').val());
            closePopUp();
            $('.add-seance-form > input').val('');
            dragnDropOutSeance();
        }).fail(function(data) {
            console.log(data);
        });
    });

    function dragnDropOutSeance() {
        $('.conf-step__seances-movie').draggable({
            containment: '.draggable',
            zIndex: 100,
            scope: '2',
            opacity: 0.8,
            revert: true
        });
        $('.conf-step__seances-hall').droppable({
            scope: '2',
            out: function(event, ui) {
                currentTimeLine = $(event.target);
                currentFilm = $(ui.helper);
                openPopUp(deleteSeancePopup);
            }
        });
    };
    deleteSeance.on('click', () => {
        $.ajax({
            url: 'api/deleteSeance',
            type: 'post',
            data: {
                'id': currentFilm.data('id')
            },
            headers: {
                Accept: 'application/json',
                Authorization: localStorage.getItem('token_type') + ' ' + localStorage.getItem('access_token')
            }
        }).done(function(data) {
            console.log(data);
            currentFilm.remove();
            closePopUp();
        }).fail(function(data) {
            console.log(data);
        });
    });
    dragnDropOutSeance();

    ////////////////////////  DELETE FILM ON DBCLICK EVENT  //////////

    function deleteFilm() {
        $('.conf-step__movie').on('dblclick', function() {
            var currentFilm = $(this);
            $.ajax({
                url: 'api/deleteFilm',
                type: 'post',
                data: {
                    id: currentFilm.data('id')
                },
                headers: {
                    Accept: 'application/json',
                    Authorization: localStorage.getItem('token_type') + ' ' + localStorage.getItem('access_token')
                }
            }).done(function(data) {
                currentFilm.remove();
            }).fail(function(data) {
                console.log(data);
            });
        });
    }
    deleteFilm();

    ////////////////////////  REDIRECT ON OPENSALES'CLICK  //////////

    $('.open-sale').click(function() {
        event.preventDefault();
        location.href = '/reception';
    });

    ////////////////////////  LOGOUT  //////////

    $('.exit-btn').click(function() {
        event.preventDefault();
        $.ajax({
            url: '/api/auth/logout',
            type: 'get',
            headers: {
                Accept: 'application/json',
                Authorization: localStorage.getItem('token_type') + ' ' + localStorage.getItem('access_token')
            }
        }).done(function(data) {
            console.log(data);
            localStorage.clear();
            location.href = '/login';
        }).fail(function(data) {
            console.log(data);
        });
    });

    ////////////////////////  INPUT MASK FOR SEANCE'S TIME  //////////

    $.mask.definitions['H'] = '[012]';
    $.mask.definitions['M'] = '[012345]';
    $('.add-seance-form > input').mask('H9:M9', {
        placeholder: "_",
        completed: function() {
            var val = $(this).val().split(':');
            if (val[0] * 1 > 23) val[0] = '23';
            if (val[1] * 1 > 59) val[1] = '59';
            $(this).val(val.join(':'));
        }
    });
});
