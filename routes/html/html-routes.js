const router = require('express').Router();
const path = require('path');

router.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, '../../public/home.html'));
});

router.get('/cms', (req, res) => {
  res.sendFile(path.join(__dirname, '../../public/cms.html'));
});

router.get('/events', (req, res) => {
  res.sendFile(path.join(__dirname, '../../public/events.html'));
});

router.get('/authors', (req, res) => {
  res.sendFile(path.join(__dirname, '../../public/author-manager.html'));
});

router.get('/story', (req, res) => {
  res.sendFile(path.join(__dirname, '../../public/story.html'));
});

module.exports = router;