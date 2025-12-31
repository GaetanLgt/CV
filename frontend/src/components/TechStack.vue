<template>
  <section id="skills" class="section-container bg-secondary/30">
    <h2 ref="titleRef" class="section-title">
      Stack <span class="text-gradient">Technique</span>
    </h2>
    <p ref="subtitleRef" class="section-subtitle">
      Les technologies et outils que je maîtrise
    </p>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
      <div
        v-for="(category, index) in techStack"
        :key="category.name"
        ref="categoryRefs"
        class="card opacity-0"
      >
        <div class="flex items-center gap-3 mb-6">
          <div class="w-10 h-10 rounded-lg bg-accent/20 flex items-center justify-center">
            <component :is="category.icon" class="w-6 h-6 text-accent" />
          </div>
          <h3 class="text-xl font-bold">{{ category.name }}</h3>
        </div>

        <div class="space-y-4">
          <div v-for="skill in category.skills" :key="skill.name">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium">{{ skill.name }}</span>
              <span class="text-xs text-accent">{{ skill.level }}%</span>
            </div>
            <div class="h-2 bg-secondary rounded-full overflow-hidden">
              <div
                :ref="el => skill.barRef = el"
                class="h-full bg-gradient-to-r from-accent to-purple-600 rounded-full transition-all duration-1000"
                :style="{ width: '0%' }"
                :data-level="skill.level"
              ></div>
            </div>
          </div>
        </div>
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
const subtitleRef = ref()
const categoryRefs = ref([])

// Icons
const FrontendIcon = () =>
  h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
    h('path', {
      'stroke-linecap': 'round',
      'stroke-linejoin': 'round',
      'stroke-width': '2',
      d: 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
    }),
  ])

const BackendIcon = () =>
  h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
    h('path', {
      'stroke-linecap': 'round',
      'stroke-linejoin': 'round',
      'stroke-width': '2',
      d: 'M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01',
    }),
  ])

const ToolsIcon = () =>
  h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
    h('path', {
      'stroke-linecap': 'round',
      'stroke-linejoin': 'round',
      'stroke-width': '2',
      d: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z',
    }),
    h('path', {
      'stroke-linecap': 'round',
      'stroke-linejoin': 'round',
      'stroke-width': '2',
      d: 'M15 12a3 3 0 11-6 0 3 3 0 016 0z',
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

const DevOpsIcon = () =>
  h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
    h('path', {
      'stroke-linecap': 'round',
      'stroke-linejoin': 'round',
      'stroke-width': '2',
      d: 'M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z',
    }),
  ])

const MobileIcon = () =>
  h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
    h('path', {
      'stroke-linecap': 'round',
      'stroke-linejoin': 'round',
      'stroke-width': '2',
      d: 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z',
    }),
  ])

const techStack = [
  {
    name: 'Frontend',
    icon: FrontendIcon,
    skills: [
      { name: 'Vue.js / React', level: 90 },
      { name: 'JavaScript / TypeScript', level: 85 },
      { name: 'HTML / CSS / Tailwind', level: 95 },
      { name: 'Three.js / GSAP', level: 75 },
    ],
  },
  {
    name: 'Backend',
    icon: BackendIcon,
    skills: [
      { name: 'PHP / Symfony', level: 85 },
      { name: 'Node.js / Express', level: 80 },
      { name: 'API Platform / REST', level: 85 },
      { name: 'GraphQL', level: 70 },
    ],
  },
  {
    name: 'Database',
    icon: DatabaseIcon,
    skills: [
      { name: 'PostgreSQL / MySQL', level: 85 },
      { name: 'MongoDB', level: 75 },
      { name: 'Redis', level: 70 },
      { name: 'Elasticsearch', level: 65 },
    ],
  },
  {
    name: 'DevOps',
    icon: DevOpsIcon,
    skills: [
      { name: 'Docker / Docker Compose', level: 90 },
      { name: 'Git / GitHub', level: 95 },
      { name: 'CI/CD', level: 80 },
      { name: 'AWS / Cloud', level: 75 },
    ],
  },
  {
    name: 'Tools',
    icon: ToolsIcon,
    skills: [
      { name: 'VS Code', level: 95 },
      { name: 'Postman / Insomnia', level: 90 },
      { name: 'Figma', level: 75 },
      { name: 'Jira / Agile', level: 85 },
    ],
  },
  {
    name: 'Mobile',
    icon: MobileIcon,
    skills: [
      { name: 'React Native', level: 70 },
      { name: 'Responsive Design', level: 95 },
      { name: 'PWA', level: 80 },
      { name: 'Mobile First', level: 90 },
    ],
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

  // Animate category cards
  categoryRefs.value.forEach((card, index) => {
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

  // Animate skill bars
  techStack.forEach((category) => {
    category.skills.forEach((skill) => {
      if (skill.barRef) {
        gsap.to(skill.barRef, {
          scrollTrigger: {
            trigger: skill.barRef,
            start: 'top 85%',
          },
          width: `${skill.level}%`,
          duration: 1,
          ease: 'power2.out',
        })
      }
    })
  })
})
</script>
