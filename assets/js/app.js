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

function TimeConverter() {
    let me = this;
    me.sliderDateDay = document.getElementById("dateDay");
    me.sliderDateMonth = document.getElementById("dateMonth");
    me.sliderDateYear = document.getElementById("dateYear");
    me.sliderDateHour = document.getElementById("dateHour");
    me.sliderDateMinute = document.getElementById("dateMinute");
    me.sliderDateSecond = document.getElementById("dateSecond");
    me.showDateTimestamp = document.getElementById("showDateTimestamp");
    me.showDateUtcTimestamp = document.getElementById("showDateUtcTimestamp");
    me.showDateDay = document.getElementById("showDateDay");
    me.showDateMonth = document.getElementById("showDateMonth");
    me.showDateYear = document.getElementById("showDateYear");
    me.showDateHour = document.getElementById("showDateHour");
    me.showDateMinute = document.getElementById("showDateMinute");
    me.showDateSecond = document.getElementById("showDateSecond");

    me.initialize = function () {
        this.activateEventHandlers();
    };

    me.activateEventHandlers = function () {
        this.activateEventHandler(this.sliderDateDay, this.showDateDay, 2);
        this.activateEventHandler(this.sliderDateMonth, this.showDateMonth, 2);
        this.activateEventHandler(this.sliderDateYear, this.showDateYear, 4);
        this.activateEventHandler(this.sliderDateHour, this.showDateHour, 2);
        this.activateEventHandler(this.sliderDateMinute, this.showDateMinute, 2);
        this.activateEventHandler(this.sliderDateSecond, this.showDateSecond, 2);
    };

    me.activateEventHandler = function (sliderElement, updateElement, padLength) {
        sliderElement.oninput = function() {
            updateElement.innerHTML = me.getFormattedDateValue(this.value, padLength);
            me.updateDateTimestamp();
        };
    };

    me.getFormattedDateValue = function (value, padLength, padValue) {
        return Array(padLength-String(value).length + 1).join(padValue||'0') + value;
    };

    me.updateDateTimestamp = function () {
        this.showDateTimestamp.innerHTML = Math.round(
            new Date(
                this.sliderDateYear.value,
                this.sliderDateMonth.value - 1,
                this.sliderDateDay.value,
                this.sliderDateHour.value,
                this.sliderDateMinute.value,
                this.sliderDateSecond.value
            ).getTime() / 1000
        );

        this.showDateUtcTimestamp.innerHTML = Math.round(
            new Date(Date.UTC(
                this.sliderDateYear.value,
                this.sliderDateMonth.value - 1,
                this.sliderDateDay.value,
                this.sliderDateHour.value,
                this.sliderDateMinute.value,
                this.sliderDateSecond.value
            )).getTime() / 1000
        );
    };

    me.initialize();
    me.showDateDay.innerHTML = me.getFormattedDateValue(me.sliderDateDay.value, 2);
    me.showDateMonth.innerHTML = me.getFormattedDateValue(me.sliderDateMonth.value, 2);
    me.showDateYear.innerHTML = me.getFormattedDateValue(me.sliderDateYear.value, 4);
    me.showDateHour.innerHTML = me.getFormattedDateValue(me.sliderDateHour.value, 2);
    me.showDateMinute.innerHTML = me.getFormattedDateValue(me.sliderDateMinute.value, 2);
    me.showDateSecond.innerHTML = me.getFormattedDateValue(me.sliderDateSecond.value, 2);
    me.updateDateTimestamp();
}

new TimeConverter();
