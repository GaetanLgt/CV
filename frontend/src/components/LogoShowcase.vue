<template>
  <section class="py-16 bg-secondary/50 overflow-hidden">
    <div class="section-container">
      <h3 class="text-center text-gray-400 text-sm uppercase tracking-widest mb-12">
        Technologies que j'utilise
      </h3>

      <!-- Infinite scroll logos -->
      <div ref="logoTrackRef" class="flex gap-12 items-center">
        <div
          v-for="(logo, index) in [...logos, ...logos]"
          :key="`logo-${index}`"
          class="flex-shrink-0 grayscale hover:grayscale-0 transition-all duration-300 opacity-50 hover:opacity-100"
        >
          <div class="w-24 h-24 flex items-center justify-center">
            <span class="text-4xl font-bold text-white">{{ logo }}</span>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { gsap } from 'gsap'

const logoTrackRef = ref()

const logos = [
  'Vue',
  'React',
  'Node',
  'PHP',
  'Docker',
  'AWS',
  'MySQL',
  'Git',
]

onMounted(() => {
  // Infinite horizontal scroll animation
  const track = logoTrackRef.value

  if (track) {
    const totalWidth = track.scrollWidth / 2

    gsap.to(track, {
      x: -totalWidth,
      duration: 20,
      ease: 'none',
      repeat: -1,
    })

    // Pause on hover
    track.addEventListener('mouseenter', () => {
      gsap.to(track, { timeScale: 0.2, duration: 0.5 })
    })

    track.addEventListener('mouseleave', () => {
      gsap.to(track, { timeScale: 1, duration: 0.5 })
    })
  }
})
</script>
