const router = require('express').Router();
const db = require('../../models');

router.get('/', (req, res) => {
  const query = {};
  if (req.query.author_id) {
    query.AuthorId = req.query.author_id;
  }

  db.Event.findAll({
    where: query,

    include: [db.Author]
  }).then(dbEvent => {
    res.json(dbEvent);
  });
});

router.get('/:id', (req, res) => {
  db.Event.findOne({
    where: {
      id: req.params.id
    },
    include: [db.Author]
  }).then(dbEvent => {
    res.json(dbEvent);
  });
});

router.post('/', (req, res) => {
  console.log(req.body);
  db.Event.create(req.body).then(dbEvent => {
    res.json(dbEvent);
  });
});

router.delete('/:id', (req, res) => {
  db.Event.destroy({
    where: {
      id: req.params.id
    }
  }).then(dbEvent => {
    res.json(dbEvent);
  });
});

router.put('/', (req, res) => {
  db.Event.update(req.body, {
    where: {
      id: req.body.id
    }
  }).then(dbEvent => {
    res.json(dbEvent);
  });
});

module.exports = router;