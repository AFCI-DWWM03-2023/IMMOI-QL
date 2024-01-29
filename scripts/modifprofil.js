const nomVoieOG = document.querySelector("#adresse").value
const zipcodeOG = document.querySelector("#zipcode").value
const localiteOG = document.querySelector("#localite").value

var nomVoie = document.querySelector("#adresse").value
var zipcode = document.querySelector("#zipcode").value
var localite = document.querySelector("#localite").value

function verifModif() {
    if (nomVoie == nomVoieOG & zipcode == zipcodeOG & localite == localiteOG) {
        return 0
    } else {
        return 1
    }
}

function verifFullAdresse() {
    if (nomVoie == "" | zipcode == "" | localite == "") {
        return 0
    } else {
        return 1
    }
}

function verifEmptyAdresse() {
    if (nomVoie == "" & zipcode == "" & localite == "") {
        return 1
    } else {
        return 0
    }
}

function verif(){
    if (verifModif()) {
        document.querySelector("#adressemodif").checked = true
        if (verifFullAdresse()) {
            document.querySelector("#validerinsc").disabled = false
            document.querySelector("#adresscorrect").innerHTML = ""
        } else {
            if (verifEmptyAdresse()) {
                document.querySelector("#validerinsc").disabled = false
                document.querySelector("#adresscorrect").innerHTML = ""
            } else {
                document.querySelector("#validerinsc").disabled = true
                document.querySelector("#adresscorrect").innerHTML = "(!)"
            }
        }
    } else {
        document.querySelector("#adressemodif").checked = false
        document.querySelector("#validerinsc").disabled = false
        document.querySelector("#adresscorrect").innerHTML = ""
    }
}

let nomVoieInput = document.querySelector("#adresse");
nomVoieInput.addEventListener('input', function(){
    nomVoie = nomVoieInput.value
    verif()
})

let zipcodeInput = document.querySelector("#zipcode");
zipcodeInput.addEventListener('input', function(){
    zipcode = zipcodeInput.value
    verif()
})

let localiteInput = document.querySelector("#localite");
localiteInput.addEventListener('input', function(){
    localite = localiteInput.value
    verif()
})