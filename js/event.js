function createCalendar(x, y) {
  var calendar = x;
  var date = new Date();
  var year = date.getFullYear();
  var month = date.getMonth();

  var monthYear = calendar.querySelector(".monthYear");
  var prevMonth = calendar.querySelector(".prevMonth");
  var nextMonth = calendar.querySelector(".nextMonth");

  // Update the month and year in the header
  updateHeader();

  // Add event listeners to the previous and next buttons
  prevMonth.addEventListener("click", showPrevMonth);
  nextMonth.addEventListener("click", showNextMonth);

  // Update the calendar
  updateCalendar();

  function updateHeader() {
    monthYear.textContent = getMonthName() + " " + year;
  }

  function showPrevMonth() {
    if (month === 0) {
      year--;
      month = 11;
    } else {
      month--;
    }
    updateHeader();
    updateCalendar();
  }

  function showNextMonth() {
    if (month === 11) {
      year++;
      month = 0;
    } else {
      month++;
    }
    updateHeader();
    updateCalendar();
  }

  function updateCalendar() {
    var tbody = calendar.querySelector("tbody");
    tbody.innerHTML = "";

    var today = new Date();
    var firstDay = new Date(year, month, 1).getDay();
    var daysInMonth = new Date(year, month + 1, 0).getDate();

    var date = 1;
    for (var i = 0; i < 6; i++) {
      var row = document.createElement("tr");
      for (var j = 0; j < 7; j++) {
        var cell = document.createElement("td");

        if (i === 0 && j < firstDay) {
          // Fill in empty cells before the first day
          var text = document.createTextNode("");
          cell.appendChild(text);
        } else if (date > daysInMonth) {
          // Fill in empty cells after the last day
          var text = document.createTextNode("");
          cell.appendChild(text);
        } else {
          // Fill in cells with the day numbers
          var text = document.createTextNode(date);
          cell.appendChild(text);

          // Add event listener to update the selected date
          if (
            year < today.getFullYear() ||
            (year === today.getFullYear() && month < today.getMonth())
          ) {
            // If the year and month are in the past, disable the cell
            cell.classList.add("disabled");
          } else if (
            year === today.getFullYear() &&
            month === today.getMonth() &&
            date < today.getDate()
          ) {
            // If the date is in the past in the current month, disable the cell
            cell.classList.add("disabled");
          } else {
            // Otherwise, add the click event listener to select the cell
            cell.addEventListener("click", function () {
              var selected = tbody.querySelector(".selected");
              if (selected) {
                selected.classList.remove("selected");
              }
              this.classList.add("selected");
              var day = this.textContent;
              var fullDate = new Date(year, month, day);
              var options = { month: "long", year: "numeric", day: "numeric" };
              var formattedDate = fullDate.toLocaleDateString("en-US", options);

              const arrDate = y;
              arrDate.value = formattedDate;
            });
          }

          // If this is the current date, add the 'today' class
          if (
            date === today.getDate() &&
            month === today.getMonth() &&
            year === today.getFullYear()
          ) {
            cell.classList.add("today");
          }

          date++;
        }

        if (cell.innerText === "") {
          cell.classList.add("ignore");
        }
        row.appendChild(cell);
      }
      tbody.appendChild(row);
    }
  }

  function getMonthName() {
    var monthNames = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December",
    ];
    return monthNames[month];
  }
}

document.addEventListener("click", function (event) {
 
  if (
    event.target !== dateTrigger &&
    event.target !== datePicker &&
    !event.target.classList.contains("ignore") &&
    !event.target.classList.contains("disabled")
  ) {
    datePicker.classList.remove("date-picker-active");
  }

});

const ignoreEl = document.querySelectorAll(".ignore");

ignoreEl.forEach((el) => {
  el.addEventListener("click", function (event) {
    event.stopPropagation();
  });
});

const datePicker = document.getElementById("picker");
const dateTrigger = document.getElementById("date-trigger");
createCalendar(datePicker, dateTrigger);

dateTrigger.addEventListener("click", function () {
  datePicker.classList.toggle("date-picker-active");
});


