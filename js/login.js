const words = ["cleaner", "better", "faster", "classier", "prettier"];
var word = 0;

function next_word()
{
    document.querySelector("#word-changer").innerHTML = words[word];
    word++;
    word = word % words.length;
    setTimeout(next_word, 1000);
}
next_word();

document.querySelector("#no-account").onclick = function () {
    document.querySelector("#form-signup").toggleAttribute('open');
    document.querySelector("#form").toggleAttribute('open');
}

document.querySelector("#already-account").onclick = function () {
    document.querySelector("#form-signup").toggleAttribute('open');
    document.querySelector("#form").toggleAttribute('open');
}
