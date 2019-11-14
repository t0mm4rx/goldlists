function toggle_menu()
{
    document.querySelector("#page").toggleAttribute("open");
    document.querySelector("#off-canvas").toggleAttribute("open");
}

function toggle_add()
{

}

function toggle_task(item)
{
    item.classList.toggle("done");
}

function listen_tasks()
{
    for (let el of document.querySelectorAll(".task-list > li"))
    {
        el.onclick = () => toggle_task(el);
    }
}

listen_tasks();
