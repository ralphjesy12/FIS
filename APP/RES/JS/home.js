 $(document).ready(function() {
     //AUTO LOAD
     $(".panel-main").css("min-height", $(window).height() - 100);
     $(".overflow-scrollable").css("overflow", "auto");
     $(".overflow-scrollable").css("max-height", function() {
         $(window).height() - parseInt()
         var height = $(window).height();
         var offset = parseInt($(this).data("offset"));
         return height - offset;
     });
     if (window.location.hash.length > 0) {
         $("#sidebar li a.active").removeClass("active");
         $("#sidebar li a[href=" + window.location.hash + "]").addClass("active");
     }

     $.post("APP/SYS/CNT/user.php?a=getClerks",function(data){
        $("#clerks").html(data);
        randomClerk();
     });


     //EVENTS

     $("#menu-toggle").click(function(e) {
         e.preventDefault();
         $("#wrapper").toggleClass("active");
     });
     $("#sidebar li a").click(function() {
         var scope = this;
         $("#sidebar li a.active").removeClass("active");
         $(scope).addClass("active");
     });

     $("#btn-signout").click(function(event) {
         $.post("APP/SYS/CNT/user.php?a=signout", function() {
             window.location.assign('');
         });
     });


     $("#select2").change(function() {

         console.log($(this));

         console.log($(this).val());
     });


     $("#form-account").on("submit",function(event){
        event.preventDefault();
        var d = $(this).serializeArray();
        var u = d[0].value.trim();
        var p = d[1].value.trim();
        if( u && p ){
            bootbox.prompt("Provide Current Password",function(ans){
                if(ans && ans.trim()!=""){
                    $.post("APP/SYS/CNT/user.php?a=update",{ op : ans , un : u , pw : p},function(data){
                        if(data=='ip'){
                            bootbox.alert("Old Password Incorrect.");
                        }else{
                            bootbox.alert("Account Details Updated! Please sign in to continue",function(){
                                 $.post("APP/SYS/CNT/user.php?a=signout",function(){
                                    window.location.reload();
                                 });
                            });
                        }
                    });
                }
            });
        }
     });
     $("#form-clerk").on("submit",function(event){
        event.preventDefault();
        var d = $(this).serializeArray();
        var u = d[0].value.trim();
        var p = d[1].value.trim();
        if( u && p ){
            $.post("APP/SYS/CNT/user.php?a=addClerk",{ un : u , pw : p},function(data){
                    bootbox.alert("New Clerk Added",function(){
                         $.post("APP/SYS/CNT/user.php?a=getClerks",function(data){
                            $("#clerks").html(data);
                         }).then(function(){
                            $("#modal-new-clerk").modal('hide');
                         });
                    });
                });
        }
     });

     $("#randomClerk").click(function(){
        randomClerk();
     });
     //DELEGATES
    $("a[href='#modal-project']").tooltip({placement:'right'});
    $("a[href='#modal-stock']").tooltip({placement:'right'});
    $("a[href='#modal-material']").tooltip({placement:'right'});
    $("a[href='#modal-print-report']").tooltip({placement:'right'});
    $("a[href='#modal-settings']").tooltip({placement:'right'});
     
 });

  function randomClerk(){
        $.post("APP/SYS/CNT/user.php?a=randomCred",function(data){
                            var dat = data.split("|");
                            $("#clerk_un").val(dat[0]);
                            $("#clerk_pw").val(dat[1]);
                         });
     }