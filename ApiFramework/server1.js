const express = require('express')
const app = express()
const axios = require('axios');




app.get('/generateOTP', (req, res) => {
    let OTP = parseInt(Math.random() * 1000000);
    res.set("Access-Control-Allow-Origin", "*")
 
    let email = req.query.email
    sendMail(OTP, email)
    axios.post('http://localhost:80/php_modules/OTPupdate.php', { otp: OTP, email: email }).then((res1) => {
        res.json({ status: "successfully sent" })
        console.log(res1.data)
    }).catch(e => {
        console.log(e)
    })

})

app.get('/verifyOTP', async (req, res) => {//Button[verify]=>This API is called with input OTP and email details to search from db whether the values are same or not

    axios.post('http://localhost:80/php_modules/OTPverify.php', { email: req.query.email }).then((res2) => {
        res.set("Access-Control-Allow-Origin", "*")
        OTP = res2.data['OTP']
        console.log(res2.data)
        console.log(req.query.OTP)
        if (OTP == req.query.OTP) {


            res.json({ OTPVerified: true, description: "success" })
        }
        else {

            res.json({ OTPVerified: false, description: "failure" })
        }
    }).catch(e => {
        console.log(e)
    })
})


app.get('/getStData', async (req, res) => {//Button[verify]=>This API is called with input OTP and email details to search from db whether the values are same or not

    axios.post('http://localhost:80/php_modules/getStudentDB.php', { email: req.query.email }).then((res2) => {
        res.set("Access-Control-Allow-Origin", "*")
        res.json(res2.data)
    }).catch(e => {
        console.log(e)
    })
})
app.get('/updateStData', async (req, res) => {//Button[verify]=>This API is called with input OTP and email details to search from db whether the values are same or not

    axios.post('http://localhost:80/php_modules/updateStudentDB.php', { stdata: req.query.stdata }).then((res2) => {
        res.set("Access-Control-Allow-Origin", "*")
        console.log(req.query.stdata)
        res.json({bool:res2.data})
    }).catch(e => {
        console.log(e)
    })
})

app.get('/getAttendanceData', async (req, res) => {//Button[verify]=>This API is called with input OTP and email details to search from db whether the values are same or not

    axios.post('http://localhost:80/php_modules/getAttendancesheet.php', { department: req.query.department, year: req.query.year }).then((res2) => {
        res.set("Access-Control-Allow-Origin", "*")
        // console.log(res2.data)
        // res2.data.forEach(item => {
        //     if (item.isPresent == "true")
        //         item.isPresent = true
        //     else
        //         item.isPresent = false
        // });
            res2.data.map(item => {
                if (item.isPresent == "true")
                    item.isPresent = true
                else
                    item.isPresent = false
            });
        console.log(res2.data)
        res.json(res2.data)
    }).catch(e => {
        console.log(e)
    })
})

app.get('/UpdateAttendance', async (req, res) => {//Button[verify]=>This API is called with input OTP and email details to search from db whether the values are same or not
    console.log(req.query.Students)
    axios.post('http://localhost:80/php_modules/updateAttendance.php', { Students: req.query.Students, department: req.query.department, year: req.query.year }).then((res2) => {
        res.set("Access-Control-Allow-Origin", "*")
        res.json({bool:res2.data})
    }).catch(e => {
        console.log(e)
    })
})

app.get('/addStudent', async (req, res) => {//Button[verify]=>This API is called with input OTP and email details to search from db whether the values are same or not
    console.log(req.query.Student)
    axios.post('http://localhost:80/php_modules/addStudent.php', { Student: req.query.Student }).then((res2) => {
        res.set("Access-Control-Allow-Origin", "*")
        console.log(res2.data)
        res.json({bool:res2.data})
    }).catch(e => {
        console.log(e)
    })
})

app.get('/PresentAttendance', async (req, res) => {//Button[verify]=>This API is called with input OTP and email details to search from db whether the values are same or not

    axios.post('http://localhost:80/php_modules/getPresentAttendancesheet.php', { department: req.query.department, year: req.query.year,date:req.query.date }).then((res2) => {
        res.set("Access-Control-Allow-Origin", "*")
        console.log(res2.data)
        res.json(res2.data)
    }).catch(e => {
        console.log(e)
    })
})




app.get('/logIN', async (req, res) => {//Button[verify]=>This API is called with input OTP and email details to search from db whether the values are same or not

    axios.post('http://localhost:80/php_modules/checkPassw.php', { email: req.query.email }).then((res2) => {
        res.set("Access-Control-Allow-Origin", "*")
        password = res2.data['password']
        if (password == req.query.password) {
            console.log(res2.data)
            res.json({ passwVerified: true, description: "success", role: res2.data['role'], name: res2.data['name'], department: res2.data['department'] })
        }
        else {

            res.json({ passwVerified: false, description: "failure" })
        }
    }).catch(e => {
        console.log(e)
    })
})


app.get('/passChange', async (req, res) => {//Button[verify]=>This API is called with input OTP and email details to search from db whether the values are same or not

    axios.post('http://localhost:80/php_modules/changePassw.php', { email: req.query.email,password:req.query.password }).then((res2) => {
        res.set("Access-Control-Allow-Origin", "*")
        console.log(res2.data)
        res.json({state:true})
    }).catch(e => {
        console.log(e)
    })
})








function sendMail(OTP, email) {
    let NodeMailer = require('nodemailer')
    const transporter = NodeMailer.createTransport({
        host: "smtp.gmail.com",
        port: 465,
        secure: true,
        auth: {
            // TODO: replace `user` and `pass` values from <https://forwardemail.net>
            user: "yournodemailer@gmail.com",
            pass: "Your16CharPass",
        },
    });
    async function main() {
        // send mail with defined transport object
        const info = await transporter.sendMail({
            from: '"STDRMS 👻" <yournodemailer@gmail.com>', // sender address
            to: email, // list of receivers
            subject: "Your OTP verification code for STDRMS", // Subject line
            text: "Hello " + OTP, // plain text body
        });
        console.log("Message sent: %s", info.messageId);
    }
    main().catch(console.error);
}
app.listen(3003)