console.log("JavaScript is connected");

// Scroll suave desde botones de Hero a secciones internas
document.addEventListener('DOMContentLoaded', () => {
  const heroButtons = document.querySelectorAll('.hero-buttons a[href^="#"]');

  heroButtons.forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth'
        });
      }
    });
  });
});
