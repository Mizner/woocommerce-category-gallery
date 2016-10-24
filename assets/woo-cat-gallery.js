(function () {
    var wcMainImage = document.getElementById("theImage");
    var wcGalleryImages = document.querySelectorAll(".theGalleryImage");

    function imageClickEvent(element, target) {
        var productLink = element.getAttribute("product_link");
        var theImageAttr = element.getAttribute("value");
        var theImageValue = "background: url(" + theImageAttr + ") center center no-repeat;";
        console.log(theImageValue);
        console.log(target);
        //target.style.background = ;
        target.setAttribute("style", theImageValue);
        target.parentElement.setAttribute("href", productLink)
    }

    for (var i = 0; i < wcGalleryImages.length; i++) {
        if (i === 0) {
            imageClickEvent(wcGalleryImages[i], wcMainImage)
        }
        wcGalleryImages[i].addEventListener("click", function () {
            imageClickEvent(this, wcMainImage)
        })
    }
})();