const notification = async () => {
    let link = "";
    if (localStorage.getItem("notification")) {
        let queue = localStorage.getItem("notification");
        queue = JSON.parse(queue).queue;

        link = `${location.origin}/reservation/check_queue?queue=${queue}`;
    } else {
        link = `${location.origin}/reservation/check_queue`;
    }

    const response = await fetch(link);
    const { total, queue, new_notification } = await response.json();

    if (new_notification == 1) {
        changeNotif(queue, total);
        $(".notification-sub-amount").html(total + " Notifikasi");
        $(".notification-amount").html(total);

        localStorage.setItem(
            "notification",
            JSON.stringify({
                total,
                queue,
                read: 0,
            })
        );
    } else if (new_notification == -1) {
        $(".notification-sub-amount").html("Tidak ada notifikasi");
        $("#notif-menu").empty();
        localStorage.removeItem("notification");
    }
};

notification();

let notifItem = localStorage.getItem("notification");
if (notifItem) {
    notifItem = JSON.parse(notifItem);
    if (notifItem.read == 0) {
        $(".notification-sub-amount").html(notifItem.total + " Notifikasi");
        $(".notification-amount").html(notifItem.total);

        changeNotif(notifItem.queue, notifItem.total);
    } else {
        changeNotif(notifItem.queue, notifItem.total);
        $(".notification-sub-amount").html("Notifikasi");
        $(".notification-amount").html("");
    }
}

function changeNotif(queue, total) {
    $("#notif-menu").empty();

    const elementNotification = `<div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> ${queue} Antrian anda saat ini
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> ${total} Total Pasien
        </a>`;
    $("#notif-menu").append(elementNotification);
}

$(".notif-dropdown").click(function (e) {
    let notifItem = localStorage.getItem("notification");

    if (notifItem) {
        notifItem = JSON.parse(notifItem);
        if (notifItem.read == 0) {
            $(".notification-sub-amount").html("Notifikasi");
            $(".notification-amount").html("");

            localStorage.removeItem("notification");
            localStorage.setItem(
                "notification",
                JSON.stringify({
                    ...notifItem,
                    read: 1,
                })
            );
        }
    }
});
