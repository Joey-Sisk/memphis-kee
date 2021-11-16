const Event = require('./event');
const Author = require('./author');

Event.belongsTo(Author);

Author.hasMany(Event);

module.exports = { Event, Author };