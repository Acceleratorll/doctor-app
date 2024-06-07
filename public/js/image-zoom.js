document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("imageModal");
    const modalImg = document.getElementById("modalImage");
    const img = document.getElementsByClassName("toZoom");

    for (let i = 0; i < img.length; i++) {
        img[i].onclick = function () {
            $("#imageModal").modal("show");
            modalImg.src = this.src;
        };
    }

    document.getElementsByClassName("close")[0].onclick = function () {
        $("#imageModal").modal("hide");
    };
});
