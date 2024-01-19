
const orderDropdown = document.querySelector("#orderDropdown");
const orderDropdownDefaultButton = document.querySelector("#orderDropdownDefaultButton");

orderDropdownDefaultButton.addEventListener("click", () => {
    console.log("waaa")
    if (orderDropdown.classList.contains("hidden")) {
        orderDropdown.classList.remove("hidden")
    } else {
        orderDropdown.classList.add("hidden");
    }
})


const dropdown = document.querySelector("#dropdown");
const dropdownDefaultButton = document.querySelector("#dropdownDefaultButton");

dropdownDefaultButton.addEventListener("click", () => {
    if (dropdown.classList.contains("hidden")) {
        dropdown.classList.remove("hidden")
    } else {
        dropdown.classList.add("hidden");
    }
})
