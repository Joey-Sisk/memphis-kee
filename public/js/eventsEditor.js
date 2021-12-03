$(document).ready(function () {
  var eventContainer = $(".event-container");
  var eventCatagorySelect = $("#category");

  $(document).on("click", "button.delete", handleEventDelete);
  $(document).on("click", "button.edit", handleEventEdit);

  var events;
  var authorId;

  var url = window.location.search;

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

  function deleteEvent(id) {
    $.ajax({
      method: "DELETE",
      url: "/api/events/" + id,
    }).then(function () {
      getEvents(eventCatagorySelect.val());
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

  function initializeRows() {
    eventContainer.empty();
    var eventsToAdd = [];
    for (var i = 0; i < events.length; i++) {
      eventsToAdd.push(createNewRow(events[i]));
    }
    eventContainer.append(eventsToAdd);
  }

  // function createNewRow(event) {
  //   var formattedDate = event.time;
  //   formattedDate = moment(formattedDate).format("MMMM Do YYYY, h:mm a");

  //   var newEventTableRow = $("<tr>");

  //   var newEventDate = $("<td>");
  //   var newEventTitle = $("<td>");
  //   var newEventBody = $("<td>");
  //   var deleteBtn = $("<button>");
  //   var editBtn = $("<button>");

  //   newEventDate.text(formattedDate);
  //   newEventTitle.text(event.title);
  //   newEventBody.text(event.body);
  //   deleteBtn.text("DELETE");
  //   editBtn.text("EDIT");

  //   deleteBtn.addClass("delete btn btn-danger");
  //   editBtn.addClass("edit btn btn-info float-none");

  //   newEventTableRow.append(newEventDate);
  //   newEventTableRow.append(newEventTitle);
  //   newEventTableRow.append(newEventBody);
  //   newEventTableRow.append(deleteBtn);
  //   newEventTableRow.append(editBtn);

  //   newEventTableRow.data("event", event);

  //   return newEventTableRow;
  // }

  function createNewRow(event) {
    var formattedDate = event.time;
    formattedDate = moment.utc(formattedDate).format("MM/DD/YYYY, hh:mm a");

    var newEventCard = $("<div>");
    newEventCard.addClass("card");

    var newEventCardHeading = $("<div>");
    newEventCardHeading.addClass("card-header");

    var deleteBtn = $("<button>");
    deleteBtn.text("x");
    deleteBtn.addClass("delete btn btn-danger");

    var editBtn = $("<button>");
    editBtn.text("EDIT");
    editBtn.addClass("edit btn btn-info");

    var newEventTitle = $("<h3>");

    var newEventDate = $("<small>");

    var newEventAuthor = $("<h5>");
    newEventAuthor.text("Written by: " + event.Author.name);
    newEventAuthor.css({
      // float: "right",
      color: "grey",
      "margin-top": "-10px",
    });

    var newEventCardBody = $("<div>");
    newEventCardBody.addClass("card-body");

    var newEventBody = $("<p>");
    newEventTitle.text(event.title + " ");
    newEventBody.text(event.body);
    newEventDate.text(formattedDate);
    newEventTitle.append(newEventDate);

    newEventCardHeading.append(deleteBtn);
    newEventCardHeading.append(editBtn);
    newEventCardHeading.append(newEventTitle);
    newEventCardHeading.append(newEventAuthor);

    newEventCardBody.append(newEventBody);

    newEventCard.append(newEventCardHeading);
    newEventCard.append(newEventCardBody);
    newEventCard.data("event", event);

    return newEventCard;
  }

  //   var deleteBtn = $("<button>");
  //   deleteBtn.text("x");
  //   deleteBtn.addClass("delete btn btn-danger");

  //   var editBtn = $("<button>");
  //   editBtn.text("EDIT");
  //   editBtn.addClass("edit btn btn-info");

  //   newEventCardHeading.append(deleteBtn);
  //   newEventCardHeading.append(editBtn);

  function handleEventDelete() {
    var currentEvent = $(this).parent().parent().data("event");
    deleteEvent(currentEvent.id);
  }

  function handleEventEdit() {
    var currentEvent = $(this).parent().parent().data("event");
    window.location.href = "/cms?event_id=" + currentEvent.id;
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
