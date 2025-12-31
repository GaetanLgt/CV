<template>
  <section id="features" class="section-container bg-secondary/30">
    <h2 ref="titleRef" class="section-title">
      Ce que je <span class="text-gradient">propose</span>
    </h2>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
      <div
        v-for="(feature, index) in features"
        :key="feature.title"
        ref="featureRefs"
        class="card group relative overflow-hidden opacity-0"
        :data-index="index"
      >
        <!-- Icon -->
        <div
          class="w-16 h-16 rounded-lg bg-accent/20 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform"
        >
          <component :is="feature.icon" class="w-8 h-8 text-accent" />
        </div>

        <!-- Content -->
        <h3 class="text-2xl font-bold mb-3">{{ feature.title }}</h3>
        <p class="text-gray-400 leading-relaxed">{{ feature.description }}</p>

        <!-- Decorative element -->
        <div
          class="absolute -bottom-10 -right-10 w-32 h-32 bg-accent/5 rounded-full blur-2xl group-hover:bg-accent/10 transition-colors"
        ></div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, h } from 'vue'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

const titleRef = ref()
const featureRefs = ref([])

// SVG icon components
const CodeIcon = () =>
  h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
    h('path', {
      'stroke-linecap': 'round',
      'stroke-linejoin': 'round',
      'stroke-width': '2',
      d: 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4',
    }),
  ])

const DesignIcon = () =>
  h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
    h('path', {
      'stroke-linecap': 'round',
      'stroke-linejoin': 'round',
      'stroke-width': '2',
      d: 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01',
    }),
  ])

const OptimizeIcon = () =>
  h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
    h('path', {
      'stroke-linecap': 'round',
      'stroke-linejoin': 'round',
      'stroke-width': '2',
      d: 'M13 10V3L4 14h7v7l9-11h-7z',
    }),
  ])

const ResponsiveIcon = () =>
  h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
    h('path', {
      'stroke-linecap': 'round',
      'stroke-linejoin': 'round',
      'stroke-width': '2',
      d: 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z',
    }),
  ])

const DatabaseIcon = () =>
  h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
    h('path', {
      'stroke-linecap': 'round',
      'stroke-linejoin': 'round',
      'stroke-width': '2',
      d: 'M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4',
    }),
  ])

const CloudIcon = () =>
  h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
    h('path', {
      'stroke-linecap': 'round',
      'stroke-linejoin': 'round',
      'stroke-width': '2',
      d: 'M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z',
    }),
  ])

const features = [
  {
    icon: CodeIcon,
    title: 'Développement Web',
    description: 'Création d\'applications web modernes avec les dernières technologies frontend et backend.',
  },
  {
    icon: DesignIcon,
    title: 'UI/UX Design',
    description: 'Conception d\'interfaces utilisateur élégantes et intuitives pour une expérience optimale.',
  },
  {
    icon: OptimizeIcon,
    title: 'Performance',
    description: 'Optimisation des performances pour des applications rapides et réactives.',
  },
  {
    icon: ResponsiveIcon,
    title: 'Responsive Design',
    description: 'Applications adaptées à tous les écrans, du mobile au desktop.',
  },
  {
    icon: DatabaseIcon,
    title: 'Bases de données',
    description: 'Architecture et gestion de bases de données relationnelles et NoSQL.',
  },
  {
    icon: CloudIcon,
    title: 'Cloud & DevOps',
    description: 'Déploiement et gestion d\'infrastructures cloud avec Docker et CI/CD.',
  },
]

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

  // Animate feature cards with stagger
  featureRefs.value.forEach((card, index) => {
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
