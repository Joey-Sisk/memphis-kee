$(document).ready(function () {
  var bodyInput = $('#body');
  var titleInput = $('#title');
  var cmsForm = $('#cms');
  var authorSelect = $('#author');

  $(cmsForm).on('submit', handleFormSubmit);

  var url = window.location.search;
  var eventId;
  var authorId;

  var updating = false;

  if (url.indexOf('?event_id=') !== -1) {
    eventId = url.split('=')[1];
    getEventData(eventId, 'event');
  }

  else if (url.indexOf('?author_id=') !== -1) {
    authorId = url.split('=')[1];
  }

  getAuthors();

  function handleFormSubmit(event) {
    event.preventDefault();

    if (!titleInput.val().trim() || !bodyInput.val().trim() || !authorSelect.val()) {
      return;
    }

    var newEvent = {
      title: titleInput.val().trim(),
      body: bodyInput.val().trim(),
      AuthorId: authorSelect.val(),
    };

    console.log(newEvent);

    if (updating) {
      newEvent.id = eventId;
     updateEvent(newEvent);
    } else {
      submitEvent(newEvent);
    }
  }

  function submitEvent(event) {
    $.post('/api/events', event, function () {
      window.location.href = '/home'; 
    });
  }

  function getEventData(id, type) {
    var queryUrl;
    switch (type) {
      case 'event':
        queryUrl = '/api/eventss/' + id;
        break;
      case 'author':
        queryUrl = '/api/authors/' + id;
        break;
      default:
        return;
    }
    $.get(queryUrl, function (data) {
      if (data) {
        console.log(data.AuthorId || data.id);

        titleInput.val(data.title);
        bodyInput.val(data.body);
        authorId = data.AuthorId || data.id;

        updating = true;
      }
    });
  }

  function getAuthors() {
    $.get('/api/authors', renderAuthorList);
  }

  function renderAuthorList(data) {
    if (!data.length) {
      window.location.href = '/authors';
    }
    $('.hidden').removeClass('hidden');
    var rowsToAdd = [];
    for (var i = 0; i < data.length; i++) {
      rowsToAdd.push(createAuthorRow(data[i]));
    }
    authorSelect.empty();
    console.log(rowsToAdd);
    console.log(authorSelect);
    authorSelect.append(rowsToAdd);
    authorSelect.val(authorId);
  }

  function createAuthorRow(author) {
    var listOption = $('<option>');
    listOption.attr('value', author.id);
    listOption.text(author.name);
    return listOption;
  }

  function updateEvent(event) {
    $.ajax({
      method: 'PUT',
      url: '/api/events',
      data: event,
    }).then(function () {
      window.location.href = '/home'; 
    });
  }
});