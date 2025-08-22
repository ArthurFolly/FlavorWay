// FlavorWay Main JavaScript

document.addEventListener("DOMContentLoaded", () => {
  // Mobile Menu Toggle
  const mobileMenuBtn = document.getElementById("mobileMenuBtn")
  const nav = document.getElementById("nav")

  if (mobileMenuBtn && nav) {
    mobileMenuBtn.addEventListener("click", () => {
      nav.classList.toggle("active")
      const icon = mobileMenuBtn.querySelector("i")
      if (nav.classList.contains("active")) {
        icon.classList.remove("fa-bars")
        icon.classList.add("fa-times")
      } else {
        icon.classList.remove("fa-times")
        icon.classList.add("fa-bars")
      }
    })
  }

  // Smooth Scrolling for Navigation Links
  const navLinks = document.querySelectorAll('a[href^="#"]')
  navLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault()
      const targetId = this.getAttribute("href")
      const targetSection = document.querySelector(targetId)

      if (targetSection) {
        const headerHeight = document.querySelector(".header").offsetHeight
        const targetPosition = targetSection.offsetTop - headerHeight - 20

        window.scrollTo({
          top: targetPosition,
          behavior: "smooth",
        })

        // Close mobile menu if open
        if (nav.classList.contains("active")) {
          nav.classList.remove("active")
          const icon = mobileMenuBtn.querySelector("i")
          icon.classList.remove("fa-times")
          icon.classList.add("fa-bars")
        }
      }
    })
  })

  // Fade In Animation on Scroll
  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("visible")
      }
    })
  }, observerOptions)

  // Add fade-in class to elements
  const fadeElements = document.querySelectorAll(
    ".recipe-card, .technique-card, .cuisine-card, .stat-card, .combination-card",
  )
  fadeElements.forEach((el) => {
    el.classList.add("fade-in")
    observer.observe(el)
  })

  // Recipe Bookmark Toggle
  const bookmarkBtns = document.querySelectorAll(".recipe-bookmark")
  bookmarkBtns.forEach((btn) => {
    btn.addEventListener("click", function (e) {
      e.preventDefault()
      const icon = this.querySelector("i")
      if (icon.classList.contains("fas")) {
        icon.classList.remove("fas")
        icon.classList.add("far")
        showNotification("Receita removida dos favoritos", "info")
      } else {
        icon.classList.remove("far")
        icon.classList.add("fas")
        showNotification("Receita adicionada aos favoritos!", "success")
      }
    })
  })

  // Search Functionality
  const searchInput = document.querySelector(".search-input input")
  if (searchInput) {
    searchInput.addEventListener("input", function () {
      const searchTerm = this.value.toLowerCase()
      // Here you would implement actual search functionality
      console.log("Searching for:", searchTerm)
    })
  }

  // Random Combination Generator
  const randomBtn = document.querySelector(".btn-secondary")
  if (randomBtn && randomBtn.textContent.includes("Gerar Combinação")) {
    randomBtn.addEventListener("click", () => {
      generateRandomCombination()
    })
  }

  // Newsletter Subscription
  const newsletterForm = document.querySelector(".newsletter-form")
  if (newsletterForm) {
    const emailInput = newsletterForm.querySelector('input[type="email"]')
    const submitBtn = newsletterForm.querySelector("button")

    submitBtn.addEventListener("click", (e) => {
      e.preventDefault()
      const email = emailInput.value.trim()

      if (validateEmail(email)) {
        // Simulate API call
        submitBtn.innerHTML = '<div class="loading"></div>'
        submitBtn.disabled = true

        setTimeout(() => {
          showNotification("Inscrição realizada com sucesso!", "success")
          emailInput.value = ""
          submitBtn.innerHTML = "OK"
          submitBtn.disabled = false
        }, 2000)
      } else {
        showNotification("Por favor, insira um e-mail válido", "error")
      }
    })
  }

  // Header Background on Scroll
  const header = document.querySelector(".header")
  window.addEventListener("scroll", () => {
    if (window.scrollY > 100) {
      header.style.backgroundColor = "rgba(255, 255, 255, 0.98)"
      header.style.boxShadow = "0 2px 20px rgba(0, 0, 0, 0.1)"
    } else {
      header.style.backgroundColor = "rgba(255, 255, 255, 0.95)"
      header.style.boxShadow = "none"
    }
  })

  // Technique Video Play Buttons
  const playBtns = document.querySelectorAll(".play-btn")
  playBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      // Simulate video play
      showNotification("Abrindo vídeo da técnica...", "info")
    })
  })

  // Community Post Interactions
  const postActions = document.querySelectorAll(".post-actions span")
  postActions.forEach((action) => {
    action.addEventListener("click", function () {
      if (this.textContent.includes("❤️")) {
        const currentLikes = Number.parseInt(this.textContent.match(/\d+/)[0])
        this.textContent = `❤️ ${currentLikes + 1}`
        showNotification("Curtiu o post!", "success")
      }
    })
  })
})

// Utility Functions
function validateEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  return re.test(email)
}

function showNotification(message, type = "info") {
  // Create notification element
  const notification = document.createElement("div")
  notification.className = `alert alert-${type}`
  notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        z-index: 3000;
        max-width: 300px;
        animation: slideIn 0.3s ease;
    `
  notification.textContent = message

  // Add to page
  document.body.appendChild(notification)

  // Remove after 3 seconds
  setTimeout(() => {
    notification.style.animation = "slideOut 0.3s ease"
    setTimeout(() => {
      if (notification.parentNode) {
        notification.parentNode.removeChild(notification)
      }
    }, 300)
  }, 3000)
}

function generateRandomCombination() {
  const ingredients = [
    "Açafrão",
    "Leite de Coco",
    "Camarão",
    "Miso",
    "Manteiga",
    "Alho",
    "Cardamomo",
    "Chocolate",
    "Pimenta",
    "Quinoa",
    "Cogumelos",
    "Abacate",
    "Trufa",
    "Queijo Brie",
    "Rúcula",
    "Peixe",
    "Batata Doce",
    "Gengibre",
  ]

  const flavors = [
    "Sabor tropical sofisticado",
    "Umami cremoso intenso",
    "Doce picante exótico",
    "Terroso e aromático",
    "Fresco e vibrante",
    "Rico e complexo",
  ]

  // Select 3 random ingredients
  const selectedIngredients = []
  for (let i = 0; i < 3; i++) {
    const randomIndex = Math.floor(Math.random() * ingredients.length)
    selectedIngredients.push(ingredients[randomIndex])
    ingredients.splice(randomIndex, 1)
  }

  const randomFlavor = flavors[Math.floor(Math.random() * flavors.length)]

  showNotification(`Combinação: ${selectedIngredients.join(" + ")} = ${randomFlavor}`, "success")
}

// Add CSS animations
const style = document.createElement("style")
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
`
document.head.appendChild(style)

// Service Worker Registration (for PWA capabilities)
if ("serviceWorker" in navigator) {
  window.addEventListener("load", () => {
    navigator.serviceWorker
      .register("/sw.js")
      .then((registration) => {
        console.log("ServiceWorker registration successful")
      })
      .catch((err) => {
        console.log("ServiceWorker registration failed")
      })
  })
}

// Performance Monitoring
window.addEventListener("load", () => {
  // Log page load time
  const loadTime = performance.timing.loadEventEnd - performance.timing.navigationStart
  console.log("Page load time:", loadTime + "ms")
})
