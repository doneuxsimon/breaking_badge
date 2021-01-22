const firstName = document.querySelector('#firstName')
const email = document.querySelector('#email')
const pwd = document.querySelector('#pwd')
const count = document.querySelector('#count')
const errorName = document.querySelector('#errorName')
const errorMail = document.querySelector('#errorMail')
const errorPwd = document.querySelector('#errorPwd')

const namePattern = /^[a-zA-Z-]+$/
const mailPattern = /^[\w-]+(\.?[\w-]+)?@{1}[a-z]+\.{1}[a-z]+$/i
const checkPwd = (str) => {
    let pattern1 = /[a-z]+/
    let pattern2 = /[A-Z]+/
    let pattern3 = /\d+/
    let pattern4 = /[\W_]/
    let pattern5 = /^\S{8,18}$/
    if (str.match(pattern1) && str.match(pattern2) && str.match(pattern3) && str.match(pattern4) && str.match(pattern5)) {
        return true
    } else {
        return false
    }
}

let name = false
let mail = false
let pass = false
let x = 0
count.textContent = x + '/3'

firstName.addEventListener('change', (e) => {
    let inputValue = e.target.value
    if (inputValue.match(namePattern)) {
        if (!name){
            x++
            count.textContent = x + '/3'
            errorName.style.visibility = 'hidden'
            name = true
        } else {
            count.textContent = x + '/3'
            errorName.style.visibility = 'hidden'
        }
    } else if (!inputValue) {
        if (name) {
            x--
            count.textContent = x + '/3'
            errorName.style.visibility = 'hidden'
            name = false
        } else {
            count.textContent = x + '/3'
            errorName.style.visibility = 'hidden' 
        }
    } else {
        if (name) {
            x--
            count.textContent = x + '/3'
            errorName.style.visibility = 'visible'
            name = false
        } else {
            count.textContent = x + '/3'
            errorName.style.visibility = 'visible'
        }
    }
})
email.addEventListener('change', (e) => {
    let inputValue = e.target.value
    if (inputValue.match(mailPattern)) {
        if (!mail){
            x++
            count.textContent = x + '/3'
            errorMail.style.visibility = 'hidden'
            mail = true
        } else {
            count.textContent = x + '/3'
            errorMail.style.visibility = 'hidden'
        }
    }  else if (!inputValue) {
        if (mail) {
            x--
            count.textContent = x + '/3'
            errorMail.style.visibility = 'hidden'
            mail = false
        } else {
            count.textContent = x + '/3'
            errorMail.style.visibility = 'hidden'
        }
    } else {
        if (mail) {
            x--
            count.textContent = x + '/3'
            errorMail.style.visibility = 'visible'
            mail = false
        } else {
            count.textContent = x + '/3'
            errorMail.style.visibility = 'visible'
        }
    }
})
pwd.addEventListener('change', (e) => {
    let inputValue = e.target.value
    if (checkPwd(inputValue)) {
        if (!pass){
            x++
            count.textContent = x + '/3'
            errorPwd.style.visibility = 'hidden'
            pass = true
        } else {
            count.textContent = x + '/3'
            errorPwd.style.visibility = 'hidden'
        }
    } else if (!inputValue) {
        if (pass) {
            x--
            count.textContent = x + '/3'
            errorPwd.style.visibility = 'hidden'
            pass = false
        } else {
            count.textContent = x + '/3'
            errorPwd.style.visibility = 'hidden'
        }
    } else {
        if (pass) {
            x--
            count.textContent = x + '/3'
            errorPwd.style.visibility = 'visible'
            pass = false
        } else {
            count.textContent = x + '/3'
            errorPwd.style.visibility = 'visible'
        }
    }
})