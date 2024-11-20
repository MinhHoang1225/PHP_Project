// Lấy tất cả các mục trong sidebar
const menuItems = document.querySelectorAll(".menu a");

// Lấy tất cả các section
const sections = document.querySelectorAll(".section");

// Lặp qua các mục menu và thêm sự kiện click
menuItems.forEach((item) => {
  item.addEventListener("click", (event) => {
    event.preventDefault();

    // Xóa class 'active' khỏi tất cả các mục menu
    menuItems.forEach((menuItem) => menuItem.classList.remove("active"));

    // Thêm class 'active' vào mục được nhấn
    item.classList.add("active");

    // Ẩn tất cả các section
    sections.forEach((section) => {
      section.style.display = "none";
    });

    // Hiển thị section tương ứng
    const sectionId = item.getAttribute("data-section");
    const activeSection = document.getElementById(sectionId);
    if (activeSection) {
      activeSection.style.display = "block";
    }
  });
});

// Mặc định chỉ hiển thị phần dashboard
document.addEventListener("DOMContentLoaded", () => {
  sections.forEach((section) => (section.style.display = "none"));
  document.getElementById("dashboard").style.display = "block";
});
