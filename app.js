const express = require("express");
var path = require("path");
const app = express();
const port = 8080;

app.get("/", (req, res) =>
  res.sendFile(path.join(__dirname + "/samples/productionEditor.html"))
);

app.listen(port, () =>
  console.log(`Example app listening at http://localhost:${port}`)
);
