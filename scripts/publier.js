const fileSelector = document.querySelector('#photocouv');
fileSelector.addEventListener('change', (event) => {
    const filesize = event.target.files[0]["size"];
    if (filesize>2097152) {
        document.querySelector('#submitform').disabled = true;
        document.querySelector('#filesizewarning').classList.remove("hide");
    } else {
        document.querySelector('#submitform').disabled = false;
        document.querySelector('#filesizewarning').classList.add("hide");
    }
    document.querySelector("#removephoto").classList.remove("hide");
});

function removePhoto() {
    document.querySelector("#photocouv").value = ""
    document.querySelector("#removephoto").classList.add("hide");
    document.querySelector('#filesizewarning').classList.add("hide");
    document.querySelector('#submitform').disabled = false;
}