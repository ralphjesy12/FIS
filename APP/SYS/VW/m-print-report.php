<!-- Modal -->
<div class="modal fade" id="modal-print-report" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Report Generation</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <h4>Project</h4>
            <select id="select-project-3" class="form-control"></select>
            <h4>Material</h4>
            <select id="list-item-2" class="form-control"></select>
          </div>
          <div class="col-lg-6">
            <h4>From</h4>
            <input type="text" id="alt-from" class="form-control">
            <div id="print-from"></div>
          </div>
          <div class="col-lg-6">
            <h4>To</h4>
            <input type="text" id="alt-to" class="form-control">
            <div id="print-to"></div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="report-preview" type="button" class="btn btn-danger" data-dismiss="modal">Stock Card</button>
        <button id="report-preview-2" type="button" class="btn btn-danger" data-dismiss="modal">Count Sheet</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    $(document).ready(function(){

      $("#modal-print-report").on('show.bs.modal',function(){
        $.post("APP/SYS/CNT/project.php?a=fetchSelect", function(data) {
            $("#select-project-3").html(data).trigger('change');
        })
      });

      $("#report-preview").click(function(){
        var sid = $("#list-item-2").val();
        if(sid!=-1){
          var df = $("#print-from").val();
          var dt = $("#print-to").val();
          var pc = $("#select-project-3").val();
          window.open("print?" + sid + "&" + df + "&" + dt+"&"+pc+"&stock", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=20, left=300, width=1000, height=600");
        }else{
          bootbox.alert("Nothing to Generate.");
        }
      });
      $("#report-preview-2").click(function(){
        var sid = $("#list-item-2").val();
        if(sid!=-1){
          var df = $("#print-from").val();
          var dt = $("#print-to").val();
          var pc = $("#select-project-3").val();
          window.open("print?" + sid + "&" + df + "&" + dt+"&"+pc+"&count", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=20, left=300, width=1000, height=600");
        }else{
          bootbox.alert("Nothing to Generate.");
        }
      });

      $("#list-item-2").on('change',function(){
        var active_id = $(this).val();
         $.post("APP/SYS/CNT/stock.php?a=getDates", {
                    s: active_id
                }, function(data) {
                    var d = data.split("|");
                    var mind = d[0];
                    var maxd = d[1];
                     
                     $("#print-from").datepicker({
                      defaultDate : mind,
                      showOtherMonths: true,
                      selectOtherMonths: true,
                      onSelect: function(selected) {
                          $("#print-to").datepicker("option", "minDate", selected);
                      },
                      showAnim: "slideDown",
                      altField: "#alt-from",
                      altFormat: "MM d, yy"
                    });

                    $("#print-to").datepicker({
                      defaultDate : maxd,
                      showOtherMonths: true,
                      selectOtherMonths: true,
                      onSelect: function(selected) {
                          $("#print-from").datepicker("option", "maxDate", selected);
                      },
                      showAnim: "slideDown",
                      altField: "#alt-to",
                      altFormat: "MM d, yy"
                    });

                    $("#print-from").datepicker("option", "minDate", mind);
                    $("#print-from").datepicker("option", "defaultDate", mind);
                    $("#print-from").datepicker("option", "maxDate", maxd);

                    $("#print-to").datepicker("option", "minDate", mind);
                    $("#print-to").datepicker("option", "defaultDate", maxd);
                    $("#print-to").datepicker("option", "maxDate", maxd);
                });
            });
      });
      $("#select-project-3").on('change',function(){
        var pid = $(this).val();
        $.post("APP/SYS/CNT/stock.php?a=fetchList2", {
                p: pid
            }, function(data) {
                $("#list-item-2").html(data);
              }).then(function(){
                $("#list-item-2").trigger('change');
              });
         });

</script>