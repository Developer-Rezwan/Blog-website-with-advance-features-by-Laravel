window._ = require("lodash");

import Echo from "laravel-echo";

window.Pusher = require("pusher-js");

window.Echo = new Echo({
    broadcaster: "pusher",
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
})
    .channel("post.updated")
    .listen(".post-updated-event", (e) => {
        let post = e.post;
        let title = post.title;
        $("#notification").prepend(title);
        console.log(title);
    });
