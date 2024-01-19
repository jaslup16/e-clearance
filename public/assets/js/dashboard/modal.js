const uservalueId= document.querySelector("#user-id");
const userName = document.querySelector("#user-name");
const popmodal = document.querySelector("#popup-remove-modal")

function deleteUser(userId, name) {
    popmodal.classList.remove("hidden");
    popmodal.classList.add("flex");
    userName.textContent = name;
    uservalueId.value =  userId
}

function cancelRemove() {
    popmodal.classList.add("hidden");
    popmodal.classList.remove("flex");
}