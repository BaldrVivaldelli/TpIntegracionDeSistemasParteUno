const express = require('express');
const fetch = require('node-fetch');
const router = express.Router();

const sFile = require('../models/File')


router.get("/getFileById/:id", (req, res) => {

    const data = fetch("http://127.0.0.1:8000/getFileById/:id")
        .then((respLaravel) => respLaravel.json())
        .then((data) =>
            res.json(data)
        )
        .catch(function(error) {
            console.log('There has been a problem with your fetch operation: ' + error.message) + data;
        })
})

router.get("/getAll", (req, res) => {
    const data = fetch("http://127.0.0.1:8000/getAll")
        .then((respLaravel) => respLaravel.json())
        .then((dataList) => {
            const fullResponse = []
            for (let i = 0; i < dataList.length; i++) {
                fullResponse.push({
                    "server": urls[i],
                    "files": dataList[i]
                })
            }
            console.log(fullResponse)
            res.json(fullResponse)
        })
        .catch(function(error) {
            console.log('There has been a problem with your fetch operation: ' + error.message) + data;
        })
})



router.get('/getTopTen', function(req, res, next) {

    sFile.aggregate([{
        $group: {
            _id: '$name', //$name es el nombre que tiene la columna en mongo db
            count: { $sum: 1 }
        }
    }], function(err, result) {
        let topTenValues = result;
        console.log(topTenValues)
        res.send(topTenValues)
    });

    // sFile.find({}, function(err, files) {
    // files.forEach((file) => {
    // console.log(file);
    // allFile[file._id] = file;
    // });
    // res.send(allFile);
    // });
});

//son las rutas que van al mongo "http://10.23.14.22:8000", 

let urls = ["http://localhost:8000"]
router.post("/buscar", (req, res, next) => {
    //hay que iterar el buscar y por cada vueltaque da ir a una ip diferente
    let userInput = {
        "name": req.body.data
    };
    console.log(userInput);
    sFile.create(userInput).then(function(file) {
        console.log(file.name)
    });
        const calls = urls.map((url) => fetch(`${url}/getFileByTagName/?value=${userInput.name}`))
        Promise.all(calls)
        .then((reps) => {
            const futureJsons = reps.map((res) => res.json())
            return Promise.all(futureJsons)
        })
        .then((dataList) => {
            const fullResponse = []
            for (let i = 0; i < dataList.length; i++) {
                console.log(urls[i]),
                console.log(dataList[i]),
                fullResponse.push({
                    "server": urls[i],
                        "files": dataList[i]
                    })
            }
            console.log(fullResponse)
            return res.json(fullResponse)
        })
    .catch(next)
});


module.exports = router;