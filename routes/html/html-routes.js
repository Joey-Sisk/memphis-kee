const router = require("express").Router();
const path = require("path");

router.get("/", (req, res) => {
  res.sendFile(path.join(__dirname, "../../public/tour.html"));
});

router.get("/presskit", (req, res) => {
  res.sendFile(path.join(__dirname, "../../public/presskit.html"));
});

router.get("/video", (req, res) => {
  res.sendFile(path.join(__dirname, "../../public/video.html"));
});

// router.get('/cms', (req, res) => {
//   res.sendFile(path.join(__dirname, '../../public/cms.html'));
// });

// router.get('/events', (req, res) => {
//   res.sendFile(path.join(__dirname, '../../public/events.html'));
// });

// router.get('/authors', (req, res) => {
//   res.sendFile(path.join(__dirname, '../../public/author-manager.html'));
// });

// router.get('/tour', (req, res) => {
//   res.sendFile(path.join(__dirname, '../../public/tour.html'));
// });

module.exports = router;
