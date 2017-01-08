 $(document).ready(function() {
     $("#form-login").submit(function(event) {
         $("#btn-login").button('loading');
         event.preventDefault();
         var un = $("input[name='username']").val();
         var pw = $("input[name='password']").val();
         $.post("APP/SYS/CNT/user.php?a=signin", {
             un: un,
             pw: pw
         }, function(rtn) {
             if (rtn.trim().length > 0) {
                 bootbox.alert(rtn, function() {
                     window.location.reload();
                 });
             } else {
                 window.location.assign('home');
             }
         });
     });
 });