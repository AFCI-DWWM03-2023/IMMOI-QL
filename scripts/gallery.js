let thumbnails = document.querySelectorAll(".thumbimage")

let display = document.querySelector(".displayedimage")

for (thumb of thumbnails) {
    thumb.addEventListener('click', function(e){
        for (thumb of thumbnails) {
            thumb.classList.remove("active")
        }
        e.target.classList.add("active")
        display.src = e.target.src
    })
}