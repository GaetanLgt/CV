<template>
  <section id="experience" class="section-container bg-primary">
    <h2 ref="titleRef" class="section-title">
      Mon <span class="text-gradient">Parcours</span>
    </h2>
    <p ref="subtitleRef" class="section-subtitle">
      Mes expériences professionnelles et académiques
    </p>

    <div class="max-w-4xl mx-auto mt-16">
      <!-- Timeline -->
      <div class="relative">
        <!-- Vertical line -->
        <div
          ref="timelineLineRef"
          class="absolute left-0 md:left-1/2 top-0 bottom-0 w-0.5 bg-accent/30 transform md:-translate-x-1/2"
          style="height: 0"
        ></div>

        <!-- Timeline items -->
        <div class="space-y-12">
          <div
            v-for="(exp, index) in experiences"
            :key="exp.id"
            ref="timelineItemRefs"
            class="relative opacity-0"
            :class="index % 2 === 0 ? 'md:text-right md:pr-1/2' : 'md:pl-1/2 md:ml-auto'"
          >
            <!-- Timeline dot -->
            <div
              class="absolute left-0 md:left-1/2 top-6 w-4 h-4 bg-accent rounded-full transform md:-translate-x-1/2 border-4 border-primary"
              :class="exp.current ? 'ring-4 ring-accent/30 animate-pulse' : ''"
            ></div>

            <!-- Content card -->
            <div
              class="ml-8 md:ml-0 card"
              :class="index % 2 === 0 ? 'md:mr-8' : 'md:ml-8'"
            >
              <div class="flex items-start gap-4" :class="index % 2 === 0 ? 'md:flex-row-reverse md:text-right' : ''">
                <!-- Logo -->
                <div
                  v-if="exp.logo"
                  class="flex-shrink-0 w-12 h-12 rounded-lg overflow-hidden bg-white/10"
                >
                  <img :src="exp.logo" :alt="exp.company" class="w-full h-full object-cover" />
                </div>

                <!-- Details -->
                <div class="flex-1">
                  <div class="flex items-center gap-2 mb-2" :class="index % 2 === 0 ? 'md:justify-end' : ''">
                    <span class="text-sm text-accent font-medium">
                      {{ formatDate(exp.startDate) }} - {{ exp.current ? 'Présent' : formatDate(exp.endDate) }}
                    </span>
                    <span v-if="exp.current" class="px-2 py-1 text-xs bg-accent/20 text-accent rounded-full">
                      En cours
                    </span>
                  </div>

                  <h3 class="text-xl font-bold mb-1">{{ exp.position }}</h3>
                  <p class="text-accent mb-3">{{ exp.company }}</p>
                  <p class="text-gray-400 text-sm leading-relaxed">{{ exp.description }}</p>

                  <!-- Technologies -->
                  <div
                    v-if="exp.technologies && exp.technologies.length"
                    class="flex flex-wrap gap-2 mt-4"
                    :class="index % 2 === 0 ? 'md:justify-end' : ''"
                  >
                    <span
                      v-for="tech in exp.technologies"
                      :key="tech"
                      class="text-xs bg-secondary px-2 py-1 rounded"
                    >
                      {{ tech }}
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Empty State -->
      <div v-if="experiences.length === 0" class="text-center py-16">
        <p class="text-gray-400 text-lg">Aucune expérience pour le moment...</p>
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
  experiences: {
    type: Array,
    default: () => [],
  },
})

const titleRef = ref()
const subtitleRef = ref()
const timelineLineRef = ref()
const timelineItemRefs = ref([])

const formatDate = (dateString) => {
  if (!dateString) return ''
  const date = new Date(dateString)
  return date.toLocaleDateString('fr-FR', { month: 'short', year: 'numeric' })
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

  // Animate timeline line
  if (timelineLineRef.value && timelineItemRefs.value.length > 0) {
    gsap.to(timelineLineRef.value, {
      scrollTrigger: {
        trigger: timelineLineRef.value,
        start: 'top 70%',
        end: 'bottom 30%',
        scrub: 1,
      },
      height: '100%',
      ease: 'none',
    })
  }

  // Animate timeline items
  timelineItemRefs.value.forEach((item, index) => {
    gsap.to(item, {
      scrollTrigger: {
        trigger: item,
        start: 'top 80%',
      },
      opacity: 1,
      x: 0,
      duration: 0.6,
      delay: index * 0.1,
      ease: 'power3.out',
    })
  })
})
</script>
