$(document).ready(function() {
    //AUTOLOADS
    list_project_refresh();
    //EVENTS
    $("#form-project-create").submit(function(event) {
        event.preventDefault();
        $("#btn-project-create").button('loading');
        var p = $(this).serializeArray();
        $.post("APP/SYS/CNT/project.php?a=create", {
            data: p
        }, function(data) {
            if (data.trim().length > 0) bootbox.alert(data.trim());
            else {
                list_project_refresh();
                select_project_refresh();
                $("#modal-project-create").modal('hide');
                resetForm("#form-project-create");
            }
            $("#btn-project-create").button('reset');
        });
    });

    $("#modal-logs").on("shown.bs.modal", function() {
        $.post("APP/SYS/CNT/project.php?a=logs", function(data) {
            $("#logs").val(data);
        });
    });
    $.post("APP/SYS/CNT/project.php?a=stats", function(data) {
        var g = data.split("|")
        var d = g[0].split(",");
        var c = g[1].split(",");
        $("#stat-trans").text(d[0]);
        $("#stat-proj").text(d[1]);
        $("#stat-items").text(d[2]);
        $("#stat-stocks").text(d[3]);
        var labels = [];
        var data = [];
        for (i in c) {
            var cc = c[i].split(':');
            labels.push(cc[0]);
            data.push(parseInt(cc[1]));
        };
        var superData = {
            labels: labels,
            datasets: [{
                fillColor: "rgba(46,204,113,0.5)",
                strokeColor: "#27ae60",
                pointColor: "#27ae60",
                data: data
            }],
            scaleBeginAtZero: false
        };
        var ctx = document.getElementById("genChart4").getContext("2d");
        if(typeof myNewChart != 'undefined') myNewChart.destroy();
        myNewChart = new Chart(ctx).Bar(superData);
    });

    $('#modal-stock').on('shown.bs.modal', function(e) {
        $.post("APP/SYS/CNT/project.php?a=fetchSelect", function(data) {
            $("#select-project-2").html(data);
        }).then(function() {
            list_stock_refresh($("#select-project-2").val());
        });
    });
    $('#modal-project').on('shown.bs.modal', function(e) {
        list_project_refresh();
    });

    $("#btn-project-remove").click(function() {
        var pid = $("#projCode").val();
        bootbox.confirm("Are you sure you want to remove this project?", function(ans) {
            if (ans) {
                $.post("APP/SYS/CNT/project.php?a=remove", {
                    p: pid
                }, function(data) {
                    list_project_refresh();
                });
            }
        });
    });

    $(".btn-projInfo-edit").click(function() {
        var scope = this;
        var label = $(this).parents(".form-group").children("label").text();
        bootbox.prompt("New " + label, function(ans) {
            if (ans && ans.trim().length > 0) {
                var pid = $("#projCode").val();
                $.post("APP/SYS/CNT/project.php?a=editInfo", {
                    p: pid,
                    d: ans,
                    c: label
                },
                function(data) {
                    $(scope).parents(".input-group").children("input").val(ans);
                });
            }
        });
    });

    $('#modal-stock-new').on('show.bs.modal', function(e) {
        select_project_refresh();
        var d = new Date();
        $("#input-receive-date").val(d.toISOString().split("T")[0]);
        $("#table-stock-entry #row-stock-add").siblings().remove();

    });
    $('#modal-stock-new').on('hide.bs.modal', function(e) {
        $.post("APP/SYS/CNT/project.php?a=fetchSelect", function(data) {
            $("#select-project-2").html(data);
        }).then(function() {
            list_stock_refresh($("#select-project-2").val());
        });
    });
    $("#select-project-2").on('change', function() {
        list_stock_refresh($(this).val());
    })

    $('#modal-stock-entry').on('hidden.bs.modal',function(){

        // Reset Modal State
        $('#modal-stock-entry .modal-title').text('New Stock Entry');
        $('#modal-stock-entry #btn-stock-entry').removeClass('hidden');
        $('#modal-stock-entry #btn-stock-update').addClass('hidden');
        $('#modal-stock-entry').find('input,select').each(function(){ $(this).val('') });

    });

    $('#modal-stock-entry').on('show.bs.modal', function(e) {
        $.post("APP/SYS/CNT/item.php?a=fetchSelect", function(data) {
            $("#select-item").html(data);
            $("#select-edit-item").html(data);
        });
        $.post("APP/SYS/CNT/supplier.php?a=fetchSelect", function(data) {
            var sup = data.split('|');
            sup.push('-');
            $("#input-supplier").autocomplete({
                source: sup,
                messages: {
                    noResults: '',
                    results: function() {}
                }
            });
        });
        $("#input-totalprice").val((parseFloat($("#input-unitprice").val()) * parseFloat($("#input-quantity").val())).toFixed(2));
    });
    $('#modal-item-create').on('hide.bs.modal', function(e) {
        $.post("APP/SYS/CNT/item.php?a=fetchSelect", function(data) {
            $("#select-item").html(data);
            $("#select-edit-item").html(data);
        });

        $.post("APP/SYS/CNT/item.php?a=fetchTable", function(data) {
            $("#table-item-list tbody").html(data);
        });
    });

    $("#btn-item-create").click(function() {
        var code = $("#input-item-code").val().trim();
        var name = $("#input-item-name").val().trim();
        var desc = $("#input-item-desc").val().trim();
        var unit = $("#input-item-unit").val();
        var price = parseFloat($("#input-item-price").val());
        if (name.length && unit.length && price >= 0) {
            $(this).button('loading');
            $.post("APP/SYS/CNT/item.php?a=create", {
                c: code,
                n: name,
                u: unit,
                p: price,
                d: desc
            }, function(data) {
                if (data.trim().length > 0) bootbox.alert(data.trim());
                else {
                    list_project_refresh();
                    $("#modal-item-create").modal('hide');
                    resetForm("#form-project-create");
                }
                $("#btn-item-create").button('reset');
            });
        } else {
            bootbox.alert("Please complete filling up the form");
        }

    });

    $("#select-item").change(function() {
        var transType = $("#select-transaction").val();
        var itmcode = $(this).val();
        var projCode = $("#select-project").val();
        $.post("APP/SYS/CNT/item.php?a=getPrice", {
            i: itmcode,
            p: projCode
        }, function(data) {
            data = data.split("|");
            $("#input-unitprice").val(parseFloat(data[0])).trigger('change');
            $("#text-unit").text(data[1]);
            if (transType == 'ISSUE') {
                $("#input-quantity").attr("max", data[2]);
                if (data[2] == 0) {
                    $("#input-quantity").attr("min", data[2]).attr("value", data[2]);
                    $("#select-item").val(-1);
                    resetForm('#modal-stock-entry');
                    bootbox.alert("Sorry. We have no stocks left for this item.");
                }
            }
        });


    });
    $("#select-edit-item").change(function() {
        var itmcode = $(this).val();
        $.post("APP/SYS/CNT/item.php?a=getPrice", {
            i: itmcode
        }, function(data) {
            data = data.split("|");
            $("#input-edit-unitprice").val(parseFloat(data[0])).trigger('change');
            $("#text-edit-unit").text(data[1]);
        });
    });
    $("#input-unitprice").change(function() {
        $("#input-totalprice").val(parseFloat($("#input-unitprice").val() * $("#input-quantity").val()).toFixed(2));
    });
    $("#input-edit-unitprice").change(function() {
        $("#input-edit-totalprice").val(parseFloat($("#input-edit-unitprice").val() * $("#input-edit-quantity").val()).toFixed(2));
    });
    $("#input-quantity").change(function() {
        $("#input-totalprice").val(parseFloat($("#input-unitprice").val() * $("#input-quantity").val()).toFixed(2));
    });
    $("#input-edit-quantity").change(function() {
        $("#input-edit-totalprice").val(parseFloat($("#input-edit-unitprice").val() * $("#input-edit-quantity").val()).toFixed(2));
    });

    $("#btn-stock-entry").click(function() {
        var drnum = $("#input-drnum").val().trim();
        var quantity = $("#input-quantity").val();
        var unit = $("#text-unit").text();
        var itemCode = $("#select-item").val();
        var item = $("#select-item").find("option:nth-child(" + ($("#select-item")[0].selectedIndex + 1) + ")").text();
        var supplier = $("#input-supplier").val().trim();
        var price = parseFloat($("#input-unitprice").val());
        var totalprice = parseFloat($("#input-totalprice").val());
        if (drnum && quantity > 0 && itemCode != -1 && supplier && price >= 0) {
            $(this).button('loading');

            var dup = 0;
            $("#table-stock-entry").find("tr").each(function() {
                if (
                    $(this).children("td:nth-child(1)").text() == drnum &&
                    $(this).children("td:nth-child(4)").text() == item &&
                    $(this).children("td:nth-child(5)").text() == supplier &&
                    $(this).children("td:nth-child(6)").text() == price
                ) {
                    dup++;
                }
            });
            if (dup) {

                bootbox.dialog({
                    message: "A Duplicate Entry was found. Do you want to merge duplicate entries?",
                    title: "Duplicate Entry",
                    buttons: {
                        success: {
                            label: "Merge",
                            className: "btn-success",
                            callback: function() {
                                //Merge Entries
                                var dupFirst = 1;
                                var totalQty = quantity;
                                console.log(totalQty);
                                //Calculate Total Qty
                                $("#table-stock-entry").find("tr").each(function() {
                                    if (
                                        $(this).children("td:nth-child(1)").text() == drnum &&
                                        $(this).children("td:nth-child(4)").text() == item &&
                                        $(this).children("td:nth-child(5)").text() == supplier &&
                                        $(this).children("td:nth-child(6)").text() == price
                                    ) {
                                        totalQty = parseFloat(totalQty) + parseFloat($(this).children("td:nth-child(2)").text());
                                    }
                                });


                                console.log(totalQty);
                                //Edit the First Duplicate then Remove the rest
                                $("#table-stock-entry").find("tr").each(function() {
                                    if (
                                        $(this).children("td:nth-child(1)").text() == drnum &&
                                        $(this).children("td:nth-child(4)").text() == item &&
                                        $(this).children("td:nth-child(5)").text() == supplier &&
                                        $(this).children("td:nth-child(6)").text() == price
                                    ) {
                                        if (dupFirst == 1) {
                                            $(this).children("td:nth-child(2)").text(totalQty);
                                            $(this).children("td:nth-child(7)").text((price * totalQty));
                                            dupFirst = 0;
                                        } else {
                                            $(this).remove();
                                        }
                                    }
                                });

                                $("#modal-stock-entry").modal('hide');
                            }
                        },
                        warning: {
                            label: "Keep",
                            className: "btn-warning",
                            callback: function() {
                                //Continue Adding

                                $("<tr><td>" + drnum + "</td><td>" + quantity + "</td><td>" + unit + "</td><td rel='" + itemCode + "''>" + item + "</td><td>" + supplier + "</td><td>" + price + "</td><td>" + totalprice + "</td><td class='stock-action'>" + '<span class="btn-group hidden"> <button type="button" class="btn-stock-entry-edit btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit</button> <button type="button" class="btn-stock-entry-delete btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button> </span>' + "</td></tr>").insertBefore("#row-stock-add");

                                $("#modal-stock-entry").modal('hide');
                            }
                        },
                        danger: {
                            label: "Remove",
                            className: "btn-danger",
                            callback: function() {
                                //Remove Entry
                                resetForm("#modal-stock-entry");

                                $("#modal-stock-entry").modal('hide');
                            }
                        }
                    }
                });
            } else {
                $("<tr><td>" + drnum + "</td><td>" + quantity + "</td><td>" + unit + "</td><td rel='" + itemCode + "''>" + item + "</td><td>" + supplier + "</td><td>" + price + "</td><td>" + totalprice + "</td><td class='stock-action'>" + '<span class="btn-group hidden"> <button type="button" class="btn-stock-entry-edit btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit</button> <button type="button" class="btn-stock-entry-delete btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button> </span>' + "</td></tr>").insertBefore("#row-stock-add");

                $("#modal-stock-entry").modal('hide');
            }
        } else {
            bootbox.alert("Please complete filling up the form");
        }
        $("#btn-stock-entry").button("reset");
    });

    $("#btn-stock-edit").click(function() {
        var drnum = $("#input-edit-drnum").val().trim();
        var quantity = $("#input-edit-quantity").val();
        var unit = $("#text-edit-unit").text();
        var itemCode = $("#select-edit-item").val();
        var item = $("#select-edit-item").find("option:nth-child(" + ($("#select-edit-item")[0].selectedIndex + 1) + ")").text();
        var supplier = $("#input-edit-supplier").val().trim();
        var price = parseFloat($("#input-edit-unitprice").val());
        var totalprice = parseFloat($("#input-edit-totalprice").val());
        var row = $(this).data("row");
        if (drnum && quantity > 0 && itemCode && supplier && price >= 0) {
            $(this).button('loading');
            $("#table-stock-entry tbody tr:nth-child(" + (row + 1) + ")").html("<td>" + drnum + "</td><td>" + quantity + "</td><td>" + unit + "</td><td rel='" + itemCode + "''>" + item + "</td><td>" + supplier + "</td><td>" + price + "</td><td>" + totalprice + "</td><td class='stock-action'>" + '<span class="btn-group hidden"> <button type="button" class="btn-stock-entry-edit btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit</button> <button type="button" class="btn-stock-entry-delete btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button> </span>' + "</td>");
            $("#btn-stock-edit").button("reset");
            $("#modal-stock-edit").modal('hide');
        } else {
            bootbox.alert("Please complete filling up the form");
        }
    });


    $("#btn-stock-save").click(function() {
        var type = $("#select-transaction").val();
        var projId = $("#select-project").val();
        var date = $("#input-receive-date").val();
        if (projId != -1) {
            var info = [type, projId, date];
            var recs = [];
            var recCtr = 0;
            $("#table-stock-entry tbody").find("tr").each(function() {
                recs[recCtr++] = [
                    $(this).children("td:nth-child(1)").text(),
                    $(this).children("td:nth-child(2)").text(),
                    $(this).children("td:nth-child(3)").text(),
                    $(this).children("td:nth-child(4)").attr("rel"),
                    $(this).children("td:nth-child(5)").text(),
                    $(this).children("td:nth-child(6)").text()
                ];
            });

            if (recs.length > 1) {
                recs.pop();
                bootbox.confirm("<b>This cannot be undone</b><br> Are you sure you want to continue saving this transaction?", function(ans) {
                    if (ans) {
                        $("#btn-stock-save").button('loading');
                        $.post("APP/SYS/CNT/record.php?a=entry", {
                            i: info,
                            r: recs
                        }, function() {
                            $("#btn-stock-save").button('reset');
                            $('#modal-stock-new').modal('hide');
                        });
                    }
                });
            } else {
                bootbox.alert("Entry List Empty.");
            }
        } else {
            bootbox.alert("Please identify Project.");
        }
    });

    $("#modal-usage-graph").on('shown.bs.modal', function() {
        var logData = [];
        var qty = 0;
        var val = 0;
        var sign = '+';
        $("#table-stock-info tbody tr").each(function() {
            if ($(this).hasClass("success")) {
                val = parseFloat($(this).find("td:nth-child(4)").text());
                qty += val;
                sign = '+';
            } else if ($(this).hasClass("danger")) {
                val = parseFloat($(this).find("td:nth-child(9)").text());
                qty -= val;
                sign = '-';
            }
            var d = new Date($(this).find("td:nth-child(1)").text()).toDateString();
            var dates = d.split(" ");
            var label = dates[1] + '' + dates[2] + '(' + sign + val + ')';
            logData.push(label + "|" + qty);
        })

        var superData = {
            labels: [],
            datasets: [{
                fillColor: "rgba(160,28,67,0.5)",
                strokeColor: "rgba(160,28,67,1)",
                pointColor: "rgba(160,28,67,1)",
                pointStrokeColor: "#fff",
                data: []
            }]
        };
        var ctx = document.getElementById("genChart").getContext("2d");
        var count = logData.length;
        var interval = Math.floor(count / 20);
        if (interval < 1)
        interval = 1;
        var cnt = 0;

        superData.labels.push("");
        superData.datasets[0].data.push(0);
        while (cnt < count && logData[cnt]) {
            var lognow = logData[cnt];
            var logs = lognow.split("|");
            cnt += interval;
            superData.labels.push(logs[0]);
            superData.datasets[0].data.push(parseFloat(logs[1]));
        }

        if(typeof myNewChart != 'undefined') myNewChart.destroy();
        myNewChart = new Chart(ctx).Line(superData);
    });

    $("#btn-proj-stats").on('click', function() {
        $(this).button('loading');
        //
        var labels = [];

        var pcode = $("#projCode").val();
        $.post("APP/SYS/CNT/project.php?a=projStats", {
            p: pcode
        }, function(data) {
            if (data.trim().length > 0) {
                var r = data.split('#');
                var s = r[1];
                $("#table-statistics tbody").html(s);
                var d = r[0].split('&');
                var labels = d[0].split(',');
                var da = d[1].split('+');
                var dats1 = da[0].split('|');
                var dats2 = da[1].split('|');
                var dat0 = dats1[0].split(':');
                var dat1 = dats1[1].split(':');
                var dat2 = dats2[0].split(':');
                var dat3 = dats2[1].split(':');
                var dat4 = dats1[2].split(':');
                var dat5 = dats2[2].split(':');

                dat0 = dat0.map(function(a) {
                    return parseFloat(a);
                });
                dat1 = dat1.map(function(a) {
                    return parseFloat(a);
                });
                dat2 = dat2.map(function(a) {
                    return parseFloat(a);
                });
                dat3 = dat3.map(function(a) {
                    return parseFloat(a);
                });
                dat4 = dat4.map(function(a) {
                    return parseFloat(a);
                });
                dat5 = dat5.map(function(a) {
                    return parseFloat(a);
                });
                dat0.unshift(0);
                dat1.unshift(0);
                dat2.unshift(0);
                dat3.unshift(0);
                dat4.unshift(0);
                dat5.unshift(0);
                labels.unshift('Initial');
                var superData1 = {
                    labels: labels,
                    datasets: [
                        {
                            fillColor: "rgba(46,204,113,0.5)",
                            strokeColor: "#27ae60",
                            pointColor: "#27ae60",
                            pointStrokeColor: "#fff",
                            data: dat0,
                            label: "Received",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)"
                        }, {
                            fillColor: "rgba(231,76,60,0.5)",
                            strokeColor: "#c0392b",
                            pointColor: "#c0392b",
                            pointStrokeColor: "#fff",
                            data: dat1,
                            label: "Issued",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)"
                        }, {
                            fillColor: "rgba(52,152,219,0.2)",
                            strokeColor: "rgba(41,128,185,0.5)",
                            pointColor: "#2980b9",
                            pointStrokeColor: "#fff",
                            data: dat4,
                            label: "Balance",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)"
                        }
                    ]
                };
                var superData2 = {
                    labels: labels,
                    datasets: [
                        {
                            fillColor: "rgba(46,204,113,0.5)",
                            strokeColor: "#27ae60",
                            pointColor: "#27ae60",
                            pointStrokeColor: "#fff",
                            data: dat2,
                            label: "Received",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)"
                        }, {
                            fillColor: "rgba(231,76,60,0.5)",
                            strokeColor: "#c0392b",
                            pointColor: "#c0392b",
                            pointStrokeColor: "#fff",
                            data: dat3,
                            label: "Issued",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)"
                        }, {
                            fillColor: "rgba(52,152,219,0.2)",
                            strokeColor: "rgba(41,128,185,0.5)",
                            pointColor: "#2980b9",
                            pointStrokeColor: "#fff",
                            data: dat5,
                            label: "Balance",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)"
                        }
                    ]
                };
                var ctx1 = document.getElementById("genChart2").getContext("2d");
                var ctx2 = document.getElementById("genChart3").getContext("2d");
                if(typeof myNewChart1 != 'undefined') myNewChart1.destroy();
                if(typeof myNewChart2 != 'undefined') myNewChart2.destroy();

                myNewChart1 = new Chart(ctx1).Line(superData1,{
                    multiTooltipTemplate: "<%= datasetLabel %> - PHP <%= value %>"
                });
                myNewChart2 = new Chart(ctx2).Line(superData2,{
                    multiTooltipTemplate: "<%= datasetLabel %> - <%= value %> pcs"
                });
                $("#btn-proj-stats").button('reset');
                $("#modal-statistics-graph").modal('show');
            } else {
                $("#btn-proj-stats").button('reset');
                bootbox.alert("Unable to show Project Statistics. No stocks to Calculate.");
            }
        });

    });

    $("#form-stock-search").submit(function(event) {
        event.preventDefault();
        var data = $(this).serializeArray();
        $.post("APP/SYS/CNT/stock.php?a=search", {
            d: data
        }, function(data) {
            $("#table-stock-search tbody").html(data);
        });
    });

    $(".sorter").click(function() {
        $("input[name='sort']").val($(this).data("sort"));
        $("#form-stock-search").submit();
    });


    $("#btn-print-preview").click(function() {
        var pid = $("#select-project-2").val();
        var sid = $("#list-item").val();
        var df = $("#date-from").val();
        var dt = $("#date-to").val();
        var d = window.open("print?" + sid + "&" + df + "&" + dt + "&" + pid + "&stock", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=20, left=300, width=1000, height=600");
    });
    $("#btn-project-reports").click(function() {
        var pid = $("#projCode").attr("rel");
        $("#modal-print-report").modal('show');

        setTimeout(function() {
            $("#select-project-3").val(pid).trigger("change");
        }, 200);

    });
    //DELEGATES

    $("#list-project.list-group").delegate(".list-group-item", "click", function() {
        $(this).parent().find(".list-group-item.active").removeClass("active");
        $(this).addClass("active");
        list_project_info_refresh();
    });

    $("#list-item").on("change", function() {
        list_stock_info_refresh();

    });

    $("#table-stock-entry").delegate("tr", "mouseover", function() {
        $(this).find('.stock-action span').removeClass('hidden');
    });
    $("#table-stock-entry").delegate("tr", "mouseout", function() {
        $(this).find('.stock-action span').addClass('hidden');
    });
    $("#table-stock-entry").delegate(".stock-action span .btn-stock-entry-edit ", "click", function() {
        $("#input-edit-drnum").val($(this).parents("tr").children("td:nth-child(1)").text());
        $("#input-edit-quantity").val($(this).parents("tr").children("td:nth-child(2)").text());
        $("#text-edit-unit").text($(this).parents("tr").children("td:nth-child(3)").text());
        $("#select-edit-item").val($(this).parents("tr").children("td:nth-child(4)").attr("rel"));
        $("#input-edit-supplier").val($(this).parents("tr").children("td:nth-child(5)").text());
        $("#input-edit-unitprice").val($(this).parents("tr").children("td:nth-child(6)").text()).trigger('change');
        $("#modal-stock-edit").modal('show');
        $("#btn-stock-edit").attr("data-row", $(this).parents("tr").index());
    });
    $("#table-stock-entry").delegate(".stock-action span .btn-stock-entry-delete ", "click", function() {
        $(this).parents("tr").remove();
    });

    $("#table-stock-search tbody").delegate("button", "click", function() {
        var pid = $(this).data("proj");
        var itm = $(this).data("item");
        $("#select-project-2").val(pid).trigger('change');
        $("#modal-stock-search").modal('hide');
        setTimeout(function() {
            $("#list-item").val(itm).trigger('change');
        }, 200);
    });


    $('#modal-material').on('show.bs.modal', function(e) {
        $.post("APP/SYS/CNT/item.php?a=fetchTable", function(data) {
            $("#table-item-list tbody").html(data);
        });
    });


    $("#table-item-list").delegate("tr", "mouseover", function() {
        $(this).find('.item-action span').removeClass('hidden');
    });
    $("#table-item-list").delegate("tr", "mouseout", function() {
        $(this).find('.item-action span').addClass('hidden');
    });


    $("#table-item-list").delegate(".item-action span .btn-item-entry-edit ", "click", function() {
        $("#input-item-edit-name").val($(this).parents("tr").children("td:nth-child(2)").text());
        $("#input-item-edit-code").val($(this).parents("tr").children("td:nth-child(1)").text());
        $("#input-item-edit-desc").val($(this).parents("tr").children("td:nth-child(3)").text());
        $("#input-item-edit-price").val($(this).parents("tr").children("td:nth-child(5)").text());
        $("#input-item-edit-unit").val($(this).parents("tr").children("td:nth-child(4)").text());

        $("#modal-item-edit").modal('show');
        $("#btn-item-edit").attr("data-item", $(this).parents("tr").data("item"));
        $("#btn-item-edit").attr("data-code", $(this).parents("tr").children("td:nth-child(1)").text());
    });
    $("#table-item-list").delegate(".item-action span .btn-item-entry-delete ", "click", function() {
        var scope = this;

        bootbox.confirm("Are you sure you want to delete this item?", function(ans) {
            if (ans) {
                var code = $(scope).parents("tr").children("td:nth-child(1)").text();
                $.post("APP/SYS/CNT/item.php?a=delete", {
                    c: code
                }, function() {
                    $(scope).parents("tr").remove();
                });

            }
        });
    });

    $("#btn-item-edit").click(function() {
        var name = $("#input-item-edit-name").val().trim();
        var code = $("#input-item-edit-code").val().trim();
        var desc = $("#input-item-edit-desc").val().trim();
        var unit = $("#input-item-edit-unit").val().trim();
        var price = parseFloat($("#input-item-edit-price").val());
        var oldcode = $(this).data("code");
        var item = $(this).data("item");
        $(this).button('loading');
        if (name != '' && desc != '' && unit != '' && price > 0) {
            $.post("APP/SYS/CNT/item.php?a=edit", {
                n: name,
                c: code,
                d: desc,
                u: unit,
                p: price,
                o: oldcode,
                i: item
            }, function(data) {
                if (data.trim() == "0") {
                    bootbox.alert("Item Details already exist");
                } else {
                    $("#modal-item-edit").modal('hide');
                    $.post("APP/SYS/CNT/item.php?a=fetchTable", function(data) {
                        $("#table-item-list tbody").html(data);
                    });
                }
            });
            $(this).button('reset');
        } else {
            bootbox.alert("Please complete filling up the form.");
            $(this).button('reset');
        }
    });

    //FUNCTIONS

    function list_project_refresh() {
        $.post("APP/SYS/CNT/project.php?a=fetchList", function(data) {
            $("#list-project").html(data);
            list_project_info_refresh();
        });
    }

    function list_stock_refresh(pid) {
        $.post("APP/SYS/CNT/stock.php?a=fetchList", {
            p: pid
        }, function(data) {
            $("#list-item").html(data);
            list_stock_info_refresh();
        });
    }

    function list_project_info_refresh() {
        var active_id = $("#list-project").find(".list-group-item.active").data("project");
        if (active_id) {
            $.post("APP/SYS/CNT/project.php?a=fetchInfo", {
                p: active_id
            }, function(data) {
                var d = data.split("|");
                $("#projCode").val(d[0]);
                $("#projCode").attr("rel", d[4]);
                $("#projName").val(d[1]);
                $("#projLoc").val(d[2]);
                $("#projDesc").val(d[3]);
            });
        }
    }

    function list_stock_info_refresh() {
        var active_id = $("#list-item").val();
        var active_pid = $("#select-project-2").val();
        if (active_id != "-1") {
            $("#btn-print-preview").removeAttr('disabled');
            $("#usage-graph").removeAttr('disabled');
            $("#btn-save").removeAttr('disabled');


            $.post("APP/SYS/CNT/stock.php?a=fetchInfo", {
                s: active_id,
                p: active_pid
            }, function(data) {
                var rqty = 0;
                var ramt = 0;
                var iqty = 0;
                var iamt = 0;
                $("#table-stock-info tbody").html(data);
                $("#table-stock-info tbody").find("tr.success").each(function() {
                    rqty += parseFloat($(this).children("td:nth-child(4)").text());
                    ramt += parseFloat($(this).children("td:nth-child(6)").text());
                });
                $("#table-stock-info tbody").find("tr.danger").each(function() {
                    iqty += parseFloat($(this).children("td:nth-child(9)").text());
                    iamt += parseFloat($(this).children("td:nth-child(11)").text());
                });
                var ttl = '<tr><td>' + rqty + '</td><td>' + ramt + '</td><td>' + iqty + '</td><td>' + iamt + '</td><td>' + (rqty - iqty) + '</td><td>' + (ramt - iamt).toFixed(2) + '</td></tr>';
                $("#table-stock-info tfoot td:nth-child(4)").text(rqty);
                $("#table-stock-info tfoot td:nth-child(6)").text(ramt.toFixed(2));
                $("#table-stock-info tfoot td:nth-child(9)").text(iqty);
                $("#table-stock-info tfoot td:nth-child(11)").text(iamt.toFixed(2));
                $("#table-stock-total tbody").html(ttl);

                $.post("APP/SYS/CNT/stock.php?a=getDates", {
                    s: active_id
                }, function(data) {
                    var d = data.split("|");
                    var mind = d[0];
                    var maxd = d[1];

                    $("#date-from").datepicker({
                        defaultDate: mind,
                        showOtherMonths: true,
                        selectOtherMonths: true,
                        onSelect: function(selected) {
                            $("#date-to").datepicker("option", "minDate", selected);
                            updateStock();
                        },
                        showAnim: "slideDown",
                        altField: "#alt-from1",
                        altFormat: "MM d, yy"
                    });
                    $("#date-to").datepicker({
                        defaultDate: maxd,
                        showOtherMonths: true,
                        selectOtherMonths: true,
                        onSelect: function(selected) {
                            $("#date-from").datepicker("option", "maxDate", selected);
                            updateStock();
                        },
                        showAnim: "slideDown",
                        altField: "#alt-to1",
                        altFormat: "MM d, yy"
                    });


                    $("#date-from").datepicker("option", "minDate", mind);
                    $("#date-from").datepicker("option", "maxDate", maxd);

                    $("#date-to").datepicker("option", "minDate", mind);
                    $("#date-to").datepicker("option", "maxDate", maxd);

                    $("#date-from").val(mind);
                    $("#date-to").val(maxd);
                });

            });
        } else {
            $("#btn-print-preview").attr('disabled', 'disabled');
            $("#usage-graph").attr('disabled', 'disabled');
            $("#btn-save").attr('disabled', 'disabled');
            $("#table-stock-info tbody").html('<tr><td colspan="11" class="text-center">Nothing to display</td></tr>');
            $("#date-from").val("").datepicker("option", "disabled", true);
            $("#date-to").val("").datepicker("option", "disabled", true);

            $("#table-stock-info tfoot td:nth-child(4)").text("-");
            $("#table-stock-info tfoot td:nth-child(6)").text("-");
            $("#table-stock-info tfoot td:nth-child(9)").text("-");
            $("#table-stock-info tfoot td:nth-child(11)").text("-");
            $("#table-stock-total tbody").html('<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>');
        }
    }

    function updateStock() {
        var s = $("#date-from").val();
        var e = $("#date-to").val();
        var start = (s == "") ? new Date($("#date-from").datepicker("option", "minDate")) : new Date(s);
        var end = (e == "") ? new Date($("#date-to").datepicker("option", "maxDate")) : new Date(e);
        var thisDate = new Date();
        var rqty = 0;
        var ramt = 0;
        var iqty = 0;
        var iamt = 0;
        $("#table-stock-info tbody tr").each(function() {
            thisDate = new Date($(this).children("td:nth-child(1)").text());
            thisDate = new Date(thisDate.toLocaleDateString());
            if ((start <= thisDate) && (thisDate <= end)) {
                $(this).removeClass("hidden");
                if ($(this).hasClass('success')) {
                    rqty += parseFloat($(this).children("td:nth-child(4)").text());
                    ramt += parseFloat($(this).children("td:nth-child(6)").text());
                }

                if ($(this).hasClass('danger')) {
                    iqty += parseFloat($(this).children("td:nth-child(9)").text());
                    iamt += parseFloat($(this).children("td:nth-child(11)").text());
                }

            } else $(this).addClass("hidden");
        });


        var ttl = '<tr><td>' + rqty + '</td><td>' + ramt + '</td><td>' + iqty + '</td><td>' + iamt + '</td><td>' + (rqty - iqty) + '</td><td>' + (ramt - iamt).toFixed(2) + '</td></tr>';
        $("#table-stock-info tfoot td:nth-child(4)").text(rqty);
        $("#table-stock-info tfoot td:nth-child(6)").text(ramt.toFixed(2));
        $("#table-stock-info tfoot td:nth-child(9)").text(iqty);
        $("#table-stock-info tfoot td:nth-child(11)").text(iamt.toFixed(2));
        $("#table-stock-total tbody").html(ttl);
    }

    function select_project_refresh() {
        $.post("APP/SYS/CNT/project.php?a=fetchSelect", function(data) {
            $("#select-project").html(data);
        });
    }

    $('#table-stock-info').delegate('.btn-record-edit','click',function(){
        var record_id = $(this).closest('tr').data('id');
        var record_obj = $(this).closest('tr').data('object');

        $('#input-drnum').val(record_obj.rec_rnum);
        $('#input-quantity').val(record_obj.itm_qty);

        setTimeout(function(){
            $('#select-item').find('option[value="'+record_obj.itm_code+'"]').first().attr('selected','selected');
        },1000);

        $('#input-supplier').val(record_obj.itm_sup);
        $('#input-unitprice').val(record_obj.itm_price);
        $('#input-totalprice').val((record_obj.itm_price) * (record_obj.itm_qty));

        $('#modal-stock-entry .modal-title').text('Edit Stock Entry');
        $('#modal-stock-entry #btn-stock-entry').addClass('hidden');
        $('#modal-stock-entry #btn-stock-update').data('id',record_obj.rec_id);
        $('#modal-stock-entry #btn-stock-update').data('date',record_obj.rec_date);
        $('#modal-stock-entry #btn-stock-update').data('type',record_obj.rec_type);
        $('#modal-stock-entry #btn-stock-update').removeClass('hidden');
        $('#select-project-4').html($('#select-project-2').html());
        $('#modal-stock-entry').modal('show');
    });


    $('#table-stock-info').delegate('.btn-record-delete','click',function(){
        var record_id = $(this).closest('tr').data('id');
        var record_obj = $(this).closest('tr').data('object');
        bootbox.confirm("Are you sure you want to delete this record?", function(ans) {
            if (ans) {
                $.post("APP/SYS/CNT/record.php?a=delete", {
                    i: record_id,
                    r: record_obj,
                }, function(data) {
                    list_stock_refresh($("#select-project-2").val());
                });
            }
        });
    });

    $('#btn-stock-update').click(function(){
        var rec_id = $(this).data('id');
        var record = [];
        record = [
            $('#input-drnum').val(),
            $('#input-quantity').val(),
            $('#select-item').val(),
            $('#input-supplier').val(),
            $('#input-unitprice').val(),
            $("#select-project-4").val(),
            $(this).data('date'),
            $(this).data('type'),
        ];
        if(rec_id!==''){
            $("#btn-stock-update").button('loading');
            $.post("APP/SYS/CNT/record.php?a=update", {
                i: rec_id,
                r: record
            }, function() {
                $("#btn-stock-update").button('reset');
                list_stock_refresh($("#select-project-2").val());
                $('#modal-stock-entry').modal('hide');
            });
        }

    });
});
