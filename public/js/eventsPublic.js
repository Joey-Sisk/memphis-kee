$(document).ready(function () {
  var eventContainer = $(".event-container");

  var events;

  var url = window.location.search;

  var authorId;

  if (url.indexOf("?author_id=") !== -1) {
    authorId = url.split("=")[1];
    getEvents(authorId);
  } else {
    getEvents();
  }

  function getEvents(author) {
    authorId = author || "";
    if (authorId) {
      authorId = "/?author_id=" + authorId;
    }
    $.get("/api/events" + authorId, function (data) {
      console.log(data);
      events = data.sort((a, b) => {
        dateA = new Date(a.time).getTime();
        dateB = new Date(b.time).getTime();
        return dateA > dateB ? 1 : -1;
      });
      if (!events || !events.length) {
        displayEmpty();
      } else {
        initializeRows();
      }
    });
  }

  function initializeRows() {
    eventContainer.empty();
    var eventsToAdd = [];
    for (var i = 0; i < events.length; i++) {
      eventsToAdd.push(createNewRow(events[i]));
    }
    eventContainer.append(eventsToAdd);
  }

  function createNewRow(event) {
    var formattedDate = event.time;
    formattedDate = moment.utc(formattedDate).format("MM/DD/YYYY, hh:mm a");

    var newEventTableRow = $("<tr>");

    var newEventDate = $("<td>");
    var newEventTitle = $("<td>");
    var newEventBody = $("<td>");

    newEventDate.text(formattedDate);
    newEventTitle.text(event.title);
    newEventBody.text(event.body);

    newEventTableRow.append(newEventDate);
    newEventTableRow.append(newEventTitle);
    newEventTableRow.append(newEventBody);
    newEventTableRow.data("event", event);

    return newEventTableRow;
  }

  function displayEmpty() {
    eventContainer.empty();
    var messageH2 = $("<h2>");
    messageH2.css({ "text-align": "center", "margin-top": "50px" });
    messageH2.html(
      "No events currently on the calendar, check back soon to see where Memphis Kee is playing next!"
    );
    eventContainer.append(messageH2);
  }
});
