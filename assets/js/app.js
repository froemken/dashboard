/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.scss in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
require('bootstrap');

// Sliders for date
let sliderDateDay = document.getElementById("dateDay");
let sliderDateMonth = document.getElementById("dateMonth");
let sliderDateYear = document.getElementById("dateYear");
let sliderDateHour = document.getElementById("dateHour");
let sliderDateMinute = document.getElementById("dateMinute");
let sliderDateSecond = document.getElementById("dateSecond");

let showDateTimestamp = document.getElementById("showDateTimestamp");
let showDateUtcTimestamp = document.getElementById("showDateUtcTimestamp");
let showDateDay = document.getElementById("showDateDay");
let showDateMonth = document.getElementById("showDateMonth");
let showDateYear = document.getElementById("showDateYear");
let showDateHour = document.getElementById("showDateHour");
let showDateMinute = document.getElementById("showDateMinute");
let showDateSecond = document.getElementById("showDateSecond");

showDateDay.innerHTML = getFormattedDateValue(sliderDateDay.value, 2);
showDateMonth.innerHTML = getFormattedDateValue(sliderDateMonth.value, 2);
showDateYear.innerHTML = sliderDateYear.value;
showDateHour.innerHTML = getFormattedDateValue(sliderDateHour.value, 2);
showDateMinute.innerHTML = getFormattedDateValue(sliderDateMinute.value, 2);
showDateSecond.innerHTML = getFormattedDateValue(sliderDateSecond.value, 2);
updateDateTimestamp();

sliderDateDay.oninput = function() {
    showDateDay.innerHTML = getFormattedDateValue(this.value, 2);
    updateDateTimestamp();
};
sliderDateMonth.oninput = function() {
    showDateMonth.innerHTML = getFormattedDateValue(this.value, 2);
    updateDateTimestamp();
};
sliderDateYear.oninput = function() {
    showDateYear.innerHTML = this.value;
    updateDateTimestamp();
};
sliderDateHour.oninput = function() {
    showDateHour.innerHTML = getFormattedDateValue(this.value, 2);
    updateDateTimestamp();
};
sliderDateMinute.oninput = function() {
    showDateMinute.innerHTML = getFormattedDateValue(this.value, 2);
    updateDateTimestamp();
};
sliderDateSecond.oninput = function() {
    showDateSecond.innerHTML = getFormattedDateValue(this.value, 2);
    updateDateTimestamp();
};

function getFormattedDateValue(value, padLength, padValue) {
    return Array(padLength-String(value).length + 1).join(padValue||'0') + value;
}

function updateDateTimestamp() {
    showDateTimestamp.innerHTML = Math.round(
        new Date(
            sliderDateYear.value,
            sliderDateMonth.value - 1,
            sliderDateDay.value,
            sliderDateHour.value,
            sliderDateMinute.value,
            sliderDateSecond.value
        ).getTime() / 1000
    );

    showDateUtcTimestamp.innerHTML = Math.round(
        new Date(Date.UTC(
            sliderDateYear.value,
            sliderDateMonth.value - 1,
            sliderDateDay.value,
            sliderDateHour.value,
            sliderDateMinute.value,
            sliderDateSecond.value
        )).getTime() / 1000
    );
}