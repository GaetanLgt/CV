<template>
  <section id="projects" class="section-container bg-primary">
    <h2 ref="titleRef" class="section-title">
      Mes <span class="text-gradient">Projets</span>
    </h2>
    <p ref="subtitleRef" class="section-subtitle">
      Découvrez une sélection de mes réalisations les plus récentes
    </p>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
      <div
        v-for="(project, index) in projects"
        :key="project.slug"
        ref="projectRefs"
        class="card group cursor-pointer opacity-0"
        :data-index="index"
      >
        <!-- Project Image -->
        <div class="relative overflow-hidden rounded-lg mb-4 aspect-video bg-secondary">
          <img
            v-if="project.cover"
            :src="project.cover"
            :alt="project.title"
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
          />
          <div v-else class="w-full h-full flex items-center justify-center text-gray-500">
            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
          </div>

          <!-- Featured Badge -->
          <div
            v-if="project.featured"
            class="absolute top-3 right-3 bg-accent text-white text-xs font-bold px-3 py-1 rounded-full"
          >
            Featured
          </div>
        </div>

        <!-- Project Info -->
        <div class="space-y-3">
          <h3 class="text-2xl font-bold group-hover:text-accent transition-colors">
            {{ project.title }}
          </h3>
          <p class="text-gray-400 line-clamp-3">
            {{ project.description }}
          </p>

          <!-- Tags -->
          <div class="flex flex-wrap gap-2">
            <span
              v-for="tag in project.tags"
              :key="tag"
              class="text-xs bg-accent/20 text-accent px-3 py-1 rounded-full"
            >
              {{ tag }}
            </span>
          </div>

          <!-- Link -->
          <a
            v-if="project.url"
            :href="project.url"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex items-center gap-2 text-accent hover:underline mt-2"
          >
            Voir le projet
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </a>
        </div>
      </div>
    </div>

    <!-- Empty State -->
    <div v-if="projects.length === 0" class="text-center py-16">
      <p class="text-gray-400 text-lg">Aucun projet pour le moment...</p>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

const props = defineProps({
  projects: {
    type: Array,
    default: () => [],
  },
})

const titleRef = ref()
const subtitleRef = ref()
const projectRefs = ref([])

onMounted(() => {
  // Animate title and subtitle
  gsap.from(titleRef.value, {
    scrollTrigger: {
      trigger: titleRef.value,
      start: 'top 80%',
    },
    opacity: 0,
    y: 50,
    duration: 0.8,
    ease: 'power3.out',
  })

  gsap.from(subtitleRef.value, {
    scrollTrigger: {
      trigger: subtitleRef.value,
      start: 'top 80%',
    },
    opacity: 0,
    y: 30,
    duration: 0.8,
    delay: 0.2,
    ease: 'power3.out',
  })

  // Animate project cards
  projectRefs.value.forEach((card, index) => {
    gsap.to(card, {
      scrollTrigger: {
        trigger: card,
        start: 'top 85%',
      },
      opacity: 1,
      y: 0,
      duration: 0.6,
      delay: index * 0.1,
      ease: 'power3.out',
    })
  })
})
</script>
