function verifLength(str){
    const regex = /.{8,}/
    return regex.test(str)
}
function verifLower(str){
    const regex = /[a-z]/
    return regex.test(str)
}
function verifUpper(str){
    const regex = /[A-Z]/
    return regex.test(str)
}
function verifNumber(str){
    const regex = /[0-9]/
    return regex.test(str)
}
function verifSpecial(str){
    const regex = /[^A-Za-z0-9]/
    return regex.test(str)
}

function isValide(id, res){
    if (res) {
        document.getElementById(id).style.color = "green"
        return 1
    } else {
        document.getElementById(id).style.color = "red"
        return 0
    }
}

let mdp = document.querySelector("#password");
mdp.addEventListener('input', function(){
    let str = mdp.value;
    let complexite = 0;
    complexite += verifUpper(str) + verifLower(str) + verifNumber(str) + verifSpecial(str)
    if (verifLength(str)) {
        switch (complexite) {
            case 4:
                document.querySelector("#complexite").innerHTML = "fort"
                document.querySelector("#complexite").style.cssText += ";text-decoration : underline 3px cyan"
                break
            case 3:
                document.querySelector("#complexite").innerHTML = "moyen"
                document.querySelector("#complexite").style.cssText += ";text-decoration : underline 3px lime"
                break
            case 2:
                document.querySelector("#complexite").innerHTML = "faible"
                document.querySelector("#complexite").style.cssText += ";text-decoration : underline 3px yellow"
                break
            case 1:
                document.querySelector("#complexite").innerHTML = "très faible"
                document.querySelector("#complexite").style.cssText += ";text-decoration : underline 3px orange"
                break
        }
    } else {
        document.querySelector("#complexite").innerHTML = "insuffisant"
        document.querySelector("#complexite").style.cssText += ";text-decoration : underline 3px red"
    }
    
})
let repeatmdp = document.querySelector("#repeatpassword");
repeatmdp.addEventListener('input', function(){
    if (repeatmdp.value == mdp.value | repeatmdp.value == "") {
        document.querySelector("#repeatcorrect").innerHTML = ""
    } else {
        document.querySelector("#repeatcorrect").innerHTML = "Les mots de passe ne sont pas identiques"
    }
})