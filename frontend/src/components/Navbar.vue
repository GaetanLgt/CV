<template>
  <nav
    ref="navRef"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
    :class="{ 'glass shadow-lg': isScrolled, 'bg-transparent': !isScrolled }"
  >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16 md:h-20">
        <!-- Logo -->
        <a href="#hero" class="text-2xl font-bold text-gradient hover:scale-110 transition-transform">
          GL
        </a>

        <!-- Desktop Menu -->
        <ul class="hidden md:flex items-center gap-8">
          <li v-for="item in menuItems" :key="item.href">
            <a
              :href="item.href"
              class="text-gray-300 hover:text-accent transition-colors font-medium"
              @click="scrollToSection"
            >
              {{ item.label }}
            </a>
          </li>
          <li>
            <a
              href="#contact"
              class="btn-primary text-sm"
              @click="scrollToSection"
            >
              Contact
            </a>
          </li>
        </ul>

        <!-- Mobile Menu Button -->
        <button
          @click="toggleMobileMenu"
          class="md:hidden text-white focus:outline-none"
          aria-label="Toggle menu"
        >
          <svg v-if="!isMobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div
      v-if="isMobileMenuOpen"
      ref="mobileMenuRef"
      class="md:hidden glass border-t border-white/20"
    >
      <ul class="px-4 py-6 space-y-4">
        <li v-for="item in menuItems" :key="item.href">
          <a
            :href="item.href"
            class="block text-gray-300 hover:text-accent transition-colors font-medium py-2"
            @click="closeMobileMenu"
          >
            {{ item.label }}
          </a>
        </li>
        <li>
          <a
            href="#contact"
            class="block btn-primary text-center"
            @click="closeMobileMenu"
          >
            Contact
          </a>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { gsap } from 'gsap'

const navRef = ref()
const mobileMenuRef = ref()
const isScrolled = ref(false)
const isMobileMenuOpen = ref(false)

const menuItems = [
  { label: 'Projets', href: '#projects' },
  { label: 'Expérience', href: '#experience' },
  { label: 'Compétences', href: '#skills' },
  { label: 'Témoignages', href: '#testimonials' },
]

const handleScroll = () => {
  isScrolled.value = window.scrollY > 50
}

const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value

  if (isMobileMenuOpen.value) {
    gsap.from(mobileMenuRef.value, {
      opacity: 0,
      y: -20,
      duration: 0.3,
      ease: 'power2.out',
    })
  }
}

const closeMobileMenu = () => {
  isMobileMenuOpen.value = false
}

const scrollToSection = (e) => {
  e.preventDefault()
  const href = e.currentTarget.getAttribute('href')
  const target = document.querySelector(href)

  if (target) {
    const offsetTop = target.offsetTop - 80
    window.scrollTo({
      top: offsetTop,
      behavior: 'smooth',
    })
  }

  closeMobileMenu()
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll)

  // Animate navbar on mount
  gsap.from(navRef.value, {
    y: -100,
    opacity: 0,
    duration: 0.8,
    ease: 'power3.out',
    delay: 0.2,
  })
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>
