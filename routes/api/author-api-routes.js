const router = require('express').Router();
const db = require('../../models');

// Routes
// =============================================================

router.get('/', (req, res) => {
  db.Author.findAll({
    include: [db.Event]
  }).then(dbAuthor => {
    res.json(dbAuthor);
  });
});

router.get('/:id', (req, res) => {
  db.Author.findOne({
    where: {
      id: req.params.id
    },
    include: [db.Event]
  }).then(dbAuthor => {
    res.json(dbAuthor);
  });
});

router.post('/', (req, res) => {
  db.Author.create(req.body).then(dbAuthor => {
    res.json(dbAuthor);
  });
});

router.delete('/:id', (req, res) => {
  db.Author.destroy({
    where: {
      id: req.params.id
    }
  }).then(dbAuthor => {
    res.json(dbAuthor);
  });
});

module.exports = router;