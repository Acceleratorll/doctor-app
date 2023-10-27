window._ = require("lodash");

try {
    require("bootstrap");
} catch (e) {}

window.axios = require("axios");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import $ from "jquery";

window.$ = window.jQuery = $;
window.Pusher = require("pusher-js");
window.select2 = require("select2");

// window.Echo = new Echo({
//     broadcaster: "pusher",
//     key: "your-pusher-key",
//     wsHost: window.location.hostname,
//     wsPort: 6001,
//     forceTLS: false,
//     disableStats: true,
// });
