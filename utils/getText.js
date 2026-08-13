export function GetText(selector, text) {
    let el = document.querySelector(selector)
    if (el) {
        return el.innerText
    }
}