const menuItems = document.querySelectorAll(".menu a");
const sections = document.querySelectorAll(".section");
menuItems.forEach((item) => {
  item.addEventListener("click", (event) => {
    event.preventDefault();
     menuItems.forEach((menuItem) => menuItem.classList.remove("active"));
    item.classList.add("active");
    sections.forEach((section) => {
      section.style.display = "none";
    });
    const sectionId = item.getAttribute("data-section");
    const activeSection = document.getElementById(sectionId);
    if (activeSection) {
      activeSection.style.display = "block";
    }
  });
});
document.addEventListener("DOMContentLoaded", () => {
  sections.forEach((section) => (section.style.display = "none"));
  document.getElementById("dashboard").style.display = "block";
});
