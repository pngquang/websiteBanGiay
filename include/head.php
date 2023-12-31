<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="shortcut icon" href="https://preview.colorlib.com/theme/karma/img/fav.png">

<meta name="author" content="CodePixar">

<meta name="description" content="">

<meta name="keywords" content="">

<meta charset="UTF-8">



<link rel="stylesheet" href="css/linearicons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- <link rel="stylesheet" href="https://preview.colorlib.com/theme/karma/css/themify-icons.css"> -->
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/owl.carousel.css">
<link rel="stylesheet" href="css/nice-select.css">

<link rel="stylesheet" href="css/ion.rangeSlider.css" />
<link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />
<link rel="stylesheet" href="css/magnific-popup.css">
<link rel="stylesheet" href="css/main.css">
<script nonce="d45e2068-4c7e-4105-82a7-4fcba6ce9afd">
(function(w, d) {
    ! function(e, f, g, h) {
        e.zarazData = e.zarazData || {};
        e.zarazData.executed = [];
        e.zaraz = {
            deferred: [],
            listeners: []
        };
        e.zaraz.q = [];
        e.zaraz._f = function(i) {
            return function() {
                var j = Array.prototype.slice.call(arguments);
                e.zaraz.q.push({
                    m: i,
                    a: j
                })
            }
        };
        for (const k of ["track", "set", "debug"]) e.zaraz[k] = e.zaraz._f(k);
        e.zaraz.init = () => {
            var l = f.getElementsByTagName(h)[0],
                m = f.createElement(h),
                n = f.getElementsByTagName("title")[0];
            n && (e.zarazData.t = f.getElementsByTagName("title")[0].text);
            e.zarazData.x = Math.random();
            e.zarazData.w = e.screen.width;
            e.zarazData.h = e.screen.height;
            e.zarazData.j = e.innerHeight;
            e.zarazData.e = e.innerWidth;
            e.zarazData.l = e.location.href;
            e.zarazData.r = f.referrer;
            e.zarazData.k = e.screen.colorDepth;
            e.zarazData.n = f.characterSet;
            e.zarazData.o = (new Date).getTimezoneOffset();
            if (e.dataLayer)
                for (const r of Object.entries(Object.entries(dataLayer).reduce(((s, t) => ({
                        ...s[1],
                        ...t[1]
                    }))))) zaraz.set(r[0], r[1], {
                    scope: "page"
                });
            e.zarazData.q = [];
            for (; e.zaraz.q.length;) {
                const u = e.zaraz.q.shift();
                e.zarazData.q.push(u)
            }
            m.defer = !0;
            for (const v of [localStorage, sessionStorage]) Object.keys(v || {}).filter((x => x.startsWith("_zaraz_"))).forEach((w => {
                try {
                    e.zarazData["z_" + w.slice(7)] = JSON.parse(v.getItem(w))
                } catch {
                    e.zarazData["z_" + w.slice(7)] = v.getItem(w)
                }
            }));
            m.referrerPolicy = "origin";
            m.src = "https://preview.colorlib.com/theme/karma//cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(e.zarazData)));
            l.parentNode.insertBefore(m, l)
        };
        ["complete", "interactive"].includes(f.readyState) ? zaraz.init() : e.addEventListener("DOMContentLoaded", zaraz.init)
    }(w, d, 0, "script");
})(window, document);
</script>
