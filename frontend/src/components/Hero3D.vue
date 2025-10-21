<template>
  <section id="hero" class="relative h-screen w-full overflow-hidden bg-gradient-to-b from-primary via-secondary to-primary">
    <!-- Three.js Scene -->
    <TresCanvas v-bind="gl" class="absolute inset-0">
      <TresPerspectiveCamera :position="[0, 1.2, 3]" :fov="60" />
      <TresAmbientLight :intensity="0.6" />
      <TresDirectionalLight :intensity="1.2" :position="[5, 5, 5]" />
      <TresPointLight :intensity="0.8" :position="[-3, 2, -3]" color="#3B82F6" />

      <!-- 3D Icosahedron -->
      <Sphere
        ref="sphereRef"
        :args="[1, 32, 32]"
        :position="[0, 0, 0]"
      >
        <TresMeshStandardMaterial
          :color="'#3B82F6'"
          :metalness="0.7"
          :roughness="0.2"
          :wireframe="false"
        />
      </Sphere>

      <OrbitControls
        :enableZoom="false"
        :enablePan="false"
        :autoRotate="true"
        :autoRotateSpeed="0.5"
      />
    </TresCanvas>

    <!-- Hero Content -->
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-10">
      <div class="text-center px-4 max-w-4xl">
        <h1 ref="titleRef" class="text-5xl md:text-7xl lg:text-8xl font-bold mb-6 opacity-0">
          <span class="text-gradient">Portfolio 3D</span>
        </h1>
        <p ref="subtitleRef" class="text-xl md:text-2xl text-gray-300 mb-8 opacity-0">
          Développeur Full Stack & Créatif
        </p>
        <div ref="ctaRef" class="flex gap-4 justify-center opacity-0 pointer-events-auto">
          <a href="#projects" class="btn-primary">
            Voir mes projets
          </a>
          <a href="#contact" class="btn-primary bg-transparent border-2 border-accent hover:bg-accent/20">
            Me contacter
          </a>
        </div>
      </div>
    </div>

    <!-- Scroll indicator -->
    <div ref="scrollIndicatorRef" class="absolute bottom-8 left-1/2 -translate-x-1/2 opacity-0 z-10">
      <div class="flex flex-col items-center gap-2 animate-bounce">
        <span class="text-sm text-gray-400">Scroll</span>
        <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
        </svg>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { TresCanvas } from '@tresjs/core'
import { OrbitControls, Sphere } from '@tresjs/cientos'
import { gsap } from 'gsap'

const gl = {
  alpha: true,
  antialias: true,
  clearColor: '#0F172A',
}

const sphereRef = ref()
const titleRef = ref()
const subtitleRef = ref()
const ctaRef = ref()
const scrollIndicatorRef = ref()

onMounted(() => {
  // Animate 3D sphere
  if (sphereRef.value) {
    const tl = gsap.timeline()

    tl.from(sphereRef.value.position, {
      y: -5,
      duration: 1.5,
      ease: 'bounce.out',
    })
    .to(sphereRef.value.rotation, {
      y: Math.PI * 2,
      duration: 20,
      ease: 'none',
      repeat: -1,
    }, 0)
  }

  // Animate text elements
  const textTl = gsap.timeline({ delay: 0.5 })

  textTl
    .to(titleRef.value, {
      opacity: 1,
      y: 0,
      duration: 1,
      ease: 'power3.out',
    })
    .to(subtitleRef.value, {
      opacity: 1,
      y: 0,
      duration: 0.8,
      ease: 'power3.out',
    }, '-=0.5')
    .to(ctaRef.value, {
      opacity: 1,
      y: 0,
      duration: 0.8,
      ease: 'power3.out',
    }, '-=0.5')
    .to(scrollIndicatorRef.value, {
      opacity: 1,
      duration: 0.5,
    }, '-=0.3')
})
</script>

<style scoped>
#hero {
  position: relative;
  isolation: isolate;
}
</style>
