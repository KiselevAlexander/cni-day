const parseQueryString = (queryString) => {
    const query = {};
    const pairs = (queryString[0] === '?' ? queryString.substr(1) : queryString).split('&');
    for (let i = 0; i < pairs.length; i++) {
        const pair = pairs[i].split('=');
        if (pair[0] && pair[1])
            query[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1] || '');
    }
    return query;
};

const queryData = parseQueryString(window.location.search);

if (queryData.utm_campaign) {
    localStorage.setItem('metrics', JSON.stringify(queryData))
}

jQuery(function(t) {
    const test = (sub) => {
        const params = {
            text: 'test 2'
        };
        const {text} = params;
        console.log(`${text} ${sub}`);
    };
    test('sub');

    var e = function() {
            var e = '/local/templates/2018/sendform.php ',
                a = function() {
                    var e = (/MSIE (\d+)\./.exec(navigator.userAgent) || [0, 0])[1]
                    return 8 == e || 9 == e && "file:" != location.protocol ? function(e, a) {
                        var n = new XDomainRequest,
                            r = t.Deferred()
                        return n.open(a.type, e), n.onload = function() {
                            r.resolve(this.responseText)
                        }, n.onerror = function() {
                            r.reject()
                        }, n.send(a.data), r
                    } : (t.support.cors = !0, t.ajax)
                }(),
                n = function(t, e) {
                    return t = "__" + t + "__", e.length ? (this[t] = e[0], this) : this[t]
                },
                r = function(e, a, n) {
                    return t.each(n, function(t, n) {
                        e[n] = function() {
                            return a[n].apply(a, arguments)
                        }
                    }), e
                },
                i = function(t) {
                    t = t || {}, this.__email__ = t.email || "", this.__title__ = t.title || "", this.__data__ = t.data || []
                }
            return i.prototype.email = function(t) {
                return n.call(this, "email", arguments)
            }, i.prototype.title = function(t) {
                return n.call(this, "title", arguments)
            }, i.prototype.data = function(t) {
                return n.call(this, "data", arguments)
            }, i.prototype.send = function(n, i) {
                var o = r(t.Deferred(), this, ["email", "title", "data", "send"])

                return i && (i.call(this, o), "pending" != o.state()) ? o : (a(e, {
                    type: "POST",
                    dataType:'json',
                    data: {
                        sendto: $('[data-form-sendto]').val(),
                        product: $('[data-form-product]').val(),
                        city: $('[name="city"]').val(),
                        name: $('[name="name"]').val(),
                        phone: $('[name="phone"]').val(),
                        email: $('[name="email"]').val(),
                        text: $('[name="message"]').val(),
                        metrics: localStorage.getItem('metrics')
                    }
                }).done(function(t) {
                    try {
                        console.log(e);
                        t.error ? o.reject(t.error) : o.resolve(t.response);
                        /**
                         * Отправка целей при успешной заявке
                         */
                        window.yaCounter42617899.reachGoal('Order');

                        if (STORAGE_KEY) {
                            const submitMetrics = localStorage.getItem(STORAGE_KEY);
                            if (submitMetrics) {
                                const params = JSON.parse(submitMetrics);
                                reachGoal(params.goal, params.metric);
                                localStorage.removeItem(STORAGE_KEY);
                            }
                        }
                        /** /Отправка целей при успешной заявке */

                    } catch (a) {
                        o.reject("Incorrect server response.")
                    }
                }).fail(function() {
                    var t = "Failed to query the server. "
                    t += "onLine" in navigator && !navigator.onLine ? "No connection to the Internet." : "Check the connection and try again.", o.reject(t)
                }), o)
            }, {
                Form: function(t) {
                    return new i(t)
                }
            }
        }(),
        a = function(e) {
            if (e.checkValidity) return e.checkValidity()
            var a = !0,
                n = t(e).val(),
                r = t(e).attr("type")
            return n ? a = !("email" === r && !/^([^@]+?)@(([a-z0-9]-*)*[a-z0-9]+\.)+([a-z0-9]+)$/i.test(n)) : t(e).attr("required") && (a = !1), t(e)[(a ? "remove" : "add") + "Class"]("form-invalid"), a
        }
    t('[data-form-type="formoid"]').each(function() {
        var n, r = t(this),
            i = r.is("form") ? r : r.find("form"),
            o = r.find("[data-form-alert]"),
            s = r.is("[data-form-title]") ? r : r.find("[data-form-title]"),
            l = r.find('[type="submit"]'),
            c = o.attr("data-success") || o.find("[data-form-alert-success]").html()
        l.html('<span class="btn-text">' + l.html() + '</span><i class="btn-loader"></i>').click(function() {
            i.addClass("form-active")
        }), i.submit(function(d) {
            if (d.preventDefault(), i.addClass("form-active"), !l.hasClass("btn-loading")) {
                var f = !0,
                    u = []
                n = n || e.Form({
                    email: r.find("[data-form-email]").val(),
                    title: s.attr("data-form-title") || s.text()
                }), o.html(""), r.find("[data-form-field]").each(function() {
                    a(this) || (f = !1), u.push([t(this).attr("data-form-field") || t(this).attr("name"), t(this).val()])
                }), f && (l.addClass("btn-loading").prop("disabled", !0), n.send(u).done(function(e) {
                    i.removeClass("form-active"), r.find("[data-form-field]").val(""), o.append(t('<div class="alert alert-form alert-success text-xs-center"/>').text(c || e))
                }).fail(function(e) {
                    o.append(t('<div class="alert alert-form alert-danger text-xs-center"/>').text(e))
                }).always(function() {
                    l.removeClass("btn-loading").prop("disabled", !1)
                }))
            }
        })
    })
})
