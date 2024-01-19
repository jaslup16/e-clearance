
const orderDropdown = document.querySelector("#orderDropdown");
const orderDropdownDefaultButton = document.querySelector("#orderDropdownDefaultButton");

orderDropdownDefaultButton.addEventListener("click", () => {
    if (orderDropdown.classList.contains("hidden")) {
        orderDropdown.classList.remove("hidden")
    } else {
        orderDropdown.classList.add("hidden");
    }
})

const statusDropdown = document.querySelector("#statusDropdown");
const statusDropdownDefaultButton = document.querySelector("#statusDropdownDefaultButton");

statusDropdownDefaultButton.addEventListener("click", () => {  
    if (statusDropdown.classList.contains("hidden")) {
        statusDropdown.classList.remove("hidden")
    } else {
        statusDropdown.classList.add("hidden");
    }
})