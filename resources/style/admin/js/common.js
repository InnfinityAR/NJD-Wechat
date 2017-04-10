$(function () {
    // 删除单条记录
    $(".del").click(function () {
        var id = $(this).attr("id");
        layer.confirm("确认删除此信息吗？", {btn: ["确定", "取消"]}, function () {
            var data = {};
            data["_token"] = csrf_token;
            data["id"] = id;
            data["_method"] = "delete";
            console.log(data);
            $.ajax({
                type: "post",
                url: "/"+admin_prefix+"/" + controller + "/" + id,
                data: data,
                success: function (res) {
                    console.log(res);
                    if (res.status == 1) {
                        layer.msg("删除成功!", {icon: 6});
                        setTimeout(function () {
                            location.href = location.href;
                        }, 1000);
                    } else {
                        layer.msg(data.msg, {icon: 5});
                    }
                }
            });
        });

    });

    // 提交新增表单
    $(".createSubmit").click(function () {
        var data = new FormData($("#form")[0]);
        data.append("_token",csrf_token);
        $("a").attr("disabled", "true");
        var url = $(this).parents("form").attr("action");
        if (!url) {
            url = "/"+admin_prefix+"/" + controller;
        }
        $.ajax({
            type: "post",
            data: data,
            contentType: false,
            processData: false,  
            url: url,
            success: function (res) {
                if (res.status) {
                    $(".alert").addClass("alert-success");
                    $(".alert").find(".alert-msg").html(res.msg);
                    $(".alert").removeClass("hide");
                    setTimeout(function () {
                        location.href = "/"+admin_prefix+"/" + controller;
                    }, 1000);
                } else {
                    $(".alert").addClass("alert-danger");
                    $(".alert").find(".alert-msg").html(res.msg);
                    $(".alert").find(".alert-tip").html("");
                    $(".alert").removeClass("hide");
                    setTimeout(function () {
                        $(".alert").fadeOut();
                    }, 2000);
                }
            }
        });
    });

    // 提交修改表单
    $(".editSubmit").click(function () {
        $("a").attr("disabled", "true");
        var data = new FormData($("#form")[0]);
        
        data.append("_token", csrf_token);
        data.append("_method", "put");
        var id = $(this).attr("id");
        var url = $(this).parents("form").attr("action");
        if (!url) {
            url = "/"+admin_prefix+"/" + controller + "/" + id;
        }
        $.ajax({
            type: "post",
            data: data,
            contentType: false,
            processData: false,  
            url: url,
            success: function (res) {
                if (res.status) {
                    $(".alert").addClass("alert-success");
                    $(".alert").find(".alert-msg").html(res.msg);
                    $(".alert").removeClass("hide");
                    setTimeout(function () {
                        location.href = "/"+admin_prefix+"/" + controller;
                    }, 1000);
                } else {
                    $(".alert").addClass("alert-danger");
                    $(".alert").find(".alert-msg").html(res.msg);
                    $(".alert").find(".alert-tip").html("");
                    $(".alert").removeClass("hide");
                    setTimeout(function () {
                        $(".alert").fadeOut();
                    }, 2000);
                }
            }
        });
    });

    // 回车事件
    $(document).keydown(function (event) {
        if (event.keyCode == 13) { //绑定回车 
            $('.editSubmit').click();
            $('.createSubmit').click();
        }
    });

    // 回车搜索
    $("#search-input").focus(function () {
        $(document).keydown(function (event) {
            if (event.keyCode == 13) { //绑定回车 
                var search = $("#search-input").val();
                location.href = "/"+admin_prefix+"/" + controller + "?search=" + search;
            }
        });
    });

    // 全选
    $(".checkAll").click(function () {
        if ($(this).is(":checked")) {
            $(".checkAll").parents(".table").find("tbody").find(".check-input").find("input").prop("checked", "checked");
        } else {
            $(".checkAll").parents(".table").find("tbody").find(".check-input").find("input").removeAttr("checked");
        }
    });

    //　批量删除
    $(".deleteAll").click(function () {
        var checkboxes = $(".table").find("tbody").find(".check-input").find("input:checked");
        if (checkboxes.length == 0) {
            layer.msg("请选择要删除的记录");
        } else {
            var data = {};
            var ids = [];

            checkboxes.each(function (k, v) {
                ids.push($(v).attr("id"));
            });
            data["_token"] = csrf_token;
            data["_method"] = "delete";
            var url = "/"+admin_prefix+"/" + controller + "/" + ids;
            layer.confirm("确定要删除这些记录吗？", {btn: ["确定", "取消"]}, function () {
                $.ajax({
                    type: "post",
                    url: url,
                    data: data,
                    success: function (res) {
                        if (res) {
                            layer.msg("删除成功!", {icon: 6});
                            setTimeout(function () {
                                location.href = location.href;
                            }, 1000);
                        } else {
                            layer.msg("删除失败", {icon: 5});
                        }
                    }
                });
            })

        }

    });

    // 退出登录
    $(".logout").click(function () {
        layer.confirm("确认退出当前账号?", {btn: ["确定", "取消"]}, function () {
            location.href = "/"+admin_prefix+"/logout";
        });
    });
})