// $( document ).ready(function() {
//       $(".update-cart").click(function () {
//          var id= $(this).attr('id');
//          var token = $("input[name='_token']").val();
//          var qty = $(this).closest("tr").find(".quantity").val();
//          $.ajax({
//              url:'cap-nhat-gio-hang/'+id+'/'+qty,
//              type: 'GET',
//              cache:false,
//              data:{"_token":token,"id":id,"qty":qty},
//              dataType: "json",
//              success:function (data) {
//                 alert(data);
//                 if(data == "oke") {
//                     alert(123);
//                    // alert(123);
//                     window.location = "http://johndinhgk.abc/gio-hang";
//                 }
//              }
//          })
//       });
// });