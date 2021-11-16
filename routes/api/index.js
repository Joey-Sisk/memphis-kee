const router = require('express').Router();
const authorRoutes = require('./author-api-routes');
const eventRoutes = require('./event-api-routes');

router.use('/authors', authorRoutes);
router.use('/events', eventRoutes);

module.exports = router;