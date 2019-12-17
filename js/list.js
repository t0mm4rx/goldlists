function toggle_task(item)
{
    item.classList.toggle("done");
}

function listen_tasks()
{
    for (let el of document.querySelectorAll(".task-list > li"))
        el.querySelector('div').onclick = () => toggle_task(el);
}

function remove_list(id)
{
  window.location.href = "form_remove.php?id=" + id;
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

}

listen_tasks();
