// $(window).on("load", function(){
//     var minDate = new Date();
//     $("#availableOn").DateTimePicker({
//         numberOfMonth: 1,
//         minDate: minDate,
//         dateFormat:'dd/mm/yy',
//         buttonClicked: function (SET,selectedDate){
//             $('#availableUntil').DateTimePicker("option" ,"minDate", selectedDate);
//         }
//     });
    
//     $("#availableUntil").DateTimePicker({
      
//         numberOfMonth: 1,
//         minDate: minDate,
//         dateFormat:'dd/mm/yy'
       
//     });
// });

$(document).ready(function(){
    var minDate = new Date();
    $("#availableOn").DateTimePicker({
        numberOfMonth: 1,
        minDate: minDate,
        dateFormat:'dd/mm/yy',
        buttonClicked: function (SET,selectedDate){
            $('#availableUntil').DateTimePicker("option" ,"minDate", selectedDate);
        }
    });
    
    $("#availableUntil").DateTimePicker({
      
        numberOfMonth: 1,
        minDate: minDate,
        dateFormat:'dd/mm/yy'
       
    });
});