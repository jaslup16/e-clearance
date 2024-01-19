const default_sidebar = document.querySelector("#default-sidebar")

function aside() {
    if (default_sidebar.classList.contains("max-sm:hidden")) {
        default_sidebar.classList.remove("max-sm:hidden")
    } else {
        default_sidebar.classList.add("max-sm:hidden")
        
    }
}