const Sequelize = require('sequelize');

const sequelize = process.env.JAWSDB_URL
  ? new Sequelize(process.env.JAWSDB_URL)
  : new Sequelize('memphiskee', DB_USER, DB_PASS, {
      host: DB_HOST,
      port: 3306,
      dialect: 'mysql'
    });

// Exports the connection for other files to use
module.exports = sequelize;