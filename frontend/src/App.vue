<template>
  <div id="app" class="min-h-screen bg-primary text-white">
    <Navbar />
    <Hero3D />
    <LogoShowcase />
    <Showcase :projects="projects" />
    <FeatureCards />
    <Timeline :experiences="experiences" />
    <TechStack />
    <Testimonials :testimonials="testimonials" />
    <Contact />
    <Footer />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import Navbar from './components/Navbar.vue'
import Hero3D from './components/Hero3D.vue'
import LogoShowcase from './components/LogoShowcase.vue'
import Showcase from './components/Showcase.vue'
import FeatureCards from './components/FeatureCards.vue'
import Timeline from './components/Timeline.vue'
import TechStack from './components/TechStack.vue'
import Testimonials from './components/Testimonials.vue'
import Contact from './components/Contact.vue'
import Footer from './components/Footer.vue'

const projects = ref([])
const experiences = ref([])
const testimonials = ref([])

const fetchData = async () => {
  try {
    // Fetch projects
    const projectsRes = await fetch('/api/projects')
    if (projectsRes.ok) {
      const data = await projectsRes.json()
      // API Platform returns data in 'hydra:member' for collections
      projects.value = data['hydra:member'] || data
    }
  } catch (error) {
    console.error('Error fetching projects:', error)
  }

  try {
    // Fetch experiences
    const experiencesRes = await fetch('/api/experiences')
    if (experiencesRes.ok) {
      const data = await experiencesRes.json()
      experiences.value = data['hydra:member'] || data
    }
  } catch (error) {
    console.error('Error fetching experiences:', error)
  }

  try {
    // Fetch testimonials
    const testimonialsRes = await fetch('/api/testimonials')
    if (testimonialsRes.ok) {
      const data = await testimonialsRes.json()
      testimonials.value = data['hydra:member'] || data
    }
  } catch (error) {
    console.error('Error fetching testimonials:', error)
  }
}

onMounted(() => {
  fetchData()
})
</script>

<style>
/* Global smooth scroll */
html {
  scroll-behavior: smooth;
}

/* Custom scrollbar */
::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-track {
  background: #0F172A;
}

::-webkit-scrollbar-thumb {
  background: #3B82F6;
  border-radius: 5px;
}

::-webkit-scrollbar-thumb:hover {
  background: #2563EB;
}
</style>
