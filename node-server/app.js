const cors = require('cors');
const express = require('express');
const helmet = require('helmet');
const morgan = require('morgan');
const compression = require('compression');

const app = express();
const APP_PORT = 3000;
const API_BASE = '/api';
const API_ROUTES = {
  DATETIME: `${API_BASE}/datetime`,
  FALLBACK: `${API_BASE}/*`,
}

configMiddlewares();
registerRoutes();
app.listen(APP_PORT);

/**
 * Register routes exposed in the application
 * @see {@link API_ROUTES}
 */
function registerRoutes() {

  /**
   * Fetch the date and time, and the http response headers
   */
  app.get(API_ROUTES.DATETIME, function (req, res) {
    res.send({
      "date_time": new Date().toISOString(),
      "http_response": res.getHeaders(),
    });
  });

  /**
   * Fallback route if it is not registered
   */
  app.get(API_ROUTES.FALLBACK, function (req, res) {
    res.sendStatus(404);
  });
}

/**
 * Configure middleware to be used in the application.
 * Middlewares used are as follows:
 *  - helmet => secure your app by setting various HTTP headers
 *  - express.json => parse request as json
 *  - cors => enable CORS for all requests
 *  - morgan => log HTTP requests
 *  - compression => compress response bodies using gzip
 */
function configMiddlewares() {
  app.use(helmet());
  app.use(express.json());
  // app.use(cors());
  app.use(morgan('combined'));
  app.use(compression())
}
