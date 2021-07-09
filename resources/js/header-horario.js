const divHorario = document.getElementById("header-horario");
const DATE       = new Date();
let aumento      = 0;

let hours        = DATE.getHours();
let minutes      = DATE.getMinutes();
const seconds      = (60-DATE.getSeconds())*1000;

function updateTime(){

    minutes += aumento;

    if(minutes >= 60){
        hours += 1;
        minutes = 0;
    }

    if(hours >= 24){
        hours = 0;
    }

    let txtH = hours;
    let txtM = minutes;

    if(hours.toString().length == 1){ txtH = "0" + hours; }
    if(minutes.toString().length == 1){ txtM = "0" + minutes; }

    divHorario.innerHTML = txtH+":"+txtM;

    aumento = 1;

}


updateTime();
setTimeout(()=>{updateTime();setInterval(updateTime, 60000);},seconds)


