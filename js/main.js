/* compressed js code              */
/* this is just for our demo       */
/* save time and buy the theme ;-) */
/* copyright by creativemilk       */ (function (a, b, c, d) {
    a.fn.powerWidgets = function (e) {
        e = a.extend({}, a.fn.powerWidgets.options, e);
        return this.each(function () {
            function f(a) {
                if (A === true) {
                    a.parents(o).find(".powerwidget-loader").stop(true, true).fadeIn(100).delay(B).fadeOut(100)
                }
            }
            function g() {
                if (a("#powerwidget-fullscreen-mode").length) {
                    var c = a(b).height();
                    var d = a("#powerwidget-fullscreen-mode").find(o).children("header").height();
                    a("#powerwidget-fullscreen-mode").find(o).children("div").height(c - d - D)
                }
            }
            function h() {
                if (localStorage && q) {
                    var b = [];
                    j.find(o).each(function () {
                        var c = {};
                        c["id"] = a(this).attr("id");
                        c["style"] = a(this).attr("data-widget-attstyle");
                        c["title"] = a(this).children("header").children("h2").text();
                        c["hidden"] = a(this).is(":hidden") ? 1 : 0;
                        c["collapsed"] = a(this).hasClass("powerwidget-collapsed") ? 1 : 0;
                        b.push(c)
                    });
                    var c = JSON.stringify({
                        widget: b
                    });
                    if (bb != c) {
                        localStorage.setItem(ab, c)
                    }
                }
            }
            function i() {
                if (localStorage && q) {
                    var b = [];
                    j.find(p + ".sortable-grid").each(function () {
                        var c = [];
                        a(this).children(o).each(function () {
                            var b = {};
                            b["id"] = a(this).attr("id");
                            c.push(b)
                        });
                        var d = {
                            section: c
                        };
                        b.push(d)
                    });
                    var c = JSON.stringify({
                        grid: b
                    });
                    if (db != c) {
                        localStorage.setItem(cb, c)
                    }
                }
            }
            var j = a(this);
            var k = j.attr("id");
            var l = ".powerwidget-ctrls";
            var m = j.find(e.widgets);
            var n = j.find(e.widgets + " > header");
            var o = e.widgets;
            var p = e.grid;
            var q = e.localStorage;
            var r = e.deleteSettingsKey;
            var s = e.settingsKeyLabel;
            var t = e.deletePositionKey;
            var u = e.positionKeyLabel;
            var v = e.sortable;
            var w = e.editPlaceholder;
            var x = e.editSpeed;
            var y = e.buttonOrder;
            var z = e.buttonsHidden;
            var A = e.indicator;
            var B = e.indicatorTime;
            var C = e.toggleSpeed;
            var D = e.fullscreenDiff;
            var E = e.labelDelete;
            var F = e.deleteSpeed;
            var G = e.placeholderClass;
            var H = e.opacity;
            var I = e.dragHandle;
            var J = e.ajax;
            var K = e.loadingLabel;
            var L = e.timestampFormat;
            var M = e.timestampPlaceholder;
            var N = e.refreshButton;
            var O = e.refreshButtonClass;
            var P = e.labelError;
            var Q = e.labelRefresh;
            var R = e.deleteClass;
            var S = e.toggleClass.split("|");
            var T = e.editClass.split("|");
            var U = e.fullscreenClass.split("|");
            var V = e.customClass.split("|");
            var W = e.toggleButton;
            var X = e.customButton;
            var Y = e.deleteButton;
            var Z = e.editButton;
            var $ = e.fullscreenButton;
            var _ = e.rtl;
            if (localStorage && q) {
                var ab = "powerwidgets_settings_" + location.pathname + "_" + k;
                var bb = localStorage.getItem(ab);
                var cb = "powerwidgets_position_" + location.pathname + "_" + k;
                var db = localStorage.getItem(cb)
            }
            if (!k.length) {
                alert("It looks like your using a class instead of an ID, dont do that!")
            }
            if (_ === true) {
                a("body").addClass("rtl")
            }
            a(p).each(function () {
                if (a(this).children(o).length) {
                    a(this).addClass("sortable-grid")
                }
            });
            if ("ontouchstart" in b || b.DocumentTouch && c instanceof DocumentTouch) {
                var eb = "click tap"
            } else {
                var eb = "click"
            }
            if (localStorage && q && db) {
                var fb = JSON.parse(db);
                for (var gb in fb.grid) {
                    var hb = j.find(p + ".sortable-grid").eq(gb);
                    for (var ib in fb.grid[gb].section) {
                        hb.append(a("#" + fb.grid[gb].section[ib].id))
                    }
                }
            }
            if (localStorage && q && bb) {
                var jb = JSON.parse(bb);
                for (var gb in jb.widget) {
                    var kb = a("#" + jb.widget[gb].id);
                    if (jb.widget[gb].style) {
                        kb.addClass(jb.widget[gb].style).attr("data-widget-attstyle", "" + jb.widget[gb].style + "")
                    }
                    if (jb.widget[gb].hidden == 1) {
                        kb.hide(1)
                    } else {
                        kb.show(1).removeAttr("data-widget-hidden")
                    }
                    if (jb.widget[gb].collapsed == 1) {
                        kb.addClass("powerwidget-collapsed").children("div").hide(1)
                    }
                    if (kb.children("header").children("h2").text() != jb.widget[gb].title) {
                        kb.children("header").children("h2").text(jb.widget[gb].title)
                    }
                }
            }
            m.each(function () {
                var b = a(this).children("header");
                if (a(this).data("widget-hidden") === true) {
                    a(this).hide()
                }
                if (a(this).data("widget-collapsed") === true) {
                    a(this).addClass("powerwidget-collapsed").children("div").hide()
                }
                if (a(this).data("widget-icon")) {
                    b.prepend('<span class="powerwidget-icon"/>').children().addClass(a(this).data("widget-icon"))
                }
                if (X === true && a(this).data("widget-custombutton") === d) {
                    var c = '<a href="#" class="button-icon powerwidget-custom-btn"><span class="' + V[0] + '"></span></a>'
                } else {
                    c = ""
                }
                if (Y === true && a(this).data("widget-deletebutton") === d) {
                    var e = '<a href="#" class="button-icon powerwidget-delete-btn"><span class="' + R + '"></span></a>'
                } else {
                    e = ""
                }
                if (Z === true && a(this).data("widget-editbutton") === d) {
                    var f = '<a href="#" class="button-icon powerwidget-edit-btn"><span class="' + T[0] + '"></span></a>'
                } else {
                    f = ""
                }
                if ($ === true && a(this).data("widget-fullscreenbutton") === d) {
                    var g = '<a href="#" class="button-icon powerwidget-fullscreen-btn"><span class="' + U[0] + '"></span></a>'
                } else {
                    g = ""
                }
                if (W === true && a(this).data("widget-togglebutton") === d) {
                    if (a(this).data("widget-collapsed") === true || a(this).hasClass("powerwidget-collapsed")) {
                        var h = S[1]
                    } else {
                        h = S[0]
                    }
                    var i = '<a href="#" class="button-icon powerwidget-toggle-btn"><span class="' + h + '"></span></a>'
                } else {
                    i = ""
                }
                if (N === true && a(this).data("widget-refreshbutton") != false && a(this).data("widget-load")) {
                    var j = '<a href="#" class="button-icon powerwidget-refresh-btn"><span class="' + O + '"></span></a>'
                } else {
                    j = ""
                }
                var k = y.replace(/%refresh%/g, j).replace(/%delete%/g, e).replace(/%custom%/g, c).replace(/%fullscreen%/g, g).replace(/%edit%/g, f).replace(/%toggle%/g, i);
                if (j != "" || e != "" || c != "" || g != "" || f != "" || i != "") {
                    b.append('<div class="powerwidget-ctrls">' + k + "</div>")
                }
                if (v === true && a(this).data("widget-sortable") === d) {
                    a(this).addClass("powerwidget-sortable")
                }
                if (a(this).find(w).length) {
                    a(this).find(w).find("input").val(b.children("h2").text())
                }
                a(this).attr("role", "widget").children("div").attr("role", "content").prev("header").attr("role", "heading").children("div").attr("role", "menu")
            });
            if (z === true) {
                a(l).hide();
                n.hover(function () {
                    a(this).children(l).stop(true, true).fadeTo(100, 1)
                }, function () {
                    a(this).children(l).stop(true, true).fadeTo(100, 0)
                })
            }
            n.append('<span class="powerwidget-loader"/>');
            m.on(eb, ".powerwidget-toggle-btn", function (b) {
                f(a(this));
                if (a(this).parents(o).hasClass("powerwidget-collapsed")) {
                    a(this).children().removeClass(S[1]).addClass(S[0]).parents(o).removeClass("powerwidget-collapsed").children("div:first").slideDown(C, function () {
                        h()
                    })
                } else {
                    a(this).children().removeClass(S[0]).addClass(S[1]).parents(o).addClass("powerwidget-collapsed").children("div:first").slideUp(C, function () {
                        h()
                    })
                }
                if (typeof e.onToggle == "function") {
                    e.onToggle.call(this)
                }
                b.preventDefault()
            });
            m.on(eb, ".powerwidget-fullscreen-btn", function (b) {
                var c = a(this).parents(o);
                var d = c.children("div");
                f(a(this));
                if (a("#powerwidget-fullscreen-mode").length) {
                    a(".nooverflow").removeClass("nooverflow");
                    c.unwrap("<div>").children("div").removeAttr("style").end().find(".powerwidget-fullscreen-btn").children().removeClass(U[1]).addClass(U[0]).parents(l).children("a").show();
                    if (d.hasClass("powerwidget-visible")) {
                        d.hide().removeClass("powerwidget-visible")
                    }
                } else {
                    a("body").addClass("nooverflow");
                    c.wrap('<div id="powerwidget-fullscreen-mode"/>').parent().find(".powerwidget-fullscreen-btn").children().removeClass(U[0]).addClass(U[1]).parents(l).children("a:not(.powerwidget-fullscreen-btn)").hide();
                    if (d.is(":hidden")) {
                        d.show().addClass("powerwidget-visible")
                    }
                }
                g();
                if (typeof e.onFullscreen == "function") {
                    e.onFullscreen.call(this)
                }
                b.preventDefault()
            });
            a(b).resize(function () {
                g()
            });
            m.on(eb, ".powerwidget-edit-btn", function (b) {
                f(a(this));
                if (a(this).parents(o).find(w).is(":visible")) {
                    a(this).children().removeClass(T[1]).addClass(T[0]).parents(o).find(w).slideUp(x, function () {
                        h()
                    })
                } else {
                    a(this).children().removeClass(T[0]).addClass(T[1]).parents(o).find(w).slideDown(x)
                }
                if (typeof e.onEdit == "function") {
                    e.onEdit.call(this)
                }
                b.preventDefault()
            });
            a(w).find("input").keyup(function () {
                a(this).parents(o).children("header").children("h2").text(a(this).val())
            });
            m.on(eb, "[data-widget-setstyle]", function (b) {
                var c = a(this).data("widget-setstyle");
                var d = "";
                a(this).parents(w).find("[data-widget-setstyle]").each(function () {
                    d += a(this).data("widget-setstyle") + " "
                });
                a(this).parents(o).attr("data-widget-attstyle", "" + c + "").removeClass(d).addClass(c);
                f(a(this));
                h();
                b.preventDefault()
            });
            m.on(eb, ".powerwidget-custom-btn", function (b) {
                f(a(this));
                if (a(this).children("." + V[0]).length) {
                    a(this).children().removeClass(V[0]).addClass(V[1]);
                    if (typeof e.customStart == "function") {
                        e.customStart.call(this)
                    }
                } else {
                    a(this).children().removeClass(V[1]).addClass(V[0]);
                    if (typeof e.customEnd == "function") {
                        e.customEnd.call(this)
                    }
                }
                h();
                b.preventDefault()
            });
            m.on(eb, ".powerwidget-delete-btn", function (b) {
                var c = a(this).parents(o).attr("id");
                var d = a(this).parents(o).children("header").children("h2").text();
                var g = confirm(E + ' "' + d + '"');
                if (g) {
                    f(a(this));
                    a("#" + c).fadeOut(F, function () {
                        a(this).remove();
                        if (typeof e.onDelete == "function") {
                            e.onDelete.call(this)
                        }
                    })
                }
                b.preventDefault()
            });
            if (v === true) {
                var lb = j.find(".sortable-grid").not("[data-widget-excludegrid]");
                lb.sortable({
                    items: lb.find(".powerwidget-sortable").not(""),
                    connectWith: lb,
                    placeholder: G,
                    cursor: "move",
                    revert: true,
                    opacity: H,
                    delay: 200,
                    cancel: ".button-icon, #powerwidget-fullscreen-mode > div",
                    zIndex: 1e4,
                    handle: I,
                    forcePlaceholderSize: true,
                    forceHelperSize: true,
                    stop: function (a, b) {
                        f(b.item.children());
                        i()
                    }
                })
            }
            if (J === true) {
                function mb(a) {
                    var b = new Date(a);
                    c = b.getMonth() + 1;
                    d = b.getDate();
                    tsYear = b.getFullYear();
                    e = b.getHours();
                    f = b.getMinutes();
                    g = b.getUTCSeconds();
                    if (c < 10) {
                        var c = "0" + c
                    }
                    if (d < 10) {
                        var d = "0" + d
                    }
                    if (e < 10) {
                        var e = "0" + e
                    }
                    if (f < 10) {
                        var f = "0" + f
                    }
                    if (g < 10) {
                        var g = "0" + g
                    }
                    var h = L.replace(/%d%/g, d).replace(/%m%/g, c).replace(/%y%/g, tsYear).replace(/%h%/g, e).replace(/%i%/g, f).replace(/%s%/g, g);
                    return h
                }
                function nb(b, c, d, g, h) {
                    b.find(".powerwidget-ajax-placeholder").load(c, function (b, c, d) {
                        if (c == "error") {
                            a(this).html('<div class="inner-spacer">' + P + "<b>" + d.status + " " + d.statusText + "</b></div>")
                        }
                        if (c == "success") {
                            var f = a(this).parents(o).find(M);
                            if (f.length) {
                                f.html(mb(new Date))
                            }
                            if (typeof e.afterLoad == "function") {
                                e.afterLoad.call(this)
                            }
                        }
                    });
                    f(d);
                    return true
                }
                j.find("[data-widget-load]").each(function () {
                    var b = a(this);
                    var c = b.data("widget-load");
                    var d = b.data("widget-timestamp");
                    var e = b.data("widget-refreshbutton");
                    var f = b.data("widget-refresh") * 1e3;
                    var g = b.children();
                    b.children("div:first").append('<div class="powerwidget-ajax-placeholder"><span style="margin:10px">' + K + "</span></div>");
                    nb(b, c, b, d, e);
                    if (b.data("widget-refresh") > 0) {
                        setInterval(function () {
                            nb(b, c, g, d, e)
                        }, f)
                    } else {
                        nb(b, c, g, d, e)
                    }
                });
                m.on(eb, ".powerwidget-refresh-btn", function (b) {
                    var c = a(this).parents(o);
                    var d = c.data("widget-load");
                    var e = c.children();
                    var f = c.data("widget-timestamp");
                    var g = c.data("widget-refreshbutton");
                    nb(c, d, e, f, g);
                    b.preventDefault()
                })
            }
            a("body").on(eb, r, function (a) {
                if (localStorage && q) {
                    var b = confirm(s);
                    if (b) {
                        localStorage.removeItem(ab)
                    }
                }
                a.preventDefault()
            });
            a("body").on(eb, t, function (a) {
                if (localStorage && q) {
                    var b = confirm(u);
                    if (b) {
                        localStorage.removeItem(cb)
                    }
                }
                a.preventDefault()
            });
            if (localStorage && q) {
                if (bb === null || bb.length < 1) {
                    h()
                }
                if (db === null || db.length < 1) {
                    i()
                }
            }
        })
    };
    a.fn.powerWidgets.options = {
        grid: "",
        widgets: ".powerwidget",
        localStorage: true,
        deleteSettingsKey: "",
        settingsKeyLabel: "Reset settings?",
        deletePositionKey: "",
        positionKeyLabel: "Reset position?",
        sortable: true,
        buttonsHidden: false,
        toggleButton: true,
        toggleClass: "min-10 | plus-10",
        toggleSpeed: 200,
        onToggle: function () {},
        deleteButton: true,
        deleteClass: "trashcan-10",
        deleteSpeed: 200,
        onDelete: function () {},
        editButton: true,
        editPlaceholder: "",
        editClass: "pencil-10 | delete-10",
        editSpeed: 200,
        onEdit: function () {},
        fullscreenButton: true,
        fullscreenClass: "fullscreen-10 | normalscreen-10",
        fullscreenDiff: 3,
        onFullscreen: function () {},
        customButton: true,
        customClass: "",
        customStart: function () {},
        customEnd: function () {},
        buttonOrder: "%refresh% %delete% %custom% %edit% %fullscreen% %toggle%",
        opacity: 1,
        dragHandle: "> header",
        placeholderClass: "powerwidget-placeholder",
        indicator: true,
        indicatorTime: 600,
        ajax: true,
        loadingLabel: "loading...",
        timestampPlaceholder: "",
        timestampFormat: "Last update: %m%/%d%/%y% %h%:%i%:%s%",
        refreshButton: true,
        refreshButtonClass: "refresh-10",
        labelError: "Sorry but there was a error:",
        labelUpdated: "Last Update:",
        labelRefresh: "Refresh",
        labelDelete: "Delete widget:",
        afterLoad: function () {},
        rtl: false
    }
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.powerWidgetsPanel = function (d) {
        d = a.extend({}, a.fn.powerWidgetsPanel.options, d);
        return this.each(function () {
            function e() {
                if (localStorage && k) {
                    var b = [];
                    h.find(j).each(function () {
                        var c = {};
                        c["id"] = a(this).attr("id");
                        c["style"] = a(this).attr("data-widget-attstyle");
                        c["title"] = a(this).children("header").children("h2").text();
                        c["hidden"] = a(this).is(":hidden") ? 1 : 0;
                        c["collapsed"] = a(this).hasClass("powerwidget-collapsed") ? 1 : 0;
                        b.push(c)
                    });
                    var c = JSON.stringify({
                        widget: b
                    });
                    if (s != c) {
                        localStorage.setItem(r, c)
                    }
                }
            }
            var f = a(this);
            var g = a(d.target).attr("id");
            var h = a(d.target);
            var i = d.trigger;
            var j = d.widgets;
            var k = d.localStorage;
            var l = d.effectWidget;
            var m = d.speedWidget;
            var n = d.triggerClass;
            var o = d.effectPanel;
            var p = d.speedPanel;
            var q = "powerwidgets-panel-active";
            if (localStorage && k) {
                var r = "powerwidgets_settings_" + location.pathname + "_" + g;
                var s = localStorage.getItem(r)
            }
            if (!g.length) {
                alert("You are using a class instead of an ID, Please change this!")
            }
            if ("ontouchstart" in b || b.DocumentTouch && c instanceof DocumentTouch) {
                var t = "click tap"
            } else {
                var t = "click"
            }
            if (localStorage && k && s) {
                var u = JSON.parse(s);
                for (var v in u.widget) {
                    var w = f.find('[data-widget-id="' + u.widget[v].id + '"]');
                    if (u.widget[v].hidden == 1) {
                        w.addClass(q).find("[type=checkbox]").removeAttr("checked")
                    } else {
                        w.find("[type=checkbox]").attr("checked", "checked")
                    }
                }
            }
            f.find("input").each(function () {
                var b = "pwlabels-" + Math.floor(Math.random() * 999);
                if (a(this).attr("id")) {
                    var c = a(this).attr("id")
                } else {
                    c = b
                }
                if (a(this).prev("label")) {
                    a(this).attr("id", c).prev("label").attr("for", c)
                }
                if (a(this).next("label")) {
                    a(this).attr("id", c).next("label").attr("for", c)
                }
            });
            f.find("[data-widget-id]").on(t, ".e-checkbox", function (b) {
                var c = a(this).parents("[data-widget-id]");
                var f = a("#" + c.data("widget-id"));
                if (c.hasClass(q)) {
                    c.removeClass(q)
                } else {
                    c.addClass(q)
                }
                if (f.is(":hidden")) {
                    if (l == "fade") {
                        var g = "fadeIn"
                    } else {
                        g = "slideDown"
                    }
                } else {
                    if (l == "fade") {
                        var g = "fadeOut"
                    } else {
                        g = "slideUp"
                    }
                }
                f[g](m, function () {
                    e()
                });
                if (typeof d.onToggle == "function") {
                    d.onToggle.call(this)
                }
                return false
            });
            a("body").on(t, i, function (b) {
                var c = n.split("|");
                if (f.is(":hidden")) {
                    a(this).children().addClass(c[1]).removeClass(c[0])
                } else {
                    a(this).children().addClass(c[0]).removeClass(c[1])
                }
                if (f.is(":hidden")) {
                    if (o == "fade") {
                        var d = "fadeIn"
                    } else {
                        d = "slideDown"
                    }
                } else {
                    if (o == "fade") {
                        var d = "fadeOut"
                    } else {
                        d = "slideUp"
                    }
                }
                f[d](p);
                b.preventDefault()
            })
        })
    };
    a.fn.powerWidgetsPanel.options = {
        target: "",
        widgets: ".powerwidget",
        localStorage: true,
        trigger: "",
        triggerClass: "plus-10 | min-10",
        effectPanel: "slide",
        speedPanel: 200,
        effectWidget: "slide",
        speedWidget: 200,
        onToggle: function () {}
    }
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.eSelect = function (d) {
        d = a.extend({}, a.fn.eSelect.options, d);
        
        return this.each(function () {
            var e = a(this);
            var f = "e-select-multiple-highlite";
            if ("ontouchstart" in b || b.DocumentTouch && c instanceof DocumentTouch) {
                var g = "click tap"
            } else {
                var g = "click"
            }
            
            if (e.attr("multiple") || e.attr("make") || e.attr("model") || e.attr("trim")) {
                /*e.not(d.exclude).hide().wrap('<div class="e-select-multiple"/>').after('<div class="e-select-multiple-inner">' + "<ul>" + "</ul>" + "</div>" + '<div class="e-select-multiple-handle">' + "<span></span>" + "</div>").end().children("option").each(function () {
                    var b = a(this).attr("class");
                    var c = a(this).text();
                    if (a(this).is(":selected")) {
                        var d = "e-select-multiple-highlite"
                    } else {
                        var d = ""
                    }
                    a(this).parents("div.e-select-multiple").children("div.e-select-multiple-inner").children("ul").append('<li class="' + d + " " + b + '">' + c + "</li>")
                })*/
            } 
           
            else {
                e.not(d.exclude).hide().wrap('<div class="e-select"/>').after('<div class="e-select-inner">' + '<div class="e-select-selected"></div><div class="e-select-trigger"><span></span></div>' + "</div>" + '<div class="e-select-options">' + "<ul>" + "</ul>" + "</div>").end().children("option").each(function () {
                    var b = a(this).attr("class");
                    var c = a(this).text();
                    if (a(this).is(":selected")) {
                        a(this).parents("div.e-select").children("div.e-select-inner").children("div.e-select-selected").text(c)
                    }
                    a(this).parents("div.e-select").children("div.e-select-options").children("ul").append('<li class="' + b + '">' + c + "</li>")
                })
            }
            a(c).on(g, this, function (b) {
                if (!a(b.target).is("div.e-select *")) {
                    a("div.e-select-options").slideUp(d.speed)
                }
            });
            e.parents("div.e-select").on(g, "div.e-select-inner", function () {
                var b = a(this).next("div.e-select-options");
                if (b.is(":hidden")) {
                    a("div.e-select-options").slideUp(d.speed);
                    b.slideDown(d.speed)
                } else {
                    b.slideToggle(d.speed)
                }
            });
            e.parents("div.e-select").on(g, "li", function () {
                a(this).parents("div.e-select").children("div.e-select-inner").children("div.e-select-selected").text(a(this).text()).parents("div.e-select").find("select").children().removeAttr("selected").parent().children("option:contains(" + a(this).text() + ")").attr("selected", "selected").parents("div.e-select").children("div.e-select-options").slideUp(d.speed);
                if (typeof d.onSelect == "function") {
                    //hardik
                    d.onSelect.call(this)
                }
            });
            var h = e.parent("div.e-select-multiple");
            var i = h.outerHeight();
            var j = h.children("div.e-select-multiple-inner");
            var k = h.children("div.e-select-multiple-handle").children();
            var l = j.outerHeight();
            var m = i / (l / i);
            k.height(m);
            k.draggable({
                axis: "y",
                containment: e.parent(),
                drag: function () {
                    var a = k.position().top;
                    j.css({
                        top: -(a * (l / i))
                    })
                }
            });
            h.on(g, "li", function () {
                if (a(this).hasClass(f)) {
                    a(this).removeClass(f).parents("div.e-select-multiple").find("option:contains(" + a(this).text() + ")").removeAttr("selected")
                } else {
                    a(this).addClass(f).parents("div.e-select-multiple").find("option:contains(" + a(this).text() + ")").attr("selected", "selected")
                }
                if (typeof d.onSelect == "function") {
                    d.onSelect.call(this)
                }
            })
        })
    };
    a.fn.eSelect.options = {
        exclude: "",
        speed: 200,
        onSelect: function () {}
    }
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.eCheckbox = function (d) {
        d = a.extend({}, a.fn.eCheckbox.options, d);
        return this.each(function () {
            var e = a(this);
            var f = "e-checkbox-normal";
            var g = "e-checkbox-active";
            if ("ontouchstart" in b || b.DocumentTouch && c instanceof DocumentTouch) {
                var h = "click tap"
            } else {
                var h = "click"
            }
            if (e.is("[type=checkbox]")) {
                if (e.next("label").length) {
                    e.hide().next("label").andSelf().wrapAll('<div class="e-checkbox"/>')
                } else if (e.prev("label").length) {
                    e.hide().prev("label").andSelf().wrapAll('<div class="e-checkbox labelleft"/>')
                } else {
                    e.hide().wrap('<div class="e-checkbox"/>')
                }
                a('<div class="e-checkbox-img"></div>').insertBefore(e);
                if (e.is(":disabled")) {
                    e.parent("div").addClass("e-checkbox-disabled")
                }
                if (e.is(":checked")) {
                    e.parent("div").removeClass(f).addClass(g)
                } else {
                    e.parent("div").removeClass(g).addClass(f)
                }
                e.parent("div.e-checkbox").not("div.e-checkbox-disabled").on(h, a(this), function () {
                    if (a(this).find("[type=checkbox]").hasClass(d.triggerClass)) {
                        if (a(this).find("[type=checkbox]").is(":checked")) {
                            a(this).parents("." + d.sectionClass).find("div.e-checkbox").not("div.e-checkbox-disabled").removeClass(g).addClass(f).find("input").removeAttr("checked")
                        } else {
                            a(this).parents("." + d.sectionClass).find("div.e-checkbox").not("div.e-checkbox-disabled").removeClass(f).addClass(g).find("input").attr("checked", "checked")
                        }
                        if (typeof d.toggleCallback == "function") {
                            d.toggleCallback.call(this)
                        }
                    } else {
                        if (a(this).find("[type=checkbox]").is(":checked")) {
                            a(this).removeClass(g).addClass(f).find("input").removeAttr("checked")
                        } else {
                            a(this).removeClass(f).addClass(g).find("input").attr("checked", "checked")
                        }
                    }
                })
            }
        })
    };
    a.fn.eCheckbox.options = {
        sectionClass: "e-checkbox-section",
        triggerClass: "e-checkbox-trigger",
        toggleCallback: function () {}
    }
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.eRadio = function (d) {
        d = a.extend({}, a.fn.eRadio.options, d);
        return this.each(function () {
            var d = a(this);
            if ("ontouchstart" in b || b.DocumentTouch && c instanceof DocumentTouch) {
                var e = "click tap"
            } else {
                var e = "click"
            }
            if (d.is("[type=radio]")) {
                if (d.next("label").length) {
                    d.hide().next("label").andSelf().wrapAll('<div class="e-radio"/>')
                } else if (d.prev("label").length) {
                    d.hide().prev("label").andSelf().wrapAll('<div class="e-radio labelleft"/>')
                } else {
                    d.hide().wrap('<div class="e-radio"/>')
                }
                a('<div class="e-radio-img"></div>').insertBefore(d);
                if (d.is(":disabled")) {
                    d.parent("div").addClass("e-radio-disabled")
                }
                if (d.is(":checked")) {
                    d.parent("div").removeClass("e-radio-normal").addClass("e-radio-active")
                } else {
                    d.parent("div").removeClass("e-radio-active").addClass("e-radio-normal")
                }
                d.parent("div.e-radio").not("div.e-radio-disabled").on(e, this, function () {
                    var b = a(this).children("input").attr("name");
                    a("input[name=" + b + "]").removeAttr("checked").parent().removeClass("e-radio-active").addClass("e-radio-normal");
                    a(this).children("input").attr("checked", "checked").parent().addClass("e-radio-active").trigger("updateAll")
                })
            }
        })
    };
    a.fn.eRadio.options = {}
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.eTabs = function (d) {
        d = a.extend({}, a.fn.eTabs.options, d);
        return this.each(function () {
            function e(b) {
                var c = b - 1;
                var d = 0;
                k.each(function () {
                    if (d == c) {
                        a(this).addClass(m)
                    } else {
                        a(this).removeClass(m)
                    }
                    d++
                })
            }
            function f(b) {
                var c = b - 1;
                var d = 0;
                h.each(function () {
                    if (d == c) {
                        a(this).show()
                    }
                    d++
                })
            }
            var g = a(this);
            var h = g.find("div.etabs-content");
            var i = g.find("div.etabs-content:first");
            var j = g.find("ul.etabs:first");
            var k = j.children("li");
            var l = k.children("a");
            var m = "etabs-active";
            var n = j.children("li:first");
            var o = g.attr("id");
            var p = 0;
            if ("ontouchstart" in b || b.DocumentTouch && c instanceof DocumentTouch) {
                var q = "click tap"
            } else {
                var q = "click"
            }
            if (!o) {
                alert("The tab plugin can only be used with a ID selector, please change this!")
            }
            h.hide().addClass("clearfix");
            if (localStorage && d.storeTab === true) {
                var r = localStorage.getItem("e_tabs_" + location.pathname + "_" + o)
            } else {
                var r = 1
            }
            if (d.selected == 1 && r == 1) {
                n.addClass(m).show();
                i.show()
            } else {
                if (d.storeTab == true && r != null) {
                    e(r);
                    f(r)
                } else {
                    e(d.selected);
                    f(d.selected)
                }
            }
            l.each(function () {
                var b = a(this).data("tab-source");
                var c = a(this).attr("href");
                if (b && !a.trim(a(c).html()).length) {
                    a(c).load(b, function (b, d, e) {
                        if (d == "error") {
                            a(c).html(e.status + " " + e.statusText)
                        }
                    })
                }
            });
            k.on(q, "a", function (b) {
                var c = a(this).attr("href");
                l.parent("li").removeClass(m + " etabs-open-active");
                a(this).parent("li").addClass(m + " etabs-open-active");
                h.not(c).hide();
                if (a(c).is(":hidden")) {
                    a(c).fadeIn(1, function () {
                        if (typeof d.onSwitch == "function") {
                            d.onSwitch.call(this)
                        }
                    })
                }
                if (localStorage && d.storeTab === true) {
                    g.find("li").each(function (b) {
                        if (a(this).hasClass(m)) {
                            localStorage.setItem("e_tabs_" + location.pathname + "_" + o, b + 1)
                        }
                    })
                }
                b.preventDefault()
            });
            if (d.responsive === true) {
                k.each(function () {
                    p += a(this).width()
                });

                function s() {
                    j.children("." + m).addClass("etabs-open-active");
                    var b = g.children("div.etabs-to-select").length;
                    if (p >= j.outerWidth() - 10) {
                        if (b == 0) {
                            j.wrap('<div class="etabs-to-select"/>').after('<div class="etabs-arrow-left"><span></span></div><div class="etabs-arrow-right"><span></span></div>')
                        }
                        k.hide().css({
                            width: j.outerWidth() - 10
                        });
                        j.children("." + m).show()
                    } else {
                        if (b) {
                            k.removeAttr("style").show();
                            j.unwrap();
                            a(".etabs-arrow-left, .etabs-arrow-right ").remove();
                            g.find(".etabs-open-active").removeClass("etabs-open-active")
                        }
                    }
                }
                g.on(q, ".etabs-arrow-left", function (a) {
                    var b = j.children("li.etabs-open-active");
                    if (b.prev("li").length) {
                        j.children("li.etabs-open-active").hide().removeClass("etabs-open-active").prev("li").show().addClass("etabs-open-active")
                    }
                });
                g.on(q, ".etabs-arrow-right", function (a) {
                    var b = j.children("li.etabs-open-active");
                    if (b.next("li").length) {
                        j.children("li.etabs-open-active").hide().removeClass("etabs-open-active").next("li").show().addClass("etabs-open-active")
                    }
                });
                s();
                a(b).bind("resize", "ready", function () {
                    s()
                })
            }
        })
    };
    a.fn.eTabs.options = {
        selected: 1,
        storeTab: true,
        responsive: false,
        onSwitch: function () {}
    }
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.eFile = function (b) {
        b = a.extend({}, a.fn.eFile.options, b);
        return this.each(function () {
            var c = a(this);
            if (c.is("[type=file]")) {
                c.not(b.exclude).wrap('<div class="e-file"/>').before('<input type="text" class="e-file-input"/><span class="e-file-button">' + b.label + "</span>").wrap('<div class="e-file-wrapper"/>');
                if (navigator.platform === "iPad" || navigator.platform === "iPhone" || navigator.platform === "iPod") {
                    c.parents(".e-file").find(".e-file-input").val("disabled")
                }
            }
            c.parents(".e-file").mousemove(function (b) {
                var c = a(this).offset();
                var d = a(this).children(".e-file-wrapper");
                d.css({
                    left: b.pageX - c.left - d.width() + 30,
                    top: b.pageY - c.top - d.height() / 2
                })
            });
            c.change(function () {
                var c = a(this).val().split(/\\/).pop();
                a(this).parents(".e-file").children(".e-file-input").val(c);
                if (typeof b.onUpload == "function") {
                    b.onUpload.call(this)
                }
            })
        })
    };
    a.fn.eFile.options = {
        label: "upload",
        exclude: "",
        onUpload: function () {}
    }
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.eMainMenu = function (d) {
        d = a.extend({}, a.fn.eMainMenu.options, d);
        return this.each(function () {
            var e = a(this);
            var f = e.children().children();
            if ("ontouchstart" in b || b.DocumentTouch && c instanceof DocumentTouch) {
                var g = "click tap"
            } else {
                var g = "click"
            }
            f.on(g, "a", function () {
                if (a(this).attr("href").lastIndexOf("#") >= 0 || a(this).attr("href").indexOf("javascript") >= 0) {
                    var b = a(this).parent("li");
                    var c = a(this).parents("li");
                    if (!c.children("ul").is(":hidden")) {
                        b.removeClass(d.activeClass).children("a").find("." + d.closeClass).removeClass(d.closeClass).addClass(d.openClass)
                    } else {
                        b.addClass(d.activeClass).children("a").find("." + d.openClass).removeClass(d.openClass).addClass(d.closeClass)
                    }
                    b.children("ul").animate({
                        height: "toggle"
                    }, d.speed)
                }
            })
        })
    };
    a.fn.eMainMenu.options = {
        activeClass: "sub-page-active",
        closeClass: "min-10",
        openClass: "plus-10",
        speed: 400
    }
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.eMenu = function (d) {
        d = a.extend({}, a.fn.eMenu.options, d);
        return this.each(function () {
            var e = a(this);
            var f = e.children("li");
            var g = f.children("a");
            if ("ontouchstart" in b || b.DocumentTouch && c instanceof DocumentTouch) {
                var h = "click tap"
            } else {
                var h = "click"
            }
            f.each(function (b) {
                if (a(this).parent().hasClass("e-menu")) {
                    var c = a(this).children("a").outerWidth()
                } else {
                    var c = a(this).children("a").outerWidth() - 1
                }
                a(this).children("div:last-child").prepend('<span class="e-menu-brigde" style="width:' + c + 'px"></span>');
                if (jQuery.inArray(b, d.flip) != "-1") {
                    a(this).children("div").addClass("e-menu-reverze")
                }
            });
            if (d.typeEvent == "click") {
                a(c).on(h, this, function (b) {
                    if (!a(b.target).is(a(" *", e))) {
                        g.parent().children("div:last-child").slideUp(d.speed);
                        e.find("." + d.activeClass).removeClass(d.activeClass)
                    }
                });
                g.on(h, this, function () {
                    if (d.effect == "fade") {
                        if (a(this).next("div:last-child").is(":hidden")) {
                            e.children("li").children("div:last-child").fadeOut(d.speed);
                            a(this).next("div:last-child").stop(true, true).fadeIn(d.speed)
                        } else {
                            a(this).next("div:last-child").stop(true, true).fadeOut(d.speed)
                        }
                    } else {
                        e.children("li").not(a(this).parent()).children("div:last-child").hide();
                        a(this).next("div:last-child").stop(true, true).animate({
                            height: "toggle"
                        }, d.speed)
                    }
                    if (a(this).hasClass(d.activeClass)) {
                        a(this).removeClass(d.activeClass)
                    } else {
                        e.find("." + d.activeClass).removeClass(d.activeClass);
                        a(this).addClass(d.activeClass)
                    }
                })
            } else {
                g.on("mouseenter tap", function () {
                    a(this).addClass(d.activeClass);
                    if (d.effect == "fade") {
                        a(this).parent().children("div:last-child").stop(true, true).fadeIn(d.speed)
                    } else {
                        a(this).parent().children("div:last-child").stop(true, true).slideDown(d.speed)
                    }
                });
                g.parent("li").on("mouseleave tap", function () {
                    a(this).children().removeClass(d.activeClass);
                    if (d.effect == "fade") {
                        a(this).children("div:last-child").stop(true, true).fadeOut(d.speed)
                    } else {
                        a(this).children("div:last-child").stop(true, true).slideUp(d.speed)
                    }
                })
            }
        })
    };
    a.fn.eMenu.options = {
        effect: "slide",
        speed: 200,
        typeEvent: "click",
        activeClass: "e-menu-active",
        flip: []
    }
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.eInputExpand = function (d) {
        d = a.extend({}, a.fn.eInputExpand.options, d);
        return this.each(function () {
            var e = a(this);
            if ("ontouchstart" in b || b.DocumentTouch && c instanceof DocumentTouch) {
                var f = "click tap"
            } else {
                var f = "click"
            }
            e.on(f, this, function (b) {
                var c = a(this);
                if (typeof d.before == "function") {
                    d.before.call(this)
                }
                a("input").blur();
                var e = d.height;
                var f = d.width;
                var g = e / 2;
                var h = f / 2;
                var i = e - 61;
                if (a("#e-inputexpand").length < 1) {
                    a("body").append('<div id="e-inputexpand" style="height:' + e + "px;width:" + f + "px;margin:-" + g + "px 0 0 -" + h + 'px">' + '<div id="e-inputexpand-content">' + '<textarea id="e-inputexpand-textarea" name="" style="height:' + i + 'px"></textarea>' + "</div>" + "<footer>" + '<a href="javascript:void(0);" id="e-inputexpand-submit">' + d.labelSubmit + "</a>" + '<a href="javascript:void(0);" id="e-inputexpand-cancel">' + d.labelCancel + "</a>" + "</footer>" + "</div>" + '<div id="e-inputexpand-overlay"></div>');
                    a("div#e-inputexpand-overlay").fadeTo(d.speed, d.opacity, function () {
                        a("textarea#e-inputexpand-textarea").html(c.val());
                        a("div#e-inputexpand").fadeIn(d.speed)
                    });
                    c.addClass("e-inputexpand-source")
                }
                b.preventDefault()
            });
            a("body").on(f, "div#e-inputexpand a", function (b) {
                if (a(b.target).is("a#e-inputexpand-submit")) {
                    var c = a("textarea#e-inputexpand-textarea").val();
                    a("input.e-inputexpand-source").val(c)
                }
                a("input.e-inputexpand-source").blur().removeClass("e-inputexpand-source");
                a("div#e-inputexpand-overlay, div#e-inputexpand").fadeOut(d.speed, function () {
                    a(this).remove()
                });
                if (typeof d.after == "function") {
                    d.after.call(this)
                }
                b.preventDefault()
            });
            if (d.escKey === true) {
                a(c).keypress(function (b) {
                    if (b.keyCode == 27) {
                        a("div#e-inputexpand-overlay, div#e-inputexpand").fadeOut(d.speed, function () {
                            a(this).remove()
                        });
                        if (typeof d.after == "function") {
                            d.after.call(this)
                        }
                    }
                })
            }
        })
    };
    a.fn.eInputExpand.options = {
        width: 320,
        height: 220,
        labelSubmit: "Insert",
        labelCancel: "Cancel",
        opacity: .5,
        escKey: true,
        before: function () {},
        after: function () {}
    }
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.eProgressbar = function (b) {
        b = a.extend({}, a.fn.eProgressbar.options, b);
        return this.each(function () {
            var c = a(this);
            c.find(".e-progressbar").each(function (c) {
                var d = a(this).attr("data-progressbar-value");
                var e = a(this).attr("data-progressbar-color");
                if (b.showTotal === true) {
                    var f = "<span>" + d + "%</span>"
                } else {
                    var f = ""
                }
                a(this).append('<span style="background-color:' + e + '">' + f + "</span>");
                if (b.loop === true) {
                    var g = b.delay * c
                } else {
                    var g = b.delay
                }
                if (b.animate === true) {
                    a(this).children("span").delay(g).animate({
                        width: d + "%"
                    }, b.speed, b.easing, function () {
                        if (b.after) {
                            b.after.call(this)
                        }
                    })
                } else {
                    a(this).children("span").css({
                        width: d + "%"
                    });
                    if (b.after) {
                        b.after.call(this)
                    }
                }
            })
        })
    };
    a.fn.eProgressbar.options = {
        animate: true,
        easing: "",
        loop: true,
        delay: 400,
        showTotal: true,
        speed: 2e3,
        after: function () {}
    }
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.eScrollbar = function (c) {
        c = a.extend({}, a.fn.eScrollbar.options, c);
        return this.each(function () {
            var c = a(this);
            c.addClass("e-scrollbar-inner").wrap('<div class="e-scrollbar"/>').parent().append('<div class="e-scrollbar-handle"><span></span></div>');
            c.bind("runCode", function () {
                var a = c.parent(".e-scrollbar");
                var b = a.outerHeight();
                var d = a.children("div.e-scrollbar-inner");
                var e = a.children("div.e-scrollbar-handle").children();
                var f = d.outerHeight() + 15;
                var g = b / (f / b);
                e.height(g);
                e.draggable({
                    axis: "y",
                    containment: c.parent(),
                    drag: function () {
                        var a = e.position().top;
                        d.css({
                            top: -(a * (f / b))
                        })
                    }
                })
            }).trigger("runCode");
            a(b).resize(function () {
                c.trigger("runCode").css({
                    top: 0
                }).next("div.e-scrollbar-handle").children().css({
                    top: 0
                })
            })
        })
    };
    a.fn.eScrollbar.options = {}
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.eOsKeyboard = function (b) {
        b = a.extend({}, a.fn.eOsKeyboard.options, b);
        return this.each(function () {
            var c = a(this);
            var d = false;
            var e = false;
            var f = '<div class="e-oskeyboard" style="z-index:' + b.zIndex + '">' + "<div><p>" + b.title + "</p><span>x</span></div>" + "<ul>" + '<li class="symbol"><span class="off">`</span><span class="on">~</span></li>' + '<li class="symbol"><span class="off">1</span><span class="on">!</span></li>' + '<li class="symbol"><span class="off">2</span><span class="on">@</span></li>' + '<li class="symbol"><span class="off">3</span><span class="on">#</span></li>' + '<li class="symbol"><span class="off">4</span><span class="on">$</span></li>' + '<li class="symbol"><span class="off">5</span><span class="on">%</span></li>' + '<li class="symbol"><span class="off">6</span><span class="on">^</span></li>' + '<li class="symbol"><span class="off">7</span><span class="on">&</span></li>' + '<li class="symbol"><span class="off">8</span><span class="on">*</span></li>' + '<li class="symbol"><span class="off">9</span><span class="on">(</span></li>' + '<li class="symbol"><span class="off">0</span><span class="on">)</span></li>' + '<li class="symbol"><span class="off">-</span><span class="on">_</span></li>' + '<li class="symbol"><span class="off">=</span><span class="on">+</span></li>' + '<li class="delete">delete</li>' + '<li class="tab">tab</li>' + '<li class="letter">q</li>' + '<li class="letter">w</li>' + '<li class="letter">e</li>' + '<li class="letter">r</li>' + '<li class="letter">t</li>' + '<li class="letter">y</li>' + '<li class="letter">u</li>' + '<li class="letter">i</li>' + '<li class="letter">o</li>' + '<li class="letter">p</li>' + '<li class="symbol"><span class="off">[</span><span class="on">{</span></li>' + '<li class="symbol"><span class="off">]</span><span class="on">}</span></li>' + '<li class="symbol"><span class="off"></span><span class="on">|</span></li>' + '<li class="capslock">caps</li>' + '<li class="letter">a</li>' + '<li class="letter">s</li>' + '<li class="letter">d</li>' + '<li class="letter">f</li>' + '<li class="letter">g</li>' + '<li class="letter">h</li>' + '<li class="letter">j</li>' + '<li class="letter">k</li>' + '<li class="letter">l</li>' + '<li class="symbol"><span class="off">;</span><span class="on">:</span></li>' + '<li class="symbol"><span class="off">\'</span><span class="on">"</span></li>' + '<li class="enter">enter</li>' + '<li class="left-shift">shift</li>' + '<li class="letter">z</li>' + '<li class="letter">x</li>' + '<li class="letter">c</li>' + '<li class="letter">v</li>' + '<li class="letter">b</li>' + '<li class="letter">n</li>' + '<li class="letter">m</li>' + '<li class="symbol"><span class="off">,</span><span class="on"><</span></li>' + '<li class="symbol"><span class="off">.</span><span class="on">></span></li>' + '<li class="symbol"><span class="off">/</span><span class="on">?</span></li>' + '<li class="right-shift">shift</li>' + '<li class="space">space</li>' + "</ul>" + "</div>";
            if (c.is("textarea")) {
                var g = "e-oskeyboard-textarea"
            } else if (c.is("input")) {
                var g = "e-oskeyboard-input"
            }
            c.wrap('<div class="e-oskeyboard-wrap clearfix ' + g + '"></div>').parents(".e-oskeyboard-wrap").append(f);
            if (b.trigger == "focus") {
                c.focus(function () {
                    var c = a(this).outerHeight() + b.posY;
                    a(this).next().css({
                        top: c,
                        right: b.posX
                    }).fadeIn(200)
                })
            } else if (b.trigger == "icon") {
                c.parent().append('<span class="e-oskeyboard-icon"></span>');
                c.parent().children("span").click(function () {
                    var c = a(this).parent().children("input").outerHeight() + b.posY;
                    a(this).prev().css({
                        top: c,
                        right: b.posX
                    }).fadeIn(200)
                })
            }
            c.parents(".e-oskeyboard-wrap").find("li").click(function () {
                var b = a(this);
                var e = b.parent("ul");
                var f = b.html();
                var g = b.parents(".e-oskeyboard-wrap").find(c);
                if (b.hasClass("left-shift") || b.hasClass("right-shift")) {
                    e.find(".letter").toggleClass("uppercase");
                    e.find(".symbol span").toggle();
                    d = d === true ? false : true;
                    var h = false;
                    return false
                }
                if (b.hasClass("capslock")) {
                    e.find(".letter").toggleClass("uppercase");
                    var h = true;
                    return false
                }
                if (b.hasClass("delete")) {
                    if (g.is("textarea")) {
                        var i = g.html();
                        g.html(i.substr(0, i.length - 1))
                    } else if (g.is("input")) {
                        var i = g.val();
                        g.val(i.substr(0, i.length - 1))
                    }
                    return false
                }
                if (b.hasClass("symbol")) {
                    var f = a("span:visible", b).html()
                }
                if (b.hasClass("space")) {
                    var f = " "
                }
                if (b.hasClass("tab")) {
                    var f = "	"
                }
                if (b.hasClass("enter")) {
                    var f = "\n"
                }
                if (b.hasClass("uppercase")) {
                    var f = f.toUpperCase()
                }
                if (d === true) {
                    e.find(".symbol span").toggle();
                    if (h === false) {
                        e.find(".letter").toggleClass("uppercase")
                    }
                    d = false
                }
                if (g.is("textarea")) {
                    g.html(c.html() + f)
                } else if (g.is("input")) {
                    g.val(c.val() + f)
                }
            });
            a(".e-oskeyboard div span").click(function () {
                a(this).parents(".e-oskeyboard").fadeOut(200, function () {
                    a(this).css({
                        top: 0,
                        left: 0
                    })
                })
            });
            if (b.draggable === true) {
                a(".e-oskeyboard").draggable({
                    handle: a(".e-oskeyboard > div")
                })
            }
        })
    };
    a.fn.eOsKeyboard.options = {
        title: "OS Keyboard",
        trigger: "icon",
        draggable: true,
        posY: 20,
        posX: 0,
        zIndex: 1e3
    }
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.eTextareaLimiter = function (b) {
        b = a.extend({}, a.fn.eTextareaLimiter.options, b);
        return this.each(function () {
            var c = a(this);
            if (c.is("textarea")) {
                if (c.attr("maxlength")) {
                    var d = c.attr("maxlength")
                } else {
                    var d = b.maximum
                }
                var e = [8, 9, 13, 33, 34, 35, 36, 37, 38, 39, 40, 46];
                c.on("keypress", function (b) {
                    var c = a.data(this, "keycode");
                    if (d && d > 0) {
                        return a(this).val().length < d || a.inArray(c, e) !== -1
                    }
                }).on("keydown", function (b) {
                    a.data(this, "keycode", b.keyCode || b.which)
                });
                var f = Math.floor(Math.random() * 1001);
                a('<span class="e-textarealimiter-maximum" id="e-tl-id' + f + '"></span>').insertAfter(c);
                c.bind("keyup click blur focus change paste keypress keydown tap", function () {
                    var e = a(this).val().length;
                    var g = parseInt(d - e);
                    a("#e-tl-id" + f).text(g);
                    if (b.savety === true) {
                        if (g < 0) {
                            c.parents("form").find('[type="submit"]').attr("disabled", "true")
                        } else {
                            c.parents("form").find('[type="submit"]').removeAttr("disabled")
                        }
                    }
                }).change()
            }
        })
    };
    a.fn.eTextareaLimiter.options = {
        maximum: 1e4,
        savety: true
    }
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.eContactForm = function (b) {
        b = a.extend({}, a.fn.eContactForm.options, b);
        return this.each(function () {
            function c(a, c) {
                if (!a.parents("." + h).length) {
                    var e = a.parent("div");
                    if (c === d) {
                        var f = b.labelError
                    } else {
                        var f = c
                    }
                    if (e.hasClass("e-checkbox") || e.hasClass("e-select") || e.hasClass("e-select-multiple")) {
                        if (e.hasClass("e-checkbox")) {
                            var g = "width:auto;float:left;"
                        } else {
                            var g = ""
                        }
                        a.parent().wrap('<div class="' + h + ' clearfix" style="' + g + '"/>').parent("." + h).prepend("<span>" + f + "<span></span></span>")
                    } else {
                        a.wrap('<div class="' + h + ' clearfix"/>').parent("." + h).prepend("<span>" + f + "<span></span></span>")
                    }
                }
            }
            function e(a) {
                var b = a.parents("." + h);
                if (b.length) {
                    b.children("span").remove().end().replaceWith(b.contents())
                }
            }
            var f = a(this);
            var g = f.find("input:not([type=submit]), select, textarea");
            var h = "e-contactform-errorlabel";
            var i = "e-af-match";
            f.submit(function (i) {
                if (typeof b.before == "function") {
                    b.before.call(this)
                }
                a("." + h).children("span").show();
                g.each(function () {
                    var b = a(this);
                    var g = b.attr("data-validation-type");
                    var h = b.attr("data-validation-label");
                    var i = b.attr("data-validation-match-value");
                    var j = b.attr("data-validation-minimum");
                    var k = b.attr("data-validation-maximum");
                    var i = b.attr("data-validation-match");
                    if (j === d) {
                        var l = 0
                    } else {
                        var l = j - 1
                    }
                  
                    if (k === d) {
                        var m = 1e7
                    } else {
                        var m = k
                    }
                    switch (g) {
                        case "present":
                            if (b.is("[type=checkbox]")) {
                                if (b.is(":checked")) {
                                    e(b)
                                } else {
                                    c(b, h)
                                }
                            } else if (b.is("select")) {
                                if (a.trim(b.val()).length > 0) {
                                    e(b)
                                } else {
                                    c(b, h)
                                }
                            } else {
                                if (a.trim(b.val()).length > l && b.val().length < m) {
                                    e(b)
                                } else {
                                    c(b, h)
                                }
                            }
                            break;
                        case "email":
                            var n = b.val();
                            var o = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
                            if (o.test(n)) {
                                e(b)
                            } else {
                                c(b, h)
                            }
                            break;
                        case "url":
                            var n = b.val();
                            var o = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
                            if (o.test(n)) {
                                e(b)
                            } else {
                                c(b, h)
                            }
                            break;
                        case "numbers":
                            var n = b.val();
                            var o = /^[0+9]$/;
                            if (a.trim(b.val()).length > l && b.val().length < m && o.test(n)) {
                                e(b)
                            } else {
                                c(b, h)
                            }
                            break;
                        case "date":
                            var n = b.val();
                            var o = /^[0-9]{2}\-[0-9]{2}\-[0-9]{4}$/i;
                            if (o.test(n)) {
                                e(b)
                            } else {
                                c(b, h)
                            }
                            break;
                        case "letters":
                            var n = b.val();
                            var o = /^[A-Za-z ]+$/;
                            if (a.trim(b.val()).length > l && b.val().length < m && o.test(n)) {
                                e(b)
                            } else {
                                c(b, h)
                            }
                            break;
                        case "regex":
                            var n = b.val();
                            var o = b.attr("valdiation-regex");
                            if (o.test(n)) {
                                e(b)
                            } else {
                                c(b, h)
                            }
                            break;
                        case "password":
                            if (a.trim(b.val()).length > l && b.val().length < m) {
                                if (b.val() == f.find('[data-validation-type="password"]').not(b).val()) {
                                    e(b)
                                } else {
                                    c(b, h)
                                }
                            } else {
                                c(b, h)
                            }
                            break;
                        case "match":
                            if (b.val() == i) {
                                e(b)
                            } else {
                                c(b, h)
                            }
                            break;
                        case "ip":
                            var n = b.val();
                            var o = /\b(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\b/;
                            if (o.test(n)) {
                                e(b)
                            } else {
                                c(b, h)
                            }
                            break
                    }
                });
                if (f.find("." + h).length) {
                    return false
                } else {
                    if (b.useAjax === true) {
                        a(".e-contactform-infobox").remove();
                        f.prepend('<div class="e-contactform-infobox"></div>');
                        a.ajax({
                            type: f.attr("method"),
                            url: f.attr("action"),
                            data: f.serialize(),
                            dataType: "html",
                            error: function () {
                                a(".e-contactform-infobox").addClass("e-contactform-fail-color").text(b.labelFail).slideDown(200)
                            },
                            success: function () {
                                a(".e-contactform-infobox").addClass("e-contactform-success-color").text(b.labelSuccess).slideDown(200);
                                if (typeof b.after == "function") {
                                    b.after.call(this)
                                }
                            }
                        });
                        return false
                    } else {
                        return true
                    }
                }
            });
            if (b.keydown === true) {
                g.keydown(function () {
                    a(this).parents("." + h).children("span").hide()
                })
            }
        })
    };
    a.fn.eContactForm.options = {
        labelError: "This field is required ofcourse!",
        labelSuccess: "Your message has been send successfully!",
        labelFail: "The form has not been send, please try it again!",
        keydown: true,
        useAjax: true,
        before: function () {},
        after: function () {}
    }
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.eResponsiveTable = function (b) {
        b = a.extend({}, a.fn.eResponsiveTable.options, b);
        return this.each(function () {
            var c = a(this);
            var d = c.find("tr");
            d.each(function () {
                var c = 1;
                a(this).find("th, td").each(function () {
                    a(this).addClass(b.className + "" + c);
                    c++
                })
            })
        })
    };
    a.fn.eResponsiveTable.options = {
        className: "rt-"
    }
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.eGallery = function (d) {
        d = a.extend({}, a.fn.eGallery.options, d);
        return this.each(function () {
            function e(b) {
                b.fadeOut(function () {
                    var c = a("ul", k);
                    b.find(".btn-delete, .btn-lightbox").hide().end().addClass("in-bin").attr("style", "");
                    if (b.find(".btn-undo").length < 1) {
                        b.append('<a href="javascript:void(0);" class="btn-undo">Undo</a>').appendTo(c).fadeIn()
                    } else {
                        b.appendTo(c).fadeIn()
                    }
                })
            }
            function f(a) {
                a.fadeOut(function () {
                    a.removeClass("in-bin").find(".btn-undo").remove().end().find(".btn-delete, .btn-lightbox, img").show();
                    a.appendTo(i).fadeIn()
                });
                o.find(".active").removeClass(d.activeClass).end().find("a:first").addClass(d.activeClass);
                j.fadeTo(100, 1);
                if (h.find(n).find("li").length < 2) {
                    h.find(n).delay(400).slideUp(200)
                }
            }
            if (d.clearTrash === true) {
                var g = '<div style="min-height:8.5em">' + '<span class="e-gallery-emptybin"></span>' + "<ul></ul>" + "<div><span>" + d.labelTrash + '</span><a href="javascript:void(0);" class="emptybin">' + d.labelButton + "</a></div>" + "</div>"
            } else {
                var g = '<div style="min-height:5.5em">' + '<span class="e-gallery-emptybin"></span>' + "<ul></ul>" + "</div>"
            }
            a(".e-gallery-trashbin").append(g);
            var h = a(this);
            var i = h.children("ul");
            var j = i.children("li");
            var k = h.find(".e-gallery-trashbin").children("div");
            var l = k.children("ul");
            var m = h.find("header");
            var n = ".e-gallery-trashbin";
            var o = h.find(".e-gallery-filter");
            if ("ontouchstart" in b || b.DocumentTouch && c instanceof DocumentTouch) {
                var p = "click tap"
            } else {
                var p = "click"
            }
            if (d.draggable === true) {
                j.find("div").css({
                    cursor: "move"
                });
                j.draggable({
                    cancel: ".btn-undo, .btn-delete, .btn-lightbox",
                    revert: "invalid",
                    helper: "clone",
                    cursor: "move",
                    opacity: .8,
                    start: function (a, b) {
                        h.find(n).show()
                    },
                    stop: function (a, b) {
                        setTimeout(function () {
                            if (h.find(n).find("li").length > 0) {
                                h.find(n).show(200)
                            } else {
                                h.find(n).slideUp(200)
                            }
                        }, 500)
                    }
                })
            }
            k.droppable({
                accept: j,
                activeClass: "ui-state-highlight",
                drop: function (a, b) {
                    e(b.draggable)
                }
            });
            i.droppable({
                accept: ".e-gallery-trashbin li",
                activeClass: "e-gallery-state-active",
                cancel: ".button-icon",
                drop: function (a, b) {
                    f(b.draggable)
                }
            });
            if (d.clearTrash === true) {
                h.on(p, ".emptybin", function (b) {
                    a(this).parents(h).find(n).find("li").fadeOut(200, function () {
                        a(this).remove();
                        h.find(n).slideUp(200, function (b) {
                            a(this).children().fadeOut()
                        })
                    });
                    b.preventDefault()
                })
            } else {
                h.find(".emptybin").hide()
            }
            h.on(p, ".btn-delete", function (b) {
                a(this).parents(h).find(n).slideDown(200)
            });
            h.on(p, ".btn-delete", function (b) {
                e(a(this).parents("li"));
                b.preventDefault()
            });
            h.on(p, ".btn-undo", function (b) {
                f(a(this).parents("li"));
                b.preventDefault()
            });
            h.find(o).on(p, "a", function (b) {
                a(this).parents("ul").find("." + d.activeClass).removeClass(d.activeClass);
                a(this).addClass(d.activeClass);
                var c = a(this).attr("href").slice(1);
                if (c == "all") {
                    a("*", j).fadeTo(200, 1)
                } else {
                    j.each(function () {
                        if (!a(this).hasClass("in-bin")) {
                            var b = a(this).data("gallery-filter");
                            if (b == c) {
                                a("*", this).fadeTo(200, 1)
                            } else {
                                a("*", this).fadeTo(200, d.opacityFilter)
                            }
                        }
                    })
                }
                b.preventDefault()
            })
        })
    };
    a.fn.eGallery.options = {
        draggable: true,
        clearTrash: true,
        opacityFilter: .3,
        activeClass: "active",
        labelButton: "Empty",
        labelTrash: "Dragg to delete"
    }
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.eLiveSearch = function (d) {
        d = a.extend({}, a.fn.eLiveSearch.options, d);
        return this.each(function () {
            function e(b) {
                if (d.file.length > 1) {
                    var c = d.file
                } else {
                    if (f.prop("action").length) {
                        var c = f.attr("action")
                    } else {
                        alert("There is no search template(file) defined!");
                        var c = ""
                    }
                }
                var e = [d.param1, d.param2, d.param3, d.param4, d.param5, d.param6, d.param7, d.param8, d.param9, d.param10];
                var g = new Array;
                for (i = 0; i < 10; i++) {
                    if (e[i].length > 1) {
                        if (f.find(e[i]).is("[type=text]")) {
                            g[i] = f.find(e[i]).val()
                        } else {
                            g[i] = f.find(e[i]).find(":selected").val()
                        }
                    } else {
                        g[i] = ""
                    }
                }
                a.post(c, {
                    value: b,
                    param1: g[0],
                    param2: g[1],
                    param3: g[2],
                    param4: g[3],
                    param5: g[4],
                    param6: g[5],
                    param7: g[6],
                    param8: g[7],
                    param9: g[8],
                    param10: g[9],
                    order: d.order,
                    limit: d.maxResults
                }, function (b) {
                    if (m.is(":visible")) {
                        m[o](d.speed, function () {
                            a(this).children().remove().end().prepend(b)[n](d.speed)
                        })
                    } else {
                        m.children().remove().end().prepend(b)[n](d.speed)
                    }
                }).error(function () {
                    alert("There has been an error, please check your settings!")
                }).success(function () {
                    if (typeof d.afterLoad == "function") {
                        d.afterLoad.call(this)
                    }
                })
            }
            var f = a(this);
            var g = f.find("[type=text]:first");
            var h = f.find("[type=submit]");
            var j = null;
            var k = a(d.target);
            if ("ontouchstart" in b || b.DocumentTouch && c instanceof DocumentTouch) {
                var l = "click tap"
            } else {
                var l = "click"
            }
            if (k.length) {
                k.prepend('<div class="elivesearch"/>');
                var m = k.children("div.elivesearch")
            }
            if (d.effect == "slide") {
                var n = "slideDown";
                var o = "slideUp"
            } else {
                var n = "fadeIn";
                var o = "fadeOut"
            }
            if (d.live === true) {
                g.keyup(function () {
                    var b = a.trim(a(this).val());
                    var c = b.length;
                    if (c >= d.minChar) {
                        clearTimeout(j);
                        j = setTimeout(function () {
                            e(b)
                        }, d.liveDelay)
                    } else {
                        m[o](d.speed)
                    }
                })
            } else {
                f.submit(function () {
                    var b = a.trim(a(this).find("[type=text]").val());
                    var c = b.length;
                    if (c >= d.minChar) {
                        e(b)
                    }
                })
            }
            f.submit(function () {
                return false
            });
            if (d.closeClass) {
                a("body").on(l, "." + d.closeClass, function () {
                    a(this).parents("div.elivesearch")[o](d.speed)
                })
            }
        })
    };
    a.fn.eLiveSearch.options = {
        file: "",
        target: "",
        maxResults: 5,
        order: "random",
        live: true,
        minChar: 3,
        liveDelay: 1e3,
        effect: "slide",
        speed: 400,
        closeClass: "",
        param1: "",
        param2: "",
        param3: "",
        param4: "",
        param5: "",
        param6: "",
        param7: "",
        param8: "",
        param9: "",
        param10: "",
        afterLoad: function () {}
    }
})(jQuery, window, document);
(function (a, b, c, d) {
    function e() {
        a(c).ready(function () {
            a("body").append('<ul class="e-growl-left-top"></ul>' + '<ul class="e-growl-left-bottom"></ul>' + '<ul class="e-growl-right-top"></ul>' + '<ul class="e-growl-right-bottom"></ul>' + '<div class="e-notification-top"></div>' + '<div class="e-notification-bottom"></div>')
        })
    }
    e();
    a.e_notify = {
        growl: function (d) {
            if ("ontouchstart" in b || b.DocumentTouch && c instanceof DocumentTouch) {
                var e = "click tap"
            } else {
                var e = "click"
            }
            if (typeof d.onShow == "function") {
                d.onShow.call(this)
            }
            var f = Math.floor(Math.random() * 1111);
            var g = '<li><div class="e-growl" id="e-growl-' + f + '">' + "<span>x</span>" + '<div class="e-growl-img"><img src="' + d.image + '" alt=""/></div>' + '<div class="e-growl-content">' + "<h5>" + d.title + "</h5>" + "<p>" + d.text + "</p>" + "</div>" + "</div></li>";
            switch (d.position) {
                case "left-top":
                    a("ul.e-growl-left-top").addClass("e-growl-wrapper").prepend(g);
                    break;
                case "left-bottom":
                    a("ul.e-growl-left-bottom").addClass("e-growl-wrapper").append(g);
                    break;
                case "right-top":
                    a("ul.e-growl-right-top").addClass("e-growl-wrapper").prepend(g);
                    break;
                case "right-bottom":
                    a("ul.e-growl-right-bottom").addClass("e-growl-wrapper").append(g);
                    break
            }
            var h = a("#e-growl-" + f);
            if (!d.closable === true) {
                h.find("span").remove()
            }
            if (!d.image) {
                h.children("div").css({
                    width: "100%"
                }).prev(".e-growl-img").remove()
            }
            if (!d.title) {
                h.find("h5").remove()
            }
            if (!d.text) {
                h.find("p").remove()
            }
            if (d.className) {
                h.addClass(d.className)
            } else {
                h.addClass("growl-default")
            }
            h.parent("li").animate({
                height: h.height() + 15 + "px"
            }, d.speed, function () {
                if (d.delay > 0) {
                    var b = d.delay
                } else {
                    b = 0
                }
                if (d.effect == "fade") {
                    h.css({
                        right: 0,
                        left: 0
                    }).delay(b).fadeIn(d.speed).trigger("autohide")
                } else if (d.effect == "slidein") {
                    h.delay(b).show(1, function () {
                        if (h.parents("ul").is("ul.e-growl-left-top, ul.e-growl-left-bottom")) {
                            a(this).animate({
                                left: 0
                            }, d.speed, function () {
                                a(this).trigger("autohide")
                            })
                        } else {
                            a(this).animate({
                                right: 0
                            }, d.speed, function () {
                                a(this).trigger("autohide")
                            })
                        }
                    })
                }
                a(this).bind("autohide", function () {
                    if (d.sticky != true) {
                        a(this).children("div").delay(d.time).fadeOut(d.speed, function () {
                            a(this).parent("li").slideUp(d.speed, function () {
                                a(this).remove();
                                if (typeof d.onHide == "function") {
                                    d.onHide.call(this)
                                }
                            })
                        })
                    }
                })
            });
            h.on(e, "span", function () {
                a(this).parents("div").fadeTo(d.speed, 0, function () {
                    a(this).parent("li").slideUp(d.speed, function () {
                        a(this).remove()
                    })
                });
                if (typeof d.onHide == "function") {
                    d.onHide.call(this)
                }
            });
            var i = h.parent();
            if (h.parents("ul").is(".e-growl-left-top, .e-growl-right-top")) {
                h.parents("ul").children("li").each(function (b) {
                    if (b >= d.maxOpen) {
                        a(this).not(i).fadeOut(d.speed, function () {
                            a(this).remove();
                            if (typeof d.onHide == "function") {
                                d.onHide.call(this)
                            }
                        })
                    }
                })
            } else {
                jQuery.fn.reverse = [].reverse;
                h.parents("ul").children("li").reverse().each(function (b) {
                    if (b >= d.maxOpen) {
                        a(this).not(i).fadeOut(d.speed, function () {
                            a(this).remove();
                            if (typeof d.onHide == "function") {
                                d.onHide.call(this)
                            }
                        })
                    }
                })
            }
        },
        notification: function (d) {
            if ("ontouchstart" in b || b.DocumentTouch && c instanceof DocumentTouch) {
                var e = "click tap"
            } else {
                var e = "click"
            }
            if (typeof d.onShow == "function") {
                d.onShow.call(this)
            }
            var f = Math.floor(Math.random() * 1111);
            var g = '<div id="e-notification-' + f + '" class="e-notification"><p>' + d.text + "</p><span>X</span></div>";
            if (d.target.length > 1) {
                a(d.target).prepend(g)
            } else {
                switch (d.position) {
                    case "top":
                        a("div.e-notification-top").prepend(g);
                        break;
                    case "bottom":
                        a("div.e-notification-bottom").prepend(g);
                        break
                }
            }
            var h = a("#e-notification-" + f);
            if (!d.closable === true) {
                h.find("span").remove()
            }
            if (d.className) {
                h.addClass(d.className)
            } else {
                h.addClass("notification-default")
            }
            if (d.delay > 0) {
                var i = d.delay
            } else {
                i = 0
            }
            if (d.effect == "fade") {
                var j = "fadeIn";
                var k = "fadeOut"
            } else if (d.effect == "slide") {
                j = "slideDown";
                k = "slideUp"
            }
            if (h.next("div.e-notification").length) {
                h.next("div.e-notification")[k](d.speed, function () {
                    a(this).remove();
                    h.delay(i)[j](d.speed, function () {
                        if (d.sticky != true) {
                            a(this).delay(d.time)[k](d.speed, function () {
                                a(this).remove();
                                if (typeof d.onHide == "function") {
                                    d.onHide.call(this)
                                }
                            })
                        }
                    })
                })
            } else {
                h.delay(i)[j](d.speed, function () {
                    if (d.sticky != true) {
                        a(this).delay(d.time)[k](d.speed, function () {
                            a(this).remove();
                            if (typeof d.onHide == "function") {
                                d.onHide.call(this)
                            }
                        })
                    }
                })
            }
            h.on(e, "span", function () {
                a(this).parent("div")[k](d.speed, 0, function () {
                    a(this).remove()
                });
                if (typeof d.onHide == "function") {
                    d.onHide.call(this);
                    d.onHide = false
                }
            })
        },
        loader: function (b) {
            if (typeof b.onShow == "function") {
                b.onShow()
            }
            a("body").append('<div id="e-loader"><div id="e-loader-overlay"></div><div id="e-loader-img"><img src="' + b.image + '" alt=""/></div></div>');
            a("#e-loader-overlay").css({
                opacity: b.opacity
            });
            switch (b.position) {
                case "left-top":
                    a("#e-loader-img").css({
                        left: 20,
                        top: 20
                    });
                    break;
                case "left-bottom":
                    a("#e-loader-img").css({
                        left: 20,
                        bottom: 20
                    });
                    break;
                case "right-top":
                    a("#e-loader-img").css({
                        left: 20,
                        top: 20
                    });
                    break;
                case "right-bottom":
                    a("#e-loader-img").css({
                        right: 20,
                        bottom: 20
                    });
                    break;
                case "center":
                    var c = b.imageSize.split("|");
                    var d = c[0] / 2;
                    var e = c[1] / 2;
                    a("#e-loader-img").css({
                        left: "50%",
                        top: "50%",
                        marginLeft: "-" + (d + 10) + "px",
                        marginTop: "-" + (e + 10) + "px"
                    });
                    break
            }
            if (b.delay > 0) {
                var f = b.delay
            } else {
                var f = 0
            }
            a("#e-loader").delay(f).fadeIn(b.speed).delay(b.time).fadeOut(b.speed, function () {
                a(this).remove();
                if (typeof b.onHide == "function") {
                    b.onHide.call(this)
                }
            })
        },
        countdown: function () {},
        clear: function (b) {
            if (typeof b.beforeClear == "function") {
                b.beforeClear.call(this)
            }
            if (b.type == "growl") {
                a("ul.e-growl-wrapper").children("li").fadeOut(200, function () {
                    a(this).remove();
                    if (typeof b.afterClear == "function") {
                        b.afterClear.call(this);
                        b.afterClear = false
                    }
                })
            } else if (b.type == "notification") {
                a("div.e-notification").fadeOut(200, function () {
                    a(this).remove();
                    if (typeof b.afterClear == "function") {
                        b.afterClear.call(this);
                        b.afterClear = false
                    }
                })
            }
        }
    }
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.eCountdown = function (b) {
        b = a.extend({}, a.fn.eCountdown.options, b);
        return this.each(function () {
            function c(a, c, d) {
                s = (Math.floor(a / c) % d).toString();
                if (b.showZero && s.length < 2) {
                    if (s < 0) {
                        var e = "00"
                    } else {
                        var e = "0" + s
                    }
                } else {
                    if (s < 0) {
                        var e = "0"
                    } else {
                        var e = s
                    }
                }
                return "<b>" + e + "</b>"
            }
            function d(e) {
                if (e < 0) {
                    if (typeof b.after == "function") {
                        b.after.call(this)
                    }
                    var i = true
                } else {
                    var i = false
                }
                displayStr = b.displayFormat.replace(/%D%/g, c(e, 86400, 1e5));
                displayStr = displayStr.replace(/%H%/g, c(e, 3600, 24));
                displayStr = displayStr.replace(/%M%/g, c(e, 60, 60));
                displayStr = displayStr.replace(/%S%/g, c(e, 1, 60));
                a("#e-countdown-" + g).html(displayStr);
                if (b.liveTime && i === false) {
                    setTimeout(function () {
                        d(e + f)
                    }, h)
                }
                return
            }
            var e = a(this);
            var f = -1;
            var g = Math.floor(Math.random() * 1111);
            if (e.length) {
                e.append('<span id="e-countdown-' + g + '"></span>')
            }
            f = Math.ceil(f);
            var h = (Math.abs(f) - 1) * 1e3 + 990;
            var i = new Date(b.targetDate);
            var j = new Date;
            if (f > 0) {
                ddiff = new Date(j - i)
            } else {
                ddiff = new Date(i - j)
            }
            gsecs = Math.floor(ddiff.valueOf() / 1e3);
            d(gsecs)
        })
    };
    a.fn.eCountdown.options = {
        targetDate: "",
        displayFormat: "%D% Days, %H% Hours, %M% Minutes, %S% Seconds.",
        liveTime: true,
        showZero: true,
        after: function () {}
    }
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.eClone = function (d) {
        d = a.extend({}, a.fn.eClone.options, d);
        return this.each(function () {
            var e = a(this);
            var f = e.find(d.trigger);
            if ("ontouchstart" in b || b.DocumentTouch && c instanceof DocumentTouch) {
                var g = "click tap"
            } else {
                var g = "click"
            }
            if (d.effect == "slide") {
                var h = "slideDown"
            } else {
                var h = "fadeIn"
            }
            f.on(g, this, function (b) {
                if (typeof d.before == "function") {
                    d.before.call(this)
                }
                var c = e.find(d.target).not("." + d.excludeClass).last();
                c.addClass("clone-target");
                e.find(".clone-target").clone().insertAfter(c).hide().addClass("clone-new");
                e.find(".clone-target").removeClass("clone-target");
                e.find(".clone-new")[h](d.speed, function () {
                    a(this).fadeTo(d.speed, 1).removeClass("clone-new");
                    if (typeof d.after == "function") {
                        d.after.call(this)
                    }
                });
                b.preventDefault()
            })
        })
    };
    a.fn.eClone.options = {
        target: "div",
        trigger: ".clone-trigger",
        excludeClass: "not-clone",
        effect: "slide",
        speed: 200,
        before: function () {},
        after: function () {}
    }
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.eChainedInputs = function (b) {
        b = a.extend({}, a.fn.eChainedInputs.options, b);
        return this.each(function () {
            var c = a(this);
            c.on("keyup", "[data-chained-group]", function () {
                var c = a(this).data("chained-group");
                var d = a(this).attr("maxlength");
                var e = a(this).val().length;
                var f = a('[data-chained-group="' + c + '"]').length - 1;
                var g = a(this).index('[data-chained-group="' + c + '"]');
                if (e == d) {
                    if (g == f) {
                        if (typeof b.callback == "function") {
                            b.callback.call(this)
                        }
                    } else {
                        a('[data-chained-group="' + c + '"]').eq(g + 1).focus()
                    }
                }
            });
            c.on("focus", "[data-chained-group]", function () {
                if (this.createTextRange) {
                    var b = this.createTextRange();
                    b.moveStart("character", this.value.length);
                    b.collapse();
                    b.select()
                } else {
                    var c = a(this).val().length * 2;
                    this.setSelectionRange(c, c)
                }
            })
        })
    };
    a.fn.eChainedInputs.options = {
        callback: function () {}
    }
})(jQuery, window, document);
(function (a, b, c, d) {
    a.fn.eShowPassword = function (d) {
        d = a.extend({}, a.fn.eShowPassword.options, d);
        return this.each(function () {
            var e = a(this);
            if ("ontouchstart" in b || b.DocumentTouch && c instanceof DocumentTouch) {
                var f = "click tap"
            } else {
                var f = "click"
            }
            if (e.is("[type=password]")) {
                e.not(d.exclude).wrap('<div class="e-showpassword"/>').before('<input type="text" class="e-showpassword-text"/>')
            }
            a("body").on(f, d.trigger, function (a) {
                var b = e.prev();
                if (b.is(":hidden")) {
                    b.show().val(e.val())
                } else {
                    b.hide();
                    e.val(b.val())
                }
                if (typeof d.onSwitch == "function") {
                    d.onSwitch.call(this)
                }
                a.preventDefault()
            })
        })
    };
    a.fn.eShowPassword.options = {
        trigger: "",
        exclude: "",
        onSwitch: function () {}
    }
})(jQuery, window, document);
$(document).ready(function (a) {
    a("#choose-styling").eStyleSwitcher({
        target: "#themesheet",
        dir: "css/theme/",
        storeStyle: false,
        onSwitch: function () {}
    });
    a("#content").powerWidgets({
        grid: "section",
        widgets: ".powerwidget",
        localStorage: true,
        deleteSettingsKey: "#deletesettingskey-options",
        settingsKeyLabel: "Reset settings?",
        deletePositionKey: "#deletepositionkey-options",
        positionKeyLabel: "Reset position?",
        sortable: true,
        buttonsHidden: false,
        toggleButton: true,
        toggleClass: "min-10 plix-10 | plus-10 plix-10",
        toggleSpeed: 200,
        onToggle: function () {},
        deleteButton: false,
        deleteClass: "trashcan-10",
        deleteSpeed: 200,
        onDelete: function () {},
        editButton: false,
        editPlaceholder: ".powerwidget-editbox",
        editClass: "pencil-10 | delete-10",
        editSpeed: 200,
        onEdit: function () {},
        fullscreenButton: false,
        fullscreenClass: "fullscreen-10 | normalscreen-10",
        fullscreenDiff: 3,
        onFullscreen: function () {},
        customButton: false,
        customClass: "folder-10 | next-10",
        customStart: function () {
            alert("Hello you, this is a custom button...")
        },
        customEnd: function () {
            alert("bye, till next time...")
        },
        buttonOrder: "%refresh% %delete% %custom% %edit% %fullscreen% %toggle%",
        opacity: 1,
        dragHandle: "> header",
        placeholderClass: "powerwidget-placeholder",
        indicator: true,
        indicatorTime: 600,
        ajax: true,
        timestampPlaceholder: ".powerwidget-timestamp",
        timestampFormat: "Last update: %m%/%d%/%y% %h%:%i%:%s%",
        refreshButton: true,
        refreshButtonClass: "refresh-10 plix-10",
        labelError: "Sorry but there was a error:",
        labelUpdated: "Last Update:",
        labelRefresh: "Refresh",
        labelDelete: "Delete widget:",
        afterLoad: function () {},
        rtl: false
    });
    a("#powerwidgetspanel").powerWidgetsPanel({
        target: "#content",
        widgets: ".powerwidget",
        localStorage: true,
        trigger: "#powerwidget-panel-switch",
        triggerClass: "plus-10 | min-10",
        effectPanel: "slide",
        speedPanel: 200,
        effectWidget: "slide",
        speedWidget: 200,
        onToggle: function () {}
    });
    a("select").eSelect({
        exclude: "#valueA, #valueB, #set-layout-size, #set-layout-responsive, #choose-styling, #get-theme",
        speed: 200,
        after: function () {}
    });
    a('input[type="file"]').eFile({
        label: "upload",
        exclude: "",
        onUpload: function () {}
    });
    a('input[type="checkbox"]').eCheckbox();
    a('input[type="radio"]').eRadio();
    a("#demo-tabs-1").eTabs({
        storeTab: true,
        responsive: true,
        callback: function () {}
    });
    a("#demo-tabs-2").eTabs({
        selected: 3,
        storeTab: true,
        responsive: true,
        callback: function () {}
    });
    a("#demo-tabs-3").eTabs({
        storeTab: true,
        responsive: false,
        callback: function () {}
    });
    a("#demo-tabs-4").eTabs({
        storeTab: true,
        responsive: false,
        callback: function () {}
    });
    a("#doc-tabs").eTabs({
        storeTab: true,
        responsive: true,
        callback: function () {}
    });
    a("#e-block-etabs1, #e-block-etabs2").eTabs({
        storeTab: true,
        responsive: false,
        callback: function () {}
    });
    a("#dialog-5").eTabs({
        storeTab: true,
        responsive: false,
        callback: function () {}
    });
    a("nav#main-menu").eMainMenu({
        activeClass: "sub-page-active",
        closeClass: "min-10",
        openClass: "plus-10",
        speed: 400
    });
    a("ul#header-menu").eMenu({
        effect: "fade",
        speed: 100,
        target: ".e-menu-sub",
        typeEvent: "hover",
        activeClass: "e-menu-active",
        flip: [0, 1, 2]
    });
    a("ul#page-actions").eMenu({
        effect: "slide",
        speed: 200,
        target: ".e-menu-sub",
        typeEvent: "hover",
        activeClass: "e-menu-active",
        flip: [0]
    });
    a("ul#demo-menu-1").eMenu({
        effect: "slide",
        speed: 200,
        target: ".e-menu-sub",
        typeEvent: "click",
        activeClass: "e-menu-active",
        flip: []
    });
    a("ul#demo-menu-2").eMenu({
        effect: "fade",
        speed: 200,
        target: ".e-menu-sub",
        typeEvent: "hover",
        activeClass: "e-menu-active",
        flip: [0, 1, 2, 3]
    });
    a("ul.table-splitmenu").eMenu({
        effect: "fade",
        speed: 200,
        target: ".e-menu-sub",
        typeEvent: "hover",
        activeClass: "e-menu-active",
        flip: [0]
    });
    a(".input-scroll-box").eScrollbar();
    a("#countdown-1").eCountdown({
        targetDate: "07/31/2014 5:01 AM",
        displayFormat: "%D% Days, %H% Hours, %M% Minutes, %S% Seconds.",
        liveTime: true,
        showZero: true,
        callback: function () {}
    });
    a("#countdown-2").eCountdown({
        targetDate: "10/31/2012 5:01 AM",
        displayFormat: "%H% Hours, %M% Minutes, %S% Seconds (%D% Days)",
        liveTime: true,
        showZero: true,
        callback: function () {}
    });
    a("#project-cndw-1").eCountdown({
        targetDate: "01/31/2013 5:01 AM",
        displayFormat: "%D% Days, %H% Hours, %M% Minutes, %S% Seconds.",
        liveTime: true,
        showZero: true,
        callback: function () {}
    });
    a("#project-cndw-2").eCountdown({
        targetDate: "10/31/2012 1:23 AM",
        displayFormat: "%D% Days, %H% Hours, %M% Minutes",
        liveTime: true,
        showZero: true,
        callback: function () {}
    });
    a("#project-cndw-3").eCountdown({
        targetDate: "12/22/2012 9:08 AM",
        displayFormat: "%D% Days, %H% Hours, %M% Minutes",
        liveTime: true,
        showZero: true,
        callback: function () {}
    });
    a("#project-cndw-4").eCountdown({
        targetDate: "02/11/2013 10:55 PM",
        displayFormat: "%D% Days, %H% Hours, %M% Minutes",
        liveTime: true,
        showZero: true,
        callback: function () {}
    });
    a("#project-cndw-5").eCountdown({
        targetDate: "12/31/2012 9:09 PM",
        displayFormat: "%H% Hours, %M% Minutes, %S% Seconds.",
        liveTime: true,
        showZero: true,
        callback: function () {}
    });
    a("#form-validation").eContactForm({
        labelError: "This field is required!",
        labelSuccess: "Your message has been send successfully!",
        labelFail: "The form has not been send, please try it again!",
        keydown: true,
        useAjax: true,
        before: function () {},
        after: function () {}
    });
     a("#form-validation-lead").eContactForm({
        labelError: "This field is required!",
        labelSuccess: "Your message has been send successfully!",
        labelFail: "The form has not been send, please try it again!",
        keydown: true,
        useAjax: false,
        before: function () {},
        after: function () {}
    });
    a("#textarea-limiter").eTextareaLimiter({
        maximum: 250,
        savety: true
    });
    a("a#open-growl-1").click(function (b) {
        a.e_notify.growl({
            title: "Sticky growl",
            text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vel arcu est. Suspendisse laoreet nisl nec magna feugiat.",
            image: "images/growl-1.jpg",
            position: "right-top",
            delay: 0,
            time: 2500,
            speed: 400,
            effect: "fade",
            sticky: true,
            closable: true,
            maxOpen: 3,
            className: "",
            onShow: function () {},
            onHide: function () {}
        });
        b.preventDefault()
    });
    a("a#open-growl-2").click(function (b) {
        a.e_notify.growl({
            title: "Sticky with auto hide",
            text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vel arcu est. Suspendisse laoreet nisl.",
            image: "images/growl-2.jpg",
            position: "right-bottom",
            delay: 0,
            time: 5e3,
            speed: 500,
            effect: "slidein",
            sticky: false,
            closable: false,
            maxOpen: 3,
            className: "",
            onShow: function () {},
            onHide: function () {}
        });
        b.preventDefault()
    });
    a("a#open-growl-3").click(function (b) {
        a.e_notify.growl({
            text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vel arcu est. Suspendisse laoreet nisl.",
            position: "left-top",
            delay: 0,
            time: 2500,
            speed: 500,
            effect: "slidein",
            sticky: true,
            closable: true,
            maxOpen: 3,
            className: "",
            onShow: function () {},
            onHide: function () {}
        });
        b.preventDefault()
    });
    a("a#open-growl-4").click(function (b) {
        a.e_notify.growl({
            title: "Sticky with max 6 open",
            position: "left-bottom",
            delay: 0,
            time: 2500,
            speed: 500,
            effect: "slidein",
            sticky: true,
            closable: true,
            maxOpen: 6,
            className: "",
            onShow: function () {},
            onHide: function () {}
        });
        b.preventDefault()
    });
    a("a#open-growl-5").click(function (b) {
        a.e_notify.growl({
            title: "Growl with custom class",
            text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vel arcu est. Suspendisse laoreet nisl nec magna feugiat.",
            image: "images/growl-2.jpg",
            position: "right-top",
            delay: 0,
            time: 2500,
            speed: 500,
            effect: "slidein",
            sticky: true,
            closable: true,
            maxOpen: 3,
            className: "growl-white",
            onShow: function () {},
            onHide: function () {}
        });
        b.preventDefault()
    });
    a("a#open-growl-6").click(function (b) {
        a.e_notify.growl({
            title: "Sticky with callbacks",
            text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vel arcu est. Suspendisse laoreet nisl.",
            position: "left-bottom",
            delay: 0,
            time: 2500,
            speed: 500,
            effect: "slidein",
            sticky: true,
            closable: true,
            maxOpen: 3,
            className: "",
            onShow: function () {
                alert("Callback on show...")
            },
            onHide: function () {
                alert("Callback on hide...")
            }
        });
        b.preventDefault()
    });
    a("a#open-growl-7").click(function (b) {
        a.e_notify.clear({
            type: "growl",
            beforeClear: function () {
                alert("You can use a callback before removing...")
            },
            afterClear: function () {
                alert("You can use a callback after removing...")
            }
        });
        b.preventDefault()
    });
    a("a#open-loader-1").click(function (b) {
        a.e_notify.loader({
            image: "images/loaders/type2/light/32.gif",
            position: "center",
            imageSize: "32 | 32",
            delay: 0,
            time: 1200,
            speed: 100,
            opacity: .5,
            onShow: function () {},
            onHide: function () {}
        });
        b.preventDefault()
    });
    a("a#open-loader-2").click(function (b) {
        a.e_notify.loader({
            image: "images/loaders/type4/light/56.gif",
            position: "right-bottom",
            imageSize: "56 | 19",
            delay: 0,
            time: 2e3,
            speed: 200,
            opacity: 0,
            onShow: function () {},
            onHide: function () {}
        });
        b.preventDefault()
    });
    a("a#open-loader-3").click(function (b) {
        a.e_notify.loader({
            image: "images/loaders/type2/light/32.gif",
            position: "center",
            delay: 0,
            time: 2e3,
            speed: 200,
            opacity: .5,
            onShow: function () {
                alert("Callback on show...")
            },
            onHide: function () {
                alert("Callback on hide...")
            }
        });
        b.preventDefault()
    });
    a("a#open-notification-1").click(function (b) {
        a.e_notify.notification({
            text: 'This notification message, has the custom class called "notification-warning".',
            position: "top",
            target: "",
            delay: 0,
            time: 2500,
            speed: 500,
            effect: "slide",
            sticky: true,
            closable: true,
            className: "notification-warning",
            onShow: function () {},
            onHide: function () {}
        });
        b.preventDefault()
    });
    a("a#open-notification-2").click(function (b) {
        a.e_notify.notification({
            text: 'This notification message, has the custom class called "notification-info".',
            position: "bottom",
            target: " ",
            delay: 0,
            time: 2500,
            speed: 500,
            effect: "slide",
            sticky: true,
            closable: true,
            className: "notification-info",
            onShow: function () {},
            onHide: function () {}
        });
        b.preventDefault()
    });
    a("a#open-notification-3").click(function (b) {
        a.e_notify.notification({
            text: '<img src="images/icons/dialogs/plus-16.png" alt=""/> Yes you can add a notification to a target!',
            position: "top",
            target: "#widget2 > div",
            delay: 0,
            time: 2500,
            speed: 500,
            effect: "slide",
            sticky: true,
            closable: true,
            className: "notification-success-widget",
            onShow: function () {},
            onHide: function () {}
        });
        b.preventDefault()
    });
    a("a#open-notification-4").click(function (b) {
        a.e_notify.notification({
            text: 'This notification message, has the custom class called "notification-error". This message will hide after 5000 ms.',
            position: "top",
            target: "",
            delay: 0,
            time: 5e3,
            speed: 500,
            effect: "slide",
            sticky: false,
            closable: true,
            className: "notification-error",
            onShow: function () {},
            onHide: function () {}
        });
        b.preventDefault()
    });
    a("a#open-notification-5").click(function (b) {
        a.e_notify.notification({
            text: 'This notification message, has the custom class called "notification-error". This mesaage will hide after 5000 ms.',
            position: "top",
            target: "",
            delay: 0,
            time: 2e3,
            speed: 500,
            effect: "slide",
            sticky: false,
            closable: true,
            className: "notification-error",
            onShow: function () {
                alert("Callback on show...")
            },
            onHide: function () {
                alert("Callback on hide...")
            }
        });
        b.preventDefault()
    });
    a("a#open-notification-6").click(function (b) {
        a.e_notify.clear({
            type: "notification",
            beforeClear: function () {
                alert("You can use a callback before removing...")
            },
            afterClear: function () {
                alert("You can use a callback after removing...")
            }
        });
        b.preventDefault()
    });
    a("form#mainsearch").eLiveSearch({
        file: "ajax/mainsearch-results.php",
        target: "aside",
        maxResults: 3,
        order: "random",
        live: true,
        minChar: 3,
        liveDelay: 1e3,
        effect: "slide",
        speed: 400,
        closeClass: "close-search",
        param1: "",
        param2: "",
        param3: "",
        param4: "",
        param5: "",
        param6: "",
        param7: "",
        param8: "",
        param9: "",
        param10: "",
        afterLoad: function () {}
    });
    a("form#search").eLiveSearch({
        file: "ajax/search-results.php",
        target: "#advanced-search-results",
        maxResults: 5,
        order: "random",
        live: false,
        minChar: 3,
        liveDelay: 1e3,
        effect: "slide",
        speed: 400,
        closeClass: "",
        param1: "#search-searchin",
        param2: "#search-show",
        param3: "#search-order",
        param4: "",
        param5: "",
        param6: "",
        param7: "",
        param8: "",
        param9: "",
        param10: "",
        afterLoad: function () {}
    });
    a("#e-gallery").eGallery({
        draggable: true,
        clearTrash: true,
        opacityFilter: .3,
        activeClass: "active",
        labelButton: "Empty",
        labelTrash: "Dragg to delete"
    });
    a("#progressbar-demo-1").eProgressbar({
        animate: false,
        easing: "",
        loop: true,
        delay: 400,
        showTotal: true,
        speed: 2e3,
        after: function () {}
    });
    a("#progressbar-demo-2").eProgressbar({
        animate: true,
        easing: "",
        loop: true,
        delay: 400,
        showTotal: true,
        speed: 2e3,
        after: function () {}
    });
    a("#progressbar-demo-3").eProgressbar({
        animate: true,
        easing: "",
        loop: true,
        delay: 400,
        showTotal: true,
        speed: 2e3,
        after: function () {}
    });
    a("#progressbar-demo-4").eProgressbar({
        animate: false,
        easing: "",
        loop: true,
        delay: 400,
        showTotal: true,
        speed: 2e3,
        after: function () {}
    });
    a("#progressbar-demo-6").eProgressbar({
        animate: false,
        easing: "",
        loop: true,
        delay: 400,
        showTotal: true,
        speed: 2e3,
        after: function () {}
    });
    a("#tableexample2").eProgressbar({
        animate: true,
        easing: "",
        loop: true,
        delay: 400,
        showTotal: false,
        speed: 2e3,
        after: function () {}
    });
    a("#basic-table, #tableexample1, #tableexample2, #tableexample3").eResponsiveTable({
        className: "rt-"
    });
    a(".clone-range").eClone({
        target: ".g_1",
        trigger: ".clone-trigger",
        excludeClass: "not-clone",
        effect: "slide",
        speed: 200,
        before: function () {},
        after: function () {}
    });
    a("#inputexpand").eInputExpand({
        width: 320,
        height: 220,
        labelSubmit: "Insert",
        labelCancel: "Cancel",
        opacity: .5,
        escKey: true,
        before: function () {},
        after: function () {}
    });
    a("form#form-validation, form#form").eChainedInputs({
        callback: function () {}
    });
    a("#passwordfield").eShowPassword({
        trigger: "#show-password",
        exclude: "",
        onSwitch: function () {}
    });
    a("#onscreen-keyboard").eOsKeyboard({
        title: "OS Keyboard",
        trigger: "icon",
        draggable: true,
        posY: 20,
        posX: 0,
        zIndex: 1e3
    });
    a("#main-page-dialog").dialog({
        autoOpen: false,
        bgiframe: true,
        width: 500,
        resizable: false,
        modal: true,
        resizable: false,
        buttons: {
            Ok: function () {
                a(this).dialog("close")
            }
        }
    });
    a("#open-main-dialog").click(function () {
        a("#main-page-dialog").dialog("open");
        return false
    });
    a("#dialog-1").dialog({
        autoOpen: false,
        bgiframe: true,
        width: 340,
        resizable: false
    });
    a("#open-dialog-1").click(function () {
        a("#dialog-1").dialog("open");
        return false
    });
    a("#dialog-2").dialog({
        autoOpen: false,
        bgiframe: true,
        width: 340,
        modal: true,
        resizable: false,
        buttons: {
            Ok: function () {
                a(this).dialog("close")
            }
        }
    });
    a("#open-dialog-2").click(function () {
        a("#dialog-2").dialog("open");
        return false
    });
    a("#dialog-3").dialog({
        autoOpen: false,
        bgiframe: true,
        width: 340,
        modal: true,
        resizable: false,
        buttons: {
            "Delete all items": function () {
                a(this).dialog("close")
            },
            Cancel: function () {
                a(this).dialog("close")
            }
        }
    });
    a("#open-dialog-3").click(function () {
        a("#dialog-3").dialog("open");
        return false
    });
    a("#dialog-4").dialog({
        autoOpen: false,
        bgiframe: true,
        width: 380,
        modal: true,
        resizable: false
    });
    a("#open-dialog-4").click(function () {
        a("#dialog-4").dialog("open");
        return false
    });
    a("#dialog-5").dialog({
        autoOpen: false,
        bgiframe: true,
        width: 380,
        modal: true,
        resizable: false
    });
    a("#open-dialog-5").click(function () {
        a("#dialog-5").dialog("open");
        return false
    });
    a("#add-user").dialog({
        autoOpen: false,
        bgiframe: true,
        width: 380,
        modal: true,
        resizable: false
    });
    a("#open-add-user").click(function () {
        a("#add-user").dialog("open");
        return false
    });
    a("#add-image").dialog({
        autoOpen: false,
        bgiframe: true,
        width: 380,
        modal: true,
        resizable: false
    });
    a(".open-add-image").click(function () {
        a("#add-image").dialog("open");
        return false
    });
    a(".group1").colorbox({
        rel: "group1"
    });
    a(".group2").colorbox({
        rel: "group2"
    });
    a(".group3").colorbox({
        rel: "group3"
    });
    a("#datatable-1").dataTable({
        bJQueryUI: true
    });
    if (a("#wysiwyg").length) {
        a("#wysiwyg").elrte({
            cssClass: "el-rte",
            toolbar: "complete",
            height: 250
        })
    }
    if (a("#wysihtml5-textarea").length) {
        var b = new wysihtml5.Editor("wysihtml5-textarea", {
            toolbar: "toolbar",
            stylesheets: "css/wysiwyghtml5.css",
            parserRules: wysihtml5ParserRules
        })
    }
    a("#accordion").accordion({
        autoHeight: false,
        navigation: true
    });
    a("#accordion-fillspace").accordion({
        fillSpace: true
    });
    a("#accordion-collapsible").accordion({
        collapsible: true
    });
    a("#accordion-sortable").accordion({
        header: "> div > h3"
    }).sortable({
        axis: "y",
        handle: "h3",
        stop: function () {
            stop = true
        }
    });
    a("ul.sortable-list").sortable({
        items: "li",
        connectWith: "ul.sortable-list",
        placeholder: "list-highlight",
        cursor: "move",
        revert: true,
        opacity: 1,
        delay: 200,
        handle: ".handle",
        zIndex: 1e4,
        forcePlaceholderSize: true,
        forceHelperSize: true
    });
    a("#basic-ui-slider").slider();
    a("#slider-range-max").slider({
        range: "max",
        min: 1,
        max: 10,
        value: 2,
        slide: function (b, c) {
            a("#amount").val(c.value)
        }
    });
    a("#amount").val(a("#slider-range-max").slider("value"));
    a("#slider-range").slider({
        range: true,
        min: 0,
        max: 500,
        values: [75, 300],
        slide: function (b, c) {
            a("#amount1").val("$" + c.values[0] + " - $" + c.values[1])
        }
    });
    a("#amount1").val("$" + a("#slider-range").slider("values", 0) + " - $" + a("#slider-range").slider("values", 1));
    a("#slider-range-min").slider({
        range: "min",
        value: 37,
        min: 1,
        max: 700,
        slide: function (b, c) {
            a("#amount2").val("$" + c.value)
        }
    });
    a("#amount2").val("$" + a("#slider-range-min").slider("value"));
    a("#slider-vertical").slider({
        orientation: "vertical",
        range: "min",
        min: 0,
        max: 100,
        value: 60,
        slide: function (b, c) {
            a("#amount10").val(c.value)
        }
    });
    a("#amount10").val(a("#slider-vertical").slider("value"));
    a("#slider-range-vertical").slider({
        orientation: "vertical",
        range: true,
        values: [17, 67],
        slide: function (b, c) {
            a("#amount11").val("$" + c.values[0] + " - $" + c.values[1])
        }
    });
    a("#amount11").val("$" + a("#slider-range-vertical").slider("values", 0) + " - $" + a("#slider-range-vertical").slider("values", 1));
    a("#slider-vertical-1").slider({
        orientation: "vertical",
        range: "min",
        min: 0,
        max: 100,
        value: 60,
        slide: function (b, c) {
            a("#amount12").val(c.value)
        }
    });
    a("#amount12").val(a("#slider-vertical-1").slider("value"));
    a("#slider-vertical-2").slider({
        orientation: "vertical",
        range: "min",
        min: 0,
        max: 100,
        value: 80,
        slide: function (b, c) {
            a("#amount13").val(c.value)
        }
    });
    a("#amount13").val(a("#slider-vertical-2").slider("value"));
    a("#slider-vertical-3").slider({
        orientation: "vertical",
        range: "min",
        min: 0,
        max: 100,
        value: 30,
        slide: function (b, c) {
            a("#amount14").val(c.value)
        }
    });
    a("#amount14").val(a("#slider-vertical-3").slider("value"));
    a("#slider-vertical-4").slider({
        orientation: "vertical",
        range: "min",
        min: 0,
        max: 100,
        value: 80,
        slide: function (b, c) {
            a("#amount15").val(c.value)
        }
    });
    a("#amount15").val(a("#slider-vertical-4").slider("value"));
    a("#slider-vertical-5").slider({
        orientation: "vertical",
        range: "min",
        min: 0,
        max: 100,
        value: 50,
        slide: function (b, c) {
            a("#amount16").val(c.value)
        }
    });
    a("#amount16").val(a("#slider-vertical-5").slider("value"));
    a("#tabs-default").tabs();
    a("#tabs-ajax").tabs({
        ajaxOptions: {
            error: function (b, c, d, e) {
                a(e.hash).html("Couldn't load this tab. We'll try to fix this as soon as possible. If this wouldn't be a demo.")
            },
            success: function (b, c, d, e) {
                a(e.hash).html("Loaded")
            }
        }
    });
    a("#tabs-collapsible").tabs({
        collapsible: true
    });
    a("#tabs-sortable").tabs().find(".ui-tabs-nav").sortable({
        axis: "x"
    });
    a("#tabs-mouseover").tabs({
        event: "mouseover"
    });
    var c = ["ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++", "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran", "Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl", "PHP", "Python", "Ruby", "Scala", "Scheme"];
    a("#autocomplete").autocomplete({
        source: c
    });
    a("#browser").treeview({
        control: "#sidetreecontrol"
    });
    if (a("#select-to-ui-slider").length) {
        a("#select-to-ui-slider select").selectToUISlider({
            labels: 12
        })
    }
    var d = a("#fileexplore").elfinder({
        url: "php/connector.php",
        lang: "en",
        resizable: false,
        uiOptions: {
            toolbar: [
                ["back", "forward"],
                ["mkdir", "mkfile", "upload"],
                ["open", "download", "getfile"],
                ["info"],
                ["quicklook"],
                ["copy", "cut", "paste"],
                ["rm"],
                ["duplicate", "rename", "edit"],
                ["extract", "archive"],
                ["search"],
                ["view"],
                ["help"]
            ]
        },
        contextmenu: {
            navbar: ["open", "|", "copy", "cut", "paste", "duplicate", "|", "rm", "|", "info"],
            cwd: ["reload", "back", "|", "upload", "mkdir", "mkfile", "paste", "|", "info"],
            files: ["getfile", "|", "open", "quicklook", "|", "download", "|", "copy", "cut", "paste", "duplicate", "|", "rm", "|", "edit", "rename", "|", "archive", "extract", "|", "info"]
        }
    }).elfinder("instance");
    a.contextMenu({
        selector: "#context-menu",
        callback: function (a, b) {
            var c = "clicked: " + a;
            window.console && console.log(c) || alert(c)
        },
        items: {
            edit: {
                name: "Edit",
                icon: "edit"
            },
            cut: {
                name: "Cut",
                icon: "cut"
            },
            sep1: "---------",
            quit: {
                name: "Quit",
                icon: "quit"
            },
            sep2: "---------",
            fold1: {
                name: "Sub group",
                items: {
                    "fold1-key1": {
                        name: "Foo bar"
                    },
                    fold2: {
                        name: "Sub group 2",
                        items: {
                            "fold2-key1": {
                                name: "alpha"
                            },
                            "fold2-key2": {
                                name: "bravo"
                            },
                            "fold2-key3": {
                                name: "charlie"
                            }
                        }
                    },
                    "fold1-key3": {
                        name: "delta"
                    }
                }
            },
            fold1a: {
                name: "Other group",
                items: {
                    "fold1a-key1": {
                        name: "echo"
                    },
                    "fold1a-key2": {
                        name: "foxtrot"
                    },
                    "fold1a-key3": {
                        name: "golf"
                    }
                }
            }
        }
    });
    a(".external-events-box .external-event").each(function () {
        var b = {
            title: a.trim(a(this).text())
        };
        a(this).data("eventObject", b);
        a(this).draggable({
            zIndex: 999,
            revert: true,
            revertDuration: 0
        })
    });
    var e = new Date;
    var f = e.getDate();
    var g = e.getMonth();
    var h = e.getFullYear();
    a("#calendar").fullCalendar({
        editable: true,
        theme: true,
        header: {
            left: "prev,next",
            center: "title",
            right: "month,agendaWeek,agendaDay"
        },
        events: [{
            title: "All Day Event",
            start: new Date(h, g, 1),
            color: "#e58d25",
            backgroundColor: "#e58d25",
            borderColor: "#e58d25",
            textColor: "#fff"
        }, {
            title: "Long Event",
            start: new Date(h, g, f - 5),
            end: new Date(h, g, f - 2)
        }, {
            id: 999,
            title: "Repeating Event",
            start: new Date(h, g, f - 3, 16, 0),
            allDay: false
        }, {
            id: 999,
            title: "Repeating Event",
            start: new Date(h, g, f + 4, 16, 0),
            allDay: false
        }, {
            title: "Meeting",
            start: new Date(h, g, f, 10, 30),
            allDay: false,
            backgroundColor: "#e63e3e",
            borderColor: "#e63e3e",
            textColor: "#fff"
        }, {
            title: "Lunch",
            start: new Date(h, g, f, 12, 0),
            end: new Date(h, g, f, 14, 0),
            allDay: false
        }, {
            title: "Birthday Party",
            start: new Date(h, g, f + 1, 19, 0),
            end: new Date(h, g, f + 1, 22, 30),
            allDay: false,
            backgroundColor: "#6acc2e",
            borderColor: "#6acc2e"
        }, {
            title: "Click for Google",
            start: new Date(h, g, 28),
            end: new Date(h, g, 29),
            url: "http://google.com/"
        }],
        droppable: true,
        drop: function (b, c) {
            var d = a(this).data("eventObject");
            var e = a.extend({}, d);
            e.start = b;
            e.allDay = c;
            a("#calendar").fullCalendar("renderEvent", e, true);
            if (a(this).parents(".external-events-box").find(".drop-remove").is(":checked")) {
                a(this).remove()
            }
        }
    });
    a("#datepicker-default").datepicker({
        changeMonth: true,
	changeYear: true,
        yearRange: "1900:2020"
       
    });
     a("#datepicker-default_lead_reminder").datepicker({
        changeMonth: true,
	changeYear: true,
        yearRange: "2013:2020"
       
    });
     a("#datepicker-paydate1").datepicker({
        changeMonth: true,
	changeYear: true,
        yearRange: "2013:2020"
       
    });
     a("#datepicker-paydate2").datepicker({
        changeMonth: true,
	changeYear: true,
        yearRange: "2013:2020"
       
    });
    
    
    a("#datepicker-default_end").datepicker({
        changeMonth: true,
	changeYear: true,
        yearRange: "1900:2020"
       
    });
    
     a("#datepicker-policyexpire").datepicker({
        changeMonth: true,
	changeYear: true,
        yearRange: "1900:2020"
       
    });
    
     a("#datepicker-longinsured").datepicker({
        changeMonth: true,
	changeYear: true,
        yearRange: "1900:2020"
       
    });
    
    //a("#datepicker-default_end").datepicker();
    a("#datepicker-default_lead_reminder").datepicker();
    a("#datepicker-default_payday").datepicker();
    
    
    a("#datepicker-icon").datepicker({
        showOn: "button",
        buttonImage: "http://localhost/testkohana/images/datepicker.png",
        buttonImageOnly: true
    });
    a("#datepicker-inline").datepicker();
    a("#datepicker-alt").datepicker({
        altField: "#alternate",
        altFormat: "DD, d MM, yy"
    });
    a("#spinner1").spinner();
    a("#spinner2").spinner({
        step: .01,
        numberFormat: "n"
    });
    a("#spinner3").spinner({
        min: 0,
        max: 10
    });
    a(".autogrow-textarea").autogrow();
    a("textarea.resizable-textarea:not(.processed)").TextAreaResizer();
    if (a("#mask_date, #mask_phone, #mask_extphone, #mask_tin, #mask_ssn, #mask_product, #mask_eyescript").length) {
        a.mask.definitions["~"] = "[+-]";
        a("input#mask_date").mask("99/99/9999");
        a("input#mask_phone").mask("(999) 999-9999");
        a("input#mask_extphone").mask("(999) 999-9999? x99999");
        a("input#mask_tin").mask("99-9999999");
        a("input#mask_ssn").mask("999-99-9999");
        a("input#mask_product").mask("a*-999-a999", {
            placeholder: " ",
            completed: function () {
                alert("You typed the following: " + this.val())
            }
        });
        a("input#mask_eyescript").mask("~9.99 ~9.99 999")
    }
    a(".tip-s").tipsy({
        delayIn: 0,
        delayOut: 0,
        fade: false,
        fallback: "",
        gravity: "s",
        html: false,
        live: false,
        offset: 0,
        opacity: 1,
        title: "title",
        trigger: "hover"
    });
    a(".tip-nw").tipsy({
        gravity: "nw",
        opacity: 1
    });
    a(".tip-n").tipsy({
        gravity: "n",
        opacity: 1
    });
    a(".tip-ne").tipsy({
        gravity: "ne",
        opacity: 1
    });
    a(".tip-w").tipsy({
        gravity: "w",
        opacity: 1
    });
    a(".tip-e").tipsy({
        gravity: "e",
        opacity: 1
    });
    a(".tip-sw").tipsy({
        gravity: "sw",
        opacity: 1
    });
    a(".tip-se").tipsy({
        gravity: "se",
        opacity: 1
    });
    if (a(".audiojsZ").length) {
        audiojs.events.ready(function () {
            var a = document.getElementsByTagName("audio");
            var b = audiojs.create(a[0], {
                css: false,
                createPlayer: {
                    markup: false,
                    playPauseClass: "play-pauseZ",
                    scrubberClass: "scrubberZ",
                    progressClass: "progressZ",
                    loaderClass: "loadedZ",
                    timeClass: "timeZ",
                    durationClass: "durationZ",
                    playedClass: "playedZ",
                    errorMessageClass: "error-messageZ",
                    playingClass: "playingZ",
                    loadingClass: "loadingZ",
                    errorClass: "errorZ"
                }
            })
        })
    }
});
$(document).ready(function (a) {
    a(".basic-table, .clean-table").children("tbody").children("tr:odd").addClass("odd");
    if (localStorage) {
        if (localStorage.getItem("stateMenu")) {
            var b = localStorage.getItem("stateMenu")
        } else {
            var b = 0
        }
    } else {
        var b = 0
    }
    if (b == 1) {
        a("#toggle-sidebar").children().addClass("arrow-right-10").removeClass("arrow-left-10");
        a("body").addClass("mainmenu-to-icon")
    }
    a("#toggle-sidebar").click(function (b) {
        if (a(this).children("span").hasClass("arrow-left-10")) {
            if (localStorage) {
                localStorage.setItem("stateMenu", 1)
            }
            a(this).children("span").addClass("arrow-right-10").removeClass("arrow-left-10");
            a("body").addClass("mainmenu-to-icon");
            a("aside .elivesearch").hide()
        } else {
            if (localStorage) {
                localStorage.setItem("stateMenu", 0)
            }
            a(this).children("span").addClass("arrow-left-10").removeClass("arrow-right-10");
            a("body").removeClass("mainmenu-to-icon")
        }
        a("#content-header .right > .preloader").fadeIn(400).delay(200).fadeOut(400);
        b.preventDefault()
    });
    a(window).resize(function () {
        if (a(window).width() < 599) {
            a("#toggle-sidebar").children("span").addClass("arrow-left-10").removeClass("arrow-right-10");
            a(".mainmenu-to-icon").removeClass("mainmenu-to-icon")
        }
    });
    if (localStorage) {
        if (localStorage.getItem("stateMenuMobile")) {
            var c = localStorage.getItem("stateMenuMobile")
        } else {
            var c = 0
        }
    } else {
        var c = 0
    }
    if (c == 1) {
        a("#toggle-mainmenu").children("span").addClass("arrow-down-10").removeClass("arrow-up-10");
        a("aside").addClass("mainmenu-hide")
    }
    a("#toggle-mainmenu").click(function (b) {
        if (a(this).children("span").hasClass("arrow-down-10")) {
            if (localStorage) {
                localStorage.setItem("stateMenuMobile", 0)
            }
            a(this).children("span").addClass("arrow-up-10").removeClass("arrow-down-10");
            a("aside").removeClass("mainmenu-hide")
        } else {
            if (localStorage) {
                localStorage.setItem("stateMenuMobile", 1)
            }
            a(this).children("span").addClass("arrow-down-10").removeClass("arrow-up-10");
            a("aside").addClass("mainmenu-hide")
        }
        b.preventDefault()
    });
    var d = a("div#content-main-inner");
    a("a.changeto-rows").click(function () {
        d.find("section").addClass("g_one");
        d.find("div.clear").show()
    });
    a("a.changeto-grid").click(function () {
        d.find("section").removeClass("g_one");
        d.find("div.clear").show()
    });
    a("div#widgets-controls .icon-group a").click(function () {
        if (!a(this).hasClass("selected")) {
            a(this).parent("div").children("a").removeClass("selected");
            a(this).addClass("selected");
            a("#widgets-controls .preloader").fadeIn(400).delay(200).fadeOut(400)
        }
    });
    /*a(".dialog, .dialog-big, .dialog-inline, .dialog-big-inline,").click(function () {
        a(this).fadeTo(200, 0, function () {
            a(this).slideUp(400)
        });
        return false
    });*/
    a(".dialog, .dialog-big, .dialog-inline, .dialog-big-inline,").click(function () {
        a(this).fadeTo(200, 0, function () {
            a(this).slideUp(400)
        });
        return false
    });
    a(".media-basic li .delete").click(function (b) {
        a(this).parents("li").hide(1, function () {
            a(this).remove()
        });
        b.preventDefault()
    });
    a("span.toggle-min").click(function () {
        if (a(this).next("pre").is(":hidden")) {
            a(this).next("pre").show();
            a(this).removeClass("toggle-plus").addClass("toggle-min")
        } else {
            a(this).next("pre").hide();
            a(this).removeClass("toggle-min").addClass("toggle-plus")
        }
    });
    a("div#scrolltotop").click(function () {
        a("html, body").animate({
            scrollTop: 0
        }, "slow");
        return false
    });
    a(window).scroll(function () {
        if (a(window).scrollTop() > 200) {
            a("div#scrolltotop").fadeIn(200)
        } else {
            a("div#scrolltotop").fadeOut(200)
        }
    });
    a("a.contact-toggle").click(function () {
        a(this).parents("div.contact-box").children("div").slideToggle();
        if (a(this).children().hasClass("plus-10")) {
            a(this).children().addClass("min-10").removeClass("plus-10")
        } else {
            a(this).children().addClass("plus-10").removeClass("min-10")
        }
        return false
    });
    a(".empty-local-storage").click(function () {
        var a = confirm("Clear all localStorage?");
        if (a && localStorage) {
            localStorage.clear();
            alert("Local storage has been cleared!")
        }
    });
    a("div.appointment-planner").on("click", ".e-radio:not(.e-radio-disabled)", function () {
        a(this).parents("div.appointment-planner").find(".ap-active-time").removeClass("ap-active-time");
        a(this).parent("div").addClass("ap-active-time");
        var b = a(this).find("input").val().split("|");
        a(".ap-day-show").html(b[1]);
        a(".ap-time-show").html(b[0])
    });
    a("#e-styleswitcher").delay(200).animate({
        left: "-130px"
    }, 200);
    a("#e-styleswitcher").draggable({
        axis: "y",
        handle: ".e-styleswitcher-arrow"
    });
    a(".e-styleswitcher-arrow").click(function () {
        if (a(".ss-open").length) {
            a("#e-styleswitcher").delay(500).animate({
                left: "-130px"
            }, 200).removeClass("ss-open")
        } else {
            a("#e-styleswitcher").delay(500).animate({
                left: "0px"
            }, 200).addClass("ss-open")
        }
    });
    a("#set-layout-size").change(function () {
        a("body").removeClass("layout_fluid layout_768 layout_960 layout_1024 layout_1200 layout_1600").addClass(a(this).val())
    });
    a("#set-layout-responsive").change(function () {
        a("body").removeClass("layout_responsive").addClass(a(this).val())
    });
    a("#get-theme").change(function () {
        if (a(this).val() == "yes") {
            window.location = "http://themeforest.net/user/CreativeMilk"
        }
    });
    if (!Modernizr.input.placeholder) {
        a("[placeholder]").focus(function () {
            var b = a(this);
            if (b.val() == b.attr("placeholder")) {
                b.val("");
                b.removeClass("placeholder")
            }
        }).blur(function () {
            var b = a(this);
            if (b.val() == "" || b.val() == b.attr("placeholder")) {
                b.addClass("placeholder");
                b.val(b.attr("placeholder"))
            }
        }).blur();
        a("[placeholder]").parents("form").submit(function () {
            a(this).find("[placeholder]").each(function () {
                var b = a(this);
                if (b.val() == b.attr("placeholder")) {
                    b.val("")
                }
            })
        })
    }
    if (!(window.console && console.log)) {
        (function () {
            var a = function () {};
            var b = ["assert", "clear", "count", "debug", "dir", "dirxml", "error", "exception", "group", "groupCollapsed", "groupEnd", "info", "log", "markTimeline", "profile", "profileEnd", "markTimeline", "table", "time", "timeEnd", "timeStamp", "trace", "warn"];
            var c = b.length;
            var d = window.console = {};
            while (c--) {
                d[b[c]] = a
            }
        })()
    }
})