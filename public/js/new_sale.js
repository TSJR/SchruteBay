let head = document.querySelector("head");
let lib = document.createElement("script");
lib.src = "https://cdn.jsdelivr.net/npm/autonumeric@4.2.0/dist/autoNumeric.min.js";
let lib2 = document.createElement("script");
lib2.src = "../libs/cropper.js";
head.appendChild(lib);
head.appendChild(lib2);

const currencyInput = document.getElementById("cost");
lib.addEventListener("load", () => {
    console.log("test");
    const numInstance = new AutoNumeric(currencyInput, {
        currencySymbol: "",
        digitGroupSeparator: ",",
        decimalCharacter: ".",
        decimalPlaces: 2,
        clickSelectsAll: false,
    });

});

function autoResize() {
    const textarea = document.getElementById('desc');
    textarea.style.height = 'auto'; // Reset the height to auto

    // Set the height to match the scroll height
    textarea.style.height = textarea.scrollHeight + 'px';
}

function loadFile(e) {
    let file = e.target.files[0];
    let img = document.querySelector("img");
    img.src = URL.createObjectURL(file);
}
const image = document.querySelector('img');
lib2.addEventListener("load", () => {
    let dialog = document.querySelector("#img");

        dialog.addEventListener("change", () => {
            image.addEventListener("load", () => {
            console.log("GO!");
            const cropper = new Cropper(image, {
                aspectRatio: 1 / 1,
                crop(event) {
                    console.log(event.detail.x);
                    console.log(event.detail.y);
                    console.log(event.detail.width);
                    console.log(event.detail.height);
                    console.log(event.detail.rotate);
                    console.log(event.detail.scaleX);
                    console.log(event.detail.scaleY);
                },
            });
        })
    });

});

