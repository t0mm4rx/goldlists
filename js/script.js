for (let el of document.querySelectorAll(".popup"))
{
    setTimeout(() => el.classList.add("popup-hidden"), 5000);
}

for (let el of document.querySelectorAll(".modal"))
{
    el.querySelector("button").onclick = function () {
      el.toggleAttribute("open");
    };
}
