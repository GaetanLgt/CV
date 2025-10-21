<template>
  <section id="testimonials" class="section-container bg-primary">
    <h2 ref="titleRef" class="section-title">
      <span class="text-gradient">Témoignages</span>
    </h2>
    <p ref="subtitleRef" class="section-subtitle">
      Ce que disent mes clients et collaborateurs
    </p>

    <div class="max-w-5xl mx-auto mt-12">
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          v-for="(testimonial, index) in testimonials"
          :key="testimonial.id"
          ref="testimonialRefs"
          class="card flex flex-col opacity-0 hover:scale-105 transition-transform"
        >
          <!-- Quote icon -->
          <svg class="w-10 h-10 text-accent/30 mb-4" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
          </svg>

          <!-- Content -->
          <p class="text-gray-300 leading-relaxed mb-6 flex-grow">
            "{{ testimonial.content }}"
          </p>

          <!-- Rating -->
          <div v-if="testimonial.rating" class="flex gap-1 mb-4">
            <svg
              v-for="star in 5"
              :key="star"
              class="w-5 h-5"
              :class="star <= testimonial.rating ? 'text-yellow-400' : 'text-gray-600'"
              fill="currentColor"
              viewBox="0 0 20 20"
            >
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
          </div>

          <!-- Author -->
          <div class="flex items-center gap-3 pt-4 border-t border-gray-700">
            <div
              class="w-12 h-12 rounded-full overflow-hidden bg-gradient-to-br from-accent to-purple-600 flex items-center justify-center"
            >
              <img
                v-if="testimonial.avatar"
                :src="testimonial.avatar"
                :alt="testimonial.name"
                class="w-full h-full object-cover"
              />
              <span v-else class="text-white font-bold text-lg">
                {{ getInitials(testimonial.name) }}
              </span>
            </div>
            <div>
              <p class="font-semibold">{{ testimonial.name }}</p>
              <p class="text-sm text-gray-400">
                {{ testimonial.position }}
                <span v-if="testimonial.company"> · {{ testimonial.company }}</span>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Empty State -->
      <div v-if="testimonials.length === 0" class="text-center py-16">
        <p class="text-gray-400 text-lg">Aucun témoignage pour le moment...</p>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

const props = defineProps({
  testimonials: {
    type: Array,
    default: () => [],
  },
})

const titleRef = ref()
const subtitleRef = ref()
const testimonialRefs = ref([])

const getInitials = (name) => {
  return name
    .split(' ')
    .map((n) => n[0])
    .join('')
    .toUpperCase()
    .slice(0, 2)
}

onMounted(() => {
  // Animate title
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

  // Animate testimonial cards
  testimonialRefs.value.forEach((card, index) => {
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
