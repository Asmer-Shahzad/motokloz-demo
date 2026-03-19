let minRange = document.getElementById("minRange");
let maxRange = document.getElementById("maxRange");
let track = document.querySelector(".slider-track");

function updateSlider() {
    let min = parseInt(minRange.value);
    let max = parseInt(maxRange.value);

    if (min > max - 10) {
        minRange.value = max - 10;
    }

    if (max < min + 10) {
        maxRange.value = min + 10;
    }

    let percent1 = (minRange.value / minRange.max) * 100;
    let percent2 = (maxRange.value / maxRange.max) * 100;

    track.style.background = `linear-gradient(to right,#dcdcdc ${percent1}%,
            #f58d02 ${percent1}%,
            #f58d02 ${percent2}%,
            #dcdcdc ${percent2}%)`;
}

minRange.addEventListener("input", updateSlider);
maxRange.addEventListener("input", updateSlider);

updateSlider();

function goToStep(step) {
    const steps = document.querySelectorAll(".step");

    steps.forEach((el, i) => {
        el.classList.remove("active", "completed");

        if (i + 1 < step) {
            el.classList.add("completed");
            el.innerHTML = "✓";
        } else if (i + 1 === step) {
            el.classList.add("active");
            el.innerHTML = step;
        } else {
            el.innerHTML = i + 1;
        }
    });
}
