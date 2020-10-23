$(document).ready(function(){
    $("#emailtest").hide();
    })
function Provera(){
    var error=[];

    var name=document.form.name.value;

    let phone=document.form.phone.value;
    let email=document.form.email.value;
    let date=document.form.date.value;
    let time=document.form.time.value;
    var rename = /^[A-ZČĆŠĐŽ][a-zčćšđž]{2,9}(\s[A-ZČĆŠĐŽ][a-zčćšđž]{2,14})*$/;
    let reemail = /^[\w]+[\.\_\-\w]*[0-9]{0,3}\@[\w]+([\.][\w]+)+$/;
    let rephone=/^[0-9]+$/
        if(!rename.test(name)){
        error.push("Please insert a valid name");}


        if(!rephone.test(phone)){
        error.push("Please insert a valid phone");}

        if(document.form.emailtest.value!=""){
            error.push("Bot attack!");
        }
        if(!reemail.test(email)){
        error.push("Please insert a valid email");}
        if(date==""){
        error.push("Please insert a date");}
        if(time==""){
            error.push("Please insert a time");}

        if(error.length>=1){

            let x=`<ul class='list'>`;
            for(var a of error){
            x+=`<li>${a}</li>`
            }
            x+=`</ul>`
            document.getElementById("error").innerHTML=x;
            return false
        }
        else{

            return true;
        }

}
// })
