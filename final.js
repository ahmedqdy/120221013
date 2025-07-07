// ملاجظة بسبب اوضاع الانترنت والتاخر في انشاء المشروع استعنت باشياء من الذكاء الاصطناعي بخصوص ملف الجافا 


window.onscroll = function () {
  const btn = document.getElementById("scrollTopBtn");
  btn.style.display = window.scrollY> 300? "block": "none";
};

// عند الضغط على الزر
document.getElementById("scrollTopBtn").onclick = function () {
  window.scrollTo({ top: 0, behavior: "smooth"});
};

document.getElementById("menuToggle").onclick = function () {
  document.getElementById("navMenu").classList.toggle("active");
};



const sections = document.querySelectorAll("section");
const navLinks = document.querySelectorAll(".nav-link");

window.addEventListener("scroll", () => {
  let current = "";
  sections.forEach((section) => {
    const sectionTop = section.offsetTop;
    if (pageYOffset>= sectionTop - 60) {
      current = section.getAttribute("id");
}
});

  navLinks.forEach((link) => {
    link.classList.remove("active");
    if (link.getAttribute("href") === `#${current}`) {
      link.classList.add("active");
}
});
});

const toggleBtn = document.getElementById("toggle-theme");
  const currentTheme = localStorage.getItem("theme");

  if (currentTheme) {
    document.documentElement.setAttribute("data-theme", currentTheme);
  }

  toggleBtn.addEventListener("click", () => {
    let theme = document.documentElement.getAttribute("data-theme");
    if (theme === "dark") {
      document.documentElement.setAttribute("data-theme", "light");
      localStorage.setItem("theme", "light");
    } else {
      document.documentElement.setAttribute("data-theme", "dark");
      localStorage.setItem("theme", "dark");
    }
  });
