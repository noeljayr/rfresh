const eventsContainer = document.querySelector(".events");

function sortEvents(arr) {
  function parseDate(dateString) {
    // Create a Date object from the string representation
    return new Date(dateString);
  }

  function calculateDateDifference(eventDate) {
    // Get the current date
    const today = new Date();

    // Calculate the difference in milliseconds between the event date and today
    const difference = eventDate.getTime() - today.getTime();

    // Convert the difference to days (rounded down to avoid partial days)
    const differenceInDays = Math.floor(difference / (1000 * 60 * 60 * 24));

    return differenceInDays;
  }

  const sortedEvents = arr.slice().sort((eventA, eventB) => {
    // Parse the dates for accurate comparison
    const dateA = parseDate(eventA.date);
    const dateB = parseDate(eventB.date);

    // Calculate the difference in days for each event
    const differenceA = calculateDateDifference(dateA);
    const differenceB = calculateDateDifference(dateB);
    return Math.abs(differenceA) - Math.abs(differenceB);
  });

  return sortedEvents;
}
displayEvents(sortEvents(events));

function displayEvents(arr) {
  arr.forEach((event) => {
    const eventEl = document.createElement("a");
    eventEl.href = "event.php?eventid=" +  event.id;
    eventEl.className =
      "event gradient-border max-sm:flex-col max-sm:items-center";

    const dateData = convertDateFormat(event.date)
    const parts = dateData.split(" ");
    const day = parseInt(parts[0]);
    const month = parts[1];
    const year = parseInt(parts[2]);

    eventEl.innerHTML = `
           <div class="calendar">
                  <div class="top">
                    <span class="date">${month} ${year}</span>
      
                    <span class="circles">
                      <span></span>
                      <span></span>
                      <span></span>
                      <span></span>
                    </span>
      
                    <span class="handles">
                      <span></span>
                      <span></span>
                      <span></span>
                      <span></span>
                    </span>
                  </div>
      
                  <div class="bottom">${day}</div>
                </div>
      
                <div class="event-details flex flex-col gap-2">
                  <img
                    loading="lazy"
                    src="../public/images/${event.poster}"
                    alt="${event.title}"
                  />
                  <span class="event-titl font-bold text-sm">${event.title}</span>
                </div>
        `;

    eventsContainer.appendChild(eventEl);
  });
}

const input = document.querySelector("input");

input.addEventListener("input", function () {
  if (input.value.length >= 2) {
    const query = this.value.trim();
    const filteredData = filterData(query);
    eventsContainer.innerHTML = "";
    displayEvents(sortEvents(filteredData));
  } else {
    eventsContainer.innerHTML = "";
    displayEvents(sortEvents(events));
  }
});

function filterData(query) {
  return events.filter((filtered) => {
    return filtered.title.toLowerCase().includes(query.toLowerCase());
  });
}



function convertDateFormat(dateStr) {
  // Split the date string into components
  const [month, day, year] = dateStr.split(" ");

  // Create a map for month names (optional for readability)
  const months = {
    Jan: "January",
    Feb: "February",
    Mar: "March",
    Apr: "April",
    May: "May",
    Jun: "June",
    Jul: "July",
    Aug: "August",
    Sep: "September",
    Oct: "October",
    Nov: "November",
    Dec: "December",
  };

  // Format the date with desired separators
  return `${day} ${months[month]} ${year}`;
}

// Example usage
