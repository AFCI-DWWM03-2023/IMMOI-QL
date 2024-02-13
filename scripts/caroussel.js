const carouselItems = document.querySelectorAll(".carousselitem");
let pos = 0;

function updatePosition(array, pos) {
  for (item of array) {
    item.style.transform = `translateX(-${pos * 100}%)`
  }
}

setInterval(() => {
  if (pos < carouselItems.length - 1) {
    pos++;
  }
  else {
    pos = 0;
  }
  updatePosition(carouselItems, pos)
}, 5000)

document.querySelector("#carousselaright").addEventListener('click', function () {
  if (pos < carouselItems.length - 1) {
    pos++;
  }
  else {
    pos = 0;
  }
  updatePosition(carouselItems, pos)

})
document.querySelector("#carousselaleft").addEventListener('click', function () {
  if (pos > 0) {
    pos--;
  }
  else {
    pos = carouselItems.length - 1;
  }
  updatePosition(carouselItems, pos)
})