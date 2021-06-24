require("./bootstrap");
window._ = require("lodash");
window.$ = window.jQuery = require("jquery");

var notifications = [];

const NOTIFICATION_TYPE = {
    follow: "APP\\Notifications\\UserFollowed",
};

$(document).ready(function () {
    if (Laravel.userId) {
        $.get("/notifications", function (data) {
            addNotifications(data, "notifications");
        });
    }
});

function addNotifications(newNotifications, target) {
    notifications = _.concat(notifications, newNotifications);
    notifications.slice(0, 5);
    showNotifications(notifications, target);
}

function showNotifications(notifications, target) {
    if (notifications.length) {
        let htmlElements = notifications.map((notification) => {
            return makeNotification(notification);
        });

        $(target + "Menu").html(htmlElements.join(""));
        $(target).addClass("has-notifications");
    } else {
        $(target + "Menu").html(
            "<li class='dropdown-header'>No Notifications</li>"
        );
        $(target).removeClass("has-notifications");
    }
}

function makeNotification(notification) {
    let to = routeNotification(notification);
    let notificationText = makeNotificationText(notification);
    return `<li><a href="${to} ">${notificationText}</a></li>`;
}

function routeNotification(notification) {
    let to = `?read=${notification.id}`;
    if (notification.type === NOTIFICATION_TYPE.follow) {
        to = `users${to}`;
    }

    return "/" + to;
}

function makeNotificationText(notification) {
    let text = "";
    if (notification.type === NOTIFICATION_TYPE.follow) {
        const name = notification.data.follower_name;
        text += `<strong>${name}</strong> Starting Following You`;
    }
    return text;
}
