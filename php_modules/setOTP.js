axios
    .get('http://localhost:3003/getStData', { params: { email: "arkasama2001@gmail.com"} })
    .then((response) => (this.info = response))
    




axios
.get('http://localhost:3003/getAttendanceData', { params: { department: "MCA",year:"1"} })
.then((response) => (this.info = response))


axios
.get('http://localhost:3003/UpdateAttendance', { params: { Students:[{name:arkasama2001,IsPresent:TRUE}],department: "MCA",year:"1"} })
.then((response) => (this.info = response))



axios
.get('http://localhost:3003/getStData', { params: { email: "arkasama2001@gmail.com"} })
.then((response) => (this.info = response))