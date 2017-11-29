const mongoose = require('mongoose');
const Schema = mongoose.Schema;


//creo el schema y el modelo para los ultimos registros
const FileSchema = new Schema({
    //creo el modelo de como se tiene qeu comportar cada insert o select. Aca le puse un solo nombre, pero puede ir lo que sea
    name: {
        type: String,
    },

});

const sFile = mongoose.model('file', FileSchema);

module.exports = sFile;