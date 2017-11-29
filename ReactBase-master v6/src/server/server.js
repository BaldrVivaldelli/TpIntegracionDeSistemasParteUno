"use sctrict"
const path = require("path")
const express = require("express")
const bodyParser = require("body-parser");
const baseFolder = path.resolve(__dirname, '../client/')
const mongoose = require('mongoose');

const app = express()

//hago la coneccion a mongoose y creo la base de datos apenas se hace el npm run server / npm start 
//LO QUE SI, se tiene que tener la connecion abierta y para eso se tiene que hacer lo que dijo carati
mongoose.connect('mongodb://localhost/fileSearchGo', { useMongoClient: true })
    //sobre escribo este valor porque segun el tutorial donde saque la info la version de mongoose estaba deprecada
mongoose.Promise = global.Promise;


app.use("/", express.static(baseFolder))
app.use(bodyParser.json())

//mando todo lo que vaya a laravel o node aca porque sino es un kilombo de codigo totalmente innecesario y ademas el mongoose te exige tener si o si todo en modelos
app.use("/api", require('./routes/api'))

//en caso de que alguna de las promesa falle, se viene directo para aca, es para menajr mejor los errores
app.use(function(err, req, res, next) {
    //aca deveria volver algo
    console.log(err)

    return res.status(422).send({ error: err.message })
});

app.listen(8090, () => {
    console.log("Server UP!")
})