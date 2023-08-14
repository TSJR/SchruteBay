let head = document.querySelector("head");
let jQuery = document.createElement("script");
jQuery.src = "https://code.jquery.com/jquery-3.6.0.min.js";
head.appendChild(jQuery);

window.addEventListener("load", () => {
    let confirmBtn = document.querySelector(".purchase-btn");
    if (confirmBtn) {
        confirmBtn.addEventListener("click", () => {
            let userId = confirmBtn.dataset.userId;
            let itemId = confirmBtn.dataset.itemId
            //Ajax call
            $.ajax({
                url: "../purchase_bridge.php",
                method: 'POST',
                data: {itemId: itemId, userId: userId},
                success: (response) => {
                    console.log(response);
                    if (response === "success") {
                        window.location.href = "confirm_buy.php?success=true";
                    }
                    else {
                        window.location.href = "confirm_buy.php?success=false";
                    }

                },
                error: (xhr, status, error) => {
                    console.log(error);
                }
            });
        });
    }
});
