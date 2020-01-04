function toggle_menu()
{
    document.querySelector("#page").toggleAttribute("open");
    document.querySelector("#off-canvas").toggleAttribute("open");
}

function create_list()
{
  window.location.href = "form_create.php?title=" + document.querySelector('#title').value + "&subtitle=" + document.querySelector('#subtitle').value + "&id_folder=" + id_folder + "&id_user=" + id;
}

function toggle_modal()
{
  document.querySelector(".modal").toggleAttribute("open");
}

document.querySelector("#create-button").onclick = create_list;
