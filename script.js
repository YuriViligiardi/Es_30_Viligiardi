let mes = document.getElementById("message");
let contenitoreCf = document.getElementById("contenitoreInputCf");
let count = 1; 

function changeVisibilityOn() {
    let div = document.getElementById("divBiglietti");
    if (div.style.display = "none") {
        div.style.display = "block"; 
    } else {
        div.style.display = "none";
    }
}

function resetContenitoreCf() {
    let numPers = document.getElementById("numPers");
    for (let i = 2; i <= 4; i++) {
        count = i;
        deleteInput();
    }
    count = 1;
    numPers.value = parseInt(count);
}  

function changeVisibilityOff() {
    let div = document.getElementById("divBiglietti");
    resetContenitoreCf();
    if (div.style.display = "block") {
        div.style.display = "none"; 
    } else {
        div.style.display = "block";
    }
}

function increasePerson(){
    let numPers = document.getElementById("numPers");
    if (numPers.value < 4) {
        numPers.value = parseInt(numPers.value) + 1;
        count++;
        createInput();
    } else {
        mes.style.cssText = "background-color: red; color: white; width: 50%; margin: auto;";
        mes.innerHTML = "HAI RAGGIUNTO NUMERO MASSIMO DI PERSONE CHE PUOI AGGIUNGERE";
    }
}

function decreasePerson(){
    let numPers = document.getElementById("numPers");
    if (numPers.value > 1) {
        numPers.value = parseInt(numPers.value) - 1;
        deleteInput();
        count--;
    } else {
        mes.style.cssText = "background-color: green; color: white; width: 50%; margin: auto;";
        mes.innerHTML = "HAI RAGGIUNTO NUMERO MINIMO DI PERSONE CHE PUOI AGGIUNGERE";
    }
}

function createInput() {
    let newInput = document.createElement("input");
    newInput.type = "text";
    newInput.name = "cfPers" + count;
    newInput.id = "cfPers" + count;
    newInput.placeholder = "Nuovo codice fiscale";

    contenitoreCf.appendChild(newInput);
}

function deleteInput() {
    let deleteInput = document.getElementById("cfPers" + count); 
    if (deleteInput) {
        contenitoreCf.removeChild(deleteInput);
    }
}


