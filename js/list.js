var checkpoint = null;

function toggle_task(item)
{
    item.classList.toggle("done");
}

function listen_tasks()
{
    for (let el of document.querySelectorAll(".task-list > li"))
        el.querySelector('div').onclick = () => toggle_task(el);
}

function remove_list()
{
  if (id_folder == "Deleted")
    window.location.href = "form_remove.php?id=" + id;
  else
  {
    change_folder("Deleted");
    window.location.href = "lists.php";
  }
}

function delete_task(el)
{
  document.querySelector('ul.task-list').removeChild(el.parentElement);
}

function add_task()
{
  let li = document.createElement('li');
  li.innerHTML = '<div class="checkbox"></div><span contenteditable="true">Enter a task</span><i class="fas fa-times" onclick="delete_task(this)"></i>';
  document.querySelector('ul.task-list').appendChild(li);
  window.getSelection().selectAllChildren(li.querySelector('span'));
  listen_tasks();
}

function get_list()
{
  let list = {
    "title": document.querySelector('h1').innerText,
    "subtitle": document.querySelector('h3').innerText,
    "text": document.querySelector('#text').innerText,
    "tasks": []
  };
  for (let el of document.querySelectorAll(".task-list > li"))
  {
      list.tasks.push({
        "checked": el.classList.contains('done'),
        "label": el.querySelector('span').innerText
      })
  }
  return list;
}

function update()
{
  if (!checkpoint)
  {
    checkpoint = get_list();
    return ;
  }
  if (JSON.stringify(checkpoint) != JSON.stringify(get_list()))
  {
    checkpoint = get_list();
    const Http = new XMLHttpRequest();
    const url = global_url + '/api.php?service=update_list&id=' + id + '&page=' + JSON.stringify(checkpoint);
    Http.open("GET", url);
    Http.send();
  }
}

function open_modal()
{
  document.querySelector(".modal").toggleAttribute("open");
}

function change_folder(dest)
{
  console.log(dest);
  const Http = new XMLHttpRequest();
  const url = global_url + '/api.php?service=change_folder&id_folder=' + dest +'&id=' + id;
  Http.open("GET", url);
  Http.send();

}

function change_folder_button()
{
  let destination = document.querySelector("#folder-name-existing").value;
  if (document.querySelector("#folder-name-custom").value.length != 0)
    destination = document.querySelector("#folder-name-custom").value;
  open_modal();
  change_folder(destination);
}

function star_list()
{
  if (id_folder == "Important")
    change_folder("My Lists");
  else
    change_folder("Important");
  window.location.reload();
}

document.querySelector("#change-folder-button").onclick = change_folder_button;

listen_tasks();
setInterval(update, 1000);
