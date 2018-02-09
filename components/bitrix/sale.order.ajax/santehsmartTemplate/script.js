window.orderUIObject = {
    orderUIIndex: 0,
    PARTNER_ID: 0,
    PARTNER_ID_1: 0,
    PARTNER_ID_2: 0,
    PARTNER_ID_3: 0,
    AJAX_PATH: '',

    init: function (arParams) {
        _this = window.orderUIObject;
        //console.log(arParams);
        //_this.orderUIIndex = 0;
        _this.PARTNER_ID = arParams.PARTNER_ID;
        _this.PARTNER_ID_1 = arParams.PARTNER_ID_1;
        _this.PARTNER_ID_2 = arParams.PARTNER_ID_2;
        _this.PARTNER_ID_3 = arParams.PARTNER_ID_3;
        _this.AJAX_PATH = arParams.AJAX_PATH;
    },

    initTabs: function () {
        _this = window.orderUIObject;
        $('.order__checkPoint')
            .each(function (index) {
                if(index < _this.orderUIIndex) $(this).addClass('order__checkPoint--gone').addClass('order__way--gone');
            })
            .removeClass('order__checkPoint--active').eq(_this.orderUIIndex).addClass('order__checkPoint--active');
        $('.order__form').removeClass('order__form--active').eq(_this.orderUIIndex).addClass('order__form--active');
        $('div.radio .radio__input').prop('checked',false);
        $('div.radio--selected .radio__input').prop('checked',true);
        $('.toOrder').on('click',function (ev) {
            $('.order__checkPoint')
                .each(function (index) {
                    if(index <= _this.orderUIIndex) $(this).addClass('order__checkPoint--gone').addClass('order__way--gone');
                })
                .removeClass('order__checkPoint--active').eq(++_this.orderUIIndex).addClass('order__checkPoint--active');
            $('.order__form').removeClass('order__form--active').eq(_this.orderUIIndex).addClass('order__form--active');
            if(_this.orderUIIndex == 4){
                $('.bxOrder__tab_block5').addClass('bxOrder__tab_block5--active');
            }else{
                $('.bxOrder__tab_block5').removeClass('bxOrder__tab_block5--active');
            }
            ev.preventDefault();
        });
    },

    ajaxCallback: function () {},

    modalAlert: function (msg,st1button,nd2button) {
        var formContent=BX.create("span", {html: msg});
        new BX.PopupWindow("my_answer", null, {
            content: formContent,
            //titleBar: {content: BX.create("span", {html: '<b>Сообщение</b>', 'props': {'className': 'access-title-bar'}})},
            zIndex: 0,
            offsetLeft: 0,
            offsetTop: 0,
            draggable: {restrict: false},
            overlay : true,
            buttons: (st1button&&nd2button)?([
                new BX.PopupWindowButton({
                    text: st1button.name,
                    className: "popup-window-button-accept",
                    events: {click: function(){
                        st1button.callback();
                        this.popupWindow.close(); // закрытие окна
                        BX('my_answer').remove();
                        BX('popup-window-overlay-my_answer').remove();
                    }}
                }),
                new BX.PopupWindowButton({
                    text: nd2button.name,
                    className: "webform-button-link-cancel",
                    events: {click: function(){
                        nd2button.callback();
                        this.popupWindow.close(); // закрытие окна
                        BX('my_answer').remove();
                        BX('popup-window-overlay-my_answer').remove();
                    }}
                })
            ]):([
                new BX.PopupWindowButton({
                    text: "Закрыть",
                    className: "webform-button-link-cancel",
                    events: {click: function(){
                        if(st1button)st1button.callback();
                        this.popupWindow.close(); // закрытие окна
                        BX('my_answer').remove();
                        BX('popup-window-overlay-my_answer').remove();
                    }}
                })
            ])
        }).show();
    },

    modalAlertYN: function (msg) {
        _this = window.orderUIObject;
        this.modalAlert(msg.response.COMMENT,{
            name:"Да, добавить позиции, отсутствующие на складе, в заявку",
            callback:function(){
                if(msg.data.bill1) {
                    _this.sendAjax1C(msg.data.bill1, function () {
                        if(msg.data.bill2) _this.sendAjax1C(msg.data.bill2);
                    }, msg.data.bill2?true:false);
                }else _this.sendAjax1C(msg.data.bill2, function(){});
            }
        },{
            name:"Нет, оставить в заявке только позиции, которые есть в наличии",
            callback:function(){
                _this.sendAjax1C(msg.data.bill1, function(){});
            }
        });
    },

    sendAjax1C: function (objSend, callback73, orderOne) {
        _this = window.orderUIObject;
        $.post( _this.AJAX_PATH + "/ajax.php", objSend ,function( msg ) {
            if(msg.status == 'ok'){
                if(msg.response.STRING == 'NOT_FOUND'){
                    _this.modalAlertYN(msg);
                    _this.bill_cut = msg.data.bill_cut;
                    return BX.PreventDefault(event);
                }else{
                    if(_this.bill_cut) $('input[name="ORDER_PROP_75"]').attr('value',_this.bill_cut);
                    //if(confirm(msg.response.COMMENT)){
                    if(callback73) {
                        $('input[name="ORDER_PROP_73"]').attr('value',msg.data.bill_number);
                        callback73();
                        if(!orderOne){
                            _this.ajaxCallback();
                        }
                    }
                    else {
                        $('input[name="ORDER_PROP_74"]').attr('value', msg.data.bill_number);
                        $('input[name="ORDER_PROP_72"]').attr('value', objSend["alt_partner_id"]);

                        _this.ajaxCallback();
                    }
                    //}
                }
            }else{
                alert("Ошибка");
            }
        }, "json");
    },

    /**
     * Order saving action with validation. Doesn't send request while have errors
     */
    clickOrderSaveAction: function(ajaxCallback)
    {
        _this = window.orderUIObject;
        _this.ajaxCallback = ajaxCallback;
        var cart_content = {};
        var cart_names = {};
        var cart_prices = {};
        var partner_id = _this.PARTNER_ID;
        var alt_partner_id = 0;
        var payment_24 = $('#ID_PAY_SYSTEM_ID_24').is(':checked');
        var payment_25 = $('#ID_PAY_SYSTEM_ID_25').is(':checked');
        var payment_26 = $('#ID_PAY_SYSTEM_ID_26').is(':checked');
        if(payment_24) alt_partner_id = _this.PARTNER_ID_1;
        if(payment_25) alt_partner_id = _this.PARTNER_ID_2;
        if(payment_26) alt_partner_id = _this.PARTNER_ID_3;
        var comment = '';
        //console.log([payment_24,payment_25,payment_26,alt_partner_id,partner_id]);

        if(partner_id){
            $('.bxOrder__basket_info').each(function(){
                var sku=$(this).data('xml-id');
                var count=$(this).data('quantity');
                var price=$(this).data('price');
                var name=$(this).data('name');
                //alert(sku+' '+name+' '+count);
                cart_content[sku]=count;
                cart_prices[sku]=price;
                cart_names[sku]=name;
            });
            comment = $('#ORDER_DESCRIPTION').val();

            var objSend = {};
            objSend["partner_id"] = partner_id;
            objSend["alt_partner_id"] = alt_partner_id;
            objSend["comment"] = comment;
            objSend["cart_content"] = cart_content;
            objSend["cart_names"] = cart_names;
            objSend["cart_prices"] = cart_prices;
            objSend["is_second"] = 'N';

            //console.log(objSend);

            _this.sendAjax1C(objSend, function(){});
        }else{
            alert("Ошибка номера партнера");
        }
    }
};

$(document).ready(window.orderUIObject.initTabs);

console.log('hello?');