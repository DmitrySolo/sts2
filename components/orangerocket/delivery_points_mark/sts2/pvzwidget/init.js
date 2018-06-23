$(document).ready(function () {
    if(document.getElementById('pvzWidjet')){
    console.log(window.location);
    var cityFromCoockie = (qntGetCookie('BITRIX_SM_TF_LOCATION_SELECTED_CITY_NAME'));
    var pvzCountAll =  (qntSetCookie('PVZ_COUNT', '5', 1));

    var mass = 1000;
    var goodsParam=[];
    if(document.getElementById('js_prod_mass')){
       mass =  document.getElementById('js_prod_mass').value;
    }



    if($.isNumeric(mass) && mass > 0 ){
            mass = mass/1000
        }else mass = 1;

        var vPar = mass*5000;

        var lwh = Math.pow(vPar, 1/3);




         var goodsParam =  [{
                length : lwh,
                width  : lwh,
                height : lwh,
                weight : 1
            }]


    var sdekWdjetParams = {
        goods: goodsParam,
        defaultCity: cityFromCoockie || 'Воронеж', //какой город отображается по умолчанию
        cityFrom: 'Воронеж', // из какого города будет идти доставка
        country: 'Россия', // можно выбрать страну, для которой отображать список ПВЗ
        link: 'pvzWidjet',
        servicepath: '/punkty-vydachi/pvzwidget/scripts/service.php',
       // onChoose: choose,
        choose:true,
    };
    //



    //
    // var pageWdjetParams = {
    //     defaultCity: cityFromCoockie || 'Воронеж', //какой город отображается по умолчанию
    //     cityFrom: 'Воронеж', // из какого города будет идти доставка
    //     country: 'Россия', // можно выбрать страну, для которой отображать список ПВЗ
    //
    //     servicepath: '/punkty-vydachi/pvzwidget/scripts/service.php',
    //
    //     choose:true,
    // };





    var Widjet = new ISDEKWidjet(sdekWdjetParams);


       // console.log(Widjet.pvzCount+' пунктов');
    // var pagesWidget = new ISDEKWidjet(pageWdjetParams);
    }else console.log("No widget HERE");
})




