const fileSelector = document.querySelector('#photocouv');
fileSelector.addEventListener('change', (event) => {
    const filesize = event.target.files[0]["size"];
    if (filesize>2097152) {
        document.querySelector('.submitsearch').disabled = true;
        document.querySelector('#filesizewarning').classList.remove("hide");
    } else {
        document.querySelector('.submitsearch').disabled = false;
        document.querySelector('#filesizewarning').classList.add("hide");
    }
    document.querySelector("#removephoto").classList.remove("hide");
});

function removePhoto() {
    document.querySelector("#photocouv").value = ""
    document.querySelector("#removephoto").classList.add("hide");
    document.querySelector('#filesizewarning').classList.add("hide");
    document.querySelector('.submitsearch').disabled = false;
}

const typeBien = document.querySelector('#categorie')
typeBien.addEventListener('change', function() {
    const type = typeBien.value;
    if (type == "appart") {
        document.querySelector("#checkappart").classList.remove("hide");
    } else {
        document.querySelector("#checkappart").classList.add("hide");
        document.querySelector("#numappart").value = null;
    }
    if (type == "terrain") {
        document.querySelector("#nbetages").value = "0";
        document.querySelector("#nbpieces").value = "0";
    }
})