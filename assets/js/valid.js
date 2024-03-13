function valid() {
    let password = document.getElementById('password').value;
    let passwordConf = document.getElementById('passwordConf').value;
    if (password === passwordConf) {
        return true
    } else {
        document.getElementById('passwordError').innerHTML = "Le mot de passe n'a pas été saisi correctement !"
        setTimeout(() => {
            document.getElementById('passwordError').innerHTML = ""
        }, 3000)
        return false
    }
}