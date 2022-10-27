
var engine_auto = $("#engine_auto")
var electro_cars = document.getElementById('engine_auto')
var volume_all = document.getElementById('volume')

electro_cars.addEventListener('mouseup',function () {
if (engine_auto.val() == 'electro_car'){
    volume_all.style.visibility='hidden'
}else {
    volume_all.style.removeProperty('visibility')
}},false)





// $("#submit").on("click",function () {
//     var legal_entity = $("#legal_entity").val()
//     var year_auto = $("#year_auto").val()
//     var power_engine = $("#power_engine").val()
//     var engine_auto = $("#engine_auto").val()
//     var engine_power_auto = $("#engine_power_auto").val()
//     var volume_engine = $("#volume_engine").val()
//     var prise = $("#prise").val()
//     var prise_format_auto = $("#prise_format_auto").val()
//
//     if (legal_entity.trim()==""){
//         $("#errors").text("Ошибка!.Вы не указали юр.лицо.")
//         return false
//     }else if(year_auto.trim()==""){
//         $("#errors").text("Ошибка!.Вы  не указали год.")
//         return false
//     }else if(engine_auto.trim()==""){
//         $("#errors").text("Ошибка!.Вы не указали на чем работает авто.")
//         return false
//     }else if(power_engine.trim()==""){
//         $("#errors").text("Ошибка!.Вы не указали мощность двигателя.")
//         return false
//     }else if(engine_power_auto.trim()==""){
//         $("#errors").text("Ошибка!.Вы не указали объем двигателя")
//         return false
//     }else if(volume_engine.trim()==""){
//         $("#errors").text("Ошибка!.Вы не указали объем двигателя")
//         return false
//     }else if(prise.trim()==""){
//         $("#errors").text("Ошибка!.Вы не указали стоимость автомобиля.")
//         return false
//     }else if(prise_format_auto.trim()==""){
//         $("#errors").text("Ошибка!.Вы неправильно заполнили поле.")
//         return false
//     }
//     $("#errors").text("")


        // $.ajax({
        //     url: 'Class/Calculate.php',
        //     type: 'POST',
        //     cache: false,
        //     data: {'legal_entity':legal_entity,'year_auto':year_auto,'engine_auto':engine_auto,'power_engine':power_engine,'engine_power_auto':engine_power_auto,'volume_engine':volume_engine,'prise':prise,'prise_format_auto':prise_format_auto},
        //     beforeSend:function () {
        //         $("#submit").prop("disabled",true);
        //     },
        //     success: function (data) {
        //         document.writeln(data);
        //
        //         $("#submit").prop("disabled",false);
        //     }
        // })

// })