const menu = document.getElementById("menu")
const closeMenu = document.getElementById("close-menu")
const sidebar = document.getElementById("sidebar")
const overlay = document.getElementById("overlay")

menu.addEventListener("click", function() {
	sidebar.classList.add("active")
	overlay.classList.add("active")
})
closeMenu.onclick = () => {
	sidebar.classList.remove("active")
	overlay.classList.remove("active")
}

//mensagens flash
document.querySelectorAll('.close-btn').forEach(button => {
  button.addEventListener('click', () => {
    const alert = button.parentElement
    alert.style.opacity = '0'
    alert.style.transform = 'translateY(-1rem)'
    setTimeout(() => alert.remove(), 300)
  });
});
