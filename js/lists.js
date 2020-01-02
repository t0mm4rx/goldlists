function toggle_menu()
{
    document.querySelector("#page").toggleAttribute("open");
    document.querySelector("#off-canvas").toggleAttribute("open");
}

function create_list()
{
  window.location.href = "form_create.php?title=" + prompt("Enter a title") + "&subtitle=" + prompt("Enter a subtitle") + "&id_folder=" + id_folder;
}
