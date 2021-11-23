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
      console.log("Event", data);
      events = data;
      if (!events || !events.length) {
        displayEmpty(author);
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
    var formattedDate = new Date(event.createdAt);
    formattedDate = moment(formattedDate).format("MMMM Do YYYY, h:mm a");

    var newEventCard = $("<div>");
    newEventCard.addClass("card");

    var newEventCardHeading = $("<div>");
    newEventCardHeading.addClass("card-header");

    var newEventTitle = $("<h2>");

    var newEventDate = $("<small>");

    var newEventAuthor = $("<h5>");
    newEventAuthor.text("Written by: " + event.Author.name);
    newEventAuthor.css({
      float: "right",
      color: "blue",
      "margin-top": "-10px",
    });

    var newEventCardBody = $("<div>");
    newEventCardBody.addClass("card-body");

    var newEventBody = $("<p>");

    newEventTitle.text(event.title + " ");
    newEventBody.text(event.body);
    newEventDate.text(formattedDate);

    newEventTitle.append(newEventDate);
    newEventCardHeading.append(newEventTitle);
    newEventCardBody.append(newEventBody);
    newEventCard.append(newEventCardHeading);
    newEventCard.append(newEventCardBody);

    newEventCard.data("event", event);

    return newEventCard;
  }

  function displayEmpty(id) {
    var query = window.location.search;
    var partial = "";
    if (id) {
      partial = " for Author #" + id;
    }
    eventContainer.empty();
    var messageH2 = $("<h2>");
    messageH2.css({ "text-align": "center", "margin-top": "50px" });
    messageH2.html(
      "No events yet" +
        partial +
        ", navigate <a href='/cms" +
        query +
        "'>here</a> in order to get started."
    );
    eventContainer.append(messageH2);
  }
});
