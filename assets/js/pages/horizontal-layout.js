(() => {
    function e(e, t, n, o) {
        void 0 === t && (t = 400), void 0 === o && (o = !1), (e.style.overflow = "hidden"), o && (e.style.display = "block");
        var i,
            r = window.getComputedStyle(e),
            l = parseFloat(r.getPropertyValue("height")),
            a = parseFloat(r.getPropertyValue("padding-top")),
            u = parseFloat(r.getPropertyValue("padding-bottom")),
            s = parseFloat(r.getPropertyValue("margin-top")),
            d = parseFloat(r.getPropertyValue("margin-bottom")),
            p = l / t,
            c = a / t,
            y = u / t,
            m = s / t,
            g = d / t;
        window.requestAnimationFrame(function r(f) {
            void 0 === i && (i = f);
            var v = f - i;
            o
                ? ((e.style.height = p * v + "px"), (e.style.paddingTop = c * v + "px"), (e.style.paddingBottom = y * v + "px"), (e.style.marginTop = m * v + "px"), (e.style.marginBottom = g * v + "px"))
                : ((e.style.height = l - p * v + "px"), (e.style.paddingTop = a - c * v + "px"), (e.style.paddingBottom = u - y * v + "px"), (e.style.marginTop = s - m * v + "px"), (e.style.marginBottom = d - g * v + "px")),
                v >= t
                    ? ((e.style.height = ""),
                      (e.style.paddingTop = ""),
                      (e.style.paddingBottom = ""),
                      (e.style.marginTop = ""),
                      (e.style.marginBottom = ""),
                      (e.style.overflow = ""),
                      o || (e.style.display = "none"),
                      "function" == typeof n && n())
                    : window.requestAnimationFrame(r);
        });
    }
    function t() {
        var e;
        window.innerWidth < 1200 &&
            ((e = document.querySelectorAll(".menu-item.has-sub")),
            console.log(e),
            e.forEach(function (e) {
                e.querySelector(".menu-link").addEventListener("click", function (t) {
                    t.preventDefault(), e.querySelector(".submenu").classList.toggle("active");
                });
            }),
            document.querySelectorAll(".submenu-item.has-sub").forEach(function (e) {
                e.querySelector(".submenu-link").addEventListener("click", function (t) {
                    t.preventDefault(), e.querySelector(".subsubmenu").classList.toggle("active");
                });
            })),
            window.innerWidth > 1200 && (document.querySelector(".main-navbar").style.display = "");
    }
    document.querySelector(".burger-btn").addEventListener("click", function (t) {
        t.preventDefault(),
            (function (t, n, o) {
                0 === t.clientHeight ? e(t, n, o, !0) : e(t, n, o);
            })(document.querySelector(".main-navbar"), 300);
    }),
        (window.onload = function () {
            return t();
        }),
        window.addEventListener("resize", function (e) {
            t();
        });
})();
