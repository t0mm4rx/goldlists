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
